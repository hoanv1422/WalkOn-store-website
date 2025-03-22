<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderBackup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    const PATH_VIEW = 'admin.orders.';
    const PATH_UPLOAD = 'orders';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::query();

        // Tìm kiếm theo mã đơn hàng, tên khách hàng, email hoặc tên người nhận
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('order_code', 'like', '%' . $search . '%')
                    ->orWhere('user_name', 'like', '%' . $search . '%')
                    ->orWhere('user_email', 'like', '%' . $search . '%')
                    ->orWhere('receiver_name', 'like', '%' . $search . '%');
            });
        }

        // Lọc theo trạng thái đơn hàng (nếu không chọn "Tất cả")
        if ($request->filled('order_status') && $request->input('order_status') !== 'all') {
            $query->where('order_status', $request->input('order_status'));
        }

        // Lọc theo phương thức thanh toán (nếu không chọn "Tất cả")
        if ($request->filled('payment_method') && $request->input('payment_method') !== 'all') {
            $query->where('payment_method', $request->input('payment_method'));
        }

        // Lọc theo ngày đặt hàng ( input date là 1 ngày cụ thể)
        if ($request->filled('date')) {
            try {
                // Giả sử input nhận được có định dạng "d M, Y" (ví dụ "21 Thg 03, 2025")
                $date = Carbon::createFromFormat('d M, Y', $request->input('date'))->format('Y-m-d');
                $query->whereDate('created_at', $date);
            } catch (\Exception $e) {
                // Nếu chuyển đổi thất bại, bạn có thể bỏ qua bộ lọc hoặc ghi log lỗi
            }
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(10);

        // Nếu là AJAX request thì trả về view partial
        if ($request->ajax()) {
            $view = view('admin.orders._orderTable', compact('orders'))->render();
            return response()->json(['html' => $view]);
        }

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     * Nếu cần, admin có thể tạo đơn hàng thủ công.
     */
    // public function create()
    // {
    //     return view(self::PATH_VIEW . 'create');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(StoreOrderRequest $request)
    // {
    //     // Xác thực dữ liệu và tạo đơn hàng mới
    //     $data = $request->validated();
    //     $order = Order::create($data);

    //     return redirect()->route('orders.index')
    //         ->with('success', 'Đơn hàng đã được tạo thành công.');
    // }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //  user, orderItems, và quan hệ auditsCustom 
        $order->load('user', 'orderItems', 'auditsCustom');

        // Tính toán subtotal 
        $subtotal = $order->orderItems->sum(function ($item) {
            return $item->product_price * $item->quantity;
        });

        $discount = $order->discount ?? 0;
        $shipping = $order->shipping_charge ?? 0;
        $tax = $order->tax ?? 0;

        // Tính tổng số tiền đơn hàng
        $total = $subtotal - $discount + $shipping + $tax;

        // Gán các giá trị vào đơn hàng
        $order->subtotal = $subtotal;
        $order->total_price = $total;

        return view('admin.orders.detail', compact('order'));
    }




    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Order $order)
    // {
    //     return view(self::PATH_VIEW . 'edit', compact('order'));
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        // Chỉ validate trường order_status
        $data = $request->validate([
            'order_status' => 'required|string',
        ]);

        $oldStatus = $order->order_status;
        $newStatus = $data['order_status'];

        // Nếu đơn hàng đã hủy thì không cho chuyển sang trạng thái khác
        if ($oldStatus === 'cancelled' && $newStatus !== 'cancelled') {
            $errorMsg = 'Đơn hàng đã bị hủy, không thể thay đổi trạng thái sang "' . $newStatus . '"!';
            if ($request->ajax()) {
                return response()->json(['error' => $errorMsg], 422);
            }
            return redirect()->back()->with('error', $errorMsg);
        }

        // Định nghĩa các luồng chuyển trạng thái hợp lệ
        $allowedTransitions = [
            'pending'    => ['confirmed', 'processing', 'cancelled'],
            'confirmed'  => ['processing', 'cancelled'],
            'processing' => ['shipped', 'cancelled'],
            'shipped'    => ['delivered'],
            'delivered'  => ['returned'],
            'returned'   => [],
            'cancelled'  => [],
        ];

        if (! in_array($newStatus, $allowedTransitions[$oldStatus])) {
            $errorMsg = "Chuyển trạng thái từ '$oldStatus' sang '$newStatus' không hợp lệ. Vui lòng kiểm tra lại quy trình chuyển trạng thái.";
            if ($request->ajax()) {
                return response()->json(['error' => $errorMsg], 422);
            }
            return redirect()->back()->with('error', $errorMsg);
        }

        // Chỉ cập nhật trường order_status, các trường khác không thay đổi
        $order->update(['order_status' => $newStatus]);

        if ($request->ajax()) {
            return response()->json(['success' => 'Đơn hàng đã được cập nhật thành công.']);
        }

        return redirect()->route('orders.index')
            ->with('success', 'Đơn hàng đã được cập nhật thành công.');
    }




    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Order $order)
    // {
    //     $order->delete();

    //     return redirect()->route('orders.index')
    //         ->with('success', 'Đơn hàng đã được xóa thành công.');
    // }
    public function updateStatus(Request $request, Order $order)
    {
        $data = $request->validate([
            'order_status' => 'required|string',
        ]);

        $oldStatus = $order->order_status;
        $newStatus = $data['order_status'];

        // Kiểm tra quy trình chuyển trạng thái 
        $allowedTransitions = [
            'pending'    => ['confirmed', 'processing', 'cancelled'],
            'confirmed'  => ['processing', 'cancelled'],
            'processing' => ['shipped', 'cancelled'],
            'shipped'    => ['delivered', 'cancelled'],
            'delivered'  => ['returned'],
            'returned'   => [],
            'cancelled'  => [],
        ];

        if (! in_array($newStatus, $allowedTransitions[$oldStatus])) {
            $mapping = [
                'pending'    => 'Chờ xử lý',
                'confirmed'  => 'Đã xác nhận',
                'processing' => 'Đang xử lý',
                'shipped'    => 'Đang giao',
                'delivered'  => 'Đã giao',
                'cancelled'  => 'Đã hủy',
                'returned'   => 'Trả hàng'
            ];
            $errorMsg = "Chuyển trạng thái từ '{$order->order_status_vn}' sang '" . ($mapping[$newStatus] ?? $newStatus) . "' không hợp lệ. Vui lòng kiểm tra lại quy trình chuyển trạng thái.";
            return redirect()->back()->with('error', $errorMsg);
        }

        // Cập nhật trạng thái
        $order->update(['order_status' => $newStatus]);

        return redirect()->route('orders.index')->with('success', 'Trạng thái đơn hàng đã được cập nhật thành công.');
    }

    public function cancel(Request $request, Order $order)
    {
        // Kiểm tra nếu đơn hàng đã bị hủy, thì không thực hiện lại
        if ($order->order_status === 'cancelled') {
            return redirect()->back()->with('error', 'Đơn hàng đã bị hủy.');
        }

        // Cập nhật trạng thái thành 'cancelled'
        $order->update(['order_status' => 'cancelled']);

        return redirect()->route('orders.index')->with('success', 'Đơn hàng đã được hủy thành công.');
    }
    /**
     * Hiển thị danh sách backup dựa trên bộ lọc.
     */
    public function showBackups(Request $request)
    {
        // Lấy bộ lọc từ request
        $orderCode = $request->input('order_code'); // Mã đơn hàng
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = OrderBackup::query();

        // Nếu có order_code, lọc theo đơn hàng đó
        if ($orderCode) {
            // Giả sử bạn có thể tìm đơn hàng theo order_code
            $order = Order::where('order_code', $orderCode)->first();
            if ($order) {
                $query->where('original_order_id', $order->id);
            }
        }

        // Lọc theo khoảng ngày (nếu được cung cấp)
        if ($startDate) {
            $query->whereDate('created_at', '>=', Carbon::parse($startDate));
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', Carbon::parse($endDate));
        }

        $backups = $query->orderBy('created_at', 'desc')->get();

        // Trả về view với danh sách backup
        return view('admin.orders.restore_backups', compact('backups'));
    }

    /**
     * Thực hiện restore một bản backup cụ thể.
     *
     * @param int $backupId
     */
    public function restoreBackup($backupId)
    {
        $backup = OrderBackup::find($backupId);

        if (!$backup) {
            return redirect()->back()->with('error', 'Không tìm thấy bản backup nào.');
        }

        $order = Order::find($backup->original_order_id);
        if (!$order) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn hàng gốc.');
        }

        $data = json_decode($backup->data, true);
        // Loại bỏ các trường không cần thiết
        unset($data['id'], $data['created_at'], $data['updated_at']);

        $order->update($data);

        return redirect()->route('orders.index')
            ->with('success', 'Đơn hàng đã được khôi phục thành công từ bản backup.');
    }
    public function restoreBackupsByDate(Request $request)
{
    $date = $request->input('date');
    if (!$date) {
        return redirect()->back()->with('error', 'Bạn chưa chọn ngày để khôi phục.');
    }

    $backups = OrderBackup::whereDate('created_at', $date)->orderBy('created_at', 'desc')->get();

    if ($backups->isEmpty()) {
        return redirect()->back()->with('error', "Không có bản backup nào cho ngày {$date}.");
    }

    $restoredCount = 0;
    foreach ($backups as $backup) {
        $order = Order::find($backup->original_order_id);
        if ($order) {
            $data = json_decode($backup->data, true);
            unset($data['id'], $data['created_at'], $data['updated_at']);
            $order->update($data);
            $restoredCount++;
        }
    }

    return redirect()->route('orders.index')
           ->with('success', "Đã khôi phục thành công {$restoredCount} đơn hàng từ bản backup ngày {$date}.");
}

}

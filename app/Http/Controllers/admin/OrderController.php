<?php

namespace App\Http\Controllers\Admin;

use App\Events\OrderStatusChanged;
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

        // Lọc theo trạng thái đơn hàng 
        if ($request->filled('order_status') && $request->input('order_status') !== 'all') {
            $query->where('order_status', $request->input('order_status'));
        }

        // Lọc theo phương thức thanh toán (nếu không chọn "Tất cả")
        if ($request->filled('payment_method') && $request->input('payment_method') !== 'all') {
            $query->where('payment_method', $request->input('payment_method'));
        }

        // Lọc theo ngày đặt hàng 
        if ($request->filled('date')) {
            try {
                $date = Carbon::createFromFormat('d M, Y', $request->input('date'))->format('Y-m-d');
                $query->whereDate('created_at', $date);
            } catch (\Exception $e) {
            }
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(10);

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
        $data = $request->validate([
            'order_status' => 'required|string',
        ]);
    
        $oldStatus = $order->order_status;
        $newStatus = $data['order_status'];
    
        // Nếu đơn hàng đã bị hủy thì không cho phép chuyển sang trạng thái khác
        if ($oldStatus === 'cancelled' && $newStatus !== 'cancelled') {
            $errorMsg = 'Đơn hàng đã bị hủy, không thể thay đổi trạng thái sang "' 
                . Order::getStatusVn($newStatus) . '"!';
            return $request->ajax()
                ? response()->json(['error' => $errorMsg], 422)
                : redirect()->back()->with('error', $errorMsg);
        }
    
        // Chỉ cho phép huỷ đơn hàng nếu thanh toán bằng COD
        if ($newStatus === 'cancelled' && strtolower($order->payment_method) !== 'cod') {
            $errorMsg = 'Đơn hàng thanh toán online không được hủy.';
            return $request->ajax()
                ? response()->json(['error' => $errorMsg], 422)
                : redirect()->back()->with('error', $errorMsg);
        }
    
        // Định nghĩa các luồng chuyển trạng thái hợp lệ
        $allowedTransitions = [
            'pending'    => ['confirmed', 'processing', 'cancelled'],
            'confirmed'  => ['processing', 'cancelled'],
            'processing' => ['ready', 'cancelled'],
            'ready'      => ['shipped', 'cancelled'],
            'shipped'    => ['delivered'],
            'delivered'  => ['returned'],
            'cancelled'  => [],
            'returned'   => ['completed'],
            'completed'  => [],
        ];
    
        // Kiểm tra chuyển trạng thái hợp lệ
        if (! in_array($newStatus, $allowedTransitions[$oldStatus] ?? [])) {
            $errorMsg = "Chuyển trạng thái từ '{$order->order_status_vn}' sang '" 
                . Order::getStatusVn($newStatus)
                . "' không hợp lệ. Vui lòng kiểm tra lại quy trình chuyển trạng thái.";
            return $request->ajax()
                ? response()->json(['error' => $errorMsg], 422)
                : redirect()->back()->with('error', $errorMsg);
        }
    
        // Kiểm tra nghiệp vụ: chỉ cho phép hoàn hàng khi đơn hàng thanh toán bằng COD
        if ($newStatus === 'returned' && strtolower($order->payment_method) !== 'cod') {
            $errorMsg = 'Chỉ cho phép hoàn hàng đối với đơn hàng thanh toán bằng COD.';
            return $request->ajax()
                ? response()->json(['error' => $errorMsg], 422)
                : redirect()->back()->with('error', $errorMsg);
        }
    
        // Cập nhật trạng thái đơn hàng
        $order->update(['order_status' => $newStatus]);

        event(new OrderStatusChanged($order));

        
    
        return $request->ajax()
            ? response()->json(['success' => 'Đơn hàng đã được cập nhật thành công.'])
            : redirect()->route('orders.index')
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
    
        // Chỉ cho phép huỷ đơn hàng nếu thanh toán bằng COD
        if ($newStatus === 'cancelled' && strtolower($order->payment_method) !== 'cod') {
            $errorMsg = 'Đơn hàng thanh toán online không được hủy.';
            return redirect()->back()->with('error', $errorMsg);
        }
    
        // Định nghĩa các luồng chuyển trạng thái hợp lệ
        $allowedTransitions = [
            'pending'    => ['confirmed', 'processing', 'cancelled'],
            'confirmed'  => ['processing', 'cancelled'],
            'processing' => ['ready', 'cancelled'],
            'ready'      => ['shipped', 'cancelled'],
            'shipped'    => ['delivered', 'cancelled'],
            'delivered'  => ['returned'],
            'cancelled'  => [],
            'returned'   => ['completed'],
            'completed'  => [],
        ];
    
        if (! in_array($newStatus, $allowedTransitions[$oldStatus] ?? [])) {
            $errorMsg = "Chuyển trạng thái từ '{$order->order_status_vn}' sang '" 
                . Order::getStatusVn($newStatus)
                . "' không hợp lệ. Vui lòng kiểm tra lại quy trình chuyển trạng thái.";
            return redirect()->back()->with('error', $errorMsg);
        }
    
        // Kiểm tra nghiệp vụ: chỉ cho phép hoàn hàng khi đơn hàng thanh toán bằng COD
        if ($newStatus === 'returned' && strtolower($order->payment_method) !== 'cod') {
            $errorMsg = 'Chỉ cho phép hoàn hàng đối với đơn hàng thanh toán bằng COD.';
            return redirect()->back()->with('error', $errorMsg);
        }
    
        // Cập nhật trạng thái đơn hàng
        $order->update(['order_status' => $newStatus]);
    
        return redirect()->route('orders.index')
            ->with('success', 'Trạng thái đơn hàng đã được cập nhật thành công.');
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
}

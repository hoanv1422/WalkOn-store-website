<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderBackup;
use Illuminate\Http\Request;
use App\Events\OrderStatusChanged;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

        $old = $order->order_status;
        $new = $data['order_status'];

        // 1) Đơn hàng đã hủy rồi thì không thay được sang khác
        if ($old === 'cancelled' && $new !== 'cancelled') {
            $payload = [
                'code'  => 'already_cancelled',
                'error' => 'Đơn hàng đã bị hủy trước đó, không thể chuyển trạng thái nữa.',
            ];
            return response()->json($payload, 422);
        }

        // 2) Chỉ cho phép huỷ nếu COD
        if ($new === 'cancelled' && strtolower($order->payment_method) !== 'cod') {
            $payload = [
                'code'  => 'cancel_non_cod',
                'error' => 'Chỉ có đơn COD mới được phép hủy.',
            ];
            return response()->json($payload, 422);
        }

        // 3) Kiểm tra luồng chuyển trạng thái hợp lệ
        $allowed = [
            'pending'    => ['confirmed', 'processing', 'cancelled'],
            'confirmed'  => ['processing', 'cancelled'],
            'processing' => ['ready', 'cancelled'],
            'ready'      => ['picking_up', 'shipping', 'cancelled'],
            'picking_up' => ['shipping', 'cancelled'],
            'shipping'   => ['delivered', 'returned'],
            'delivered'  => ['completed', 'returned'],
            'returned'   => [],
            'cancelled'  => [],
            'completed'  => [],
        ];
        if (! in_array($new, $allowed[$old] ?? [])) {
            $payload = [
                'code'  => 'invalid_transition',
                'error' => "Không thể chuyển từ “{$order->order_status_vn}” sang “" . Order::getStatusVn($new) . "”.",
            ];
            return response()->json($payload, 422);
        }

        // 4) Chỉ cho phép hoàn hàng nếu COD
        if ($new === 'returned' && strtolower($order->payment_method) !== 'cod') {
            $payload = [
                'code'  => 'return_non_cod',
                'error' => 'Chỉ có đơn COD mới được phép hoàn hàng.',
            ];
            return response()->json($payload, 422);
        }

        // Nếu qua hết, update bình thường
        $order->update(['order_status' => $new]);
        event(new OrderStatusChanged($order));

        return response()->json(['success' => 'Cập nhật trạng thái thành công.']);
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


    // public function cancel(Request $request, Order $order)
    // {
    //     // Danh sách trạng thái không thể hủy
    //     $nonCancellableStatuses = ['cancelled', 'completed', 'delivered'];

    //     // Kiểm tra điều kiện
    //     if (in_array($order->order_status, $nonCancellableStatuses)) {
    //         $message = match ($order->order_status) {
    //             'cancelled' => 'Đơn hàng đã bị hủy trước đó',
    //             'completed' => 'Đơn hàng đã hoàn tất không thể hủy',
    //             'delivered' => $order->payment_status === 'COD'
    //                 ? 'Đơn COD đã giao không thể hủy'
    //                 : 'Đơn hàng đã giao không thể hủy',
    //             default => 'Không thể hủy đơn hàng ở trạng thái này'
    //         };

    //         return redirect()->back()->with('error', $message);
    //     }

    //     try {
    //         DB::beginTransaction();

    //         // Cập nhật trạng thái
    //         $order->update([
    //             'order_status' => 'cancelled',
    //             'cancelled_at' => now(),
    //             'cancelled_by' => auth()->id()
    //         ]);


    //         $this->handleOrderCancellation($order);

    //         DB::commit();

    //         return redirect()->route('orders.index')
    //             ->with('success', "Đã hủy đơn hàng #{$order->id} thành công");
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         Log::error("Lỗi hủy đơn {$order->id}: " . $e->getMessage());
    //         return redirect()->back()
    //             ->with('error', 'Lỗi hệ thống khi hủy đơn hàng');
    //     }
    // }
}

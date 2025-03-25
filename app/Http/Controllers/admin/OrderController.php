<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
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
    public function index()
    {
        $orders = Order::with('orderItems')->orderBy('created_at', 'desc')->get();
        $products = Product::all(); 
        return view(self::PATH_VIEW . 'index', compact('orders', 'products'));
    
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
        // Tải các quan hệ cần thiết: user và orderItems
        $order->load('user', 'orderItems');
    
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
    public function edit(Order $order)
    {
        return view(self::PATH_VIEW . 'edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
{

    $data = $request->validate([
        'order_code'       => 'required|string|max:255',
        'customer_name'    => 'required|string|max:255',
        'order_date'       => 'required|date',
        'total_price'      => 'required|numeric|min:0',
        'payment_method'   => 'required|string',
        'order_status'     => 'required|string',
    ]);

    $order->update($data);

    return redirect()->route('orders.index')
        ->with('success', 'Đơn hàng đã được cập nhật thành công.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Đơn hàng đã được xóa thành công.');
    }
}

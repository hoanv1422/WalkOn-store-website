<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShipperController extends Controller
{
    public function index(){
        $orders_shipped = DB::table('order_items as oi')
            ->join('orders as o', 'oi.order_id', '=', 'o.id')
            ->select(
                'oi.product_name',
                'oi.product_image',
                'oi.variant_size_name',
                'oi.variant_color_name',
                'oi.quantity',
                'o.id',
                'o.order_code',
                'o.receiver_address',
                'o.receiver_phone',
                'o.final_price'
            )
            ->where('o.order_status', 'shipped')
            ->get();
        $orders_delivered = DB::table('order_items as oi')
            ->join('orders as o', 'oi.order_id', '=', 'o.id')
            ->select(
                'oi.product_name',
                'oi.product_image',
                'oi.variant_size_name',
                'oi.variant_color_name',
                'oi.quantity',
                'o.id',
                'o.order_code',
                'o.receiver_address',
                'o.receiver_phone',
                'o.final_price'
            )
            ->where('o.order_status', 'delivered')
            ->get();
        $count_shipped = DB::table('orders')->where('order_status', 'shipped')->count();
        $count_delivered = DB::table('orders')->where('order_status', 'delivered')->count();
        return view('admin.shippers.index', compact('orders_shipped', 'orders_delivered', 'count_shipped', 'count_delivered'));
    }
    public function delivered($id)
    {
        $order = Order::find($id);
        
        $order->order_status = 'delivered';
        $order->save();
     
        return redirect()->back()->with('success', 'Đơn hàng đã được hoàn thành.');

    }
}
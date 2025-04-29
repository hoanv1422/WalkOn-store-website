<?php

namespace App\Http\Controllers\shipper;

use App\Http\Controllers\Controller;
use App\Models\Courier;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShipperController extends Controller
{
    public function index() {
        return view('shipper.index');
    }


    public function loadOrderForShipper()
    {
        $userId = Auth::id();

        $courier = Courier::where('user_id', $userId)->first();

        if (!$courier) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy thông tin courier cho người dùng này',
            ], 404);
        }

        $orders = Order::where('courier_id', $courier->id)
            ->with('customer:name,email')
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'courier' => $courier,
                'orders' => $orders,
            ],
        ], 200);
    }


    public function delivered($id)
    {
        $order = Order::find($id);

        $order->order_status = 'delivered';
        $order->save();

        return redirect()->back()->with('success', 'Đơn hàng đã được hoàn thành.');
    }
}

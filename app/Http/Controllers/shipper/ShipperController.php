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

    public function updateStatus(Request $request, $id)
    {

        // return response()->json([
        //     'success' => false,
        //     'message' => $id,
        // ], 404);

        $request->validate([
            'status' => 'required|in:ready,picking_up,shipping,delivered',
        ]);

        $userId = Auth::id();
        $courier = Courier::where('user_id', $userId)->first();

       
        if (!$courier) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy thông tin courier',
            ], 404);
        }

        $order = Order::where('id', $id)
            ->where('courier_id', $courier->id)
            ->first();
      

    



        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy đơn hàng',
            ], 404);
        }


        $order->order_status = $request->status;
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật trạng thái thành công',
        ], 200);
    }
}

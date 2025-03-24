<?php

namespace App\Http\Controllers\Client;

use App\Models\Cart;
use App\Models\Order;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    
    public function index(Request $request)
    {
        $user = Auth::id();
        $cart = Cart::where("user_id", $user)->first();

        if (!$cart) {
            return view('client.pages.checkout.index', [
                "cartItems" => [],
                "totalAmount" => 0
            ]);
        }

        $cartItems = CartItem::where("cart_id", $cart->id)->get();

        $totalAmount = $cartItems->sum(function ($item) {
            $unitPrice = $item->productVariant->price_sale && $item->productVariant->price_sale < $item->productVariant->price
                ? $item->productVariant->price_sale
                : $item->productVariant->price;

            return $unitPrice * $item->quantity;
        });

        return view('client.pages.checkout.index', compact("cartItems", "totalAmount"));
    }
    public function update(Request $request, Order $order)
    {
        // Validate dữ liệu từ form
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'order_date' => 'required|date',
            'total_price' => 'required|numeric',
            'payment_method' => 'required|string',
            'order_status' => 'required|string',
        ]);

        // Cập nhật thông tin đơn hàng
        $order->update([
            'user_name' => $validated['customer_name'], // Map form field 'customer_name' vào cột 'user_name'
            'created_at' => $validated['order_date'],
            'total_price' => $validated['total_price'],
            'payment_method' => $validated['payment_method'],
            'order_status' => $validated['order_status'],
        ]);

        return redirect()->back()->with('success', 'Cập nhật đơn hàng thành công!');
    }
}

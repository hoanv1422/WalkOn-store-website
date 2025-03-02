<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $userId = 1;

        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart) {
            return redirect()->route('cart.list')->with('message', 'Giỏ hàng của bạn đang trống.');
        }

        $cartItems = CartItem::where('cart_id', $cart->id)->get();

        // if ($cartItems->isEmpty()) {
        //     return redirect()->route('cart.list')->with('message', 'Giỏ hàng của bạn đang trống.');
        // }

        // dd($cartItems);

        $subtotal = 0;

        foreach ($cartItems as $item) {
            $subtotal += $item->price * $item->quantity;
        }

        return view('client.pages.checkout.index', compact('subtotal', 'cartItems'));
    }


    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'phone' => ['required', 'regex:/^0[0-9]{9,10}$/'],
            'receiver_name' => 'required|string|max:255',
            'receiver_email' => 'required|email|max:255',
            'receiver_phone' => ['required', 'regex:/^0[0-9]{9,10}$/'],
            'receiver_address' => 'required|string|max:500',
            'note' => 'nullable|string|max:1000',

        ], [
            'phone.required' => 'Số điện thoại không được để trống.',
            'phone.regex' => 'Số điện thoại không hợp lệ.',
            'receiver_name.required' => 'Tên người nhận không được để trống.',
            'receiver_email.required' => 'Email người nhận không được để trống.',
            'receiver_email.email' => 'Email không hợp lệ.',
            'receiver_phone.required' => 'Số điện thoại người nhận không được để trống.',
            'receiver_phone.regex' => 'Số điện thoại người nhận không hợp lệ.',
            'receiver_address.required' => 'Địa chỉ người nhận không được để trống.',
            'note.max' => 'Ghi chú không được quá 1000 ký tự.',
        ]);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thanh toán.');
        }

        $cart = Cart::where('user_id', $user->id)->first();
        if (!$cart) {
            return redirect()->route('cart.list')->with('error', 'Giỏ hàng của bạn trống.');
        }

        $cartItems = CartItem::where('cart_id', $cart->id)->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.list')->with('error', 'Giỏ hàng trống.');
        }

        // Tính tổng tiền
        $subtotal = $cartItems->sum(function ($item) {
            return $item->quantity * ($item->productVariant->product->gia_khuyen_mai ?? $item->productVariant->product->gia_san_pham);
        });
        $total = $subtotal;

        // Tạo đơn hàng mới
        $order = Order::create([
            'user_id' => $user->id,
            'user_email' => $user->email,
            'user_name' => $user->username,
            'user_address' => $user->address,
            'user_phone' => $request->phone,
            'receiver_name' => $request->receiver_name,
            'receiver_email' => $request->receiver_email,
            'receiver_phone' => $request->receiver_phone,
            'receiver_address' => $request->receiver_address,
            'note' => $request->note,
            'payment_method' => $request->payment_method,
            'order_status' => 'pending',
            'subtotal' => $subtotal,
            'total_price' => $total,
        ]);

        // Lưu từng sản phẩm vào `order_items`
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_variant_id' => $item->product_variant_id,
                'product_name' => $item->productVariant->product->name,
                'product_sku' => $item->productVariant->product->sku,
                'product_image' => $item->productVariant->product->image,
                'product_price' => $item->productVariant->product->gia_san_pham,
                'product_price_sale' => $item->productVariant->product->gia_khuyen_mai,
                'variant_size_name' => $item->productVariant->size->size,
                'variant_color_name' => $item->productVariant->color->color,
                'quantity' => $item->quantity,
            ]);
        }

        // Xóa giỏ hàng sau khi đặt hàng thành công
        CartItem::where('cart_id', $cart->id)->delete();

        return redirect()->route('orders.success')->with('success', 'Đơn hàng của bạn đã được đặt thành công.');
    }
}

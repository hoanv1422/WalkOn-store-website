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
use Illuminate\Support\Str;


class CheckoutController extends Controller
{

    public function store(Request $request)
    {

        // dd($request->all());
        try {
            // Validate dữ liệu đầu vào
            $request->validate([
                'receiver_name' => 'required|string|max:255',
                'receiver_email' => 'required|email|max:255',
                'receiver_phone' => ['required', 'regex:/^0[0-9]{9,10}$/'],
                'receiver_address' => 'required|string|max:500',
                'note' => 'nullable|string|max:1000',
            ], [
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

            $order = Order::create([
                'order_code' => 'ORD' . date('YmdHis') . strtoupper(Str::random(4)),
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
                'coupon' => null,
                'order_status' => 'pending',
                'payment_status' => 'unpaid',
                'payment_method' => $request->payment_method,
                'total_price' => $request->total_price,
            ]);


            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_variant_id' => $item->product_variant_id,
                    'product_name' => $item->productVariant->product->name,
                    'product_sku' => $item->productVariant->product->sku,
                    'product_image' => $item->productVariant->image,
                    'product_price' => $item->productVariant->price,
                    'product_price_sale' => $item->productVariant->price_sale,
                    'variant_size_name' => $item->productVariant->size->size,
                    'variant_color_name' => $item->productVariant->color->color,
                    'quantity' => $item->quantity,
                ]);
            }

            CartItem::where('cart_id', $cart->id)->delete();

            return redirect()->route('cart.index')->with('success', 'Đơn hàng của bạn đã được đặt thành công.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi đặt đơn hàng. Vui lòng thử lại!');
        }
    }
}

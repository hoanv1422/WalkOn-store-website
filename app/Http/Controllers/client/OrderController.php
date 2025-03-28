<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        try {

            $userId = Auth::id();
            $addresses = Address::query()->where('user_id', $userId)->get();
            $addressDefault = Address::query()->where('user_id', $userId)->where('is_default', 1)->first();
            $cart = Cart::query()->where('user_id', $userId)->first();
            $cartItemId = $request->cartItems;
            $cartItemIds = explode(',', $request->cartItems);
            $cartItems = CartItem::query()->where('cart_id', $cart->id)->whereIn('id', $cartItemIds)->get();
            $totalPrice = 0;
            foreach($cartItems as $item) {
                 if ($item->productVariant->price_sale && $item->productVariant->price_sale < $item->productVariant->price) {
                   $totalPrice += $item->productVariant->price_sale * $item->quantity;
                 } else {
                    $totalPrice += $item->productVariant->price * $item->quantity;
                }

                
            }            
            return view('client.pages.checkout.index', compact("cartItems", "cartItemId" ,"totalPrice", "addresses", "addressDefault"));
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra');
        }
        
    }


    public function applyCoupon(Request $request)
    {
        // dd($request->all());

        $user = auth()->user();
        $code = $request->couponCode;
        $totalPrice = $request->totalPrice;
        $cartItemIds = $request->cartItemsForCoupon;
        $shippingFee = $request->shippingFeeForCoupon;

        $discount = 0;
        $shippingDiscount = 0;

        $coupon = Coupon::where('code', $code)->where('is_active', 1)->first();
        if (!$coupon) {
            return response()->json(['message' => 'Mã không hợp lệ'], 400);
        }

        $now = now();
        if ($coupon->start_time > $now || $coupon->end_time < $now) {
            return response()->json(['message' => 'Mã đã hết hạn'], 400);
        }

        if ($coupon->max_uses && Order::where('coupon_id', $coupon->id)->count() >= $coupon->max_uses) {
            return response()->json(['message' => 'Mã đã đạt giới hạn sử dụng'], 400);
        }

        if ($coupon->max_uses_per_user && Order::where('coupon_id', $coupon->id)->where('user_id', $user->id)->count() >= $coupon->max_uses_per_user) {
            return response()->json(['message' => 'Bạn đã sử dụng mã này quá số lần'], 400);
        }

        if ($totalPrice < $coupon->minimum_order_value) {
            return response()->json(['message' => 'Đơn hàng không đủ điều kiện để áp dụng mã'], 400);
        }
        $cartItems = CartItem::query()->whereIn('id', $cartItemIds)->get();
        $applicableCategories = $coupon->categories->pluck('id')->toArray();
        $applicableBrands = $coupon->brands->pluck('id')->toArray();

        $valid = false;
        foreach ($cartItems as $item) {
            if (
                in_array($item->productVariant->product->category_id, $applicableCategories) ||
                in_array($item->productVariant->product->brand_id, $applicableBrands)
            ) {
                $valid = true;
                break;
            }
        }

        if (!$valid) {
            return response()->json(['message' => 'Mã không áp dụng cho sản phẩm trong giỏ hàng'], 400);
        }

        if ($coupon->discount_type === 'percentage') {
            $discount = min(($totalPrice * $coupon->discount_value) / 100, $coupon->maximum_discount_amount);
        } elseif ($coupon->discount_type === 'fixed') {
            $discount = min($coupon->discount_value, $totalPrice);
        } elseif ($coupon->discount_type === 'freeship') {
            $shippingDiscount = min($shippingFee, $coupon->max_shipping_discount ?? $shippingFee);
        }

        $finalPrice = $totalPrice - $discount + $shippingFee - $shippingDiscount;

        return response()->json([
            'message' => 'Áp dụng mã thành công',
            'discount' => $discount,
            'shipping_discount' => $shippingDiscount,
            'finalPrice' => $finalPrice
        ]);
    }
}

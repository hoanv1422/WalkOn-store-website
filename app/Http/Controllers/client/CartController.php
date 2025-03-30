<?php

namespace App\Http\Controllers\Client;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $cartItems = CartItem::with([
            'productVariant.product',
            'productVariant.size',
            'productVariant.color'
        ])
            ->whereHas('cart', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->orderBy('id', 'asc')
            ->get();

        return view('client.pages.cart.index', compact('cartItems'));
    }


    public function addToCart(Request $request, $id)
    {
        try {
            $user = Auth::user();
            $sizeId = $request->input('size');
            $colorId = $request->input('color');
            $quantity = $request->input('quantity');

            $productVariant = ProductVariant::with('product')
                ->where('product_id', $id)
                ->where('size_id', $sizeId)
                ->where('color_id', $colorId)
                ->select('id', 'price', 'quantity')
                ->first();

            if (!$productVariant) {
                return redirect()->back()->with('error', 'Biến thể sản phẩm không tồn tại!');
            }

            $request->validate([
                'size' => 'required',
                'color' => 'required',
                'quantity' => [
                    'required',
                    'numeric',
                    'min:1',
                    function ($attribute, $value, $fail) use ($productVariant) {
                        if ($value > $productVariant->quantity) {
                            $fail("Số lượng tồn kho không đủ! Chỉ còn {$productVariant->quantity} sản phẩm.");
                        }
                    },
                ],
            ], [
                'size.required' => 'Vui lòng chọn kích cỡ.',
                'color.required' => 'Vui lòng chọn màu sắc.',
                'quantity.required' => 'Vui lòng nhập số lượng.',
                'quantity.numeric' => 'Số lượng phải là số.',
                'quantity.min' => 'Số lượng tối thiểu là 1.',
            ]);

            $cart = Cart::firstOrCreate(
                ['user_id' => $user->id],
                ['user_id' => $user->id]
            );

            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('product_variant_id', $productVariant->id)
                ->first();

            if ($cartItem) {
                $newQuantity = $cartItem->quantity + $quantity;
                if ($newQuantity > $productVariant->quantity) {
                    return redirect()->back()->with('error', "Số lượng tồn kho không đủ! Chỉ còn {$productVariant->quantity} sản phẩm.");
                }
                $cartItem->update(['quantity' => $newQuantity]);
            } else {
                // Thêm mới nếu sản phẩm chưa có
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_variant_id' => $productVariant->id,
                    'quantity' => $quantity,
                ]);
            }

            return back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng. Vui lòng thử lại!');
        }
    }




    public function delete($cartItemId)
    {
        $cartItem = DB::table('cart_items')->where('id', $cartItemId)->first();
        DB::table('cart_items')->where('id', $cartItemId)->delete();
        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng!');
    }
    public function updateCart(Request $request, $cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);

        // Cập nhật số lượng sản phẩm
        $cartItem->update([
            'quantity' => $request->quantity
        ]);

        return redirect()->route('cart.index')->with('success', 'Giỏ hàng đã được cập nhật!');
    }

    public function clearCartItems()
    {
        $userId = Auth::user(); 

        DB::table('cart_items')->whereIn('cart_id', function ($query) use ($userId) {
            $query->select('id')->from('carts')->where('user_id', $userId);
        })->delete();

        return redirect()->route('cart.index')->with('success', 'Tất cả sản phẩm trong giỏ hàng đã được xóa!');
    }

    public function applyCoupon(Request $request)
    {
        $user = auth()->user();
        $code = $request->couponCode;
        $totalPrice = $request->totalPrice;
        $cartItemIds = explode(',', $request->cartItemsForCoupon);
        $shippingFee = 20000;
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
            $discount = ($totalPrice * $coupon->discount_value) / 100;
            if ($coupon->max_shipping_discount) {
                $discount = min($discount, $coupon->max_shipping_discount);
            }
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
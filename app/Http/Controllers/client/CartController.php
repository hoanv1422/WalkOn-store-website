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

    public function addToCart(Request $request)
    {
            try {
            $user = Auth::user();
            $productId = $request->input('product_id');
            $sizeId = $request->input('size');
            $colorId = $request->input('color');
            $quantity = $request->input('quantity');

            $productVariant = ProductVariant::with('product')
                ->where('product_id', $productId)
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
            // return 1;
            return back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e);
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng. Vui lòng thử lại!');
        }
    }

    public function addToCartAPI(Request $request)
    {
        try {
            $user = Auth::user();
            $productId = $request->input('product_id');
            $sizeId = $request->input('size');
            $colorId = $request->input('color');
            $quantity = $request->input('quantity');

            $productVariant = ProductVariant::with('product')
                ->where('product_id', $productId)
                ->where('size_id', $sizeId)
                ->where('color_id', $colorId)
                ->select('id', 'price', 'quantity')
                ->first();

            if (!$productVariant) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Mời chọn đầy đủ thông tin !'
                ], 404);
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
                    return response()->json([
                        'status' => 'error',
                        'message' => "Số lượng tồn kho không đủ! Chỉ còn {$productVariant->quantity} sản phẩm."
                    ], 400);
                }
                $cartItem->update(['quantity' => $newQuantity]);
            } else {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_variant_id' => $productVariant->id,
                    'quantity' => $quantity,
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Sản phẩm đã được thêm vào giỏ hàng!',
                'data' => [
                    'cart_id' => $cart->id,
                    'product_variant_id' => $productVariant->id,
                    'quantity' => $quantity
                ]
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng. Vui lòng thử lại!',
                'error_details' => $e->getMessage()
            ], 500);
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
}

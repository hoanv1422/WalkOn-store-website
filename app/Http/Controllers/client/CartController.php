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
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function indexPage()
    {
        return view('client.pages.cart.index');
    }

    public function index()
    {
        $userId = Auth::id();

        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }

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

        // Transform the data to include formatted prices
        $cartItems = $cartItems->map(function ($item) {
            $item->formatted_price = $item->productVariant->price_sale && $item->productVariant->price_sale < $item->productVariant->price
                ? $item->productVariant->price_sale * $item->quantity
                : $item->productVariant->price * $item->quantity;

            return $item;
        });

        return response()->json([
            'success' => true,
            'data' => $cartItems
        ]);
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

    public function destroy($cartItemId)
    {

        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        try {
            $cartItem = CartItem::query()->where('id', $cartItemId)->first();

            if (!$cartItem) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sản phẩm không tồn tại trong giỏ hàng!'
                ], 404);
            }

            $cartItem = CartItem::query()->where('id', $cartItemId)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi xóa sản phẩm!'
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = CartItem::find($request->cart_item_id);

        if (!$cartItem) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy sản phẩm trong giỏ hàng.'
            ], 404);
        }

        $productVariant = $cartItem->productVariant;

        if (!$productVariant) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy biến thể sản phẩm.'
            ], 404);
        }

        if ($request->quantity > $productVariant->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Số lượng yêu cầu vượt quá tồn kho. Còn lại: ' . $productVariant->quantity . ' sản phẩm.'
            ], 422);
        }

        $cartItem->update([
            'quantity' => $request->quantity
        ]);

        $effectivePrice = $productVariant->price_sale ?? $productVariant->price;
        $itemTotalPrice = $cartItem->quantity * $effectivePrice;

        return response()->json([
            'success' => true,
            'message' => 'Giỏ hàng đã được cập nhật!',
            'cart_item' => $cartItem,
            'item_total_price_raw' => $itemTotalPrice,
            'item_total_price' => number_format($itemTotalPrice, 0, ',', '.')
        ]);
    }

    public function clear()
    {
        $userId = Auth::id();
        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated',
            ], 401);
        }

        DB::beginTransaction();
        try {
            $deleted = CartItem::whereHas('cart', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => $deleted ? 'Tất cả sản phẩm trong giỏ hàng đã được xóa!' : 'Giỏ hàng đã trống.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Clear cart error: {$e->getMessage()}");
            return response()->json([
                'success' => false,
                'message' => 'Không thể xóa giỏ hàng. Vui lòng thử lại sau.',
            ], 500);
        }
    }

    public function indexHeader()
    {
        if (!Auth::check()) {
            return response()->json([
                'items' => [],
                'cartCount' => 0,
                'subTotal' => 0,
            ], 200);
        }

        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart) {
            return response()->json([
                'items' => [],
                'cartCount' => 0,
                'subTotal' => 0,
            ], 200);
        }

        $allCartItems = CartItem::where('cart_id', $cart->id)
            ->with(['productVariant.product', 'productVariant.size', 'productVariant.color'])
            ->get();

        $cartItems = $allCartItems->take(2); // Limit to 2 items for display
        $cartCount = $allCartItems->count();
        $subTotal = $allCartItems->sum('price');



        return response()->json([
            'items' => $cartItems->map(function ($item) {
                $displayPrice = $item->productVariant->price_sale !== null && $item->productVariant->price_sale > 0
                    ? $item->productVariant->price_sale
                    : $item->productVariant->price;
                return [
                    'id' => $item->id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'productVariant' => [
                        'image' => $item->productVariant->image ? asset('storage/' . $item->productVariant->image) : null,
                        'price' => $displayPrice,
                        'size' => ['size' => $item->productVariant->size->size],
                        'color' => ['color' => $item->productVariant->color->color],
                        'product' => [
                            'name' => $item->productVariant->product->name,
                            'slug' => $item->productVariant->product->slug,
                        ],
                    ],
                ];
            }),
            'cartCount' => $cartCount,
            'subTotal' => $subTotal,
        ], 200);
    }
}

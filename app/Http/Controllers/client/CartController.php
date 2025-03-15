<?php

namespace App\Http\Controllers\Client;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;

        $cartItems = DB::table('cart_items')
            ->join('product_variants', 'cart_items.product_variant_id', '=', 'product_variants.id')
            ->join('products', 'product_variants.product_id', '=', 'products.id')
            ->join('sizes', 'product_variants.size_id', '=', 'sizes.id')
            ->join('colors', 'product_variants.color_id', '=', 'colors.id')
            ->join('carts', 'cart_items.cart_id', '=', 'carts.id')
            ->where('carts.user_id', $user)
            ->select(
                'products.name as product_name',
                'sizes.size',
                'colors.color',
                'cart_items.quantity',
                'products.image as product_image',
                'cart_items.id as cart_item_id',
                'product_variants.price',
                'product_variants.price_sale'
            )->orderBy('cart_items.id', 'asc')->get();

        $totalAmount = $cartItems->sum(function ($item) {
            $unitPrice = $item->price_sale && $item->price_sale < $item->price
                ? $item->price_sale
                : $item->price;
            return $unitPrice * $item->quantity;
        });



        return view('client.pages.cart.index', compact('cartItems', 'totalAmount'));
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
                    // Kiểm tra số lượng tồn kho khi đã có sp trong giỏ hàng
                    $available = $productVariant->quantity - $cartItem->quantity;
                    return redirect()->back()->with('error', "Số lượng tồn kho không đủ! Bạn chỉ có thể thêm tối đa {$available} sản phẩm nữa.");
                }
                $cartItem->update(['quantity' => $newQuantity]);
            } else {
                // Kiểm tra số lượng tồn kho khi chưa thêm vào giỏ hàng
                if ($quantity > $productVariant->quantity) {
                    return redirect()->back()->with('error', "Số lượng tồn kho không đủ! Chỉ còn {$productVariant->quantity} sản phẩm.");
                }
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
        $userId = Auth::user(); // Giả sử đây là ID của user (có thể dùng Auth::id() nếu có authentication)

        // Xóa toàn bộ sản phẩm trong giỏ hàng nhưng giữ lại giỏ hàng
        DB::table('cart_items')->whereIn('cart_id', function ($query) use ($userId) {
            $query->select('id')->from('carts')->where('user_id', $userId);
        })->delete();

        return redirect()->route('cart.index')->with('success', 'Tất cả sản phẩm trong giỏ hàng đã được xóa!');
    }
}

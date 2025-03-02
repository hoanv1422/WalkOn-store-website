<?php

namespace App\Http\Controllers\Client;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $user = 1;
        $totalPrice = Product::sum(DB::raw('price * quantity'));
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
            'cart_items.price', 
            'cart_items.quantity',
            'products.image as product_image',
            'cart_items.id as cart_item_id' // Thêm trường 'id' vào select
        )
        ->get();
        return view('client.pages.cart.index', compact('cartItems','totalPrice'));
    }
    
    public function addToCart(Request $request, $id)
{
   
    $user = 1; 
    $size_id = $request->size;
    $color_id = $request->color;
    $quantity = $_POST['quantity'];

    
    $productVariant = DB::table('product_variants')
        ->join('products', 'product_variants.product_id', '=', 'products.id')
        ->where('products.id', $id)
        ->where('product_variants.size_id', '=', $size_id)
        ->where('product_variants.color_id', '=', $color_id)
        ->select('product_variants.id', 'product_variants.price', 'product_variants.quantity')
        ->first();

    if (!$productVariant) {
        return redirect()->back()->with('error', 'Biến thể sản phẩm không tồn tại!');
    }

    $request->validate([
        'size'     => 'required',
        'color'    => 'required',
        'quantity' => [
            function ($attribute, $value, $fail) use ($productVariant) {
                if ($value > $productVariant->quantity) {
                    $fail('Số lượng tồn kho không đủ! Chỉ còn ' . $productVariant->quantity . ' sản phẩm.');
                }
            }
        ],
    ], [
        'size.required'     => 'Vui lòng chọn kích cỡ.',
        'color.required'    => 'Vui lòng chọn màu sắc.',
    ]);
    // Kiểm tra số lượng tồn kho
    if ($productVariant->quantity < $quantity) {
        return redirect()->back()->with('error', 'Số lượng tồn kho không đủ!');
    }

    // Kiểm tra giỏ hàng của người dùng
    $cart = DB::table('carts')->where('user_id', $user)->first();
    if (!$cart) {
        $cartId = DB::table('carts')->insertGetId([
            'user_id' => $user,
            
        ]);
    } else {
        $cartId = $cart->id;
    }

    // Kiểm tra sản phẩm đã có trong giỏ hàng chưa 
    $cartItem = DB::table('carts')
        ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
        ->where('carts.user_id', $user)
        ->where('cart_items.product_variant_id', $productVariant->id)
        ->select('cart_items.id', 'cart_items.quantity', 'cart_items.price')
        ->first();

    if ($cartItem) {
        // Nếu đã có, cập nhật số lượng
        DB::table('cart_items')
            ->where('id', $cartItem->id)
            ->update([
                'quantity' => $cartItem->quantity + $quantity,
                'price' => ($cartItem->quantity + $quantity) * $productVariant->price,
                
            ]);
    } else {
        // Nếu chưa có, thêm mới vào giỏ hàng
        DB::table('cart_items')->insert([
            'cart_id' => $cartId,
            'product_variant_id' => $productVariant->id,
            'quantity'=>$_POST['quantity'],
            'price' => $quantity * $productVariant->price,
            
        ]);
    }

    return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
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
            $userId = 1; // Giả sử đây là ID của user (có thể dùng Auth::id() nếu có authentication)
        
            // Xóa toàn bộ sản phẩm trong giỏ hàng nhưng giữ lại giỏ hàng
            DB::table('cart_items')->whereIn('cart_id', function ($query) use ($userId) {
                $query->select('id')->from('carts')->where('user_id', $userId);
            })->delete();
            
            return redirect()->route('cart.index')->with('success', 'Tất cả sản phẩm trong giỏ hàng đã được xóa!');
        }

}
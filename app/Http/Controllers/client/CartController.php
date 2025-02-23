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
        return view('client.pages.cart.index', compact('cartItems'));
    }
    public function addToCart(Request $request,$id){
        $user = 1;
        $product = Product::findOrFail($id);
        $cartItem = DB::table('carts')
            ->join('cart_items', 'carts.id', '=', 'cart_items.cart_id')
            ->where('carts.user_id', $user)
            ->where('cart_items.product_variant_id', $product->id)
            ->select('cart_items.*') 
            ->first();
        $checkCart = DB::table('carts')->where('carts.user_id',$user)->first();
        if(!isset($checkCart)){
            $checkCart=Cart::create([
                'user_id'=>$user
            ]);
        }
            if ($cartItem) {
                $udquan=DB::table('cart_items')->where('id',$cartItem->id)->update(['quantity'=> $cartItem->quantity + ($request->quantity ?? 1)]);}    
            else{
                CartItem::create([
                    'cart_id'=>1,
                    'size'=>$_POST['size'],
                    'product_variant_id'=>$id,
                    'color'=>$_POST['color'],
                    'quantity'=>$_POST['quantity'],
                    'price'=> $product->price,
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
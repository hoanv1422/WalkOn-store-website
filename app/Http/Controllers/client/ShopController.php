<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::take(10)->get();
        $categories = Category::all();
        $colors = Color::all();
        return view('client.pages.shop.index', compact('products', 'categories', 'colors'));
    }


    // Lọc Sản phần theo danh mục

    public function filterByCategory($categoryId)
    {
        $products = Product::where('category_id', $categoryId)->get();
        $categories = Category::all();
        $colors = Color::all();
        return view('client.pages.shop.index', compact('products', 'categories', 'colors'));
    }

    //ADD TO CART
    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index');
    }

    public function cart()
    {
        $cart = session()->get('cart');
        return view('client.pages.shop.cart', compact('cart'));
    }
}

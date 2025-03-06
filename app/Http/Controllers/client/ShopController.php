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
        $products = Product::with('galleries', 'variants', 'colors', 'sizes')->take(10)->get();
        $categories = Category::all();
        $colors = Color::all();
        return view('client.pages.shop.index', compact('products', 'categories', 'colors'));
    }

    // Lọc Sản phần theo danh mục
    public function filterByCategory($categoryId)
    {
        $products = Product::with('galleries', 'variants', 'colors', 'sizes')->where('category_id', $categoryId)->get();
        $categories = Category::all();
        $colors = Color::all();
        return view('client.pages.shop.index', compact('products', 'categories', 'colors'));
    }
}

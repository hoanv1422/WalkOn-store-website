<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::with('galleries', 'variants', 'colors', 'sizes','brand')->paginate(12);
        $categories = Category::all();
        $colors = Color::all();
        $brand = Brand::all();
        $banners = Banner::orderBy('position')->get();
        return view('client.pages.shop.index', compact('products', 'categories', 'colors','brand','banners'));
    }

    // Lọc Sản phần theo danh mục
    public function filter(Request $request)
    {

        $query = Product::with('galleries', 'variants', 'colors', 'sizes','brand');
         // Lọc theo danh mục (Category)
         if ($request->has('category')) {
            $query->whereIn('category_id', (array) $request->category);
        }

        // Lọc theo màu sắc (Color)
        if ($request->has('color')) {
            $query->whereHas('colors', function ($q) use ($request) {
                $q->whereIn('colors.id', (array) $request->color);
            });
        }

        // Lọc theo thương hiệu (Brand)
        if ($request->has('brand')) {
            $query->whereIn('brand_id', (array) $request->brand);
        }

        // Lọc theo giá
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Lấy dữ liệu sau khi lọc (hoặc tất cả nếu không chọn bộ lọc)
        $products = $query->paginate(12);
        $categories = Category::all();
        $colors = Color::all();
        $brand = Brand::all();
        $banners = Banner::orderBy('position')->get();
        return view('client.pages.shop.index', compact('products', 'categories', 'colors','brand','banners'));
    }
}

<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::with('galleries', 'variants', 'colors', 'sizes','brand')->paginate(9);
        $categories = Category::all();
        $colors = Color::all();
        $brands = Brand::all();
        $sizes = Size::all();
        return view('client.pages.shop.index', compact('products', 'categories', 'colors','brands','sizes'));
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
         if ($request->has('size')) {
             $query->whereHas('sizes', function ($q) use ($request) {
             $q->whereIn('sizes.id', (array) $request->size);
          });
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
        $products = $query->paginate(9);
        $categories = Category::all();
        $colors = Color::all();
        $brand = Brand::all(); 
        $sizes = Size::all();
        $banners = Banner::orderBy('position')->get();
        return view('client.pages.shop.index', compact('products', 'categories', 'colors','brand','banners','sizes'));
       
    }

    public function listProducts(Request $request)
    {
        $query = Product::query();

        if ($request->has('keyword') && !empty($request->input('keyword'))) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('description', 'LIKE', "%{$keyword}%");
            });
        }

        if ($request->has('category') && !empty($request->input('category'))) {
            $query->whereIn('category_id', (array) $request->input('category'));
        }

        if ($request->has('color') && !empty($request->input('color'))) {
            $query->whereHas('colors', function ($q) use ($request) {
                $q->whereIn('colors.id', (array) $request->input('color'));
            });
        }

        if ($request->has('brand') && !empty($request->input('brand'))) {
            $query->whereIn('brand_id', (array) $request->input('brand'));
        }

        if ($request->has('size') && !empty($request->input('size'))) {
            $query->whereHas('sizes', function ($q) use ($request) {
                $q->whereIn('sizes.id', (array) $request->input('size'));
            });
        }

        if ($request->has('price') && !empty($request->input('price'))) {
            $priceRange = explode('-', $request->input('price'));
            if (count($priceRange) === 2) {
                $minPrice = (float) trim($priceRange[0]);
                $maxPrice = (float) trim($priceRange[1]);
                if ($minPrice >= 0 && $maxPrice > $minPrice) {
                    $query->whereBetween('price', [$minPrice, $maxPrice]);
                }
            }
        }

        $perPage = $request->input('per_page', 9);
        $perPage = in_array($perPage, [9, 12, 24, 36]) ? (int) $perPage : 9;

        $products = $query->paginate($perPage);

        $topSellingProducts = Product::orderByDesc('sold_quantity')
            ->limit(20)
            ->pluck('id')
            ->toArray();

        $products->getCollection()->transform(function ($product) use ($topSellingProducts) {
            return [
                'id' => $product->id,
                'slug' => $product->slug,
                'name' => $product->name,
                'description' => Str::words($product->description, 50, '...'),
                'image' => $product->image && Storage::exists($product->image)
                    ? Storage::url($product->image)
                    : asset('img/default-image.jpg'),
                'variant_image' => $product->variants->isNotEmpty() && Storage::exists($product->variants->first()->image)
                    ? Storage::url($product->variants->first()->image)
                    : asset('img/default-image.jpg'),
                'price' => number_format($product->price, 0, ',', '.'),
                'price_sale' => number_format($product->price_sale, 0, ',', '.'),
                'average_rating' => $product->average_rating ?? 0,
                'is_new' => $product->created_at >= Carbon::now()->subWeek(),
                'is_top_selling' => in_array($product->id, $topSellingProducts),
                'is_sale' => $product->price_sale > 0 && ($product->price_sale / $product->price) <= 0.9,
                'is_favorite' => Auth::check() && Wishlist::where('user_id', Auth::id())
                    ->where('product_id', $product->id)
                    ->exists(),
                'rating_count' => $product->comments->count(),    
            ];
        });

        return response()->json([
            'data' => $products->items(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'total' => $products->total(),
            'per_page' => $products->perPage(),
        ]);
    }
}

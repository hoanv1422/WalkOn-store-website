<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Client\DetailController;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Brand;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->take(6)->get();
        $brands = Brand::with('products')->get();

        $topSellingProducts = Product::orderByDesc('sold_quantity')
            ->limit(20)
            ->pluck('id')
            ->toArray();

        // Transform cho $products
        $products->transform(function ($product) use ($topSellingProducts) {
            $product->is_new = $product->created_at >= Carbon::now()->subWeek();
            $product->is_top_selling = in_array($product->id, $topSellingProducts);
            $product->is_sale = $product->price_sale > 0 && ($product->price_sale / $product->price) <= 0.9;
            return $product;
        });

        // Transform cho từng $brand->products
        $brands->each(function ($brand) use ($topSellingProducts) {
            $brand->products->transform(function ($product) use ($topSellingProducts) {
                $product->is_new = $product->created_at >= Carbon::now()->subWeek();
                $product->is_top_selling = in_array($product->id, $topSellingProducts);
                $product->is_sale = $product->price_sale > 0 && ($product->price_sale / $product->price) <= 0.9;
                return $product;
            });
        });

        // 1. Lấy top 20 sản phẩm mới nhất (trong 7 ngày gần nhất)
        $newProducts = Product::where('created_at', '>=', Carbon::now()->subYear())
            ->orderByDesc('created_at')
            ->take(20)
            ->get();
        
        // 2. Lấy top 20 sản phẩm giảm giá nhiều nhất
        $topDiscountedProducts = Product::where('price_sale', '>', 0)
            ->selectRaw('*, ((price - price_sale) / price * 100) as discount_percentage')
            ->orderByDesc('discount_percentage')
            ->take(20)
            ->get();

        // 3. Lấy top 20 sản phẩm được đánh giá cao nhất
        // $topRatedProducts = Product::whereNotNull('average_rating') // Đảm bảo không lấy sản phẩm chưa có đánh giá
        //     ->orderByDesc('average_rating')
        //     ->take(20)
        //     ->get();
        // $banners = Banner::orderBy('position')->get();
        return view('client.pages.home.index', compact('products', 'brands', 'newProducts', 'topDiscountedProducts'));
    }

    public function getProductById(Request $request)
    {
        try {
            $idProduct = $request->idProduct;
            $product = Product::query()->where('id', $idProduct)->first();

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Không tìm thấy sản phẩm'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->image,
                    'price' => $product->price,
                    'quantity' => $product->quantity,
                    'price_sale' => $product->price_sale,
                    'colors' => $product->colors,
                    'sizes' => $product->sizes,
                    'variants' => $product->variants
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi hệ thống: ' . $e->getMessage()
            ], 500);
        }
    }
}
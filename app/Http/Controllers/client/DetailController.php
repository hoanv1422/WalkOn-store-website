<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductRecommendationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class DetailController extends Controller
{

    public function index() {
        return view('client.pages.detail.index');
    }

    public function productDetail(string $slug)
    {
        try {
            $product = Product::with([
                'galleries',
                'variants' => function($query) {
                    $query->with(['color', 'size']);
                },
                'colors',
                'sizes'
            ])->where('slug', $slug)->firstOrFail();

            // dd($product);

            $productVariants = $product->variants->map(function ($variant) use ($product) {
                return [
                    'color_id' => $variant->color_id,
                    'size_id' => $variant->size_id,
                    'price' => $variant->price ?? $product->price,
                    'price_sale' => $variant->price_sale ?? $product->price_sale,
                    'quantity' => $variant->quantity,
                    'image' => $variant->image ? Storage::url($variant->image) : Storage::url($product->image)
                ];
            });

            // dd($productVariants);

            return response()->json([
                'status' => 'success',
                'data' => [
                    'product' => $product,
                    'product_variants' => $productVariants,
                ]
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found'
            ], 404);
        }
    }

    public function relatedProducts(string $slug)
    {
        try {
            $product = Product::where('slug', $slug)->firstOrFail();
            return response()->json([
                'status' => 'success',
                'data' => [
                    'related_products' => $product->relatedProducts()
                ]
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found'
            ], 404);
        }
    }

    public function show(string $slug)
    {
        try {
            $product = Product::where('slug', $slug)->firstOrFail();
            $recommendedProducts = $this->getRecommendedProducts($product->id);
            $products = $recommendedProducts->pluck('product')->values()->all();
            foreach($products as $product) {
                if ($product->variants->first()->image && Storage::exists($product->variants->first()->image)) {
                    $product->secondary_image = Storage::url($product->variants->first()->image);
                } else {
                    $product->secondary_image = asset('/img/default-image.jpg');
                }

                if ($product->image && Storage::exists($product->image)) {
                    $product->image = Storage::url($product->image);
                } else {
                    $product->image = asset('/img/default-image.jpg');
                }
            }
            return response()->json([
                'status' => 'success',
                'data' => [
                    'recommended_products' => $products
                ]
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found'
            ], 404);
        }
    }

    protected function getRecommendedProducts($productId)
    {

        $service = new ProductRecommendationService();

        // Sử dụng cache nếu có
        if (Cache::has('product_recommendation_rules')) {
            $rules = Cache::get('product_recommendation_rules');
            $service->setRules($rules);
        }

        return $service->getRecommendedProducts($productId);
    }
}

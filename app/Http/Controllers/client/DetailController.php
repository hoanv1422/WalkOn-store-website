<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DetailController extends Controller
{
    public function productDetail(string $slug)
    {
        $product = Product::with([
            'galleries',
            'variants' => function($query) {
                $query->with(['color', 'size']);
            },
            'colors',
            'sizes'
        ])->where('slug', $slug)->firstOrFail();
    
        // Chuẩn bị dữ liệu biến thể
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
    
        return view('client.pages.detail.index', [
            'product' => $product,
            'relatedProducts' => $product->relatedProducts(),
            'upSellProducts' => $product->upsellProducts(),
            'product_variants' => $productVariants 
        ]);
       
    }
    
    
    public function index() {
        return view('client.pages.detail.index');
    }
}
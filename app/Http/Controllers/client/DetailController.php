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
        $product = Product::with('galleries', 'variants', 'colors', 'sizes')->where('slug', $slug)->first();

        $relatedProducts = $product->relatedProducts();
        $upSellProducts = $product->upsellProducts();
        //    dd($product);
        $productVariants = $product->variants->map(function ($variant) {
            return [
                'id' => $variant->id,
                'color_id' => $variant->color_id,
                'size_id' => $variant->size_id,
                'quantity' => $variant->quantity,
                'image' => Storage::url($variant->image ?? $variant->product->image),
            ];
        });
    
        return view('client.pages.detail.index', compact('product','relatedProducts','upSellProducts'
    ));
    }

    public function index() {
        return view('client.pages.detail.index');

    }
}
<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function productDetail(string $slug)
    {
        $product = Product::with('galleries', 'variants', 'colors', 'sizes')->where('slug', $slug)->first();

        $relatedProducts = $product->relatedProducts();
        $upSellProducts = $product->upsellProducts();
        //    dd($product);
        return view('client.pages.detail.index', compact('product','relatedProducts','upSellProducts'
    ));
    }

    public function index() {
        return view('client.pages.detail.index');

    }
}
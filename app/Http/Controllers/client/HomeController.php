<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Client\DetailController;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Brand;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->take(6)->get();
        $brands = Brand::with('products')->get();
        $products_average_rating = Product::where('average_rating', '>', 3.5)->get();
        $banners = Banner::orderBy('position')->get();
        return view('client.pages.home.index',compact('products', 'brands','products_average_rating','banners'));
    }
   

}
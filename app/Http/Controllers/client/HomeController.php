<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Client\DetailController;
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
        
        return view('client.pages.home.index',compact('products', 'brands','products_average_rating'));
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
                    'image'=> $product->image,
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
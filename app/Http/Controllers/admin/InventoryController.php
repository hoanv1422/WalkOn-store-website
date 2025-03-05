<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class InventoryController extends Controller
{
    const PATH_VIEW = 'admin.inventory.';

    /**
     * Display a listing of the inventory.
     */
    public function index()
    {
        $products = Product::with(['variants.size', 'variants.color', 'category'])->get();

        // dd($products->toArray());
        return view(self::PATH_VIEW . 'index', compact('products'));
    }
}
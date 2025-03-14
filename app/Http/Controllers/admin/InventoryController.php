<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    const PATH_VIEW = 'admin.inventory.';

    /**
     * Display a listing of the inventory.
     */
    public function index(Request $request)
    {
        $query = Product::with(['variants.size', 'variants.color', 'category']);

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        $products = $query->orderBy('created_at', 'desc')->get();

        return view(self::PATH_VIEW . 'index', compact('products'));
    }
}

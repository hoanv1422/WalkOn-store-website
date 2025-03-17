<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    const PATH_VIEW = 'admin.inventory.';

    /**
     * Display a listing of the inventory.
     */
    public function index(Request $request)
    {
        $query = Product::with(['variants', 'category']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('min_price') || $request->filled('max_price')) {
            $query->whereHas('variants', function ($q) use ($request) {
                if ($request->filled('min_price') && $request->filled('max_price')) {
                    $q->whereBetween('price', [(float) $request->min_price, (float) $request->max_price]);
                } elseif ($request->filled('min_price')) {
                    $q->where('price', '>=', (float) $request->min_price);
                } elseif ($request->filled('max_price')) {
                    $q->where('price', '<=', (float) $request->max_price);
                }
            });
        }

        $products = $query->latest()->get();
        $categories = Category::all();

        return view(self::PATH_VIEW . 'index', compact('products', 'categories'));
    }

    /**
     * Display the specified product variant in inventory.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Lấy biến thể cùng với sản phẩm liên quan
        $variant = ProductVariant::with(['product', 'color', 'size'])->findOrFail($id);

        return view(self::PATH_VIEW . 'show', compact('variant'));
    }

    /**
     * Remove the specified product variant from inventory.
     *
     * @param  int  $inventory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($inventory)
    {
        try {
            $variant = ProductVariant::findOrFail($inventory);
            $variant->delete();

            return redirect()->route('inventory.index')->with('success', 'Biến thể sản phẩm đã được xóa thành công!');
        } catch (\Exception $e) {
            return redirect()->route('inventory.index')->with('error', 'Xóa biến thể thất bại: ' . $e->getMessage());
        }
    }
}

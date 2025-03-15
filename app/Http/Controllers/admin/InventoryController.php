<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
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

        // Tìm kiếm theo tên sản phẩm
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Lọc theo danh mục
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Lọc theo giá (hỗ trợ nhập một giá trị hoặc cả hai)
        if ($request->filled('min_price') || $request->filled('max_price')) {
            $query->whereHas('variants', function ($q) use ($request) {
                if ($request->filled('min_price') && $request->filled('max_price')) {
                    // Nếu nhập cả hai giá trị
                    $q->whereBetween('price', [(float) $request->min_price, (float) $request->max_price]);
                } elseif ($request->filled('min_price')) {
                    // Nếu chỉ nhập giá thấp nhất
                    $q->where('price', '>=', (float) $request->min_price);
                } elseif ($request->filled('max_price')) {
                    // Nếu chỉ nhập giá cao nhất
                    $q->where('price', '<=', (float) $request->max_price);
                }
            });
        }

        // Sắp xếp theo thời gian mới nhất
        $products = $query->latest()->get();
        $categories = Category::all();

        return view(self::PATH_VIEW . 'index', compact('products', 'categories'));
    }
}
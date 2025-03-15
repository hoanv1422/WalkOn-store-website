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

        // Tìm kiếm sản phẩm theo tên
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Lọc theo danh mục dựa trên kết quả tìm kiếm
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Lọc theo khoảng giá dựa trên kết quả tìm kiếm và danh mục
        if ($request->filled('min_price') && $request->filled('max_price')) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->whereBetween('price', [(float) $request->min_price, (float) $request->max_price]);
            });
        }

        // Sắp xếp theo thời gian mới nhất
        $products = $query->latest()->get();
        $categories = Category::all();

        return view(self::PATH_VIEW . 'index', compact('products', 'categories'));
    }
}

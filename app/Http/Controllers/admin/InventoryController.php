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

    public function show($id)
    {
        // Lấy biến thể cùng với sản phẩm liên quan
        $variant = ProductVariant::with(['product', 'color', 'size'])->findOrFail($id);

        return view(self::PATH_VIEW . 'show', compact('variant'));
    }


    public function update(Request $request, $id)
    {
        try {
            // Validate dữ liệu đầu vào
            $request->validate([
                'quantity' => 'required|integer|min:0', // Số lượng phải là số nguyên không âm
            ]);

            // Tìm biến thể sản phẩm
            $variant = ProductVariant::findOrFail($id);
            $product = $variant->product;

            // Lấy số lượng cũ của biến thể để tính toán sự thay đổi
            $oldQuantity = $variant->quantity;

            // Cập nhật số lượng mới cho biến thể
            $variant->quantity = $request->quantity;
            $variant->save();

            // Tính toán sự thay đổi số lượng
            $quantityDifference = $variant->quantity - $oldQuantity;

            // Cập nhật số lượng tổng của sản phẩm
            $product->quantity = $product->quantity + $quantityDifference;

            // Đảm bảo số lượng sản phẩm không âm
            if ($product->quantity < 0) {
                $product->quantity = 0; // Nếu âm, đặt lại về 0
            }
            $product->save();

            return redirect()->route('inventory.index')->with('success', 'Cập nhật số lượng biến thể thành công!');
        } catch (\Exception $e) {
            // Xử lý lỗi (ví dụ: biến thể không tồn tại hoặc lỗi database)
            return redirect()->route('inventory.index')->with('error', 'Cập nhật số lượng thất bại: ' . $e->getMessage());
        }
    }


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

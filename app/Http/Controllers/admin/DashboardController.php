<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Lấy năm và tháng từ request, mặc định là hiện tại
        $revenueYear = $request->input('revenue_year', Carbon::now()->year);
        $revenueMonth = $request->input('revenue_month', Carbon::now()->month);

        // Đảm bảo revenueYear và revenueMonth là số hợp lệ
       // Đảm bảo revenueYear là số hợp lệ
       $revenueYear = (int) $revenueYear;
       if ($revenueYear < 2000 || $revenueYear > 2100) {
           $revenueYear = Carbon::now()->year;
       }

       // Xử lý revenueMonth: Nếu là "all", không giới hạn tháng
       $isAllMonths = $revenueMonth === 'all';
       if (!$isAllMonths) {
           $revenueMonth = (int) $revenueMonth;
           if ($revenueMonth < 1 || $revenueMonth > 12) {
               $revenueMonth = Carbon::now()->month;
           }
       }

       // Xác định khoảng thời gian lọc
       if ($isAllMonths) {
           // Lọc cả năm
           $revenueStartDate = Carbon::create($revenueYear, 1, 1)->startOfDay();
           $revenueEndDate = Carbon::create($revenueYear, 12, 31)->endOfDay();
       } else {
           // Lọc theo tháng cụ thể
           $revenueStartDate = Carbon::create($revenueYear, $revenueMonth, 1)->startOfDay();
           $revenueEndDate = $revenueStartDate->copy()->endOfMonth()->endOfDay();
       }
        // Thống kê tổng số đơn hàng (không lọc thời gian)
        $totalOrders = Order::count();

        // Thống kê đơn hàng hoàn thành (lọc theo năm/tháng)
        $completedOrders = Order::where('order_status', 'completed')
                               ->whereBetween('created_at', [$revenueStartDate, $revenueEndDate])
                               ->count();

        // Thống kê đơn hàng bị hủy (lọc theo năm/tháng)
        $cancelledOrders = Order::where('order_status', 'cancelled')
                               ->whereBetween('created_at', [$revenueStartDate, $revenueEndDate])
                               ->count();

        // Thống kê đơn hàng đang chờ (không lọc thời gian)
        $pendingOrders = Order::where('order_status', 'pending')->count();

        // Thống kê số lượng tài khoản người dùng (không lọc thời gian)
        $totalUsers = User::count();

        // Thống kê doanh thu chung (không lọc thời gian)
        $revenue = Order::where('order_status', 'completed')
                       ->sum('final_price');

        // Thống kê doanh thu cho biểu đồ và card (lọc theo năm/tháng)
        $revenueForChart = Order::where('order_status', 'completed')
                               ->whereBetween('created_at', [$revenueStartDate, $revenueEndDate])
                               ->sum('final_price');

        // Dữ liệu cho biểu đồ cột: Chỉ Doanh thu
        $financialChartData = [
            'Doanh thu' => (float) ($revenueForChart ?: 0),
        ];

        // Thống kê cho card (lọc theo năm/tháng)
        $totalOrdersForChart = Order::whereBetween('created_at', [$revenueStartDate, $revenueEndDate])
                                   ->count();
        $cancelledOrdersForChart = Order::where('order_status', 'cancelled')
                                       ->whereBetween('created_at', [$revenueStartDate, $revenueEndDate])
                                       ->count();

        // Nếu là yêu cầu AJAX, trả về JSON
        if ($request->ajax()) {
            return response()->json([
                'financialChartData' => $financialChartData,
                'totalOrdersForChart' => $totalOrdersForChart,
                'revenueForChart' => $revenueForChart,
                'cancelledOrdersForChart' => $cancelledOrdersForChart,
                'completedOrders' => $completedOrders,
            ]);
        }

        // Dữ liệu cho biểu đồ tròn: Số lượng sản phẩm theo danh mục
        $productsByCategory = Product::selectRaw('COALESCE(categories.name, "Không có danh mục") as category_name, COUNT(products.id) as product_count')
                                    ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
                                    ->where('products.is_active', 1)
                                    ->groupBy('categories.name')
                                    ->pluck('product_count', 'category_name')
                                    ->mapWithKeys(function ($value, $key) {
                                        return [$key => (int) $value]; // Đảm bảo giá trị là số nguyên
                                    })
                                    ->toArray();

        // Top biến thể bán chạy
        $topSellingVariants = ProductVariant::select(
            'product_variants.id',
            'product_variants.product_id',
            'product_variants.price',
            'product_variants.quantity as stock',
            'product_variants.image'
        )
            ->leftJoin('order_items', 'product_variants.id', '=', 'order_items.product_variant_id')
            ->leftJoin('orders', 'order_items.order_id', '=', 'orders.id')
            ->leftJoin('products', 'product_variants.product_id', '=', 'products.id')
            ->leftJoin('sizes', 'product_variants.size_id', '=', 'sizes.id')
            ->leftJoin('colors', 'product_variants.color_id', '=', 'colors.id')
            ->where('orders.order_status', 'completed')
            ->selectRaw('TRIM(CONCAT(products.name, " - ", COALESCE(sizes.size, ""), " ", COALESCE(colors.color, ""))) as name')
            ->selectRaw('COUNT(DISTINCT orders.id) as order_count')
            ->selectRaw('SUM(order_items.quantity) as total_sold')
            ->groupBy(
                'product_variants.id',
                'product_variants.product_id',
                'products.name',
                'sizes.size',
                'colors.color',
                'product_variants.price',
                'product_variants.quantity',
                'product_variants.image'
            )
            ->orderBy('order_count', 'desc')
            ->take(5)
            ->get();

        // Top sản phẩm bán chạy
        $topSellingProducts = Product::select(
            'products.id',
            'products.name',
            'products.image'
        )
            ->leftJoin('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->leftJoin('order_items', 'product_variants.id', '=', 'order_items.product_variant_id')
            ->leftJoin('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.order_status', 'completed')
            ->selectRaw('COUNT(DISTINCT orders.id) as order_count')
            ->selectRaw('SUM(order_items.quantity) as total_sold')
            ->selectRaw('SUM(order_items.quantity * COALESCE(product_variants.price_sale, product_variants.price)) as total_amount')
            ->groupBy('products.id', 'products.name', 'products.image')
            ->orderBy('total_sold', 'desc')
            ->take(5)
            ->get();

        // Dữ liệu cho bảng thống kê: Số lượng sản phẩm theo thương hiệu
        $productsByBrand = Brand::select(
            'brands.id',
            'brands.name as brand_name'
        )
            ->leftJoin('products', 'brands.id', '=', 'products.brand_id')
            ->leftJoin('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->leftJoin('order_items', 'product_variants.id', '=', 'order_items.product_variant_id')
            ->leftJoin('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('products.is_active', 1)
            ->selectRaw('COUNT(DISTINCT products.id) as product_count')
            ->selectRaw('SUM(product_variants.quantity) as total_stock')
            ->selectRaw('SUM(CASE WHEN orders.order_status = "completed" THEN order_items.quantity ELSE 0 END) as total_sold')
            ->groupBy('brands.id', 'brands.name')
            ->orderBy('total_sold', 'desc')
            ->get();

        return view('admin.dashboard.index', compact(
            'totalOrders',
            'completedOrders',
            'cancelledOrders',
            'totalUsers',
            'revenue',
            'totalOrdersForChart',
            'revenueForChart',
            'cancelledOrdersForChart',
            'topSellingVariants',
            'topSellingProducts',
            'productsByBrand',
            'productsByCategory',
            'pendingOrders',
            'financialChartData',
            'revenueYear',
            'revenueMonth'
        ));
    }
}
?>
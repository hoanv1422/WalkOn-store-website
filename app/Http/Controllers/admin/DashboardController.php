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
        // Lấy khoảng thời gian lọc từ request (mặc định là tháng hiện tại)
        $filter = $request->input('filter', 'month');
        $startDate = Carbon::now()->startOf($filter);
        $endDate = Carbon::now()->endOf($filter);

        // Thống kê tổng số đơn hàng
        // Biến: $totalOrders - Tổng số đơn hàng trong khoảng thời gian
        // Cột trong DB: created_at (thời gian thanh toán)
        $totalOrders = Order::count();

        // Thống kê đơn hàng hoàn thành
        // Biến: $completedOrders - Số đơn hàng có trạng thái 'shipped'
        // Cột trong DB: order_status (trạng thái đơn hàng), created_at
        $completedOrders = Order::where('order_status', 'delivered')
                               ->whereBetween('created_at', [$startDate, $endDate])
                               ->count();

        // Thống kê đơn hàng bị hủy
        // Biến: $cancelledOrders - Số đơn hàng có trạng thái 'cancelled'
        // Cột trong DB: order_status (trạng thái đơn hàng), created_at
        $cancelledOrders = Order::where('order_status', 'cancelled')
                               ->whereBetween('created_at', [$startDate, $endDate])
                               ->count();
        $pendingOrders = Order::where('order_status','pending')->count();
        // Thống kê số lượng tài khoản người dùng
        // Biến: $totalUsers - Tổng số người dùng
        // Model: User (không lọc thời gian)
        $totalUsers = User::count();

        // Thống kê doanh thu
        // Biến: $revenue - Tổng doanh thu từ các đơn hàng đã giao (shipped)
        // Cột trong DB: final_price (giá cuối cùng), order_status, created_at
        $revenue = Order::where('order_status', 'delivered')
                       ->sum('final_price');
       // Thống kê chi phí (dùng selectRaw thay vì DB::raw)
       $cost = Order::where('order_status', 'delivered')
       ->join('order_items', 'orders.id', '=', 'order_items.order_id')
       ->join('product_variants', 'order_items.product_variant_id', '=', 'product_variants.id')
       ->join('products', 'product_variants.product_id', '=', 'products.id')
       ->selectRaw('SUM(order_items.quantity * COALESCE(products.price_income, 0)) as total_cost')
       ->value('total_cost');

// Thống kê lợi nhuận
$profit = $revenue - $cost;

// Dữ liệu cho biểu đồ cột: Doanh thu, Chi phí, Lợi nhuận
$financialChartData = [
'Doanh thu' => (float) $revenue,
'Chi phí' => (float) $cost,
'Lợi nhuận' => (float) $profit,
];
        // Dữ liệu cho biểu đồ số đơn hàng theo ngày
        // Biến: $chartData - Dữ liệu biểu đồ (số đơn hàng theo ngày)
        $chartData = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy('date')
        ->pluck('count', 'date')
        ->toArray();

// Dữ liệu cho biểu đồ cột kết hợp (Tổng đơn hàng, Doanh thu, Đơn hàng hủy) - KHÔNG lọc thời gian
$totalOrdersForChart = Order::count(); // Tổng đơn hàng (không lọc thời gian)
$revenueForChart = Order::where('order_status', 'delivered')->sum('final_price'); // Doanh thu (không lọc thời gian)
$cancelledOrdersForChart = Order::where('order_status', 'cancelled')->count(); // Đơn hàng hủy (không lọc thời gian)

$combinedChartData = [
'Tổng đơn hàng' => $totalOrdersForChart,
'Doanh thu (k)' => $revenueForChart / 1000, // Chia cho 1000 để hiển thị dạng "k"
'Đơn hàng hủy' => $cancelledOrdersForChart,
];

// Dữ liệu cho biểu đồ tròn (Trạng thái đơn hàng) - KHÔNG lọc thời gian
$statusChartData = Order::selectRaw('order_status, COUNT(*) as count')
              ->groupBy('order_status')
              ->pluck('count', 'order_status')
              ->toArray();
            
                $topSellingVariants = ProductVariant::select(
                    'product_variants.id',
                    'product_variants.product_id',
                    'product_variants.price',
                    'product_variants.quantity as stock', // Số lượng trong kho
                    'product_variants.image'
                )
                ->leftJoin('order_items', 'product_variants.id', '=', 'order_items.product_variant_id')
                ->leftJoin('orders', 'order_items.order_id', '=', 'orders.id')
                ->leftJoin('products', 'product_variants.product_id', '=', 'products.id') // Join để lấy tên sản phẩm
                ->leftJoin('sizes', 'product_variants.size_id', '=', 'sizes.id') // Join để lấy tên kích thước
                ->leftJoin('colors', 'product_variants.color_id', '=', 'colors.id') // Join để lấy tên màu sắc
                ->where('orders.order_status', 'delivered') // Chỉ tính đơn hàng đã giao
                ->selectRaw('TRIM(CONCAT(products.name, " - ", COALESCE(sizes.size, ""), " ", COALESCE(colors.color, ""))) as name') // Ghép tên biến thể
                ->selectRaw('COUNT(DISTINCT orders.id) as order_count') // Số đơn hàng có biến thể
                ->selectRaw('SUM(order_items.quantity) as total_sold') // Tổng số biến thể đã bán
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
                    $topSellingProducts = Product::select(
                        'products.id',
                        'products.name',
                        'products.image'
                    )
                        ->leftJoin('product_variants', 'products.id', '=', 'product_variants.product_id')
                        ->leftJoin('order_items', 'product_variants.id', '=', 'order_items.product_variant_id')
                        ->leftJoin('orders', 'order_items.order_id', '=', 'orders.id')
                        ->where('orders.order_status', 'delivered') // Chỉ tính đơn hàng đã giao
                        ->selectRaw('COUNT(DISTINCT orders.id) as order_count') // Số đơn hàng có sản phẩm
                        ->selectRaw('SUM(order_items.quantity) as total_sold') // Tổng số sản phẩm đã bán (tất cả biến thể)
                        ->selectRaw('SUM(order_items.quantity * COALESCE(product_variants.price_sale, product_variants.price)) as total_amount') // Tổng số tiền dựa trên giá thực tế
                        ->groupBy('products.id', 'products.name', 'products.image')
                        ->orderBy('total_sold', 'desc')
                        ->take(5)
                        ->get();
                    // Dữ liệu cho biểu đồ tròn: Số lượng sản phẩm theo danh mục
        $productsByCategory = Product::selectRaw('categories.name as category_name, COUNT(products.id) as product_count')
        ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
        ->where('products.is_active', 1) // Chỉ tính sản phẩm đang hoạt động
        ->groupBy('categories.name')
        ->pluck('product_count', 'category_name')
        ->toArray();

    // Dữ liệu cho bảng thống kê: Số lượng sản phẩm theo thương hiệu
    $productsByBrand = Brand::select(
        'brands.id',
        'brands.name as brand_name'
    )
        ->leftJoin('products', 'brands.id', '=', 'products.brand_id')
        ->leftJoin('product_variants', 'products.id', '=', 'product_variants.product_id')
        ->leftJoin('order_items', 'product_variants.id', '=', 'order_items.product_variant_id')
        ->leftJoin('orders', 'order_items.order_id', '=', 'orders.id')
        ->where('products.is_active', 1) // Chỉ tính sản phẩm đang hoạt động
        ->selectRaw('COUNT(DISTINCT products.id) as product_count') // Số lượng sản phẩm thuộc thương hiệu
        ->selectRaw('SUM(product_variants.quantity) as total_stock') // Tổng số lượng tồn kho
        ->selectRaw('SUM(CASE WHEN orders.order_status = "delivered" THEN order_items.quantity ELSE 0 END) as total_sold') // Tổng số lượng đã bán
        ->groupBy('brands.id', 'brands.name')
        ->orderBy('total_sold', 'desc')
        ->get();    
        return view('admin.dashboard.index', compact(
            'totalOrders',
            'completedOrders',
            'cancelledOrders',
            'totalUsers',
            'revenue',
            // 'totalComments',
            'filter',
            'chartData',
            'combinedChartData',
            'statusChartData',
            'totalOrdersForChart',
            'revenueForChart',     
            'cancelledOrdersForChart',
            'topSellingVariants',
            'topSellingProducts',
            'productsByBrand',
            'productsByCategory',
            'pendingOrders',
            'financialChartData',
            'cost', 
            'profit'
        ));
    }
}
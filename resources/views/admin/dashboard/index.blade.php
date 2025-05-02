@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="h-100">
                    <div class="row mb-3 pb-1">
                        <div class="col-12">
                            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                <div class="flex-grow-1">
                                    <h4 class="fs-16 mb-1">Xin chào, Admin !</h4>
                                    <p class="text-muted mb-0">Chúc bạn một ngày tốt lành</p>
                                </div>
                                <div class="mt-3 mt-lg-0">
                                    <form action="javascript:void(0);">
                                        <div class="row g-3 mb-0 align-items-center">
                                            {{-- <div class="col-sm-auto">
                                                <div class="input-group">
                                                    <input type="text"
                                                        class="form-control border-0 minimal-border dash-filter-picker shadow"
                                                        data-provider="flatpickr" data-range-date="true"
                                                        data-date-format="d M, Y"
                                                        data-deafult-date="01 Jan 2022 to 31 Jan 2022">
                                                    <div class="input-group-text bg-primary border-primary text-white">
                                                        <i class="ri-calendar-2-line"></i>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <!--end col-->
                                            {{-- <div class="col-auto">
                                                <button type="button"
                                                    class="btn btn-soft-success material-shadow-none"><i
                                                        class="ri-add-circle-line align-middle me-1"></i> Add
                                                    Product</button>
                                            </div>
                                            <!--end col-->
                                            <div class="col-auto">
                                                <button type="button"
                                                    class="btn btn-soft-info btn-icon waves-effect material-shadow-none waves-light layout-rightside-btn"><i
                                                        class="ri-pulse-line"></i></button>
                                            </div> --}}
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>
                            </div><!-- end card header -->
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Doanh Thu</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <h5 class="text-success fs-14 mb-0">
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                $<span>{{ number_format($revenue) }}</span> VND
                                            </h4>
                                            <a href="{{route('orders.index')}}" class="text-decoration-underline">Chi tiết</a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-success-subtle rounded fs-3">
                                                <i class="bx bx-dollar-circle text-success"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Đơn hàng mới</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <h5 class="text-danger fs-14 mb-0">
                                                {{-- <i class="ri-arrow-right-down-line fs-13 align-middle"></i> -3.57 % --}}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                                <span>{{ $pendingOrders }} </span>
                                            </h4>
                                            <a href="{{route('orders.index')}}" class="text-decoration-underline">Chi tiết</a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-info-subtle rounded fs-3">
                                                <i class="bx bx-shopping-bag text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Thành viên
                                            </p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <h5 class="text-success fs-14 mb-0">
                                                {{-- <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +29.08 % --}}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span>{{ $totalUsers }}</span></h4>
                                            <a href="{{route('users.index')}}" class="text-decoration-underline">Chi tiết</a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-warning-subtle rounded fs-3">
                                                <i class="bx bx-user-circle text-warning"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Bình luận</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <h5 class="text-muted fs-14 mb-0">
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                    data-target=""></span> </h4>
                                            <a href="#" class="text-decoration-underline">Chi tiết</a>
                                        </div>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                <i class="bx bx-comment text-primary"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div> <!-- end row-->

                    <div class="row">
                        <!-- Biểu đồ cột (Tổng đơn hàng, Doanh thu, Đơn hàng hủy) -->
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header border-0 align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Thống kê Tổng đơn hàng, Doanh thu, Đơn hàng hủy</h4>
                                    <div class="d-flex gap-2">
                                        <!-- Dropdown cho năm -->
                                        <select id="revenueYearFilter" class="form-select form-select-sm" style="width: 120px;">
                                            @for ($y = Carbon\Carbon::now()->year - 5; $y <= Carbon\Carbon::now()->year + 5; $y++)
                                                <option value="{{ $y }}" {{ $y == $revenueYear ? 'selected' : '' }}>{{ $y }}</option>
                                            @endfor
                                        </select>
                                        <!-- Dropdown cho tháng -->
                                        <select id="revenueMonthFilter" class="form-select form-select-sm" style="width: 120px;">
                                            @for ($m = 1; $m <= 12; $m++)
                                                <option value="{{ $m }}" {{ $m == $revenueMonth ? 'selected' : '' }}>{{ sprintf('%02d', $m) }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div><!-- end card header -->
                        
                                <div class="card-header p-0 border-0 bg-light-subtle">
                                    <div class="row g-0 text-center">
                                        <div class="col-6 col-sm-3">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h5 class="mb-1" id="totalOrders">{{ $totalOrdersForChart }}</h5>
                                                <p class="text-muted mb-0">Tổng đơn hàng</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-6 col-sm-3">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h5 class="mb-1" id="revenue">${{ number_format($revenueForChart / 1000, 2) }}k</h5>
                                                <p class="text-muted mb-0">Doanh thu</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-6 col-sm-3">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h5 class="mb-1" id="cancelledOrders">{{ $cancelledOrdersForChart }}</h5>
                                                <p class="text-muted mb-0">Đơn hàng hủy</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-6 col-sm-3">
                                            <div class="p-3 border border-dashed border-start-0 border-end-0">
                                                <h5 class="mb-1 text-success" id="completionRate">
                                                    {{ $totalOrdersForChart > 0 ? number_format(($completedOrders / $totalOrdersForChart) * 100, 2) : 0 }}%
                                                </h5>
                                                <p class="text-muted mb-0">Tỷ lệ hoàn thành</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                </div><!-- end card header -->
                        
                                <div class="card-body p-0 pb-2">
                                    <div class="w-100">
                                        <h2>Tổng quan tài chính</h2>
                                        <canvas id="financialChartCanvas"></canvas>
                                        {{-- <div id="financial_chart" class="apex-charts" dir="ltr"></div> --}}
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                
                        <!-- Biểu đồ tròn (Trạng thái đơn hàng) -->
                        
                        <!-- end col -->
                    </div>

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1"> Top Sản phẩm bán chạy nhất</h4>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown card-header-dropdown">
                                            <a class="text-reset dropdown-btn" href="#"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="fw-semibold text-uppercase fs-12">Sort by:
                                                </span><span class="text-muted">Today<i
                                                        class="mdi mdi-chevron-down ms-1"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Today</a>
                                                <a class="dropdown-item" href="#">Yesterday</a>
                                                <a class="dropdown-item" href="#">Last 7 Days</a>
                                                <a class="dropdown-item" href="#">Last 30 Days</a>
                                                <a class="dropdown-item" href="#">This Month</a>
                                                <a class="dropdown-item" href="#">Last Month</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body ">
                                    @if($topSellingVariants->isEmpty())
                                        <p class="text-muted">Hiện tại chưa có dữ liệu sản phẩm biến thể bán chạy.</p>
                                    @else
                                        <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                            <tbody>
                                                @foreach($topSellingVariants as $variant)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                    <img src="{{ asset($variant->image) }}" alt="" class="img-fluid d-block" />
                                                                </div>
                                                                <div>
                                                                    <h5 class="fs-14 my-1">
                                                                        <a href="" class="text-reset">
                                                                            {{ $variant->name }}
                                                                        </a>
                                                                    </h5>
                                                                    <span class="text-muted">{{ Carbon\Carbon::parse($variant->created_at)->format('d M Y') }}</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                            <h5 class="fs-14 my-1 fw-normal">${{ number_format($variant->price, 2) }}</h5>
                                                            <span class="text-muted">Price</span>
                                                        </td> --}}
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">{{ $variant->order_count }}</h5>
                                                            <span class="text-muted">Đơn hàng</span>
                                                        </td>
                                                        {{-- <td>
                                                            <h5 class="fs-14 my-1 fw-normal">
                                                                @if($variant->stock > 0)
                                                                    {{ $variant->stock }}
                                                                @else
                                                                    <span class="badge bg-danger-subtle text-danger">Out of stock</span>
                                                                @endif
                                                            </h5>
                                                            <span class="text-muted">Stock</span>
                                                        </td> --}}
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">${{ number_format(($variant->total_sold * $variant->price)  / 1000, 2) }}</h5>
                                                            <span class="text-muted">Giá trị</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div><!-- end card body -->
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="card card-height-100">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Top Mẫu sản phẩm</h4>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown card-header-dropdown">
                                            <a class="text-reset dropdown-btn" href="#"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted">Report<i
                                                        class="mdi mdi-chevron-down ms-1"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Download Report</a>
                                                <a class="dropdown-item" href="#">Export</a>
                                                <a class="dropdown-item" href="#">Import</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    @if($topSellingProducts->isEmpty())
                                        <p class="text-muted">Hiện tại chưa có dữ liệu sản phẩm bán chạy.</p>
                                    @else
                                        <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                            <tbody>
                                                @foreach($topSellingProducts as $product)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                    <img src="{{ asset($product->image) }}" alt="" class="img-fluid d-block" />
                                                                </div>
                                                                <div>
                                                                    <h5 class="fs-14 my-1">
                                                                        <a href="" class="text-reset">
                                                                            {{ $product->name }}
                                                                        </a>
                                                                    </h5>
                                                                    <span class="text-muted">{{ Carbon\Carbon::parse($product->created_at)->format('d M Y') }}</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">{{ $product->order_count }}</h5>
                                                            <span class="text-muted">Orders</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">{{ $product->total_sold }}</h5>
                                                            <span class="text-muted">Total Sold</span>
                                                        </td>
                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">${{ number_format($product->total_amount, 2) }}</h5>
                                                            <span class="text-muted">Amount</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div><!-- end card body -->
                            </div> <!-- .card-->
                        </div> <!-- .col-->
                    </div> <!-- end row-->

                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card card-height-100">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Số lượng sản phẩm theo danh mục</h4>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown card-header-dropdown">
                                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted">Báo cáo<i class="mdi mdi-chevron-down ms-1"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Tải báo cáo</a>
                                                <a class="dropdown-item" href="#">Xuất dữ liệu</a>
                                                <a class="dropdown-item" href="#">Nhập dữ liệu</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card header -->
                
                                <div class="card-body">
                                    <canvas id="productsByCategoryChartCanvas"></canvas>
                                    {{-- <div id="products_by_category_chart" class="apex-charts" dir="ltr"></div> --}}
                                </div>
                            </div> <!-- .card-->
                        </div> <!-- .col-->

                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Thống kê sản phẩm theo thương hiệu</h4>
                                    <div class="flex-shrink-0">
                                        <button type="button" class="btn btn-soft-info btn-sm material-shadow-none">
                                            <i class="ri-file-list-3-line align-middle"></i> Generate Report
                                        </button>
                                    </div>
                                </div><!-- end card header -->
                
                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                            <thead class="text-muted table-light">
                                                <tr>
                                                    <th scope="col">Thương hiệu</th>
                                                    <th scope="col">Số lượng sản phẩm</th>
                                                    <th scope="col">Tổng số lượng tồn kho</th>
                                                    <th scope="col">Tổng số lượng đã bán</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($productsByBrand as $brand)
                                                    <tr>
                                                        <td>{{ $brand->brand_name }}</td>
                                                        <td>{{ $brand->product_count ?? 0 }}</td>
                                                        <td>{{ $brand->total_stock ?? 0 }}</td>
                                                        <td>{{ $brand->total_sold ?? 0 }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-muted">Hiện tại chưa có dữ liệu thống kê theo thương hiệu.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- .card-->
                        </div> <!-- .col-->
                    </div> <!-- end row-->

                </div> <!-- end .h-100-->

            </div> <!-- end col -->

            <div class="col-auto layout-rightside-col">
                <div class="overlay"></div>
                <div class="layout-rightside">
                    <div class="card h-100 rounded-0">
                        <div class="card-body p-0">
                            <div class="p-3">
                                <h6 class="text-muted mb-0 text-uppercase fw-semibold">Recent Activity</h6>
                            </div>
                            <div data-simplebar style="max-height: 410px;" class="p-3 pt-0">
                                <div class="acitivity-timeline acitivity-main">
                                    <div class="acitivity-item d-flex">
                                        <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                                            <div
                                                class="avatar-title bg-success-subtle text-success rounded-circle material-shadow">
                                                <i class="ri-shopping-cart-2-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1 lh-base">Purchase by James Price</h6>
                                            <p class="text-muted mb-1">Product noise evolve smartwatch </p>
                                            <small class="mb-0 text-muted">02:14 PM Today</small>
                                        </div>
                                    </div>
                                    <div class="acitivity-item py-3 d-flex">
                                        <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                                            <div
                                                class="avatar-title bg-danger-subtle text-danger rounded-circle material-shadow">
                                                <i class="ri-stack-fill"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1 lh-base">Added new <span class="fw-semibold">style
                                                    collection</span></h6>
                                            <p class="text-muted mb-1">By Nesta Technologies</p>
                                            <div class="d-inline-flex gap-2 border border-dashed p-2 mb-2">
                                                <a href="apps-ecommerce-product-details.html"
                                                    class="bg-light rounded p-1">
                                                    <img src="{{asset('templates/admin/assets/images/products/img-8.png')}}" alt=""
                                                        class="img-fluid d-block" />
                                                </a>
                                                <a href="apps-ecommerce-product-details.html"
                                                    class="bg-light rounded p-1">
                                                    <img src="{{asset('templates/admin/assets/images/products/img-2.png')}}" alt=""
                                                        class="img-fluid d-block" />
                                                </a>
                                                <a href="apps-ecommerce-product-details.html"
                                                    class="bg-light rounded p-1">
                                                    <img src="{{asset('templates/admin/assets/images/products/img-10.png')}}" alt=""
                                                        class="img-fluid d-block" />
                                                </a>
                                            </div>
                                            <p class="mb-0 text-muted"><small>9:47 PM Yesterday</small></p>
                                        </div>
                                    </div>
                                    <div class="acitivity-item py-3 d-flex">
                                        <div class="flex-shrink-0">
                                            <img src="{{asset('templates/admin/assets/images/users/avatar-2.jpg')}}" alt=""
                                                class="avatar-xs rounded-circle acitivity-avatar material-shadow">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1 lh-base">Natasha Carey have liked the products</h6>
                                            <p class="text-muted mb-1">Allow users to like products in your WooCommerce
                                                store.</p>
                                            <small class="mb-0 text-muted">25 Dec, 2021</small>
                                        </div>
                                    </div>
                                    <div class="acitivity-item py-3 d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-xs acitivity-avatar">
                                                <div class="avatar-title rounded-circle bg-secondary material-shadow">
                                                    <i class="mdi mdi-sale fs-14"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1 lh-base">Today offers by <a
                                                    href="apps-ecommerce-seller-details.html"
                                                    class="link-secondary">Digitech Galaxy</a></h6>
                                            <p class="text-muted mb-2">Offer is valid on orders of Rs.500 Or above for
                                                selected products only.</p>
                                            <small class="mb-0 text-muted">12 Dec, 2021</small>
                                        </div>
                                    </div>
                                    <div class="acitivity-item py-3 d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-xs acitivity-avatar">
                                                <div
                                                    class="avatar-title rounded-circle bg-danger-subtle text-danger material-shadow">
                                                    <i class="ri-bookmark-fill"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1 lh-base">Favorite Product</h6>
                                            <p class="text-muted mb-2">Esther James have Favorite product.</p>
                                            <small class="mb-0 text-muted">25 Nov, 2021</small>
                                        </div>
                                    </div>
                                    <div class="acitivity-item py-3 d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-xs acitivity-avatar">
                                                <div class="avatar-title rounded-circle bg-secondary material-shadow">
                                                    <i class="mdi mdi-sale fs-14"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1 lh-base">Flash sale starting <span
                                                    class="text-primary">Tomorrow.</span></h6>
                                            <p class="text-muted mb-0">Flash sale by <a href="javascript:void(0);"
                                                    class="link-secondary fw-medium">Zoetic Fashion</a></p>
                                            <small class="mb-0 text-muted">22 Oct, 2021</small>
                                        </div>
                                    </div>
                                    <div class="acitivity-item py-3 d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-xs acitivity-avatar">
                                                <div
                                                    class="avatar-title rounded-circle bg-info-subtle text-info material-shadow">
                                                    <i class="ri-line-chart-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1 lh-base">Monthly sales report</h6>
                                            <p class="text-muted mb-2"><span class="text-danger">2 days left</span>
                                                notification to submit the monthly sales report. <a
                                                    href="javascript:void(0);"
                                                    class="link-warning text-decoration-underline">Reports Builder</a>
                                            </p>
                                            <small class="mb-0 text-muted">15 Oct</small>
                                        </div>
                                    </div>
                                    <div class="acitivity-item d-flex">
                                        <div class="flex-shrink-0">
                                            <img src="{{asset('templates/admin/assets/images/users/avatar-3.jpg')}}" alt=""
                                                class="avatar-xs rounded-circle acitivity-avatar material-shadow" />
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1 lh-base">Frank Hook Commented</h6>
                                            <p class="text-muted mb-2 fst-italic">" A product that has reviews is more
                                                likable to be sold than a product. "</p>
                                            <small class="mb-0 text-muted">26 Aug, 2021</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 mt-2">
                                <h6 class="text-muted mb-3 text-uppercase fw-semibold">Top 10 Categories
                                </h6>

                                <ol class="ps-3 text-muted">
                                    <li class="py-1">
                                        <a href="#" class="text-muted">Mobile & Accessories <span
                                                class="float-end">(10,294)</span></a>
                                    </li>
                                    <li class="py-1">
                                        <a href="#" class="text-muted">Desktop <span
                                                class="float-end">(6,256)</span></a>
                                    </li>
                                    <li class="py-1">
                                        <a href="#" class="text-muted">Electronics <span
                                                class="float-end">(3,479)</span></a>
                                    </li>
                                    <li class="py-1">
                                        <a href="#" class="text-muted">Home & Furniture <span
                                                class="float-end">(2,275)</span></a>
                                    </li>
                                    <li class="py-1">
                                        <a href="#" class="text-muted">Grocery <span
                                                class="float-end">(1,950)</span></a>
                                    </li>
                                    <li class="py-1">
                                        <a href="#" class="text-muted">Fashion <span
                                                class="float-end">(1,582)</span></a>
                                    </li>
                                    <li class="py-1">
                                        <a href="#" class="text-muted">Appliances <span
                                                class="float-end">(1,037)</span></a>
                                    </li>
                                    <li class="py-1">
                                        <a href="#" class="text-muted">Beauty, Toys & More <span
                                                class="float-end">(924)</span></a>
                                    </li>
                                    <li class="py-1">
                                        <a href="#" class="text-muted">Food & Drinks <span
                                                class="float-end">(701)</span></a>
                                    </li>
                                    <li class="py-1">
                                        <a href="#" class="text-muted">Toys & Games <span
                                                class="float-end">(239)</span></a>
                                    </li>
                                </ol>
                                <div class="mt-3 text-center">
                                    <a href="javascript:void(0);" class="text-muted text-decoration-underline">View
                                        all Categories</a>
                                </div>
                            </div>
                            <div class="p-3">
                                <h6 class="text-muted mb-3 text-uppercase fw-semibold">Products Reviews</h6>
                                <!-- Swiper -->
                                <div class="swiper vertical-swiper" style="height: 250px;">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="card border border-dashed shadow-none">
                                                <div class="card-body">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 avatar-sm">
                                                            <div class="avatar-title bg-light rounded material-shadow">
                                                                <img src="{{asset('templates/admin/assets/images/companies/img-1.png')}}"
                                                                    alt="" height="30">
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <div>
                                                                <p
                                                                    class="text-muted mb-1 fst-italic text-truncate-two-lines">
                                                                    " Great product and looks great, lots of features. "
                                                                </p>
                                                                <div class="fs-11 align-middle text-warning">
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-fill"></i>
                                                                </div>
                                                            </div>
                                                            <div class="text-end mb-0 text-muted">
                                                                - by <cite title="Source Title">Force Medicines</cite>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="card border border-dashed shadow-none">
                                                <div class="card-body">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0">
                                                            <img src="{{asset('templates/admin/assets/images/users/avatar-3.jpg')}}" alt=""
                                                                class="avatar-sm rounded material-shadow">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <div>
                                                                <p
                                                                    class="text-muted mb-1 fst-italic text-truncate-two-lines">
                                                                    " Amazing template, very easy to understand and
                                                                    manipulate. "</p>
                                                                <div class="fs-11 align-middle text-warning">
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-half-fill"></i>
                                                                </div>
                                                            </div>
                                                            <div class="text-end mb-0 text-muted">
                                                                - by <cite title="Source Title">Henry Baird</cite>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="card border border-dashed shadow-none">
                                                <div class="card-body">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 avatar-sm">
                                                            <div class="avatar-title bg-light rounded">
                                                                <img src="{{asset('templates/admin/assets/images/companies/img-8.png')}}"
                                                                    alt="" height="30">
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <div>
                                                                <p
                                                                    class="text-muted mb-1 fst-italic text-truncate-two-lines">
                                                                    "Very beautiful product and Very helpful customer
                                                                    service."</p>
                                                                <div class="fs-11 align-middle text-warning">
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-line"></i>
                                                                    <i class="ri-star-line"></i>
                                                                </div>
                                                            </div>
                                                            <div class="text-end mb-0 text-muted">
                                                                - by <cite title="Source Title">Zoetic Fashion</cite>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="card border border-dashed shadow-none">
                                                <div class="card-body">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0">
                                                            <img src="{{asset('templates/admin/assets/images/users/avatar-2.jpg')}}" alt=""
                                                                class="avatar-sm rounded material-shadow">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <div>
                                                                <p
                                                                    class="text-muted mb-1 fst-italic text-truncate-two-lines">
                                                                    " The product is very beautiful. I like it. "</p>
                                                                <div class="fs-11 align-middle text-warning">
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-fill"></i>
                                                                    <i class="ri-star-half-fill"></i>
                                                                    <i class="ri-star-line"></i>
                                                                </div>
                                                            </div>
                                                            <div class="text-end mb-0 text-muted">
                                                                - by <cite title="Source Title">Nancy Martino</cite>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3">
                                <h6 class="text-muted mb-3 text-uppercase fw-semibold">Customer Reviews</h6>
                                <div class="bg-light px-3 py-2 rounded-2 mb-2">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <div class="fs-16 align-middle text-warning">
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-fill"></i>
                                                <i class="ri-star-half-fill"></i>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <h6 class="mb-0">4.5 out of 5</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="text-muted">Total <span class="fw-medium">5.50k</span> reviews</div>
                                </div>

                                <div class="mt-3">
                                    <div class="row align-items-center g-2">
                                        <div class="col-auto">
                                            <div class="p-1">
                                                <h6 class="mb-0">5 star</h6>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="p-1">
                                                <div class="progress animated-progress progress-sm">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: 50.16%" aria-valuenow="50.16" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="p-1">
                                                <h6 class="mb-0 text-muted">2758</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <div class="row align-items-center g-2">
                                        <div class="col-auto">
                                            <div class="p-1">
                                                <h6 class="mb-0">4 star</h6>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="p-1">
                                                <div class="progress animated-progress progress-sm">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: 29.32%" aria-valuenow="29.32" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="p-1">
                                                <h6 class="mb-0 text-muted">1063</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <div class="row align-items-center g-2">
                                        <div class="col-auto">
                                            <div class="p-1">
                                                <h6 class="mb-0">3 star</h6>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="p-1">
                                                <div class="progress animated-progress progress-sm">
                                                    <div class="progress-bar bg-warning" role="progressbar"
                                                        style="width: 18.12%" aria-valuenow="18.12" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="p-1">
                                                <h6 class="mb-0 text-muted">997</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <div class="row align-items-center g-2">
                                        <div class="col-auto">
                                            <div class="p-1">
                                                <h6 class="mb-0">2 star</h6>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="p-1">
                                                <div class="progress animated-progress progress-sm">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: 4.98%" aria-valuenow="4.98" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-auto">
                                            <div class="p-1">
                                                <h6 class="mb-0 text-muted">227</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->

                                    <div class="row align-items-center g-2">
                                        <div class="col-auto">
                                            <div class="p-1">
                                                <h6 class="mb-0">1 star</h6>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="p-1">
                                                <div class="progress animated-progress progress-sm">
                                                    <div class="progress-bar bg-danger" role="progressbar"
                                                        style="width: 7.42%" aria-valuenow="7.42" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="p-1">
                                                <h6 class="mb-0 text-muted">408</h6>
                                            </div>
                                        </div>
                                    </div><!-- end row -->
                                </div>
                            </div>

                            <div class="card sidebar-alert bg-light border-0 text-center mx-4 mb-0 mt-3">
                                <div class="card-body">
                                    <img src="{{asset('templates/admin/assets/images/giftbox.png')}}" alt="">
                                    <div class="mt-4">
                                        <h5>Invite New Seller</h5>
                                        <p class="text-muted lh-base">Refer a new seller to us and earn $100 per refer.
                                        </p>
                                        <button type="button" class="btn btn-primary btn-label rounded-pill"><i
                                                class="ri-mail-fill label-icon align-middle rounded-pill fs-16 me-2"></i>
                                            Invite Now</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> <!-- end card-->
                </div> <!-- end .rightbar-->

            </div> <!-- end col -->
        </div>

    </div>
    <!-- container-fluid -->
</div>


<!-- Thêm Chart.js -->
<style>
    #financial_chart {
        min-height: 350px !important;
        width: 100% !important;
        border: 1px solid #ddd;
    }
    canvas#financialChartCanvas {
        max-height: 350px;
        width: 100%;
    }
    #products_by_category_chart {
        min-height: 350px !important;
        width: 100% !important;
        border: 1px solid #ddd;
    }
    canvas#productsByCategoryChartCanvas {
        max-height: 350px;
        width: 100%;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>
    // --- Biểu đồ cột: Tổng đơn hàng, Doanh thu, Đơn hàng hủy ---
    var initialTotalOrders = {{ $totalOrdersForChart }};
    var initialRevenue = {{ $revenueForChart ?: 0 }};
    var initialCancelledOrders = {{ $cancelledOrdersForChart }};

    var financialChartElement = document.querySelector("#financialChartCanvas");
    if (financialChartElement) {
        var financialChart = new Chart(financialChartElement, {
            type: 'bar',
            data: {
                labels: ['Thống kê'],
                datasets: [
                    {
                        label: 'Tổng đơn hàng',
                        data: [initialTotalOrders],
                        backgroundColor: '#3b82f6',
                        borderColor: '#3b82f6',
                        borderWidth: 1
                    },
                    {
                        label: 'Doanh thu (triệu VND)',
                        data: [initialRevenue / 1000000],
                        backgroundColor: '#10b981',
                        borderColor: '#10b981',
                        borderWidth: 1
                    },
                    {
                        label: 'Đơn hàng hủy',
                        data: [initialCancelledOrders],
                        backgroundColor: '#ef4444',
                        borderColor: '#ef4444',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.dataset.label || '';
                                var value = context.parsed.y;
                                if (label === 'Doanh thu (triệu VND)') {
                                    return label + ': ' + (value * 1000000).toLocaleString('vi-VN') + ' VND';
                                }
                                return label + ': ' + value.toLocaleString('vi-VN');
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Danh mục'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Giá trị'
                        },
                        ticks: {
                            callback: function(value, index, ticks) {
                                return value.toLocaleString('vi-VN');
                            }
                        }
                    }
                }
            }
        });
        console.log('Biểu đồ financialChart đã khởi tạo:', financialChart);
    } else {
        console.error('Không tìm thấy canvas #financialChartCanvas');
    }

    // --- Biểu đồ tròn: Số lượng sản phẩm theo danh mục ---
    var productsByCategoryData = @json($productsByCategory);
    console.log('Initial productsByCategoryData:', productsByCategoryData);

    var seriesData = Object.values(productsByCategoryData).map(value => Number(value) || 0);
    var labelsData = Object.keys(productsByCategoryData);

    var productsByCategoryChartElement = document.querySelector("#productsByCategoryChartCanvas");
    if (productsByCategoryChartElement && labelsData.length > 0 && seriesData.every(value => !isNaN(value))) {
        var total = seriesData.reduce((sum, value) => sum + value, 0); // Tính tổng
        var productsByCategoryChart = new Chart(productsByCategoryChartElement, {
            type: 'pie',
            data: {
                labels: labelsData,
                datasets: [{
                    label: 'Số lượng sản phẩm',
                    data: seriesData,
                    backgroundColor: ['#3b82f6', '#10b981', '#ef4444', '#f59e0b', '#6b7280'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.label || '';
                                var value = context.parsed;
                                var percentage = ((value / total) * 100).toFixed(2); // Tính phần trăm
                                return label + ': ' + value.toLocaleString('vi-VN') + ' (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });
        console.log('Biểu đồ productsByCategoryChart đã khởi tạo:', productsByCategoryChart);
    } else {
        console.warn('Không thể khởi tạo productsByCategoryChart: Dữ liệu không hợp lệ hoặc canvas không tồn tại');
    }

    // --- Xử lý sự kiện thay đổi bộ lọc ---
    document.addEventListener('DOMContentLoaded', function () {
        const revenueYearFilter = document.getElementById('revenueYearFilter');
        const revenueMonthFilter = document.getElementById('revenueMonthFilter');

        function updateFinancialChartAndStats() {
            const revenue_year = revenueYearFilter.value;
            const revenue_month = revenueMonthFilter.value;

            fetch('{{ route("admin.dashboard") }}?revenue_year=' + revenue_year + '&revenue_month=' + revenue_month, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log('AJAX response:', data);

                // Cập nhật biểu đồ financial_chart
                if (financialChart) {
                    financialChart.data.datasets[0].data = [Number(data.totalOrdersForChart || 0)];
                    financialChart.data.datasets[1].data = [Number(data.revenueForChart || 0) / 1000000];
                    financialChart.data.datasets[2].data = [Number(data.cancelledOrdersForChart || 0)];
                    financialChart.update();
                } else {
                    console.error('financialChart không tồn tại để cập nhật');
                }

                // Cập nhật thống kê
                document.getElementById('totalOrders').textContent = data.totalOrdersForChart || 0;
                document.getElementById('revenue').textContent = '$' + (data.revenueForChart ? (data.revenueForChart / 1000).toFixed(2) : '0.00') + 'k';
                document.getElementById('cancelledOrders').textContent = data.cancelledOrdersForChart || 0;
                document.getElementById('completionRate').textContent = 
                    (data.totalOrdersForChart > 0 ? 
                        ((data.completedOrders / data.totalOrdersForChart) * 100).toFixed(2) : 0) + '%';
            })
            .catch(error => console.error('Error fetching financial data:', error));
        }

        if (revenueYearFilter && revenueMonthFilter) {
            revenueYearFilter.addEventListener('change', updateFinancialChartAndStats);
            revenueMonthFilter.addEventListener('change', updateFinancialChartAndStats);
        } else {
            console.error('Không tìm thấy revenueYearFilter hoặc revenueMonthFilter');
        }
    });
</script>
@endsection
@extends('admin.layouts.app')
@section('title', 'Mã Giảm Giá')
@section('style')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        .bg-gradient-primary {
            background: linear-gradient(90deg, #2f3d69, #405189, #6b7bbc);
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
            transition: background-color 0.3s ease;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .badge {
            font-weight: bold;
            border-radius: 8px;
            transition: transform 0.2s;
        }

        .badge:hover {
            transform: scale(1.05);
        }

        .text-center {
            text-align: center !important;
        }

        .fs-5 {
            font-size: 1.25rem !important;
        }

        .ri-eye-fill,
        .ri-pencil-fill,
        .ri-delete-bin-5-fill {
            transition: color 0.2s;
        }

        .ri-eye-fill:hover {
            color: #007bff !important;
        }

        .ri-pencil-fill:hover {
            color: #28a745 !important;
        }

        .ri-delete-bin-5-fill:hover {
            color: #dc3545 !important;
        }
    </style>
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Mã giảm giá</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Thương mại điện tử</a></li>
                                <li class="breadcrumb-item active">Mã giảm giá</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="orderList">
                        <div class="card-header border-0">
                            <div class="row align-items-center gy-3">
                                <div class="col-sm">
                                    <h5 class="card-title mb-0">Danh Sách Mã Giảm Giá</h5>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex gap-1 flex-wrap">
                                        <a href="{{ route('coupons.create') }}" class="btn btn-success add-btn"><i
                                                class="ri-add-line align-bottom me-1"></i> Tạo Mã Giảm Giá</a>
                                        <button type="button" class="btn btn-info"><i
                                                class="ri-file-download-line align-bottom me-1"></i> Thêm bằng
                                            Excel</button>
                                        <button class="btn btn-soft-danger" id="remove-actions"
                                            onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body border border-dashed border-end-0 border-start-0">
                            <form id="filterForm" method="GET" action="{{ route('coupons.index') }}">
                                <div class="row g-3">
                                    <!-- Ô tìm kiếm theo tên -->
                                    <div class="col-lg-5 col-md-6">
                                        <div class="search-box">
                                            <input type="text" class="form-control search" name="name"
                                                id="searchInput" placeholder="Nhập tên mã giảm giá...">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                    <!-- Ô tìm kiếm theo ngày -->
                                    <div class="col-lg-5 col-md-6">
                                        <div class="search-box">
                                            <input type="date" class="form-control search" name="date"
                                                id="searchDate">
                                            <i class="ri-calendar-2-line search-icon"></i>
                                        </div>
                                    </div>
                                    <!-- Nút lọc -->
                                    <div class="col-lg-2 ">
                                        <a class="btn btn-primary" href="{{ route('coupons.index') }}">Xóa</a>

                                        <button type="submit" class="btn btn-primary">
                                            <i class="ri-equalizer-fill me-1 align-bottom"></i> Lọc
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>




                        <div class="card-body pt-0">
                            <div>
                                <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active All py-3" data-bs-toggle="tab" id="All"
                                            href="#home1" role="tab" aria-selected="true">
                                            <i class="ri-store-2-fill me-1 align-bottom"></i> Tất cả <span
                                                class="badge bg-danger align-middle ms-1">{{ $coupons->count() }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link py-3 Delivered" data-bs-toggle="tab" id="Delivered"
                                            href="#delivered" role="tab" aria-selected="false">
                                            <i class="ri-checkbox-circle-line me-1 align-bottom"></i> Đang Phát Hành <span
                                                class="badge bg-danger align-middle ms-1">{{ $coupons->filter(fn($item) => $item->is_active && \Carbon\Carbon::parse($item->start_time)->isPast() && \Carbon\Carbon::parse($item->end_time)->isFuture())->count() }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link py-3 Pickups" data-bs-toggle="tab" id="Pickups" href="#pickups"
                                            role="tab" aria-selected="false">
                                            <i class="ri-truck-line me-1 align-bottom"></i> Chưa Phát Hành <span
                                                class="badge bg-danger align-middle ms-1">{{ $coupons->filter(fn($item) => \Carbon\Carbon::parse($item->start_time)->isFuture())->count() }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link py-3 Returns" data-bs-toggle="tab" id="Returns" href="#returns"
                                            role="tab" aria-selected="false">
                                            <i class="ri-arrow-left-right-fill me-1 align-bottom"></i> Đã Hết Hạn <span
                                                class="badge bg-danger align-middle ms-1">{{ $coupons->filter(fn($item) => \Carbon\Carbon::parse($item->end_time)->isPast())->count() }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link py-3 Cancelled" data-bs-toggle="tab" id="Cancelled"
                                            href="#cancelled" role="tab" aria-selected="false">
                                            <i class="ri-close-circle-line me-1 align-bottom"></i> Đã Hủy <span
                                                class="badge bg-danger align-middle ms-1">{{ $coupons->filter(fn($item) => !$item->is_active)->count() }}</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <!-- Tab Tất cả -->
                                    <div class="tab-pane active" id="home1" role="tabpanel">
                                        <div class="table-responsive table-card mb-1">
                                            <table class="table table-hover table-nowrap align-middle" id="orderTable">
                                                <thead class="text-white bg-gradient-primary">
                                                    <tr class="text-uppercase">
                                                        <th scope="col" style="width: 25px;">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="checkAll" value="option">
                                                            </div>
                                                        </th>
                                                        <th class="sort" data-sort="code">Mã Coupon</th>
                                                        <th class="sort" data-sort="start_time">Bắt Đầu</th>
                                                        <th class="sort" data-sort="end_time">Kết Thúc</th>
                                                        <th class="sort" data-sort="discount_type">Loại</th>
                                                        <th class="sort text-center" data-sort="discount_value">Giá Trị
                                                        </th>
                                                        <th class="sort text-center" data-sort="is_active">Trạng Thái</th>
                                                        <th class="sort text-center" data-sort="city">Hành Động</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                    @foreach ($coupons as $item)
                                                        @include('admin.coupons.partials.coupon-row', [
                                                            'item' => $item,
                                                        ])
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Tab Đang Phát Hành -->
                                    <div class="tab-pane" id="delivered" role="tabpanel">
                                        <div class="table-responsive table-card mb-1">
                                            <table class="table table-hover table-nowrap align-middle"
                                                id="deliveredTable">
                                                <thead class="text-white bg-gradient-primary">
                                                    <tr class="text-uppercase">
                                                        <th scope="col" style="width: 25px;">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="checkAllDelivered" value="option">
                                                            </div>
                                                        </th>
                                                        <th class="sort" data-sort="code">Mã Coupon</th>
                                                        <th class="sort" data-sort="start_time">Bắt Đầu</th>
                                                        <th class="sort" data-sort="end_time">Kết Thúc</th>
                                                        <th class="sort" data-sort="discount_type">Loại</th>
                                                        <th class="sort text-center" data-sort="discount_value">Giá Trị
                                                        </th>
                                                        <th class="sort text-center" data-sort="is_active">Trạng Thái</th>
                                                        <th class="sort text-center" data-sort="city">Hành Động</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                    @foreach ($coupons->filter(fn($item) => $item->is_active && \Carbon\Carbon::parse($item->start_time)->isPast() && \Carbon\Carbon::parse($item->end_time)->isFuture()) as $item)
                                                        @include('admin.coupons.partials.coupon-row', [
                                                            'item' => $item,
                                                        ])
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Tab Chưa Phát Hành -->
                                    <div class="tab-pane" id="pickups" role="tabpanel">
                                        <div class="table-responsive table-card mb-1">
                                            <table class="table table-hover table-nowrap align-middle" id="pickupsTable">
                                                <thead class="text-white bg-gradient-primary">
                                                    <tr class="text-uppercase">
                                                        <th scope="col" style="width: 25px;">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="checkAllPickups" value="option">
                                                            </div>
                                                        </th>
                                                        <th class="sort" data-sort="code">Mã Coupon</th>
                                                        <th class="sort" data-sort="start_time">Bắt Đầu</th>
                                                        <th class="sort" data-sort="end_time">Kết Thúc</th>
                                                        <th class="sort" data-sort="discount_type">Loại</th>
                                                        <th class="sort text-center" data-sort="discount_value">Giá Trị
                                                        </th>
                                                        <th class="sort text-center" data-sort="is_active">Trạng Thái</th>
                                                        <th class="sort text-center" data-sort="city">Hành Động</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                    @foreach ($coupons->filter(fn($item) => \Carbon\Carbon::parse($item->start_time)->isFuture()) as $item)
                                                        @include('admin.coupons.partials.coupon-row', [
                                                            'item' => $item,
                                                        ])
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Tab Đã Hết Hạn -->
                                    <div class="tab-pane" id="returns" role="tabpanel">
                                        <div class="table-responsive table-card mb-1">
                                            <table class="table table-hover table-nowrap align-middle" id="returnsTable">
                                                <thead class="text-white bg-gradient-primary">
                                                    <tr class="text-uppercase">
                                                        <th scope="col" style="width: 25px;">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="checkAllReturns" value="option">
                                                            </div>
                                                        </th>
                                                        <th class="sort" data-sort="code">Mã Coupon</th>
                                                        <th class="sort" data-sort="start_time">Bắt Đầu</th>
                                                        <th class="sort" data-sort="end_time">Kết Thúc</th>
                                                        <th class="sort" data-sort="discount_type">Loại</th>
                                                        <th class="sort text-center" data-sort="discount_value">Giá Trị
                                                        </th>
                                                        <th class="sort text-center" data-sort="is_active">Trạng Thái</th>
                                                        <th class="sort text-center" data-sort="city">Hành Động</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                    @foreach ($coupons->filter(fn($item) => \Carbon\Carbon::parse($item->end_time)->isPast()) as $item)
                                                        @include('admin.coupons.partials.coupon-row', [
                                                            'item' => $item,
                                                        ])
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Tab Đã Hủy -->
                                    <div class="tab-pane" id="cancelled" role="tabpanel">
                                        <div class="table-responsive table-card mb-1">
                                            <table class="table table-hover table-nowrap align-middle"
                                                id="cancelledTable">
                                                <thead class="text-white bg-gradient-primary">
                                                    <tr class="text-uppercase">
                                                        <th scope="col" style="width: 25px;">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="checkAllCancelled" value="option">
                                                            </div>
                                                        </th>
                                                        <th class="sort" data-sort="code">Mã Coupon</th>
                                                        <th class="sort" data-sort="start_time">Bắt Đầu</th>
                                                        <th class="sort" data-sort="end_time">Kết Thúc</th>
                                                        <th class="sort" data-sort="discount_type">Loại</th>
                                                        <th class="sort text-center" data-sort="discount_value">Giá Trị
                                                        </th>
                                                        <th class="sort text-center" data-sort="is_active">Trạng Thái</th>
                                                        <th class="sort text-center" data-sort="city">Hành Động</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list form-check-all">
                                                    @foreach ($coupons->filter(fn($item) => !$item->is_active) as $item)
                                                        @include('admin.coupons.partials.coupon-row', [
                                                            'item' => $item,
                                                        ])
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev disabled" href="#">Trước</a>
                                        <ul class="pagination listjs-pagination mb-0"></ul>
                                        <a class="page-item pagination-next" href="#">Sau</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body p-5 text-center">
                                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                                colors="primary:#405189,secondary:#f06548"
                                                style="width:90px;height:90px"></lord-icon>
                                            <div class="mt-4 text-center">
                                                <h4>Bạn muốn xóa mã giảm giá này sao?</h4>
                                                <p class="text-muted fs-15 mb-4">Xóa mã giảm giá sẽ không thể khôi phục</p>
                                                <div class="hstack gap-2 justify-content-center remove">
                                                    <button
                                                        class="btn btn-link link-success border-danger fw-medium text-decoration-none"
                                                        id="deleteRecord-close" data-bs-dismiss="modal">
                                                        <i class="ri-close-line me-1 align-middle"></i> Đóng
                                                    </button>
                                                    <form id="deleteForm" method="POST" action="">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger"
                                                            id="delete-record">Có Hãy Xóa Nó</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end modal -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Lắng nghe sự kiện click vào nút "Remove" với class remove-item-btn
            $('.remove-item-btn').on('click', function(e) {
                e.preventDefault(); // Ngăn hành vi mặc định của <a>
                var actionUrl = $(this).data('action');
                $('#deleteForm').attr('action', actionUrl);
            });
        });
    </script>

@endsection

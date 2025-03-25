@extends('admin.layouts.app')
@section('title', 'Mã Giảm Giá')
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- Optional Custom CSS -->
<style>
    .bg-gradient-primary {
        background: linear-gradient(90deg, #007bff, #00c4cc);
    }
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .bg-light {
        background-color: #f8f9fa !important;
    }
    .rounded {
        border-radius: 8px !important;
    }
    .badge {
        font-weight: bold;
        border-radius: 10px;
    }
</style>
@endsection

@section('content')

    <div class="page-content">
        <div class="container-fluid">
            <div class="card shadow-sm border-0">
                <!-- Card Header -->
               <div class="card-header bg-gradient-primary text-white p-4 d-flex justify-content-between align-items-center">
    <h5 class="card-title mb-0"><i class="fas fa-ticket-alt me-2"></i> Chi Tiết Mã Giảm Giá</h5>
    <span class="badge bg-light text-dark fs-4 px-3 py-2">{{ $coupon->code }}</span>
</div>

                <!-- Card Body -->
                <div class="card-body p-4">
                    <!-- Basic Info -->
                    <div class="mb-4">
                        <h6 class="text-muted fw-bold"><i class="fas fa-info-circle me-1"></i> Thông Tin Cơ Bản</h6>
                        <div class="row">
                            <div class="col-12">
                                <div class="bg-light p-3 rounded">
                                    <strong>Mô Tả:</strong>
                                    <span class="ms-2">{{ $coupon->description ?? 'Không có mô tả' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Discount Details -->
                    <div class="mb-4">
                        <h6 class="text-muted fw-bold"><i class="fas fa-tag me-1"></i> Chi Tiết Giảm Giá</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded">
                                    <strong>Loại:</strong>
                                    <span class="ms-2">
                                        @if ($coupon->discount_type == 'percentage')
                                            Percentage
                                        @elseif($coupon->discount_type == 'fixed')
                                            Fixed
                                        @elseif($coupon->discount_type == 'freeship')
                                            FreeShip
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded">
                                    <strong>Giá Trị:</strong>
                                    <span class="ms-2">{{ $coupon->discount_value }}
                                        {{ $coupon->discount_type == 'percentage' ? '%' : 'VNĐ' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded">
                                    <strong>Giá Trị Đơn Hàng Tối Thiểu:</strong>
                                    <span class="ms-2">{{ number_format($coupon->minimum_order_value) }} VNĐ</span>
                                </div>
                            </div>
                            @if ($coupon->discount_type == 'freeship')
                                <div class="col-md-6">
                                    <div class="bg-light p-3 rounded">
                                        <strong>Giảm Giá Vận Chuyển Tối Đa:</strong>
                                        <span class="ms-2">{{ number_format($coupon->max_shipping_discount) }} VNĐ</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Usage Limits -->
                    <div class="mb-4">
                        <h6 class="text-muted fw-bold"><i class="fas fa-users me-1"></i> Giới Hạn Sử Dụng</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded">
                                    <strong>Số Lần Sử Dụng:</strong>
                                    <span class="ms-2">{{ $coupon->max_uses }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded">
                                    <strong>Mã/Người:</strong>
                                    <span class="ms-2">{{ $coupon->max_uses_per_user }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Date Info -->
                    <div class="mb-4">
                        <h6 class="text-muted fw-bold"><i class="fas fa-calendar-alt me-1"></i> Thời Gian</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded">
                                    <strong>Ngày Phát Hành:</strong>
                                    <span
                                        class="ms-2">{{ \Carbon\Carbon::parse($coupon->start_time)->format('d/m/Y') }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded">
                                    <strong>Ngày Kết Thúc:</strong>
                                    <span
                                        class="ms-2">{{ \Carbon\Carbon::parse($coupon->end_time)->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Categories & Brands -->
                    <div class="mb-4">
                        <h6 class="text-muted fw-bold"><i class="fas fa-list me-1"></i> Danh Mục & Thương Hiệu</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded">
                                    <strong>Danh Mục:</strong>
                                    <span class="ms-2">
                                        @if ($coupon->categories && $coupon->categories->isNotEmpty())
                                            {{ $coupon->categories->pluck('name')->implode(', ') }}
                                        @else
                                            Không có
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-light p-3 rounded">
                                    <strong>Thương Hiệu:</strong>
                                    <span class="ms-2">
                                        @if ($coupon->brands && $coupon->brands->isNotEmpty())
                                            {{ $coupon->brands->pluck('name')->implode(', ') }}
                                        @else
                                            Không có
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <h6 class="text-muted fw-bold"><i class="fas fa-toggle-on me-1"></i> Trạng Thái</h6>
                        <div class="bg-light p-3 rounded">
                            <span class="badge {{ $coupon->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $coupon->is_active ? 'Hoạt Động' : 'Khóa' }}
                            </span>
                        </div>
                    </div>

                    <!-- Back Button -->
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('coupons.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i> Quay Lại
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@extends('admin.layouts.app')
@section('title', 'Mã Giảm Giá')
@section('style')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        .bg-gradient-primary {
            background: linear-gradient(90deg, #007bff, #00c4cc);
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Thương mại điện tự</a></li>
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
                            <form>
                                <div class="row g-3">
                                    <div class="col-xxl-5 col-sm-6">
                                        <div class="search-box">
                                            <input type="text" class="form-control search"
                                                placeholder="Search for order ID, customer, order status or something...">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-2 col-sm-6">
                                        <div>
                                            <input type="text" class="form-control" data-provider="flatpickr"
                                                data-date-format="d M, Y" data-range-date="true" id="demo-datepicker"
                                                placeholder="Select date">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-2 col-sm-4">
                                        <div>
                                            <select class="form-control" data-choices data-choices-search-false
                                                name="choices-single-default" id="idStatus">
                                                <option value="">Status</option>
                                                <option value="all" selected>All</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Inprogress">Inprogress</option>
                                                <option value="Cancelled">Cancelled</option>
                                                <option value="Pickups">Pickups</option>
                                                <option value="Returns">Returns</option>
                                                <option value="Delivered">Delivered</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-2 col-sm-4">
                                        <div>
                                            <select class="form-control" data-choices data-choices-search-false
                                                name="choices-single-default" id="idPayment">
                                                <option value="">Select Payment</option>
                                                <option value="all" selected>All</option>
                                                <option value="Mastercard">Mastercard</option>
                                                <option value="Paypal">Paypal</option>
                                                <option value="Visa">Visa</option>
                                                <option value="COD">COD</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xxl-1 col-sm-4">
                                        <div>
                                            <button type="button" class="btn btn-primary w-100" onclick="SearchData();"> <i
                                                    class="ri-equalizer-fill me-1 align-bottom"></i>
                                                Lọc
                                            </button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <div class="card-body pt-0">
                            <div>
                                <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active All py-3" data-bs-toggle="tab" id="All"
                                            href="#home1" role="tab" aria-selected="true">
                                            <i class="ri-store-2-fill me-1 align-bottom"></i> Tất cả <span
                                                class="badge bg-danger align-middle ms-1">2</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link py-3 Delivered" data-bs-toggle="tab" id="Delivered"
                                            href="#delivered" role="tab" aria-selected="false">
                                            <i class="ri-checkbox-circle-line me-1 align-bottom"></i> Đang Phát Hành <span
                                                class="badge bg-danger align-middle ms-1">2</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link py-3 Pickups" data-bs-toggle="tab" id="Pickups"
                                            href="#pickups" role="tab" aria-selected="false">
                                            <i class="ri-truck-line me-1 align-bottom"></i> Chưa Phát Hành <span
                                                class="badge bg-danger align-middle ms-1">2</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link py-3 Returns" data-bs-toggle="tab" id="Returns"
                                            href="#returns" role="tab" aria-selected="false">
                                            <i class="ri-arrow-left-right-fill me-1 align-bottom"></i> Đã Hết Hạn <span
                                                class="badge bg-danger align-middle ms-1">2</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link py-3 Cancelled" data-bs-toggle="tab" id="Cancelled"
                                            href="#cancelled" role="tab" aria-selected="false">
                                            <i class="ri-close-circle-line me-1 align-bottom"></i> Đã Hủy <span
                                                class="badge bg-danger align-middle ms-1">2</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="table-responsive table-card mb-1">
                                    <table class="table table-hover table-nowrap align-middle" id="orderTable">
                                        <!-- Table Header -->
                                        <thead class="text-white bg-gradient-primary">
                                            <tr class="text-uppercase">
                                                <th scope="col" style="width: 25px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll"
                                                            value="option">
                                                    </div>
                                                </th>
                                                <th class="sort" data-sort="code">Mã Coupon</th>
                                                <th class="sort" data-sort="start_time">Bắt Đầu</th>
                                                <th class="sort" data-sort="end_time">Kết Thúc</th>
                                                <th class="sort" data-sort="discount_type">Loại</th>
                                                <th class="sort text-center" data-sort="discount_value">Giá Trị</th>
                                                <th class="sort text-center" data-sort="is_active">Trạng Thái</th>
                                                <th class="sort text-center" data-sort="city">Hành Động</th>
                                            </tr>
                                        </thead>

                                        <!-- Table Body -->
                                        <tbody class="list form-check-all">
                                            @foreach ($coupons as $item)
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="checkAll" value="option1">
                                                        </div>
                                                    </th>

                                                    <!-- Coupon Code -->
                                                    <td class="code">
                                                        <span
                                                            class="badge bg-primary-subtle text-primary fs-5 fw-bold px-3 py-2 text-uppercase">
                                                            <i class="fas fa-ticket-alt me-1"></i> {{ $item->code }}
                                                        </span>
                                                    </td>

                                                    <!-- Start Time -->
                                                    <td class="startTime">
                                                        <span
                                                            class="d-block">{{ \Carbon\Carbon::parse($item->start_time)->format('d/m/Y') }}</span>
                                                        <small
                                                            class="text-muted">{{ \Carbon\Carbon::parse($item->start_time)->format('H:i A') }}</small>
                                                    </td>

                                                    <!-- End Time -->
                                                    <td class="endTime">
                                                        <span
                                                            class="d-block">{{ \Carbon\Carbon::parse($item->end_time)->format('d/m/Y') }}</span>
                                                        <small
                                                            class="text-muted">{{ \Carbon\Carbon::parse($item->end_time)->format('H:i A') }}</small>
                                                    </td>

                                                    <!-- Discount Type -->
                                                    <td class="discount-type">
                                                        @php
                                                            $discountTypes = [
                                                                'percentage' => [
                                                                    'text' => 'Giảm %',
                                                                    'class' => 'bg-primary-subtle text-primary',
                                                                ],
                                                                'fixed' => [
                                                                    'text' => 'Giảm Tiền',
                                                                    'class' => 'bg-success-subtle text-success',
                                                                ],
                                                                'freeship' => [
                                                                    'text' => 'FreeShip',
                                                                    'class' => 'bg-warning-subtle text-warning',
                                                                ],
                                                            ];
                                                            $type = $discountTypes[$item->discount_type] ?? [
                                                                'text' => 'N/A',
                                                                'class' => 'bg-secondary-subtle text-secondary',
                                                            ];
                                                        @endphp
                                                        <span
                                                            class="badge {{ $type['class'] }} fs-5 px-3 py-2">{{ $type['text'] }}</span>
                                                    </td>

                                                    <!-- Discount Value -->
                                                    <td class="discount-value text-center">
                                                        @if ($item->discount_type === 'percentage')
                                                            <span
                                                                class="badge bg-success-subtle text-success fs-5 px-3 py-2">
                                                                <i class="fas fa-percent me-1"></i>
                                                                {{ number_format($item->discount_value, 0) }}%
                                                            </span>
                                                        @elseif ($item->discount_type === 'fixed')
                                                            <span
                                                                class="badge bg-danger-subtle text-danger fs-5 px-3 py-2">
                                                                <i class="fas fa-money-bill-wave me-1"></i>
                                                                {{ number_format($item->discount_value, 0, ',', '.') }} VNĐ
                                                            </span>
                                                        @else
                                                            <span
                                                                class="badge bg-warning-subtle text-warning fs-5 px-3 py-2">
                                                                <i class="fas fa-truck me-1"></i> Free
                                                            </span>
                                                        @endif
                                                    </td>

                                                    <!-- Status -->
                                                    <td class="status text-center">
                                                        @php
                                                            $status = 'Đang Áp Dụng';
                                                            $badgeClass = 'bg-success-subtle text-success';
                                                            if (
                                                                $item->end_time &&
                                                                \Carbon\Carbon::parse($item->end_time)->isPast()
                                                            ) {
                                                                $status = 'Hết Hạn';
                                                                $badgeClass = 'bg-secondary-subtle text-secondary';
                                                            } elseif (!$item->is_active) {
                                                                $status = 'Không Áp Dụng';
                                                                $badgeClass = 'bg-danger-subtle text-danger';
                                                            }
                                                        @endphp
                                                        <span
                                                            class="badge {{ $badgeClass }} fs-5 px-3 py-2 text-uppercase">{{ $status }}</span>
                                                    </td>

                                                    <!-- Actions -->
                                                    <td class="text-center">
                                                        <ul class="list-inline hstack gap-2 mb-0">
                                                            <li class="list-inline-item" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Xem Chi Tiết">
                                                                <a href="{{ route('coupons.show', $item) }}"
                                                                    class="text-primary d-inline-block">
                                                                    <i class="ri-eye-fill fs-18"></i>
                                                                </a>
                                                            </li>
                                                            <li class="list-inline-item" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Chỉnh Sửa">
                                                                <a href="{{ route('coupons.edit', $item) }}"
                                                                    class="text-success d-inline-block">
                                                                    <i class="ri-pencil-fill fs-18"></i>
                                                                </a>
                                                            </li>
                                                            <li class="list-inline-item" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Xóa">
                                                                <a class="text-danger d-inline-block remove-item-btn"
                                                                    data-bs-toggle="modal" href="#deleteOrder"
                                                                    data-id="{{ $item->id }}"
                                                                    data-action="{{ route('coupons.destroy', $item) }}">
                                                                    <i class="ri-delete-bin-5-fill fs-18"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                colors="primary:#405189,secondary:#0ab39c"
                                                style="width:75px;height:75px"></lord-icon>
                                            <h5 class="mt-2">Sorry! No Result Found</h5>
                                            <p class="text-muted">We've searched more than 150+ Orders We did not find any
                                                orders for you search.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev disabled" href="#">
                                            Trước
                                        </a>
                                        <ul class="pagination listjs-pagination mb-0"></ul>
                                        <a class="page-item pagination-next" href="#">
                                            Sau
                                        </a>
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
                                                        class="btn btn-link link-success fw-medium text-decoration-none"
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
                <!--end col-->
            </div>
            <!--end row-->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Lắng nghe sự kiện click vào nút "Remove" với class remove-item-btn
            $('.remove-item-btn').on('click', function(e) {
                e.preventDefault(); // Ngăn hành vi mặc định của <a>

                // Lấy URL từ data-action
                var actionUrl = $(this).data('action');

                // Cập nhật action của form trong modal
                $('#deleteForm').attr('action', actionUrl);
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector(".tablelist-form");

            form.addEventListener("submit", function(event) {
                event.preventDefault();
                let isValid = true;

                document.querySelectorAll(".error-message").forEach(el => el.innerText = "");
                document.querySelectorAll(".border-danger").forEach(el => el.classList.remove(
                    "border-danger"));

                function showError(input, message) {
                    isValid = false;
                    input.classList.add("border-danger");
                    let errorDiv = input.parentElement.querySelector(".error-message");
                    if (errorDiv) {
                        errorDiv.innerText = message;
                    }
                }

                // Validate Mã Code
                let code = document.getElementById("code");
                if (!code.value.trim()) showError(code, "Mã Code không được để trống");

                // Validate Mô tả
                let description = document.getElementById("description-field");
                if (!description.value.trim()) showError(description, "Mô tả không được để trống");

                // Validate Loại Giảm Giá
                let discountType = document.getElementById("discount-type-field");
                if (!discountType.value) showError(discountType, "Vui lòng chọn loại giảm giá");

                // Validate Giá Trị Giảm Giá
                let discountValue = document.getElementById("discount-value-field");
                if (discountValue.disabled) {
                    let errorDiv = discountValue.parentElement.querySelector(".error-message");
                    if (errorDiv) errorDiv.innerText = ""; // Xóa lỗi nếu input bị disable
                    discountValue.classList.remove("border-danger");
                } else if (discountValue.value === "" || parseFloat(discountValue.value) <= 0) {
                    showError(discountValue, "Giá trị phải lớn hơn 0");
                }

                // Validate Số Lần Sử Dụng
                let maxUses = document.getElementById("max_uses");
                if (maxUses.value === "" || parseInt(maxUses.value) < 1) {
                    showError(maxUses, "Số lần sử dụng phải lớn hơn 0");
                }

                // Validate Giá Trị Đơn Hàng Tối Thiểu
                let minimumOrderValue = document.getElementById("minimum_order_value");
                if (minimumOrderValue.value === "" || parseInt(minimumOrderValue.value) < 1) {
                    showError(minimumOrderValue, "Giá trị đơn hàng tối thiểu phải lớn hơn 0");
                }

                // Validate Số Mã/Người
                let maxUsesPerUser = document.getElementById("max-uses-per-user-field");
                if (maxUsesPerUser.value === "" || parseInt(maxUsesPerUser.value) < 1) {
                    showError(maxUsesPerUser, "Số mã/người phải lớn hơn 0");
                }

                // Validate Số Giảm Giá Tối Đa Vận Chuyển (chỉ khi freeship)
                let maxShippingDiscount = document.getElementById("max-shipping-discount-field");
                if (discountType.value === "freeship") {
                    if (maxShippingDiscount.value === "" || parseInt(maxShippingDiscount.value) < 1) {
                        showError(maxShippingDiscount, "Số giảm giá tối đa vận chuyển phải lớn hơn 0");
                    }
                }

                // Validate Ngày Phát Hành và Ngày Kết Thúc
                let startDate = document.querySelector("input[name='start_time']");
                let endDate = document.querySelector("input[name='end_time']");

                if (!startDate.value) {
                    showError(startDate, "Vui lòng chọn ngày phát hành");
                }
                if (!endDate.value) {
                    showError(endDate, "Vui lòng chọn ngày kết thúc");
                }
                if (startDate.value && endDate.value && new Date(startDate.value) > new Date(endDate
                        .value)) {
                    showError(endDate, "Ngày kết thúc phải sau ngày phát hành");
                }

                // Nếu hợp lệ, submit form
                if (isValid) form.submit();
            });
        });
    </script>



    <script>
        let selectedCategories = [];
        let selectedBrands = [];

        function handleSelection(selectId, selectedArray, displayDivId, inputId) {
            let selectElement = document.getElementById(selectId);
            let selectedOption = selectElement.options[selectElement.selectedIndex];
            let id = selectedOption.value;
            let name = selectedOption.getAttribute("data-name");

            if (!id) return;

            if (id === "all") {
                selectedArray.length = 0;
                document.querySelectorAll(`#${selectId} option:not([value=""], [value="all"])`).forEach(option => {
                    selectedArray.push({
                        id: option.value,
                        name: option.getAttribute("data-name")
                    });
                });
            } else {
                if (!selectedArray.some(item => item.id === id)) {
                    selectedArray.push({
                        id,
                        name
                    });
                }
            }

            updateDisplay(selectedArray, displayDivId, inputId);
            selectElement.value = "";
        }

        function updateDisplay(selectedArray, displayDivId, inputId) {
            let displayDiv = document.getElementById(displayDivId);
            displayDiv.innerHTML = "";

            selectedArray.forEach(item => {
                let badge = document.createElement("div");
                badge.classList.add("selected-item");
                badge.innerHTML = `${item.name} <span data-id="${item.id}">&times;</span>`;

                badge.querySelector("span").addEventListener("click", function() {
                    let index = selectedArray.findIndex(i => i.id === item.id);
                    if (index !== -1) {
                        selectedArray.splice(index, 1);
                    }
                    updateDisplay(selectedArray, displayDivId, inputId);
                });

                displayDiv.appendChild(badge);
            });

            // Cập nhật input hidden dưới dạng mảng JSON
            document.getElementById(inputId).value = JSON.stringify(selectedArray.map(item => item.id));
        }

        document.getElementById("category-select").addEventListener("change", function() {
            handleSelection("category-select", selectedCategories, "selected-categories", "category-id");
        });

        document.getElementById("brand-select").addEventListener("change", function() {
            handleSelection("brand-select", selectedBrands, "selected-brands", "brand-id");
        });

        // Discount
        document.getElementById("discount-type-field").addEventListener("change", function() {
            let discountValueField = document.getElementById("discount-value-field");
            let discountUnit = document.getElementById("discount-unit");
            let maxShippingDiscountContainer = document.getElementById("max-shipping-discount-container");

            if (this.value === "percentage") {
                discountUnit.textContent = "%";
                discountValueField.disabled = false;
                discountValueField.placeholder = "Nhập phần trăm";
                maxShippingDiscountContainer.style.display = "none";
                toggleDisableElements(maxShippingDiscountContainer, true);
            } else if (this.value === "fixed") {
                discountUnit.textContent = "VNĐ";
                discountValueField.disabled = false;
                discountValueField.placeholder = "Nhập số tiền giảm";
                maxShippingDiscountContainer.style.display = "none";
                toggleDisableElements(maxShippingDiscountContainer, true);
            } else if (this.value === "freeship") {
                discountUnit.textContent = "";
                discountValueField.value = "";
                discountValueField.disabled = true;
                discountValueField.placeholder = "Miễn phí vận chuyển";
                maxShippingDiscountContainer.style.display = "block";
                toggleDisableElements(maxShippingDiscountContainer, false);
            }
        });

        function toggleDisableElements(container, disable) {
            container.querySelectorAll("input, select, textarea, button").forEach(el => {
                el.disabled = disable;
            });
        }
    </script>

@endsection

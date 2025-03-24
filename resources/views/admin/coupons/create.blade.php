@extends('admin.layouts.app')
@section('title', 'Mã Giảm Giá')
@section('style')
    <!-- Custom CSS -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .bg-gradient-primary {
            background: linear-gradient(90deg, #405189, #6775b0);
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .selected-item {
            display: inline-block;
            background: #007bff;
            color: #fff;
            padding: 5px 10px;
            margin: 2px;
            border-radius: 5px;
            cursor: pointer;
        }

        .selected-item span {
            margin-left: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }
    </style>
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="card shadow-sm border-0">
                <!-- Card Header -->
                <div class="card-header bg-gradient-primary text-white p-4">
                    <h5 class="card-title mb-0 text-white"><i class="fas fa-plus-circle me-2"></i> Thêm Mã Giảm Giá</h5>
                </div>

                <!-- Card Body -->
                <form action="{{ route('coupons.store') }}" method="POST" class="p-4 tablelist-form">
                    @csrf
                    <input type="hidden" id="id-field" />

                    <!-- Basic Info -->
                    <div class="mb-4">
                        <h6 class="text-muted fw-bold"><i class="fas fa-info-circle me-1"></i> Thông Tin Cơ Bản</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="code" class="form-label fw-bold">Mã Code</label>
                                <input type="text" id="code" name="code" class="form-control"
                                    placeholder="Nhập mã code" />
                                <div class="error-message text-danger mt-1">{{ $errors->first('code') }}</div>
                            </div>
                            <div class="col-12">
                                <label for="description-field" class="form-label fw-bold">Mô Tả</label>
                                <textarea id="description-field" name="description" class="form-control" placeholder="Nhập mô tả" rows="3"></textarea>
                                <div class="error-message text-danger mt-1">{{ $errors->first('description') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Discount Details -->
                    <div class="mb-4">
                        <h6 class="text-muted fw-bold"><i class="fas fa-tag me-1"></i> Chi Tiết Giảm Giá</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="discount-type-field" class="form-label fw-bold">Loại</label>
                                <select name="discount_type" id="discount-type-field" class="form-control">
                                    <option value="percentage">Giảm giá theo phần trăm</option>
                                    <option value="fixed">Giảm giá cố định</option>
                                    <option value="freeship">Miễn phí vận chuyển</option>
                                </select>
                                <div class="error-message text-danger mt-1">{{ $errors->first('discount_type') }}</div>
                            </div>
                            <div class="col-md-6">
                                <label for="discount-value-field" class="form-label fw-bold">Giá Trị</label>
                                <div class="input-group">
                                    <input type="number" id="discount-value-field" class="form-control"
                                        name="discount_value" />
                                    <span class="input-group-text" id="discount-unit">%</span>
                                </div>
                                <div class="error-message text-danger mt-1">{{ $errors->first('discount_value') }}</div>
                            </div>
                            <div class="col-md-6">
                                <label for="minimum_order_value" class="form-label fw-bold">Giá Trị Đơn Hàng Tối
                                    Thiểu</label>
                                <div class="input-group">
                                    <input type="text" name="minimum_order_value" id="minimum_order_value"
                                        class="form-control" placeholder="Giá trị đơn tối thiểu" />
                                    <span class="input-group-text">VNĐ</span>
                                </div>

                                <div class="error-message text-danger mt-1">{{ $errors->first('minimum_order_value') }}
                                </div>
                            </div>
                            <div class="col-md-6" id="max-shipping-discount-container" style="display: none;">
                                <label for="max-shipping-discount-field" class="form-label fw-bold">Giảm Giá Vận Chuyển Tối
                                    Đa</label>
                                <div class="input-group">
                                    <input type="number" id="max-shipping-discount-field" class="form-control"
                                        name="max_shipping_discount" placeholder="Nhập số tiền tối đa" />
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                                <div class="error-message text-danger mt-1">{{ $errors->first('max_shipping_discount') }}
                                </div>
                            </div>
                            <!-- Thêm trường Số tiền giảm tối đa -->
                            <div class="col-md-6" id="max-discount-amount-container">
                                <label for="max-discount-amount-field" class="form-label fw-bold">Số Tiền Giảm Tối
                                    Đa</label>
                                <div class="input-group">
                                    <input type="number" id="max-discount-amount-field" class="form-control"
                                        name="maximum_discount_amount" placeholder="Nhập số tiền giảm tối đa" />
                                    <span class="input-group-text">VNĐ</span>
                                </div>

                                <div class="error-message text-danger mt-1">{{ $errors->first('maximum_discount_amount') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Usage Limits -->
                    <div class="mb-4">
                        <h6 class="text-muted fw-bold"><i class="fas fa-users me-1"></i> Giới Hạn Sử Dụng</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="max_uses" class="form-label fw-bold">Số Lần Sử Dụng</label>
                                <input type="number" name="max_uses" id="max_uses" class="form-control"
                                    placeholder="Số lần sử dụng" />
                                <div class="error-message text-danger mt-1">{{ $errors->first('max_uses') }}</div>
                            </div>
                            <div class="col-md-6">
                                <label for="max-uses-per-user-field" class="form-label fw-bold">Mã/Người</label>
                                <input type="number" id="max-uses-per-user-field" class="form-control"
                                    name="max_uses_per_user" placeholder="Mã/Người" />
                                <div class="error-message text-danger mt-1">{{ $errors->first('max_uses_per_user') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Date Info -->
                    <div class="mb-4">
                        <h6 class="text-muted fw-bold"><i class="fas fa-calendar-alt me-1"></i> Thời Gian</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="start_time" class="form-label fw-bold">Ngày Phát Hành</label>
                                <input type="date" id="start_time" class="form-control" name="start_time"
                                    data-provider="flatpickr" data-date-format="Y-m-d" />
                                <div class="error-message text-danger mt-1">{{ $errors->first('start_time') }}</div>
                            </div>
                            <div class="col-md-6">
                                <label for="end_time" class="form-label fw-bold">Ngày Kết Thúc</label>
                                <input type="date" id="end_time" class="form-control" name="end_time"
                                    data-provider="flatpickr" data-date-format="Y-m-d" />
                                <div class="error-message text-danger mt-1">{{ $errors->first('end_time') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Categories & Brands -->
                    <div class="mb-4">
                        <h6 class="text-muted fw-bold"><i class="fas fa-list me-1"></i> Danh Mục & Thương Hiệu</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="category-select" class="form-label fw-bold">Chọn Danh Mục</label>
                                <select class="form-control" id="category-select">
                                    <option value="">-- Chọn danh mục --</option>
                                    <option value="all">🔥 Tất cả</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" data-name="{{ $item->name }}">
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <div class="selected-items mt-2" id="selected-categories"></div>
                                <input type="hidden" id="category-id" name="category_id" />
                                <div class="error-message text-danger mt-1">{{ $errors->first('category_id') }}</div>
                            </div>
                            <div class="col-md-6">
                                <label for="brand-select" class="form-label fw-bold">Chọn Thương Hiệu</label>
                                <select class="form-control" id="brand-select">
                                    <option value="">-- Chọn thương hiệu --</option>
                                    <option value="all">🔥 Tất cả</option>
                                    @foreach ($brands as $item)
                                        <option value="{{ $item->id }}" data-name="{{ $item->name }}">
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <div class="selected-items mt-2" id="selected-brands"></div>
                                <input type="hidden" id="brand-id" name="brand_id" />
                                <div class="error-message text-danger mt-1">{{ $errors->first('brand_id') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <h6 class="text-muted fw-bold"><i class="fas fa-toggle-on me-1"></i> Trạng Thái</h6>
                        <select class="form-control" name="is_active" id="delivered-status">
                            <option value="1">Hoạt Động</option>
                            <option value="0">Khóa</option>
                        </select>
                        <div class="error-message text-danger mt-1">{{ $errors->first('is_active') }}</div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success px-4 py-2">
                            <i class="fas fa-plus me-2"></i> Thêm Mã
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Lấy form
            const form = document.querySelector(".tablelist-form");
            if (!form) {
                console.error("Không tìm thấy form với class 'tablelist-form'");
                return;
            }

            // Validation khi submit form
            form.addEventListener("submit", function(event) {
                event.preventDefault();
                let isValid = true;

                function showError(input, message) {
                    if (!input) return;
                    isValid = false;
                    input.classList.add("border-danger");
                    let parent = input.parentElement;
                    while (parent && !parent.querySelector(".error-message")) {
                        parent = parent.parentElement;
                    }
                    const errorDiv = parent ? parent.querySelector(".error-message") : null;
                    if (errorDiv) errorDiv.innerText = message;
                }
                document.querySelectorAll(".error-message").forEach(el => el.innerText = "");
                document.querySelectorAll(".border-danger").forEach(el => el.classList.remove(
                    "border-danger"));

                const code = document.getElementById("code");
                const description = document.getElementById("description-field");
                const discountType = document.getElementById("discount-type-field");
                const discountValue = document.getElementById("discount-value-field");
                const minimumOrderValue = document.getElementById("minimum_order_value");
                const maxUses = document.getElementById("max_uses");
                const maxUsesPerUser = document.getElementById("max-uses-per-user-field");
                const maxShippingDiscount = document.getElementById("max-shipping-discount-field");
                const maxDiscountAmount = document.getElementById("max-discount-amount-field");
                const startTime = document.querySelector("input[name='start_time']");
                const endTime = document.querySelector("input[name='end_time']");
                const categoryId = document.getElementById("category-id");
                const brandId = document.getElementById("brand-id");
                const isActive = document.getElementById("delivered-status");

                if (!code.value.trim()) showError(code, "Mã Code không được để trống");

                if (!description.value.trim()) showError(description, "Mô tả không được để trống");

                if (!discountType.value) showError(discountType, "Vui lòng chọn loại giảm giá");


                if (!minimumOrderValue.value || parseFloat(minimumOrderValue.value) < 0) {
                    showError(minimumOrderValue, "Giá trị đơn hàng tối thiểu phải lớn hơn hoặc bằng 0");
                }

                if (!maxUses.value || parseInt(maxUses.value) < 1) {
                    showError(maxUses, "Số lần sử dụng phải lớn hơn 0");
                }

                if (!maxUsesPerUser.value || parseInt(maxUsesPerUser.value) < 1) {
                    showError(maxUsesPerUser, "Số mã/người phải lớn hơn 0");
                }

                if (discountType.value === "freeship") {
                    if (!maxShippingDiscount.value || parseInt(maxShippingDiscount.value) < 1) {
                        showError(maxShippingDiscount, "Số giảm giá vận chuyển tối đa phải lớn hơn 0");
                    }
                }

                if (!discountValue.disabled) {
                    if (!discountValue.value || parseFloat(discountValue.value) <= 0) {
                        showError(discountValue, "Giá trị giảm phải lớn hơn 0");
                    } else if (discountType.value === "percentage" && parseFloat(discountValue.value) >
                        100) {
                        showError(discountValue, "Giá trị giảm không được vượt quá 100%");
                    } else if (discountType.value === "fixed" && parseFloat(discountValue.value) >
                        parseFloat(minimumOrderValue.value)) {
                        showError(discountValue,
                            "Giá trị giảm không được lớn hơn giá trị đơn hàng tối thiểu");
                    }
                }

                if (discountType.value === "percentage") {
                    if (!maxDiscountAmount.value || parseInt(maxDiscountAmount.value) < 0) {
                        showError(maxDiscountAmount, "Số tiền giảm tối đa phải lớn hơn hoặc bằng 0");
                    } else if (parseInt(maxDiscountAmount.value) < parseInt(minimumOrderValue.value)) {
                        showError(maxDiscountAmount,
                            "Số tiền giảm tối đa không được lớn hơn giá trị đơn hàng tối thiểu");
                    }
                }

                if (!startTime.value) showError(startTime, "Vui lòng chọn ngày phát hành");

                if (!endTime.value) showError(endTime, "Vui lòng chọn ngày kết thúc");

                if (startTime.value && endTime.value && new Date(startTime.value) > new Date(endTime
                        .value)) {
                    showError(endTime, "Ngày kết thúc phải sau ngày phát hành");
                }

                if (!categoryId.value || categoryId.value === "[]") {
                    showError(document.getElementById("category-select"),
                        "Vui lòng chọn ít nhất một danh mục");
                }

                if (!brandId.value || brandId.value === "[]") {
                    showError(document.getElementById("brand-select"),
                        "Vui lòng chọn ít nhất một thương hiệu");
                }

                if (!isActive.value) showError(isActive, "Vui lòng chọn trạng thái");

                // Submit nếu hợp lệ
                if (isValid) form.submit();
            });

            // Quản lý danh mục và thương hiệu
            let selectedCategories = [];
            let selectedBrands = [];

            function handleSelection(selectId, array, displayId, inputId) {
                const select = document.getElementById(selectId);
                const option = select.options[select.selectedIndex];
                const id = option.value;
                const name = option.getAttribute("data-name");

                if (!id) return;

                if (id === "all") {
                    array.length = 0;
                    document.querySelectorAll(`#${selectId} option:not([value=""], [value="all"])`).forEach(opt => {
                        array.push({
                            id: opt.value,
                            name: opt.getAttribute("data-name")
                        });
                    });
                } else if (!array.some(item => item.id === id)) {
                    array.push({
                        id,
                        name
                    });
                }

                updateDisplay(array, displayId, inputId);
                select.value = "";
            }

            function updateDisplay(array, displayId, inputId) {
                const display = document.getElementById(displayId);
                display.innerHTML = "";

                array.forEach(item => {
                    const badge = document.createElement("div");
                    badge.classList.add("selected-item");
                    badge.innerHTML = `${item.name} <span data-id="${item.id}">×</span>`;
                    badge.querySelector("span").addEventListener("click", () => {
                        array.splice(array.findIndex(i => i.id === item.id), 1);
                        updateDisplay(array, displayId, inputId);
                    });
                    display.appendChild(badge);
                });

                document.getElementById(inputId).value = JSON.stringify(array.map(item => item.id));
            }

            document.getElementById("category-select").addEventListener("change", () => {
                handleSelection("category-select", selectedCategories, "selected-categories",
                    "category-id");
            });

            document.getElementById("brand-select").addEventListener("change", () => {
                handleSelection("brand-select", selectedBrands, "selected-brands", "brand-id");
            });

            // Xử lý thay đổi loại giảm giá
            const discountTypeField = document.getElementById("discount-type-field");
            const discountValueField = document.getElementById("discount-value-field");
            const discountUnit = document.getElementById("discount-unit");
            const maxShippingContainer = document.getElementById("max-shipping-discount-container");
            const maxDiscountContainer = document.getElementById("max-discount-amount-container");

            discountTypeField.addEventListener("change", function() {
                discountValueField.disabled = false;
                maxShippingContainer.style.display = "none";
                maxDiscountContainer.style.display = "none";

                if (this.value === "percentage") {
                    discountUnit.textContent = "%";
                    discountValueField.placeholder = "Nhập phần trăm";
                    maxDiscountContainer.style.display = "block";
                } else if (this.value === "fixed") {
                    discountUnit.textContent = "VNĐ";
                    discountValueField.placeholder = "Nhập số tiền giảm";
                } else if (this.value === "freeship") {
                    discountUnit.textContent = "";
                    discountValueField.value = "";
                    discountValueField.disabled = true;
                    discountValueField.placeholder = "Miễn phí vận chuyển";
                    maxShippingContainer.style.display = "block";
                }
            });

            // Khởi tạo trạng thái ban đầu
            discountTypeField.dispatchEvent(new Event("change"));
        });
    </script>
@endsection

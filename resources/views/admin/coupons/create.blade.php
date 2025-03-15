@extends('admin.layouts.app')
@section('title', 'Mã Giảm Giá')
@section('style')
    <!-- Custom CSS -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                    <h5 class="card-title mb-0"><i class="fas fa-plus-circle me-2"></i> Thêm Mã Giảm Giá</h5>
                </div>

                <!-- Card Body -->
                <form action="{{ route('coupons.store') }}" method="POST" class="p-4">
                    @csrf
                    <input type="hidden" id="id-field" />

                    <!-- Basic Info -->
                    <div class="mb-4">
                        <h6 class="text-muted fw-bold"><i class="fas fa-info-circle me-1"></i> Thông Tin Cơ Bản</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="code" class="form-label fw-bold">Mã Code</label>
                                <input type="text" id="code" name="code" class="form-control"
                                    placeholder="Nhập mã code" required />
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
                                    <option value="percentage">Percentage</option>
                                    <option value="fixed">Fixed</option>
                                    <option value="freeship">FreeShip</option>
                                </select>
                                <div class="error-message text-danger mt-1">{{ $errors->first('discount_type') }}</div>
                            </div>
                            <div class="col-md-6">
                                <label for="discount-value-field" class="form-label fw-bold">Giá Trị</label>
                                <div class="input-group">
                                    <input type="number" id="discount-value-field" class="form-control"
                                        name="discount_value" required />
                                    <span class="input-group-text" id="discount-unit">%</span>
                                </div>
                                <div class="error-message text-danger mt-1">{{ $errors->first('discount_value') }}</div>
                            </div>
                            <div class="col-md-6">
                                <label for="minimum_order_value" class="form-label fw-bold">Giá Trị Đơn Hàng Tối
                                    Thiểu</label>
                                <input type="text" name="minimum_order_value" id="minimum_order_value"
                                    class="form-control" />
                                <div class="error-message text-danger mt-1">{{ $errors->first('minimum_order_value') }}
                                </div>
                            </div>
                            <div class="col-md-6" id="max-shipping-discount-container" style="display: none;">
                                <label for="max-shipping-discount-field" class="form-label fw-bold">Giảm Giá Vận Chuyển Tối
                                    Đa</label>
                                <input type="number" id="max-shipping-discount-field" class="form-control"
                                    name="max_shipping_discount" placeholder="Nhập số tiền tối đa" />
                                <div class="error-message text-danger mt-1">{{ $errors->first('max_shipping_discount') }}
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
                                <input type="number" name="max_uses" id="max_uses" class="form-control" />
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
                        <select class="form-control" name="is_active" required id="delivered-status">
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

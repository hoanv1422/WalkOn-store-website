@extends('admin.layouts.app')
@section('title', 'Mã Giảm Giá')
@section('style')

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        .bg-gradient-primary {
            background: linear-gradient(90deg, #405189, #6775b0);

        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .badge {
            font-weight: bold;
            border-radius: 10px;
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
    @php
        $selectedCategories = json_encode($selectedCategoryIds ?? []);
        $selectedBrands = json_encode($selectedBrandIds ?? []);
    @endphp
    <div class="page-content">
        <div class="container-fluid">
            <div class="card shadow-sm border-0">
                <!-- Card Header -->
                <div
                    class="card-header bg-gradient-primary text-white p-4 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0 text-white"><i class="fas fa-edit me-2"></i> Sửa Mã Giảm Giá</h5>
                    <span class="badge bg-light text-dark fs-4 px-3 py-2">{{ $coupon->code }}</span>
                </div>

                <!-- Card Body -->
                <form action="{{ route('coupons.update', $coupon) }}" method="POST" class="p-4 tablelist-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="id-field" />

                    <!-- Basic Info -->
                    <div class="mb-4">
                        <h6 class="text-muted fw-bold"><i class="fas fa-info-circle me-1"></i> Thông Tin Cơ Bản</h6>
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="code" class="form-label fw-bold">Mã Code</label>
                                <input type="text" id="code" name="code" class="form-control"
                                    placeholder="Nhập mã code" value="{{ $coupon->code }}" />
                                <div class="error-message text-danger mt-1">{{ $errors->first('code') }}</div>
                            </div>
                            <div class="col-12">
                                <label for="description-field" class="form-label fw-bold">Mô Tả</label>
                                <textarea id="description-field" name="description" class="form-control" placeholder="Nhập mô tả" rows="3">{{ $coupon->description }}</textarea>
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
                                    <option value="percentage"
                                        {{ $coupon->discount_type == 'percentage' ? 'selected' : '' }}>Giảm giá theo phần
                                        trăm</option>
                                    <option value="fixed" {{ $coupon->discount_type == 'fixed' ? 'selected' : '' }}>Giảm
                                        giá cố định
                                    </option>
                                    <option value="freeship" {{ $coupon->discount_type == 'freeship' ? 'selected' : '' }}>
                                        Miễn phí giảm giá</option>
                                </select>
                                <div class="error-message text-danger mt-1">{{ $errors->first('discount_type') }}</div>
                            </div>
                            <div class="col-md-6">
                                <label for="discount-value-field" class="form-label fw-bold">Giá Trị</label>
                                <div class="input-group">
                                    <input type="number" id="discount-value-field" class="form-control"
                                        name="discount_value" value="{{ $coupon->discount_value }}" />
                                    <span class="input-group-text"
                                        id="discount-unit">{{ $coupon->discount_type == 'percentage' ? '%' : 'VNĐ' }}</span>
                                </div>
                                <div class="error-message text-danger mt-1">{{ $errors->first('discount_value') }}</div>
                            </div>
                            <div class="col-md-6">
                                <label for="minimum_order_value" class="form-label fw-bold">Giá Trị Đơn Hàng Tối
                                    Thiểu</label>
                                <input type="text" name="minimum_order_value" id="minimum_order_value"
                                    class="form-control" value="{{ $coupon->minimum_order_value }}" />
                                <div class="error-message text-danger mt-1">{{ $errors->first('minimum_order_value') }}
                                </div>
                            </div>
                            <div class="col-md-6" id="max-shipping-discount-container"
                                style="{{ $coupon->discount_type == 'freeship' ? 'display: block' : 'display: none' }}">
                                <label for="max-shipping-discount-field" class="form-label fw-bold">Giảm Giá Vận Chuyển Tối
                                    Đa</label>
                                <input type="number" id="max-shipping-discount-field" class="form-control"
                                    name="max_shipping_discount" value="{{ $coupon->max_shipping_discount }}"
                                    placeholder="Nhập số tiền tối đa" />
                                <div class="error-message text-danger mt-1">{{ $errors->first('max_shipping_discount') }}
                                </div>
                            </div>
                            <!-- Thêm trường Số tiền giảm tối đa -->
                            <div class="col-md-6" id="max-discount-amount-container">
                                <label for="max-discount-amount-field" class="form-label fw-bold">Số Tiền Giảm Tối
                                    Đa</label>
                                <div class="input-group">
                                    <input type="number" id="max-discount-amount-field" class="form-control"
                                        name="maximum_discount_amount" value="{{ $coupon->maximum_discount_amount }}"
                                        placeholder="Nhập số tiền giảm tối đa" />
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
                                    value="{{ $coupon->max_uses }}" />
                                <div class="error-message text-danger mt-1">{{ $errors->first('max_uses') }}</div>
                            </div>
                            <div class="col-md-6">
                                <label for="max-uses-per-user-field" class="form-label fw-bold">Mã/Người</label>
                                <input type="number" id="max-uses-per-user-field" class="form-control"
                                    name="max_uses_per_user" value="{{ $coupon->max_uses_per_user }}"
                                    placeholder="Mã/Người" />
                                <div class="error-message text-danger mt-1">{{ $errors->first('max_uses_per_user') }}
                                </div>
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
                                    data-provider="flatpickr" data-date-format="Y-m-d"
                                    value="{{ old('start_time', isset($coupon->start_time) ? \Carbon\Carbon::parse($coupon->start_time)->format('Y-m-d') : '') }}" />
                                <div class="error-message text-danger mt-1">{{ $errors->first('start_time') }}</div>
                            </div>
                            <div class="col-md-6">
                                <label for="end_time" class="form-label fw-bold">Ngày Kết Thúc</label>
                                <input type="date" id="end_time" class="form-control" name="end_time"
                                    data-provider="flatpickr" data-date-format="Y-m-d"
                                    value="{{ old('end_time', isset($coupon->end_time) ? \Carbon\Carbon::parse($coupon->end_time)->format('Y-m-d') : '') }}" />
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
                                <input type="hidden" id="category-id" name="category_id"
                                    value="{{ $selectedCategories }}" />
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
                                <input type="hidden" id="brand-id" name="brand_id" value="{{ $selectedBrands }}" />
                                <div class="error-message text-danger mt-1">{{ $errors->first('brand_id') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <h6 class="text-muted fw-bold"><i class="fas fa-toggle-on me-1"></i> Trạng Thái</h6>
                        <select class="form-control" name="is_active" id="delivered-status">
                            <option value="1" {{ $coupon->is_active == 1 ? 'selected' : '' }}>Hoạt Động</option>
                            <option value="0" {{ $coupon->is_active == 0 ? 'selected' : '' }}>Khóa</option>
                        </select>
                        <div class="error-message text-danger mt-1">{{ $errors->first('is_active') }}</div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success px-4 py-2">
                            <i class="fas fa-save me-2"></i> Cập Nhật
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
        });

        document.addEventListener("DOMContentLoaded", function() {
            const discountType = document.getElementById("discount-type-field");
            const discountValue = document.getElementById("discount-value-field");
            const maxShippingDiscount = document.getElementById("max-shipping-discount-field");

            function updateDiscountFields() {
                if (discountType.value === "freeship") {
                    discountValue.disabled = true;
                    discountValue.value = ""; // Xóa giá trị nếu disable
                    maxShippingDiscount.disabled = false;
                } else {
                    discountValue.disabled = false;
                    maxShippingDiscount.disabled = true;
                    maxShippingDiscount.value = ""; // Xóa giá trị nếu disable
                }
            }

            // Gọi ngay khi trang load (để xử lý trường hợp khi edit)
            updateDiscountFields();

            // Lắng nghe sự kiện thay đổi loại giảm giá
            discountType.addEventListener("change", updateDiscountFields);
        });
    </script>



    <script>
        let selectedCategories = JSON.parse(document.getElementById("category-id").value || "[]");
        let selectedBrands = JSON.parse(document.getElementById("brand-id").value || "[]");

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

        // Xử lý chọn danh mục
        document.getElementById("category-select").addEventListener("change", function() {
            handleSelection("category-select", selectedCategories, "selected-categories", "category-id");
        });

        // Xử lý chọn thương hiệu
        document.getElementById("brand-select").addEventListener("change", function() {
            handleSelection("brand-select", selectedBrands, "selected-brands", "brand-id");
        });

        function loadExistingSelections(selectId, selectedArray, displayDivId, inputId) {
            let selectElement = document.getElementById(selectId);
            let tempArray = [];

            selectedArray.forEach(id => {
                let option = selectElement.querySelector(`option[value="${id}"]`);
                if (option) {
                    tempArray.push({
                        id: option.value,
                        name: option.getAttribute("data-name")
                    });
                }
            });

            selectedArray.length = 0;
            selectedArray.push(...tempArray);

            updateDisplay(selectedArray, displayDivId, inputId);
        }

        document.addEventListener("DOMContentLoaded", function() {
            loadExistingSelections("category-select", selectedCategories, "selected-categories", "category-id");
            loadExistingSelections("brand-select", selectedBrands, "selected-brands", "brand-id");
        });
    </script>

    <script>
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

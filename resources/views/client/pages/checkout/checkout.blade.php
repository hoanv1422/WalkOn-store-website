<div class="checkout-container">
    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="row g-0">
            <!-- Phần thông tin khách hàng -->
            <div class="col-lg-6 p-5">
                <h3 class="section-title">Thông Tin Thanh Toán</h3>
                <form id="checkout-form">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Họ và tên" name="receiver_name"
                            value="{{ Auth::user()->name }}">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="receiver_email"
                            value="{{ Auth::user()->email }}">
                    </div>
                    <div class="mb-3">
                        <input type="tel" class="form-control" placeholder="Số điện thoại" name="receiver_phone"
                            value="{{ Auth::user()->phone }}">
                    </div>

                    <!-- Hiển thị địa chỉ mặc định -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Địa chỉ giao hàng</label>
                        <div class="address-display d-flex justify-content-between align-items-center">
                            <div id="current-address">
                                <strong>{{ $addressDefault->type_label }}</strong><br>
                                <span>{{ $addressDefault->full_address }}</span>
                            </div>
                            <button type="button" class="btn change-address-btn" data-bs-toggle="modal"
                                data-bs-target="#addressModal">
                                Thay đổi
                            </button>
                        </div>
                        <div id="distance-display" class="mt-2 text-muted"></div>
                        <input type="hidden" name="receiver_address" id="selected-address" value="{{ $addressDefault->full_address }}">
                        <input type="hidden" id="selected-lat" value="{{ $addressDefault->latitude }}">
                        <input type="hidden" id="selected-lon" value="{{ $addressDefault->longitude }}">
                    </div>

                    <div class="mb-3">
                        <textarea class="form-control" rows="2" placeholder="Ghi chú (nếu có)" name=""></textarea>
                    </div>
                </form>
            </div>

            <!-- Phần đơn hàng -->
            <div class="col-lg-6 p-5 bg-light">
                <h3 class="section-title">Đơn Hàng Của Bạn</h3>
                <div class="order-items mb-4">
                    @foreach ($cartItems as $item)
                        <input type="hidden" name="cartItemIds[]" value="{{$item->id}}">
                        <div class="order-item d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="" alt="{{ $item->productVariant->product->name }}" class="me-3"
                                    style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                <div>
                                    <span>{{ $item->productVariant->product->name }} × {{ $item->quantity }}</span>
                                    <div class="text-muted small">Màu: {{ $item->productVariant->color->color }} |
                                        Size:
                                        {{ $item->productVariant->size->size }}</div>
                                </div>
                            </div>
                            <span>{{ number_format($item->formatted_price, 0, ',', '.') }} VND</span>
                        </div>
                    @endforeach
                </div>

                <div class="coupon-area">
                    <form id="couponForm" action="{{ route('coupon.apply') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="input-group mb-2">
                            <input type="text" name="couponCode" id="couponCodeInput"
                                class="form-control coupon-input" placeholder="Nhập mã giảm giá">
                            <button type="submit" class="btn coupon-btn text-white">Áp dụng</button>
                        </div>

                        <div class="d-flex justify-content-between">
                            <small id="couponMessage"></small>
                            <div class="text-end">
                                <a href="#" class="btn btn-outline-secondary" id="clearCoupon">Xóa</a>
                            </div>
                        </div>
                        <input type="hidden" name="totalPrice" id="totalPriceForCoupon" value="{{ $totalPrice }}">
                        <input type="hidden" name="shippingFeeForCoupon" id="shippingFeeForCoupon" value="0">
                        @foreach ($cartItems as $item)
                            <input type="hidden" name="cartItemsForCoupon[]" id="cartItemsForCoupon"
                                value="{{ $item->id }}">
                        @endforeach
                    </form>
                </div>
                <input type="hidden" name="couponCodeForOrder" id="couponCodeForOrder" value="">
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tạm tính</span>
                        <span id="displayTotalPrice">{{ number_format($totalPrice, 0, ',', '.') }} VND</span>
                        <input type="hidden" id="totalPrice" name="totalPrice" value="{{ $totalPrice }}">
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Phí vận chuyển</span>
                        <span id="displayShippingFee"></span>
                        <input type="hidden" name="shippingFee" id="shippingFee" value="">
                    </div>
                    <div class="d-flex justify-content-between mb-2 text-success">
                        <span>Giảm giá</span>
                        <span id="displayDiscount">-0 VND</span>
                        <input type="hidden" name="discountAmount" id="discountAmount" value="0">
                    </div>
                    <div class="d-flex justify-content-between pt-2 border-top">
                        <strong>Tổng cộng</strong>
                        <span id="displayFinalPrice" class="total-amount">{{ number_format(0) }} VND</span>
                        <input type="hidden" name="finalPrice" id="finalPrice" value="">
                    </div>
                </div>

                <div class="mb-4">
                    <div class="payment-option">
                        <input type="radio" name="payment_method" id="cod" value="cod" checked>
                        <label for="cod" class="ms-2">Thanh toán khi nhận hàng (COD)</label>
                    </div>
                    <div class="payment-option">
                        <input type="radio" name="payment_method" id="vnpay" value="vnpay">
                        <label for="vnpay" class="ms-2">Thanh toán qua VNPAY</label>
                    </div>
                </div>

                <button class="btn checkout-btn w-100 text-white">ĐẶT HÀNG NGAY</button>
            </div>
        </div>
    </form>

</div>

<!-- Modal chọn địa chỉ -->
<div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header-1">
                <h5 class="modal-title" id="addressModalLabel">Chọn Địa Chỉ Giao Hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="address-list" id="addressList">
                    @foreach ($addresses as $item)
                        <div class="address-item" data-address="{{ $item->full_address }}"
                            data-lat="{{ $item->latitude }}" data-lon="{{ $item->longitude }}"
                            onclick="selectAddress(this)">
                            <strong>{{ $item->type_label }}</strong><br>
                            <span>{{ $item->full_address }}</span>
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#addAddressModal" onclick="hideAddressModal()">Thêm mới</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" onclick="confirmAddress()">Xác nhận</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal thêm địa chỉ mới -->
<div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form action="{{ route('create.address') }}" method="POST" id="formAddress">
            @csrf
            <div class="modal-content">
                <div class="modal-header-1">
                    <h5 class="modal-title" id="addAddressModalLabel">Thêm Địa Chỉ Mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex gap-2">
                        <select id="province" class="form-control"
                            onchange="loadDistricts(); updateHiddenInputs();">
                            <option value="">-- Chọn Tỉnh/Thành --</option>
                        </select>
                        <select id="district" class="form-control" onchange="loadWards(); updateHiddenInputs();"
                            disabled>
                            <option value="">-- Chọn Quận/Huyện --</option>
                        </select>
                        <select id="ward" class="form-control"
                            onchange="getCoordinates(); updateHiddenInputs();" disabled>
                            <option value="">-- Chọn Phường/Xã --</option>
                        </select>
                    </div>
                    <input type="hidden" id="provinceName" name="province_name">
                    <input type="hidden" id="districtName" name="district_name">
                    <input type="hidden" id="wardName" name="ward_name">
                    <div class="mb-3 mt-3">
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" id="newAddressDetail" name="address_line" rows="2"
                            placeholder="Địa chỉ cụ thể"></textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <input type="radio" class="btn-check" name="addressType" id="typeOfAddress1"
                            value="HOME" autocomplete="off">
                        <label class="btn btn-outline-primary" for="typeOfAddress1">Nhà Riêng</label>
                        <input type="radio" class="btn-check" name="addressType" id="typeOfAddress2"
                            value="OFFICE" autocomplete="off">
                        <label class="btn btn-outline-success" for="typeOfAddress2">Văn Phòng</label>
                        <input type="radio" class="btn-check" name="addressType" id="typeOfAddress3"
                            value="OTHER" autocomplete="off">
                        <label class="btn btn-outline-warning" for="typeOfAddress3">Khác</label>
                    </div>
                    <div class="mt-3">
                        <input type="checkbox" id="check-default" name="default_address" class="form-check-input">
                        <label class="form-check-label" for="check-default">
                            Đặt làm mặc định
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-toggle="modal"
                        data-bs-target="#addressModal">Quay lại</button>
                    <button type="submit" class="btn btn-success">Lưu địa chỉ</button>
                </div>
            </div>
        </form>
    </div>
</div>



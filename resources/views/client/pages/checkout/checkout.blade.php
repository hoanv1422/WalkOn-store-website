<div class="checkout-container">
    <form id="checkout-form">
        @csrf
        <div class="row g-0">
            <!-- Phần thông tin khách hàng -->
            <div class="col-lg-6 p-5">
                <h3 class="section-title">Thông Tin Thanh Toán</h3>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Họ và tên" name="receiver_name"
                        value="{{ Auth::user()->name }}" id="receiver-name">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Email" name="receiver_email"
                        value="{{ Auth::user()->email }}" id="receiver-email">
                </div>
                <div class="mb-3">
                    <input type="tel" class="form-control" placeholder="Số điện thoại" name="receiver_phone"
                        value="{{ Auth::user()->phone }}" id="receiver-phone">
                </div>

                <!-- Hiển thị địa chỉ mặc định -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Địa chỉ giao hàng</label>
                    <div class="address-display d-flex justify-content-between align-items-center">
                        <div id="current-address">
                            {{-- Địa chỉ  --}}
                        </div>
                        <button type="button" class="btn change-address-btn" data-bs-toggle="modal"
                            data-bs-target="#addressModalList">
                            Thay đổi
                        </button>
                    </div>

                    <div id="distance-display" class="mt-2 text-muted"></div>
                    <input type="hidden" name="receiver_address" id="selected-address" value="">
                    <input type="hidden" id="selected-lat" value="">
                    <input type="hidden" id="selected-lon" value="">

                </div>

                <div class="mb-3">
                    <textarea class="form-control" rows="2" placeholder="Ghi chú (nếu có)" name="" id="note"></textarea>
                </div>
            </div>

            <!-- Phần đơn hàng -->
            <div class="col-lg-6 p-5 bg-light">
                <h3 class="section-title">Đơn Hàng Của Bạn</h3>
                <div class="order-items mb-4">
                    {{-- CartItems --}}
                </div>

                <div class="coupon-area">

                    <div class="input-group mb-2">
                        <input type="text" name="couponCode" id="couponCodeInput" class="form-control coupon-input"
                            placeholder="Nhập mã giảm giá" form="coupon-form">
                        <input type="hidden" name="totalPrice" id="totalPriceForCoupon" value="" form="coupon-form">
                        <input type="hidden" name="shippingFeeForCoupon" id="shippingFeeForCoupon" value="0" form="coupon-form">
                        <div id="cart-items-for-coupon">
                            {{-- CartItemIds --}}
                        </div>
                        <button type="submit" class="btn coupon-btn text-white" form="coupon-form">Áp dụng</button>
                    </div>

                    <div class="d-flex justify-content-between">
                        <small id="couponMessage"></small>
                        <div class="text-end">
                            <a href="#" class="btn btn-outline-secondary" id="clearCoupon">Xóa</a>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="couponCodeForOrder" id="couponCodeForOrder" value="">
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tạm tính</span>
                        <span id="displayTotalPrice"></span>
                        <input type="hidden" id="totalPrice" name="totalPrice" value="">
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
                        <input type="radio" name="payment_method" id="cod" value="COD" checked>
                        <label for="cod" class="ms-2">Thanh toán khi nhận hàng (COD)</label>
                    </div>
                    <div class="payment-option">
                        <input type="radio" name="payment_method" id="vnpay" value="VNPAY">
                        <label for="vnpay" class="ms-2">Thanh toán qua VNPAY</label>
                    </div>
                </div>

                <button class="btn checkout-btn w-100 text-white" id="submit-checkout-button">ĐẶT HÀNG NGAY</button>
            </div>
        </div>
    </form>

      <form id="coupon-form">
        @csrf
      </form>

</div>

<!-- Modal chọn địa chỉ -->
<div class="modal fade" id="addressModalList" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header-1">
                <h5 class="modal-title" id="addressModalLabel">Chọn Địa Chỉ Giao Hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="address-list" id="address-list">
                    {{-- Address List --}}

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="btn-create-address">Thêm mới</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" id="btn-confirm-address">Xác nhận</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal thêm địa chỉ mới -->
<div class="modal fade" id="address-modal" tabindex="-1" aria-labelledby="AddressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form action="" id="address-form">
            @csrf
            <div class="modal-content">
                <div class="d-flex justify-content-between m-3">
                    <h5 class="modal-title" id="AddressModalLabel">Thêm Địa Chỉ Mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="address-error" class="alert alert-danger d-none" role="alert"></div>
                    <input type="hidden" id="address-id" name="address_id">
                    <div class="d-flex gap-2">
                        <select id="province" class="form-control" name="city_code"
                           >
                            <option value="">-- Chọn Tỉnh/Thành --</option>
                        </select>
                        <select id="district" class="form-control"
                            name="district_code" disabled>
                            <option value="">-- Chọn Quận/Huyện --</option>
                        </select>
                        <select id="ward" class="form-control"
                             name="ward_code" disabled>
                            <option value="">-- Chọn Phường/Xã --</option>
                        </select>
                    </div>
                    <input type="hidden" id="provinceName" name="province_name">
                    <input type="hidden" id="districtName" name="district_name">
                    <input type="hidden" id="wardName" name="ward_name">
                    <div class="mb-3 mt-3">
                        <input type="text" name="latitude" id="latitude">
                        <input type="text" name="longitude" id="longitude">
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
                        <label class="btn btn-outline-success" for="typeOfAddress2">Cơ Quan</label>
                        <input type="radio" class="btn-check" name="addressType" id="typeOfAddress3"
                            value="OTHER" autocomplete="off">
                        <label class="btn btn-outline-warning" for="typeOfAddress3">Khác</label>
                    </div>
                    <div class="mt-3">
                        <input type="checkbox" id="check-default" name="is_default" class="form-check-input">
                        <label class="form-check-label" for="check-default">
                            Đặt làm mặc định
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-success">Lưu địa chỉ</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="deleteAddressModal" tabindex="-1" aria-labelledby="deleteAddressModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form>
            @csrf
            <div class="modal-content">
                <div class="d-flex justify-content-between m-3">
                    <h5 class="modal-title" id="deleteAddressModalLabel">Xác nhận xóa địa chỉ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-danger">Bạn có chắc muốn xóa địa chỉ này?</p>
                    <p class="small text-muted">Hành động này không thể hoàn tác.</p>
                    <input type="hidden" id="delete-address-id" name="address_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </div>
            </div>
        </form>
    </div>
</div>

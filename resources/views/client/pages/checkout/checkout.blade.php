<div class="checkout-area pb-5">
    <div class="container">
        <form id="checkout-form" action="" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="mb-4">
                        <h3>Chi Tiết Thanh Toán</h3>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Họ và tên</label>
                                <input type="text" name="receiver_name" class="form-control"
                                    value="{{ old('receiver_name', Auth::user()->name) }}">
                                @error('receiver_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Email</label>
                                <input type="text" name="receiver_email" class="form-control"
                                    value="{{ old('receiver_email', Auth::user()->mail) }}">
                                @error('receiver_email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" name="receiver_phone" class="form-control"
                                    value="{{ old('receiver_phone', Auth::user()->phone) }}">
                                @error('receiver_phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Địa chỉ</label>
                                <textarea name="receiver_address" class="form-control">{{ old('receiver_address', Auth::user()->address) }}</textarea>
                                @error('receiver_address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Ghi chú</label>
                                <textarea name="note" class="form-control">{{ old('note') }}</textarea>
                                @error('note')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Đơn Hàng Của Bạn</h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Sản Phẩm</th>
                                        <th>Tổng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                        <tr>
                                            <td>
                                                {{ Str::limit($item->productVariant->product->name, 30, '...') }} ×
                                                {{ $item->quantity }}
                                                <br>
                                                <span style="color: gray; font-size: 14px;">
                                                    Màu: {{ $item->productVariant->color->color }} | Cỡ:
                                                    {{ $item->productVariant->size->size }}
                                                </span>
                                            </td>
                                            <td>
                                                @php
                                                    $unitPrice =
                                                        $item->productVariant->price_sale &&
                                                        $item->productVariant->price_sale < $item->productVariant->price
                                                            ? $item->productVariant->price_sale
                                                            : $item->productVariant->price;

                                                    $subtotal = $unitPrice * $item->quantity;
                                                @endphp
                                                {{ number_format($subtotal, 0, ',', '.') }} VND</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tổng</th>
                                        <td class="fw-bold">{{ number_format($totalAmount, 0, ',', '.') }} VND</td>
                                    </tr>
                                    <tr>
                                        <th>Phí Vận Chuyển</th>
                                        <td>0 VND</td>
                                    </tr>
                                    <tr>
                                        <th>Voucher</th>
                                        <td>0 VND</td>
                                    </tr>
                                    <tr>
                                        <th>Tổng Đơn</th>
                                        <input type="hidden" name="total_price" id=""
                                            value="{{ $totalAmount }}">
                                        <td class="text-danger fw-bold fs-5">
                                            {{ number_format($totalAmount, 0, ',', '.') }} VND</td>
                                    </tr>
                                </tfoot>
                            </table>

                            <div id="payment-method">
                                <div class="payment-option">
                                    <input type="radio" id="cod" name="payment_method" value="COD" checked>
                                    <label for="cod">COD</label>
                                </div>

                                <div class="payment-option">
                                    <input type="radio" id="vnpay" name="payment_method" value="VNPAY">
                                    <label for="vnpay">VN PAY</label>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary w-100" id="pay-now">Đặt Hàng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

<!-- checkout area start -->
<div class="checkout-area pb-5">
    <div class="container">
        <form action="{{route('checkout.store')}}" method="POST">
        <div class="row">
                @csrf
                <div class="col-lg-6 col-12">
                    <div class="mb-4">
                        <h3>Chi Tiết Thanh Toán</h3>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Họ và tên</label>
                                <input type="text" name="receiver_name" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Email</label>
                                <input type="text" name="receiver_email" class="form-control">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" name="receiver_phone" class="form-control" placeholder="">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Địa chỉ</label>
                                <textarea type="text" name="receiver_address" class="form-control"> </textarea>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Ghi chú</label>
                                <textarea type="text" name="note" class="form-control"> </textarea>
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


                                            <td>{{ $item->price }} VND</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tổng Phụ</th>
                                        <td>{{ $subtotal }} VND</td>
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
                                        <td><strong>{{ $subtotal }} VND</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div id="payment-method">
                                <div class="payment-option">
                                    <input type="radio" id="bank-transfer" name="payment_method" value="COD"
                                        checked>
                                    <label for="bank-transfer">COD</label>
                                </div>

                                <div class="payment-option">
                                    <input type="radio" id="cheque" name="payment_method" value="">
                                    <label for="cheque">VN PAY</label>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary w-100">Đặt Hàng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- checkout area end -->

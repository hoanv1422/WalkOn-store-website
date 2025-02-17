<!-- checkout area start -->
<div class="checkout-area pb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12">
                <form action="#">
                    <div class="mb-4">
                        <h3>Chi Tiết Thanh Toán</h3>
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Họ và tên</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Địa chỉ</label>
                                <textarea type="text" class="form-control" > </textarea>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Ghi chú</label>
                                <textarea type="text" class="form-control" > </textarea>
                            </div>

                        </div>
                    </div>
                </form>
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
                                <tr>
                                    <td>Vestibulum suscipit × 1</td>
                                    <td>£165.00</td>
                                </tr>
                                <tr>
                                    <td>Vestibulum suscipit × 1</td>
                                    <td>£165.00</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Tổng Phụ</th>
                                    <td>£215.00</td>
                                </tr>
                                <tr>
                                    <th>Phí Vận Chuyển</th>
                                    <td>£215.00</td>
                                </tr>
                                <tr>
                                    <th>Voucher</th>
                                    <td>£215.00</td>
                                </tr>
                                <tr>
                                    <th>Tổng Đơn</th>
                                    <td><strong>£215.00</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                        <div class="accordion" id="payment-method">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#bank-transfer">
                                        Direct Bank Transfer
                                    </button>
                                </h2>
                                <div id="bank-transfer" class="accordion-collapse collapse show"
                                    data-bs-parent="#payment-method">
                                    <div class="accordion-body">
                                        <p>Make your payment directly into our bank account...</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#cheque">
                                        Cheque Payment
                                    </button>
                                </h2>
                                <div id="cheque" class="accordion-collapse collapse"
                                    data-bs-parent="#payment-method">
                                    <div class="accordion-body">
                                        <p>Make your payment directly into our bank account...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary w-100">Place order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- checkout area end -->

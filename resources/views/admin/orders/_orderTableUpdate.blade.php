<div class="modal fade" id="updateOrderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="orderModalLabel">Cập nhật đơn hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng" id="close-modal"></button>
            </div>
            <form action="" method="POST" class="tablelist-form" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="id-field" name="id" />
                    <div class="mb-3" id="modal-id">
                        <label for="orderId" class="form-label">Mã đơn hàng</label>
                        <input type="text" id="orderId" name="order_code" class="form-control" readonly />
                    </div>
                    <div class="mb-3">
                        <label for="customername-field" class="form-label">Tên khách hàng</label>
                        <input type="text" id="customername-field" name="customer_name" class="form-control" placeholder="Nhập tên khách hàng" readonly />
                    </div>
                    <div class="mb-3">
                        <label for="date-field" class="form-label">Ngày đặt hàng</label>
                        <input type="date" id="date-field" name="order_date" class="form-control" data-provider="flatpickr" required data-date-format="d M, Y" data-enable-time placeholder="Chọn ngày" readonly />
                    </div>
                    <div class="row gy-4 mb-3">
                        <div class="col-md-6">
                            <div>
                                <label for="amount-field" class="form-label">Tổng số tiền</label>
                                <input type="text" id="amount-field" name="total_price" class="form-control" placeholder="Nhập tổng số tiền" readonly />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <label for="payment-field" class="form-label">Phương thức thanh toán</label>
                                <select class="form-control" data-trigger name="payment_method" id="payment-field" readonly disabled>
                                    <option value="">Chọn phương thức thanh toán</option>
                                    <option value="Mastercard">Mastercard</option>
                                    <option value="Visa">Visa</option>
                                    <option value="COD">COD</option>
                                    <option value="Paypal">Paypal</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Chỉ trường trạng thái được sửa -->
                    <div>
                        <label for="delivered-status" class="form-label">Trạng thái giao hàng</label>
                        <select class="form-control" data-trigger name="order_status" id="delivered-status" required>
                            <option value="">Chọn trạng thái giao hàng</option>
                            <option value="pending">Chờ xử lý</option>
                            <option value="processing">Đang xử lý</option>
                            <option value="cancelled">Đã hủy</option>
                            <option value="shipped">Đang giao</option>
                            <option value="delivered">Đã giao</option>
                            <option value="returned">Trả hàng</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-success">Cập nhật đơn hàng</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

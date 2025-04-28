<!-- cart item area start -->
<div class="shopping-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table-bordered table table-hover">
                        <thead>
                            <tr>
                                <th class="checkbox text-center"><input type="checkbox" id="selectAll"></th>
                                <th class="cart-item-img"></th>
                                <th class="cart-product-name">Tên Sản Phẩm</th>
                                <th class="edit">Cỡ</th>
                                <th class="move-wishlist">Màu</th>
                                <th class="unit-price">Đơn Giá</th>
                                <th class="quantity">Số Lượng</th>
                                <th class="subtotal">Tổng</th>
                                <th class="remove-icon">Xóa</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <!-- Cart items will be loaded here via JavaScript -->
                            <tr>
                                <td colspan="9" class="text-center">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="shopping-button">
                        <div class="continue-shopping">
                            <a href="{{ route('shop.index') }}">
                                <button type="button">Tiếp tục mua hàng</button>
                            </a>
                        </div>
                        <div class="shopping-cart-left">
                            <div class="shopping-button">
                                <button id="clearCartButton" type="button" class="btn btn-danger">Xóa tất cả sản phẩm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-end">
            <div class="col-md-4">
                <form action="{{ route('order.index') }}" method="GET">
                    <input type="hidden" name="cartItems" id="cartItems">
                    <div class="totals p-3">
                        <hr>
                        <div class="row">
                            <div class="col-12 text-start">
                                <h3>Tổng Cộng</h3>
                            </div>
                            <div class="col-12 text-end fw-bold text-primary text-wrap overflow-hidden">
                                <h3 class="d-inline-block w-100 text-end" id="displayTotalPrice">
                                    0 VND
                                </h3>
                            </div>
                        </div>
                        <div class="shopping-button text-center mt-3">
                            <button type="submit" id="checkoutButton" class="w-100" disabled>Tiến hành thanh toán</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

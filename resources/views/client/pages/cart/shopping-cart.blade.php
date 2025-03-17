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
                            @foreach ($cartItems as $cartItem)
                                <tr>
                                    <td class="align-middle"><input type="checkbox" class="cartItemCheckbox"
                                            value="{{ $cartItem->id }}" data-price=" {{ $cartItem->formatted_price }}">
                                    </td>
                                    <td class="cart-item-img">
                                        <a href="single-product.html">
                                            <img src="img/cart/3.png" alt="">
                                        </a>
                                    </td>
                                    <td class="cart-product-name">
                                        <a href="single-product.html">{{ $cartItem->productVariant->product->name }}</a>
                                    </td>
                                    <td class="edit">
                                        <a href="#">{{ $cartItem->productVariant->size->size }}</a>
                                    </td>
                                    <td class="move-wishlist">
                                        <a href="#">{{ $cartItem->productVariant->color->color }}</a>
                                    </td>
                                    <td class="unit-price">
                                        @if ($cartItem->productVariant->price_sale && $cartItem->productVariant->price_sale < $cartItem->productVariant->price)
                                            <span class="text-muted text-decoration-line-through small">
                                                {{ number_format($cartItem->productVariant->price, 0, ',', '.') }} VND
                                            </span>
                                            <span class="text-danger fw-bold">
                                                {{ number_format($cartItem->productVariant->price_sale, 0, ',', '.') }}
                                                VND
                                            </span>
                                        @else
                                            <span>{{ number_format($cartItem->productVariant->price, 0, ',', '.') }}
                                                VND</span>
                                        @endif
                                    </td>

                                    <td class="quantity align-middle">
                                        <form action="{{ route('cart.update', $cartItem->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div style="" class="input-group">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    onclick="changeQty({{ $cartItem->id }}, -0)">-</button>
                                                <input style="width: 0px" type="text"
                                                    class="form-control form-control-sm text-center qtyInput"
                                                    id="qtyInput-{{ $cartItem->id }}" name="quantity"
                                                    value="{{ $cartItem->quantity }}">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    onclick="changeQty({{ $cartItem->id }}, +0.5)">+</button>
                                            </div>
                                        </form>
                                    </td>

                                    <td class="subtotal">
                                        <span class="text-danger fw-bold">
                                            {{ number_format($cartItem->formatted_price, 0, ',', '.') }} VND
                                        </span>
                                    </td>

                                    <td class="remove-icon align-middle">
                                        <form action="{{ route('cart.delete', $cartItem->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="shopping-button">
                        <div class="continue-shopping">
                            <button type="submit">Tiếp tục mua hàng</button>
                        </div>
                        <div class="shopping-cart-left">

                            <div class="shopping-button">
                                <form action="{{ route('cart.items.clear') }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Xóa tất cả sản phẩm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-end">
            <div class="col-md-4">
                <form id="couponForm" action="{{ route('coupon.apply') }}" method="POST">
                    @csrf
                    <div class="discount-code">
                        <h3>Mã Giảm Giá</h3>
                        <p>Nhập mã phiếu giảm giá của bạn nếu bạn có.</p>
                        <input type="text" name="couponCode" id="couponCodeInput" value="" >
                        <a href="#" class="btn btn-outline-secondary" id="clearCoupon">Xóa</a>
                        <div id="couponMessage"></div>
                        <input type="hidden" name="totalPrice" id="totalPriceForCoupon" value="">
                        <input type="hidden" value="" name="cartItemsForCoupon" id="cartItemsForCoupon">
                        <div class="shopping-button">
                            <button type="submit">Áp Dụng Mã</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <form action="{{ route('order.index') }}" method="GET">
                    @csrf
                    <input type="hidden" value="" name="cartItems" id="cartItems">
                    <input type="hidden" name="couponCodeForOrder" id="couponCodeForOrder" value="">
                    <div class="totals p-3 ">
                        <div class="row">
                            <p class="col-6 text-start">Tổng Phụ</p>
                            <p id="displayTotalPrice" class="col-6 text-end fw-bold">0 VND</p>
                            <input type="hidden" id="totalPrice" name="totalPrice" value="">

                        </div>
                        <div class="row">
                            <p class="col-6 text-start">Phí Vận Chuyển</p>
                            <p class="col-6 text-end fw-bold">20,000 VND</p>
                            <input type="hidden" name="shippingFee" id="shippingFee" value="20000">

                        </div>
                        <div class="row">
                            <p class="col-6 text-start">Giảm Giá</p>
                            <p class="col-6 text-end fw-bold" id="displayDiscount">-0 VND</p>
                            <input type="hidden" name="discountAmount" id="discountAmount" value="0">

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12 text-start">
                                <h3>Tổng Cộng</h3>
                            </div>
                            <div class="col-12 text-end fw-bold text-primary text-wrap overflow-hidden">
                                <h3 id="displayFinalPrice" class="d-inline-block w-100 text-end">
                                    {{ number_format(0) }} VND</h3>
                                <input type="hidden" name="finalPrice" id="finalPrice" value="">

                            </div>
                        </div>
                        <div class="shopping-button text-center mt-3">
                            <button type="submit" class="w-100">Tiến hành thanh toán</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- cart item area end -->
{{-- <script>
   
    function changeQty(cartItemId, change) {
        let qtyInput = document.getElementById("qtyInput-" + cartItemId);
        let newQty = parseInt(qtyInput.value) + change;
        if (newQty > 0) {
            qtyInput.value = newQty;

            // Tự động submit form
            qtyInput.form.submit();
        }
    }
</script>
 --}}

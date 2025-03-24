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
                <form action="{{ route('order.index') }}" method="GET">
                    @csrf
                    <input type="hidden" value="" name="cartItems" id="cartItems">
                    <div class="totals p-3 ">
                        <hr>
                        <div class="row">
                            <div class="col-12 text-start">
                                <h3>Tổng Cộng</h3>
                            </div>
                            <div class="col-12 text-end fw-bold text-primary text-wrap overflow-hidden">
                                <h3 class="d-inline-block w-100 text-end" id="displayTotalPrice">
                                     VND</h3>
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

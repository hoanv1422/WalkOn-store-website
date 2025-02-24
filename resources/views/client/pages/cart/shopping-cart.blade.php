<!-- cart item area start -->
<div class="shopping-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table-bordered table table-hover">
                        <thead>
                            <tr>
                                <th class="cart-item-img"></th>
                                <th class="cart-product-name">Tên Sản Phẩm</th>
                                <th class="edit">Cỡ</th>
                                <th class="move-wishlist">Màu</th>
                                <th class="unit-price">Đơn Giá</th>
                                <th class="quantity">Số Lượng</th>
                                <th class="subtotal">Tổng</th>
                                <th class="remove-icon"></th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($cartItems as $cartItem)
                                <tr>
                                    <td class="cart-item-img">
                                        <a href="single-product.html">
                                            <img src="img/cart/3.png" alt="">
                                        </a>
                                    </td>
                                    <td class="cart-product-name">
                                        <a href="single-product.html">{{ $cartItem->product_name }}</a>
                                    </td>
                                    <td class="edit">
                                        <a href="#">{{ $cartItem->size }}</a>
                                    </td>
                                    <td class="move-wishlist">
                                        <a href="#">{{ $cartItem->color }}</a>
                                    </td>
                                    <td class="unit-price">
                                        <span>{{ $cartItem->price }}</span>
                                    </td>
                                    <td class="quantity">
                                        <span>{{ $cartItem->quantity }}</span>
                                    </td>
                                    <td class="subtotal">
                                        <span>
                                            {{ $cartItem->price * $cartItem->quantity }}

                                        </span>
                                    </td>
                                    <td class="remove-icon">
                                        <form action="{{ route('cart.delete', $cartItem->cart_item_id) }}"
                                            method="POST" style="display:inline;">
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
                            <button type="submit">continue shopping</button>
                        </div>
                        <div class="shopping-cart-left">
                            <button type="submit">Clear Shopping Cart</button>
                            <button type="submit">Update Shopping Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-end">
            <div class="col-md-4">
                <div class="discount-code">
                    <h3>Mã Giảm Giá</h3>
                    <p>Nhập mã phiếu giảm giá của bạn nếu bạn có.</p>
                    <input type="text">
                    <div class="shopping-button">
                        <button type="submit">Áp Dụng Mã</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                {{-- <form action="{{route('order.index')}}" method="GET"> --}}
                    {{-- @csrf --}}

                    {{-- <input type="hidden" name="productVariants" value="{{ $cartItems }}"> --}}
                    {{-- <input type="hidden" name="grandAmount" value="{{ $totalAmount }}"> --}}


                    <div class="totals p-3 ">
                        <div class="row">
                            <p class="col-6 text-start">Tổng Phụ</p>
                            <p class="col-6 text-end fw-bold">{{ number_format($totalAmount) }} VND</p>
                        </div>
                        <div class="row">
                            <p class="col-6 text-start">Phí Vận Chuyển</p>
                            <p class="col-6 text-end fw-bold">20,000 VND</p>
                        </div>
                        <div class="row">
                            <p class="col-6 text-start">Giảm Giá</p>
                            <p class="col-6 text-end fw-bold"> VND</p>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12 text-start">
                                <h3>Tổng Cộng</h3>
                            </div>
                            <div class="col-12 text-end fw-bold text-primary text-wrap overflow-hidden">
                                <h3 class="d-inline-block w-100 text-end">{{ number_format($totalAmount) }} VND</h3>
                            </div>
                        </div>



                        <div class="shopping-button text-center mt-3">
                            {{-- <button type="submit" class="w-100">Tiến hành thanh toán</button> --}}
                            <a href="{{route('checkout.index')}}" class="w-100">Tiến hành thanh toán</a>
                        </div>
                    </div>
                {{-- </form> --}}
            </div>

        </div>
    </div>
</div>
<!-- cart item area end -->

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
                                <th class="cart-product-name">Product Name</th>
                                <th class="edit">Size</th>
                                <th class="move-wishlist">Color</th>
                                <th class="unit-price">Unit Price</th>
                                <th class="quantity">Qty</th>
                                <th class="subtotal">Subtotal</th>
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
                                    <a href="single-product.html">{{$cartItem->product_name}}</a>
                                </td>
                                <td class="edit">
                                    <a href="#">{{$cartItem->size}}</a>
                                </td>
                                <td class="move-wishlist">
                                    <a href="#">{{$cartItem->color}}</a>
                                </td>
                                <td class="unit-price">
                                    <span>{{$cartItem->price}}</span>
                                </td>
                                <td class="quantity">
                                    <form action="{{ route('cart.update', $cartItem->cart_item_id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="input-group">
                                            <button type="button" class="btn btn-outline-secondary" onclick="changeQty({{ $cartItem->cart_item_id }}, -0)">-</button>
                                            <input type="text" class="form-control text-center qtyInput" id="qtyInput-{{ $cartItem->cart_item_id }}" name="quantity" value="{{ $cartItem->quantity }}">
                                            <button type="button" class="btn btn-outline-secondary" onclick="changeQty({{ $cartItem->cart_item_id }}, +0.5)">+</button>
                                        </div>
                                    </form>
                                </td>
                                <td class="subtotal">
                                    <span>
                                        {{$cartItem->price * $cartItem->quantity}} 
                                        
                                    </span>
                                </td>
                                <td class="remove-icon">
                                    <form action="{{ route('cart.delete', $cartItem->cart_item_id) }}" method="POST" style="display:inline;">
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
        <div class="row">
            <div class="col-md-4">
                <div class="discount-code">
                    <h3>Discount Codes</h3>
                    <p>Enter your coupon code if you have one.</p>
                    <input type="text">
                    <div class="shopping-button">
                        <button type="submit">apply coupon</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="estimate-shipping">
                    <h3>Estimate Shipping and Tax</h3>
                    <p>Enter your destination to get a shipping estimate.</p>
                    <form action="#">
                        <div class="form-box">
                            <div class="form-name">
                                <label> country <em>*</em> </label>
                                <select>
                                    <option value="1">Afghanistan</option>
                                    <option value="1">Algeria</option>
                                    <option value="1">American Samoa</option>
                                    <option value="1">Australia</option>
                                    <option value="1">Bangladesh</option>
                                    <option value="1">Belgium</option>
                                    <option value="1">Bosnia and Herzegovina</option>
                                    <option value="1">Chile</option>
                                    <option value="1">China</option>
                                    <option value="1">Egypt</option>
                                    <option value="1">Finland</option>
                                    <option value="1">France</option>
                                    <option value="1">United State</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-box">
                            <div class="form-name">
                                <label> State/Province </label>
                                <select>
                                    <option value="1">Please select region, state or province</option>
                                    <option value="1">Arizona</option>
                                    <option value="1">Armed Forces Africa</option>
                                    <option value="1">California</option>
                                    <option value="1">Florida</option>
                                    <option value="1">Indiana</option>
                                    <option value="1">Marshall Islands</option>
                                    <option value="1">Minnesota</option>
                                    <option value="1">New Mexico</option>
                                    <option value="1">Utah</option>
                                    <option value="1">Virgin Islands</option>
                                    <option value="1">West Virginia</option>
                                    <option value="1">Wyoming</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-box">
                            <div class="form-name">
                                <label> Zip/Postal Code </label>
                                <input type="text">
                            </div>
                        </div>
                        <div class="shopping-button">
                            <button type="submit">get a quote</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="totals">
                    <p>subtotal <span>$1,540.00</span> </p>
                    <h3>Grand Total <span>$1,540.00</span></h3>
                    <div class="shopping-button">
                        <button type="submit">proceed to checkout</button>
                    </div>
                    <a href="#">Checkout with Multiple Addresses</a>
                </div>
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
 <script>
    function changeQty(cartItemId, change) {
        let qtyInput = document.getElementById("qtyInput-" + cartItemId);
        let newQty = parseInt(qtyInput.value) + change;

        if (newQty > 0) {
            qtyInput.value = newQty;

            // Đợi 500ms sau khi nhập xong rồi mới submit để tránh submit nhiều lần
            clearTimeout(qtyInput.dataset.timeout);
            qtyInput.dataset.timeout = setTimeout(() => {
                qtyInput.form.submit();
            }, 500);
        }
    }

    document.querySelectorAll(".qtyInput").forEach(input => {
        input.addEventListener("change", function() {
            clearTimeout(this.dataset.timeout);
            this.dataset.timeout = setTimeout(() => {
                this.form.submit();
            }, 500);
        });
    });
</script>

                             
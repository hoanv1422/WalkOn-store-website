@extends('client.layouts.app')
@section('title', 'Giỏ hàng')
@section('content')

    @include('client.layouts.partials.menu_header')
    <div class="mainmenu-area home2 product-items">
        @include('client.layouts.partials.menu_header1')
        <!-- header area end -->
        <!-- cart item area start -->
        <div class="shopping-cart">
            <div class="container">
                @include('client.components.breadcrumb')
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table-bordered table table-hover">
                                <thead>
                                    <tr>
                                        <th class="cart-item-img"></th>
                                        <th class="cart-product-name">Product Name</th>
                                        <th class="edit"></th>
                                        <th class="move-wishlist">Move to Wishlist</th>
                                        <th class="unit-price">Unit Price</th>
                                        <th class="quantity">Qty</th>
                                        <th class="subtotal">Subtotal</th>
                                        <th class="remove-icon"></th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($cart as $id => $details)
                                        <tr>
                                            <td class="cart-item-img">
                                                <a href="single-product.html">
                                                    <img src="{{ $details['image'] }}" alt="">
                                                </a>
                                            </td>
                                            <td class="cart-product-name">
                                                <a href="single-product.html">{{ $details['name'] }}</a>
                                            </td>
                                            <td class="edit">
                                                <a href="#">Edit</a>
                                            </td>
                                            <td class="move-wishlist">
                                                <a href="#">Move</a>
                                            </td>
                                            <td class="unit-price">
                                                <span>{{ number_format($details['price'], 0, ',', '.') }} VND</span>
                                            </td>
                                            <td class="quantity">
                                                <span>{{ $details['quantity'] }}</span>
                                            </td>
                                            <td class="subtotal">
                                                <span>{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}
                                                    VND</span>
                                            </td>
                                            <td class="remove-icon">
                                                <a href="#">
                                                    <img src="img/cart/btn_remove.png" alt="">
                                                </a>
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
                            <p>subtotal <span>{{ number_format(array_sum(array_column($cart, 'price')), 0, ',', '.') }}
                                    VND</span> </p>
                            <h3>Grand Total
                                <span>{{ number_format(array_sum(array_map(function ($item) {return $item['price'] * $item['quantity'];}, $cart)),0,',','.') }}
                                    VND</span></h3>
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
        <!-- footer top area start -->
    @endsection

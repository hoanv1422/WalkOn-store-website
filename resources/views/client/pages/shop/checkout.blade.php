@extends('client.layouts.app')
@section('title', 'thanh toán')
@section('content')

@include('client.layouts.partials.menu_header')
            <div class="mainmenu-area home2 product-items">
                @include('client.layouts.partials.menu_header1')
        <!-- header area end -->
        <!-- checkout area start -->
        <div class="checkout-area">
            <div class="container">
                @include('client.components.breadcrumb')
                <div class="row">
                    @include('client.layouts.sidebar.sidebar1')
                    <div class="col-lg-9">
                        <div class="checkout-banner hidden-xs">
                            <a href="#">
                                <img src="img/checkout/checkout_banner.jpg" alt="">
                            </a>
                        </div>
                        <div class="checkout-heading">
                            <h2>Checkout</h2>
                        </div>
                        <div class="checkout-accordion">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title">
                                            <a role="button" data-bs-toggle="collapse"  href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Step 1: Checkout Options
                                                <i class="fa fa-caret-down"></i>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne" data-bs-parent="#accordion">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="checkout-collapse">
                                                        <h3 class="checkout-title">New Customer</h3>
                                                        <p class="c-title-content">Checkout Options</p>
                                                        <form action="#">
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="account" value="register">Register Account
                                                                </label>
                                                            </div>
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="account" value="guest">Guest Checkout
                                                                </label>
                                                            </div>
                                                            <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
                                                            <button type="submit" value="Continue" class="check-button">Continue</button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="checkout-collapse">
                                                        <h3 class="checkout-title">Returning Customer</h3>
                                                        <p class="c-title-content">I am a returning customer</p>
                                                        <form action="#">
                                                            <div class="form-box">
                                                                <div class="form-name">
                                                                    <label>E-mail</label>
                                                                    <input type="email">
                                                                </div>
                                                            </div>
                                                            <div class="form-box">
                                                                <div class="form-name">
                                                                    <label>Password</label>
                                                                    <input type="password">
                                                                </div>
                                                            </div>
                                                            <a href="#">Forgotten Password</a>
                                                        </form>
                                                        <button type="submit" value="Continue" class="check-button">Continue</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingTwo">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-bs-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Step 2: Account & Billing Details
                                                <i class="fa fa-caret-down"></i>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" data-bs-parent="#accordion">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="account-details">
                                                        <h4>Your Personal Details</h4>
                                                        <div class="form-box">
                                                            <div class="form-name">
                                                                <label>First Name <em>*</em> </label>
                                                                <input type="text" placeholder="First Name">
                                                            </div>
                                                        </div>
                                                        <div class="form-box">
                                                            <div class="form-name">
                                                                <label>Last Name <em>*</em> </label>
                                                                <input type="text" placeholder="Last Name">
                                                            </div>
                                                        </div>
                                                        <div class="form-box">
                                                            <div class="form-name">
                                                                <label>E-mail <em>*</em> </label>
                                                                <input type="email" placeholder="E-mail">
                                                            </div>
                                                        </div>
                                                        <div class="form-box">
                                                            <div class="form-name">
                                                                <label>Telephone <em>*</em> </label>
                                                                <input type="text" placeholder="Telephone">
                                                            </div>
                                                        </div>
                                                        <div class="form-box">
                                                            <div class="form-name">
                                                                <label>Fax </label>
                                                                <input type="text" placeholder="Fax">
                                                            </div>
                                                        </div>
                                                        <h4>Your Password</h4>
                                                        <div class="form-box">
                                                            <div class="form-name">
                                                                <label>Password <em>*</em> </label>
                                                                <input type="password" placeholder="Password">
                                                            </div>
                                                        </div>
                                                        <div class="form-box">
                                                            <div class="form-name">
                                                                <label>Password Confirm <em>*</em> </label>
                                                                <input type="password" placeholder="Password Confirm">
                                                            </div>
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" name="newsletter">I wish to subscribe to the Malias1 newsletter.
                                                        </div>
                                                        <div class="checkbox">
                                                            <input type="checkbox" checked="" name="shipping-address">My delivery and billing addresses are the same.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="checkout-collapse">
                                                        <h4>Your Address</h4>
                                                        <div class="form-box">
                                                            <div class="form-name">
                                                                <label>Company </label>
                                                                <input type="text" placeholder="Company">
                                                            </div>
                                                        </div>
                                                        <div class="form-box">
                                                            <div class="form-name">
                                                                <label>Address 1 <em>*</em> </label>
                                                                <input type="text" placeholder="Address 1">
                                                            </div>
                                                        </div>
                                                        <div class="form-box">
                                                            <div class="form-name">
                                                                <label>Address 2 <em>*</em> </label>
                                                                <input type="text" placeholder="Address 2">
                                                            </div>
                                                        </div>
                                                        <div class="form-box">
                                                            <div class="form-name">
                                                                <label>City <em>*</em> </label>
                                                                <input type="text" placeholder="City">
                                                            </div>
                                                        </div>
                                                        <div class="form-box">
                                                            <div class="form-name">
                                                                <label>Post Code <em>*</em> </label>
                                                                <input type="text" placeholder="Post Code">
                                                            </div>
                                                        </div>
                                                        <div class="form-box">
                                                            <div class="form-name">
                                                                <label> country <em>*</em> </label>
                                                                <select>
                                                                    <option value="1">---Please select---</option>
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
                                                                    <option value="1">---Please select---</option>
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
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="privacy-policy">
                                                I have read and agree to the
                                                <a href="#">Privacy Policy</a>
                                                <input type="checkbox" name="agree">
                                                <button type="submit" value="Continue" class="check-button">Continue</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingThree">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-bs-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Step 3: Delivery Details
                                                <i class="fa fa-caret-down"></i>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" data-bs-parent="#accordion">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="delivery-details">
                                                        <form action="#">
                                                            <div class="list-style">
                                                                <div class="form-name">
                                                                    <label>First Name <em>*</em> </label>
                                                                    <input type="text" placeholder="First Name">
                                                                </div>
                                                                <div class="form-name">
                                                                    <label>Last Name <em>*</em> </label>
                                                                    <input type="text" placeholder="Last Name">
                                                                </div>
                                                                <div class="form-name">
                                                                    <label>Company </label>
                                                                    <input type="text" placeholder="Company">
                                                                </div>
                                                                <div class="form-name">
                                                                    <label>Address 1 <em>*</em> </label>
                                                                    <input type="text" placeholder="Address 1">
                                                                </div>
                                                                <div class="form-name">
                                                                    <label>Address 2 <em>*</em> </label>
                                                                    <input type="text" placeholder="Address 2">
                                                                </div>
                                                                <div class="form-name">
                                                                    <label>City <em>*</em> </label>
                                                                    <input type="text" placeholder="City">
                                                                </div>
                                                                <div class="form-name">
                                                                    <label>Post Code <em>*</em> </label>
                                                                    <input type="text" placeholder="Post Code">
                                                                </div>
                                                                <div class="form-name">
                                                                    <label> country <em>*</em> </label>
                                                                    <select>
                                                                        <option value="1">---Please select---</option>
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
                                                                <div class="form-name">
                                                                    <label> State/Province </label>
                                                                    <select>
                                                                        <option value="1">---Please select---</option>
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
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingFour">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-bs-toggle="collapse" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                                Step 4: Delivery Method
                                                <i class="fa fa-caret-down"></i>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour" data-bs-parent="#accordion">
                                        <div class="panel-body">
                                            <div class="delivery-method">
                                                <p>Please select the preferred shipping method to use on this order.</p>
                                                <p> <strong>Flat Rate</strong> </p>
                                                <div class="radio">
                                                    <input type="radio" checked="" value="shipping-method">Flat Shipping Rate - $5.00
                                                </div>
                                                <p> <strong> Add Comments About Your Order</strong></p>
                                                <p> <textarea name="comment" rows="8"></textarea> </p>
                                                <button type="submit" value="Continue" class="check-button">Continue</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingFive">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-bs-toggle="collapse" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                                Step 5: Payment Method
                                                <i class="fa fa-caret-down"></i>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive" data-bs-parent="#accordion">
                                        <div class="panel-body">
                                            <div class="patment-method">
                                                <p>Please select the preferred payment method to use on this order.</p>
                                                <div class="radio">
                                                    <input type="radio" checked="" value="shipping-method">Cash On Delivery
                                                </div>
                                                <p> <strong> Add Comments About Your Order</strong></p>
                                                <p> <textarea name="comment" rows="8"></textarea> </p>
                                                <div class="privacy-policy">
                                                    I have read and agree to the
                                                    <a href="#">Privacy Policy</a>
                                                    <input type="checkbox" name="agree">
                                                    <button type="submit" value="Continue" class="check-button">Continue</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingSix">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-bs-toggle="collapse" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                                Step 6: Confirm Order
                                                <i class="fa fa-caret-down"></i>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix" data-bs-parent="#accordion">
                                        <div class="panel-body">
                                            <div class="confirm-order">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Product Name</th>
                                                                <th>Model</th>
                                                                <th>Quantity</th>
                                                                <th>Unit Price</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <a href="#">More-Or-Less</a>
                                                                </td>
                                                                <td>Product 14</td>
                                                                <td>2</td>
                                                                <td>$100.00</td>
                                                                <td>$200.00</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <a href="#">Aliquam Consequat</a>
                                                                </td>
                                                                <td>Product 14</td>
                                                                <td>1</td>
                                                                <td>$90.00</td>
                                                                <td>$90.00</td>
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td class="text-right" colspan="4">
                                                                    <strong>Sub-Total:</strong>
                                                                </td>
                                                                <td>$290.00</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right" colspan="4">
                                                                    <strong>Flat Shipping Rate:</strong>
                                                                </td>
                                                                <td>$5.00</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-right" colspan="4">
                                                                    <strong>Flat Shipping Rate:</strong>
                                                                </td>
                                                                <td>$5.00</td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                                <button type="submit" value="Continue" class="check-button">Confirm Order</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- checkout area end -->
  
@endsection
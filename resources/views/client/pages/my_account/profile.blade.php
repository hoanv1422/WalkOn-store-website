@extends('client.layouts.app')
@section('title', 'profile')
@section('content')

@include('client.layouts.partials.menu_header')
            <div class="mainmenu-area home2 product-items">
@include('client.layouts.partials.menu_header1')
<div class="account-area">
    <div class="container">
        @include('client.components.breadcrumb')
        <div class="row">
            @include('client.layouts.sidebar.sidebar1')
            <div class="col-lg-9">
                <div class="my-account-accordion">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <i class="fa fa-list-ol"></i>
                                        Order history and details
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" data-bs-parent="#accordion">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="account-title">
                                                <h4>Here are the orders you've placed since your account was created.</h4>
                                            </div>
                                            <div class="order-history">
                                                <p>You have not placed any orders.</p>
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
                                        <i class="fa fa-file-o"></i>
                                        My credit slips
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" data-bs-parent="#accordion">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="account-title">
                                                <h4>Credit slips you have received after canceled orders. </h4>
                                            </div>
                                            <div class="credit-slids">
                                                <p>You have not received any credit slips.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-bs-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <i class="fa fa-building-o"></i>
                                        My addresses
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" data-bs-parent="#accordion">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="my-address">
                                                <p>Please configure your default billing and delivery addresses when placing an order. You may also add additional addresses, which can be useful for sending gifts or receiving an order at your office.</p>
                                                <div class="account-title">
                                                    <h4>Your addresses are listed below. </h4>
                                                </div>
                                                <p>Be sure to update your personal information if it has changed.</p>
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="account-address">
                                                            <ul>
                                                                <li class="address-menu-title">My address</li>
                                                                <li>Hridoy roy</li>
                                                                <li>Expert</li>
                                                                <li>Bristol</li>
                                                                <li>Manchester1</li>
                                                                <li>Bristol</li>
                                                                <li>United Kingdom</li>
                                                                <li>2334234</li>
                                                                <li>454565768678</li>
                                                                <li>
                                                                    <button> update </button>
                                                                    <button> submit </button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="add-address">
                                                    <button>add new address</button>
                                                </div>
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
                                        <i class="fa fa-user"></i>
                                        My personal information
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour" data-bs-parent="#accordion">
                                <div class="panel-body">
                                    <div class="col-md-12">
                                        <div class="delivery-details">
                                            <form action="#">
                                                <div class="list-style">
                                                    <div class="account-title">
                                                        <h4>Please be sure to update your personal information if it has changed. </h4>
                                                    </div>
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
                                                    <div class="save-button">
                                                        <button>save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFive">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-bs-toggle="collapse" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        <i class="fa fa-heart"></i>
                                        My wishlists
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive" data-bs-parent="#accordion">
                                <div class="panel-body">
                                    <div class="col-sm-12">
                                        <div class="wishlist-container">
                                            <h3>New Wishlist</h3>
                                            <form action="#">
                                                <label>Name</label>
                                                <input type="text">
                                                <div class="save-button">
                                                    <button type="submit">save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="account-button">
                        <div class="back-btn"> <a href="#">Back to your Account</a> </div>
                        <div class="home"> <a href="index.html"> home</a> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
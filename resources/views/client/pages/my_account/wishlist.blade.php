@extends('client.layouts.app')
@section('title', 'wishlist')
@section('content')

@include('client.layouts.partials.menu_header')

            <div class="mainmenu-area home2 product-items">
                @include('client.layouts.partials.menu_header1')
        <!-- header area end -->
        <!-- wishlist area start -->
        <div class="wishlist-area">
            <div class="container">
                @include('client.components.breadcrumb')
                <div class="row">
                    @include('client.layouts.sidebar.sidebar2')
                    <div class="col-lg-9">
                        <div class="wishlist-banner">
                            <a href="#">
                                <img src="img/checkout/checkout_banner.jpg" alt="">
                            </a>
                        </div>
                        <div class="wishlist-heading">
                            <h2>Wishlist</h2>
                        </div>
                        <div class="wishlist-content">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Model</th>
                                            <th>Stock</th>
                                            <th>Unit Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="#" class="text-center"><img src="img/wishlist/1.png" alt=""> </a></td>
                                            <td>
                                                <a href="single-product.html">More-Or-Less</a>
                                            </td>
                                            <td>Product 14</td>
                                            <td>In Stock</td>
                                            <td class="unit-price">$100.00</td>
                                            <td>
                                                <div class="wishlist-actions">
                                                    <button type="button" data-bs-toggle="tooltip" title="Add to Cart"> <i class="fa fa-shopping-cart"></i> </button>
                                                    <button type="button" data-bs-toggle="tooltip" title="Remove"> <i class="fa fa-times"></i> </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> <a href="#" class="text-center"><img src="img/wishlist/2.png" alt=""> </a> </td>
                                            <td>
                                                <a href="single-product.html">Aliquam Consequat</a>
                                            </td>
                                            <td>Product 14</td>
                                            <td>In Stock</td>
                                            <td class="unit-price">$90.00</td>
                                            <td>
                                                <div class="wishlist-actions">
                                                    <button type="button" data-bs-toggle="tooltip" title="Add to Cart"> <i class="fa fa-shopping-cart"></i> </button>
                                                    <button type="button" data-bs-toggle="tooltip" title="Remove"> <i class="fa fa-times"></i> </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="#" class="text-center"><img src="img/wishlist/1.png" alt=""> </a></td>
                                            <td>
                                                <a href="single-product.html">More-Or-Less</a>
                                            </td>
                                            <td>Product 14</td>
                                            <td>In Stock</td>
                                            <td class="unit-price">$100.00</td>
                                            <td>
                                                <div class="wishlist-actions">
                                                    <button type="button" data-bs-toggle="tooltip" title="Add to Cart"> <i class="fa fa-shopping-cart"></i> </button>
                                                    <button type="button" data-bs-toggle="tooltip" title="Remove"> <i class="fa fa-times"></i> </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="submit" value="Continue" class="check-button">Continue</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- wishlist area end -->
   
@endsection
@extends('client.layouts.app')
@section('title', 'danh sách sản phẩm')
@section('content')

    @include('client.layouts.partials.menu_header')
    <div class="mainmenu-area home2 product-items">
        @include('client.layouts.partials.menu_header1')
        <!-- header area end -->
        <!-- product items banner start -->
        @include('client.layouts.banner.banner3')
        <!-- product items banner end -->
        <!-- product main items area start -->
        <div class="product-main-items">
            <div class="container">
                @include('client.components.breadcrumb')
                @include('client.layouts.sidebar.sidebar')
                <div class="col-lg-9">
                    <div class="product-bar">
                        <ul class="nav product-navigation justify-content-center" role="tablist">
                            <li role="presentation" class="gird">
                                <a href="#gird" aria-controls="gird" role="tab" data-bs-toggle="tab">
                                    <span>
                                        <img class="primary" src="client_views/img/product/grid-primary.png" alt="">
                                        <img class="secondary" src="client_views/img/product/grid-secondary.png"
                                            alt="">
                                    </span>
                                    Gird
                                </a>
                            </li>
                            <li role="presentation" class="list">
                                <a class="active" href="#list" aria-controls="list" role="tab" data-bs-toggle="tab">
                                    <span>
                                        <img class="primary" src="client_views/img/product/list-primary.png" alt="">
                                        <img class="secondary" src="client_views/img/product/list-secondary.png"
                                            alt="">
                                    </span>
                                    List
                                </a>
                            </li>
                        </ul>
                        <div class="sort-by">
                            <label>Sort By</label>
                            <select name="sort">
                                <option value="#" selected>Position</option>
                                <option value="#">Name</option>
                                <option value="#">Price</option>
                            </select>
                            <a href="#" title="Set Descending Direction">
                                <img src="client_views/img/product/i_asc_arrow.gif" alt="">
                            </a>
                        </div>
                        <div class="limit-product">
                            <label>Show</label>
                            <select name="show">
                                <option value="#" selected>9</option>
                                <option value="#">12</option>
                                <option value="#">24</option>
                                <option value="#">36</option>
                            </select>
                            per page
                        </div>
                    </div>
                    <div class="row">
                        <div class="product-content">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade home2" id="gird">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="single-product">
                                                <div class="level-pro-new">
                                                    <span>new</span>
                                                </div>
                                                <div class="product-img">
                                                    <a href="single-product.html">
                                                        <img src="client_views/img/product/25.png" alt=""
                                                            class="primary-img">
                                                        <img src="client_views/img/product/26.png" alt=""
                                                            class="secondary-img">
                                                    </a>
                                                </div>
                                                <div class="actions">
                                                    <button type="submit" class="cart-btn" title="Add to cart">add to
                                                        cart</button>
                                                    <ul class="add-to-link">
                                                        <li><a class="modal-view" data-target="#productModal"
                                                                data-bs-toggle="modal" href="#"> <i
                                                                    class="fa fa-search"></i></a></li>
                                                        <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                        <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product-price">
                                                    <div class="product-name">
                                                        <a href="single-product.html" title="Fusce aliquam">Fusce
                                                            aliquam</a>
                                                    </div>
                                                    <div class="price-rating">
                                                        <span>$170.00</span>
                                                        <div class="ratings">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="single-product">
                                                <div class="level-pro-new">
                                                    <span>new</span>
                                                </div>
                                                <div class="product-img">
                                                    <a href="single-product.html">
                                                        <img src="client_views/img/product/23.png" alt=""
                                                            class="primary-img">
                                                        <img src="client_views/img/product/24.png" alt=""
                                                            class="secondary-img">
                                                    </a>
                                                </div>
                                                <div class="actions">
                                                    <button type="submit" class="cart-btn" title="Add to cart">add to
                                                        cart</button>
                                                    <ul class="add-to-link">
                                                        <li><a class="modal-view" data-target="#productModal"
                                                                data-bs-toggle="modal" href="#"> <i
                                                                    class="fa fa-search"></i></a></li>
                                                        <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                        <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product-price">
                                                    <div class="product-name">
                                                        <a href="single-product.html" title="Fusce aliquam">Fusce
                                                            aliquam</a>
                                                    </div>
                                                    <div class="price-rating">
                                                        <span>$170.00</span>
                                                        <div class="ratings">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="single-product">
                                                <div class="level-pro-new">
                                                    <span>new</span>
                                                </div>
                                                <div class="product-img">
                                                    <a href="single-product.html">
                                                        <img src="client_views/img/product/21.png" alt=""
                                                            class="primary-img">
                                                        <img src="client_views/img/product/22.png" alt=""
                                                            class="secondary-img">
                                                    </a>
                                                </div>
                                                <div class="actions">
                                                    <button type="submit" class="cart-btn" title="Add to cart">add to
                                                        cart</button>
                                                    <ul class="add-to-link">
                                                        <li><a class="modal-view" data-target="#productModal"
                                                                data-bs-toggle="modal" href="#"> <i
                                                                    class="fa fa-search"></i></a></li>
                                                        <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                        <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product-price">
                                                    <div class="product-name">
                                                        <a href="single-product.html" title="Fusce aliquam">Fusce
                                                            aliquam</a>
                                                    </div>
                                                    <div class="price-rating">
                                                        <span>$170.00</span>
                                                        <div class="ratings">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="single-product">
                                                <div class="level-pro-new">
                                                    <span>new</span>
                                                </div>
                                                <div class="product-img">
                                                    <a href="single-product.html">
                                                        <img src="client_views/img/product/19.png" alt=""
                                                            class="primary-img">
                                                        <img src="client_views/img/product/20.png" alt=""
                                                            class="secondary-img">
                                                    </a>
                                                </div>
                                                <div class="actions">
                                                    <button type="submit" class="cart-btn" title="Add to cart">add to
                                                        cart</button>
                                                    <ul class="add-to-link">
                                                        <li><a class="modal-view" data-target="#productModal"
                                                                data-bs-toggle="modal" href="#"> <i
                                                                    class="fa fa-search"></i></a></li>
                                                        <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                        <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product-price">
                                                    <div class="product-name">
                                                        <a href="single-product.html" title="Fusce aliquam">Fusce
                                                            aliquam</a>
                                                    </div>
                                                    <div class="price-rating">
                                                        <span>$170.00</span>
                                                        <div class="ratings">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="single-product">
                                                <div class="level-pro-new">
                                                    <span>new</span>
                                                </div>
                                                <div class="product-img">
                                                    <a href="single-product.html">
                                                        <img src="client_views/img/product/17.png" alt=""
                                                            class="primary-img">
                                                        <img src="client_views/img/product/18.png" alt=""
                                                            class="secondary-img">
                                                    </a>
                                                </div>
                                                <div class="actions">
                                                    <button type="submit" class="cart-btn" title="Add to cart">add to
                                                        cart</button>
                                                    <ul class="add-to-link">
                                                        <li><a class="modal-view" data-target="#productModal"
                                                                data-bs-toggle="modal" href="#"> <i
                                                                    class="fa fa-search"></i></a></li>
                                                        <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                        <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product-price">
                                                    <div class="product-name">
                                                        <a href="single-product.html" title="Fusce aliquam">Fusce
                                                            aliquam</a>
                                                    </div>
                                                    <div class="price-rating">
                                                        <span>$170.00</span>
                                                        <div class="ratings">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="single-product">
                                                <div class="level-pro-new">
                                                    <span>new</span>
                                                </div>
                                                <div class="product-img">
                                                    <a href="single-product.html">
                                                        <img src="client_views/img/product/15.png" alt=""
                                                            class="primary-img">
                                                        <img src="client_views/img/product/16.png" alt=""
                                                            class="secondary-img">
                                                    </a>
                                                </div>
                                                <div class="actions">
                                                    <button type="submit" class="cart-btn" title="Add to cart">add to
                                                        cart</button>
                                                    <ul class="add-to-link">
                                                        <li><a class="modal-view" data-target="#productModal"
                                                                data-bs-toggle="modal" href="#"> <i
                                                                    class="fa fa-search"></i></a></li>
                                                        <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                        <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product-price">
                                                    <div class="product-name">
                                                        <a href="single-product.html" title="Fusce aliquam">Fusce
                                                            aliquam</a>
                                                    </div>
                                                    <div class="price-rating">
                                                        <span>$170.00</span>
                                                        <div class="ratings">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="single-product">
                                                <div class="level-pro-new">
                                                    <span>new</span>
                                                </div>
                                                <div class="product-img">
                                                    <a href="single-product.html">
                                                        <img src="client_views/img/product/13.png" alt=""
                                                            class="primary-img">
                                                        <img src="client_views/img/product/14.png" alt=""
                                                            class="secondary-img">
                                                    </a>
                                                </div>
                                                <div class="actions">
                                                    <button type="submit" class="cart-btn" title="Add to cart">add to
                                                        cart</button>
                                                    <ul class="add-to-link">
                                                        <li><a class="modal-view" data-target="#productModal"
                                                                data-bs-toggle="modal" href="#"> <i
                                                                    class="fa fa-search"></i></a></li>
                                                        <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                        <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product-price">
                                                    <div class="product-name">
                                                        <a href="single-product.html" title="Fusce aliquam">Fusce
                                                            aliquam</a>
                                                    </div>
                                                    <div class="price-rating">
                                                        <span>$170.00</span>
                                                        <div class="ratings">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="single-product">
                                                <div class="level-pro-new">
                                                    <span>new</span>
                                                </div>
                                                <div class="product-img">
                                                    <a href="single-product.html">
                                                        <img src="client_views/img/product/11.png" alt=""
                                                            class="primary-img">
                                                        <img src="client_views/img/product/12.png" alt=""
                                                            class="secondary-img">
                                                    </a>
                                                </div>
                                                <div class="actions">
                                                    <button type="submit" class="cart-btn" title="Add to cart">add to
                                                        cart</button>
                                                    <ul class="add-to-link">
                                                        <li><a class="modal-view" data-target="#productModal"
                                                                data-bs-toggle="modal" href="#"> <i
                                                                    class="fa fa-search"></i></a></li>
                                                        <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                        <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product-price">
                                                    <div class="product-name">
                                                        <a href="single-product.html" title="Fusce aliquam">Fusce
                                                            aliquam</a>
                                                    </div>
                                                    <div class="price-rating">
                                                        <span>$170.00</span>
                                                        <div class="ratings">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <div class="single-product">
                                                <div class="level-pro-new">
                                                    <span>new</span>
                                                </div>
                                                <div class="product-img">
                                                    <a href="single-product.html">
                                                        <img src="client_views/img/product/9.png" alt=""
                                                            class="primary-img">
                                                        <img src="client_views/img/product/10.png" alt=""
                                                            class="secondary-img">
                                                    </a>
                                                </div>
                                                <div class="actions">
                                                    <button type="submit" class="cart-btn" title="Add to cart">add to
                                                        cart</button>
                                                    <ul class="add-to-link">
                                                        <li><a class="modal-view" data-target="#productModal"
                                                                data-bs-toggle="modal" href="#"> <i
                                                                    class="fa fa-search"></i></a></li>
                                                        <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                        <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="product-price">
                                                    <div class="product-name">
                                                        <a href="single-product.html" title="Fusce aliquam">Fusce
                                                            aliquam</a>
                                                    </div>
                                                    <div class="price-rating">
                                                        <span>$170.00</span>
                                                        <div class="ratings">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade home2 active show" id="list">
                                    <div class="product-catagory">
                                        <div class="single-list-product row">
                                            <div class="col-md-4">
                                                <div class="list-product-img">
                                                    <a href="single-product.html">
                                                        <img src="client_views/img/product/1.png" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="list-product-info">
                                                    <a href="single-product.html" class="list-product-name"> Cras neque
                                                        metus</a>
                                                    <div class="price-rating">
                                                        <span class="old-price">$700.00</span>
                                                        <span>$800.00</span>
                                                        <div class="ratings">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                            <a href="#" class="review">1 Review(s)</a>
                                                            <a href="#" class="add-review">Add Your Review</a>
                                                        </div>
                                                    </div>
                                                    <div class="list-product-details">
                                                        <p>Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida
                                                            et mattis vulputate, tristique ut lectus. Sed et lorem nunc.
                                                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices
                                                            posuere cubilia Curae; Aenean eleifend laoreet congue. Vivamus
                                                            adipiscing nisl ut dolor dignissim semper. Nul
                                                            <a href="single-product.html">Learn More</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-list-product row">
                                            <div class="col-md-4">
                                                <div class="list-product-img">
                                                    <a href="single-product.html">
                                                        <img src="client_views/img/product/6.png" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="list-product-info">
                                                    <a href="single-product.html" class="list-product-name"> Cras neque
                                                        metus</a>
                                                    <div class="price-rating">
                                                        <span class="old-price">$700.00</span>
                                                        <span>$800.00</span>
                                                        <div class="ratings">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                            <a href="#" class="review">1 Review(s)</a>
                                                            <a href="#" class="add-review">Add Your Review</a>
                                                        </div>
                                                    </div>
                                                    <div class="list-product-details">
                                                        <p>Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida
                                                            et mattis vulputate, tristique ut lectus. Sed et lorem nunc.
                                                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices
                                                            posuere cubilia Curae; Aenean eleifend laoreet congue. Vivamus
                                                            adipiscing nisl ut dolor dignissim semper. Nul
                                                            <a href="single-product.html">Learn More</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-list-product row">
                                            <div class="col-md-4">
                                                <div class="list-product-img">
                                                    <a href="single-product.html">
                                                        <img src="client_views/img/product/3.png" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="list-product-info">
                                                    <a href="single-product.html" class="list-product-name"> Cras neque
                                                        metus</a>
                                                    <div class="price-rating">
                                                        <span class="old-price">$700.00</span>
                                                        <span>$800.00</span>
                                                        <div class="ratings">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                            <a href="#" class="review">1 Review(s)</a>
                                                            <a href="#" class="add-review">Add Your Review</a>
                                                        </div>
                                                    </div>
                                                    <div class="list-product-details">
                                                        <p>Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida
                                                            et mattis vulputate, tristique ut lectus. Sed et lorem nunc.
                                                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices
                                                            posuere cubilia Curae; Aenean eleifend laoreet congue. Vivamus
                                                            adipiscing nisl ut dolor dignissim semper. Nul
                                                            <a href="single-product.html">Learn More</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-list-product row">
                                            <div class="col-md-4">
                                                <div class="list-product-img">
                                                    <a href="single-product.html">
                                                        <img src="client_views/img/product/4.png" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="list-product-info">
                                                    <a href="single-product.html" class="list-product-name"> Cras neque
                                                        metus</a>
                                                    <div class="price-rating">
                                                        <span class="old-price">$700.00</span>
                                                        <span>$800.00</span>
                                                        <div class="ratings">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                            <a href="#" class="review">1 Review(s)</a>
                                                            <a href="#" class="add-review">Add Your Review</a>
                                                        </div>
                                                    </div>
                                                    <div class="list-product-details">
                                                        <p>Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida
                                                            et mattis vulputate, tristique ut lectus. Sed et lorem nunc.
                                                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices
                                                            posuere cubilia Curae; Aenean eleifend laoreet congue. Vivamus
                                                            adipiscing nisl ut dolor dignissim semper. Nul
                                                            <a href="single-product.html">Learn More</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="single-list-product row">
                                            <div class="col-md-4">
                                                <div class="list-product-img">
                                                    <a href="single-product.html">
                                                        <img src="client_views/img/product/5.png" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="list-product-info">
                                                    <a href="single-product.html" class="list-product-name"> Cras neque
                                                        metus</a>
                                                    <div class="price-rating">
                                                        <span class="old-price">$700.00</span>
                                                        <span>$800.00</span>
                                                        <div class="ratings">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                            <a href="#" class="review">1 Review(s)</a>
                                                            <a href="#" class="add-review">Add Your Review</a>
                                                        </div>
                                                    </div>
                                                    <div class="list-product-details">
                                                        <p>Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida
                                                            et mattis vulputate, tristique ut lectus. Sed et lorem nunc.
                                                            Vestibulum ante ipsum primis in faucibus orci luctus et ultrices
                                                            posuere cubilia Curae; Aenean eleifend laoreet congue. Vivamus
                                                            adipiscing nisl ut dolor dignissim semper. Nul
                                                            <a href="single-product.html">Learn More</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="toolbar-bottom">
                                <ul>
                                    <li><span>Pages:</span></li>
                                    <li class="current"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#"> <img src="client_views/img/product/pager_arrow_right.gif"
                                                alt=""> </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product main items area end -->


@endsection

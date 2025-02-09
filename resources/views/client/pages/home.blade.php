@extends('client.layouts.app')
@section('title', 'trang chủ')
@section('content')


<!-- @include('client.layouts.partials.menu_header') -->

    <div class="mainmenu-area product-items">
  @include('client.layouts.partials.menu_header1')

@include('client.layouts.slider.slider')

<!-- slider area end -->
<!-- banner area start -->
@include('client.layouts.banner.banner')
<!-- banner area end -->
<!-- products area start -->
<div class="products-area">
    <div class="container">
        <div class="products">
            <div class="row">
                <div class="col-lg-3">
                    <div class="product-menu">
                        <div class="menu-title">
                            <h2>Best seller <strong>Products</strong></h2>
                        </div>
                        <div class="side-menu">
                             <!-- Nav tabs -->
                            <ul class="nav tab-navigation" role="tablist">
                                <li role="presentation">
                                    <a class="active" href="#tab1" aria-controls="tab1" role="tab" data-bs-toggle="tab">Women</a>
                                </li>
                                <li role="presentation">
                                    <a href="#tab2" aria-controls="tab2" role="tab" data-bs-toggle="tab">men</a>
                                </li>
                                <li role="presentation">
                                    <a href="#tab3" aria-controls="tab3" role="tab" data-bs-toggle="tab">Footwear</a>
                                </li>
                                <li role="presentation">
                                    <a href="#tab4" aria-controls="tab4" role="tab" data-bs-toggle="tab">Jewelry</a>
                                </li>
                                <li role="presentation">
                                    <a href="#tab5" aria-controls="tab5" role="tab" data-bs-toggle="tab">Accessories</a>
                                </li>
                                <li role="presentation">
                                    <a href="#tab6" aria-controls="tab6" role="tab" data-bs-toggle="tab">Dresses</a>
                                </li>
                                <li role="presentation">
                                    <a href="#tab7" aria-controls="tab7" role="tab" data-bs-toggle="tab">shoes</a>
                                </li>
                                <li role="presentation">
                                    <a href="#tab8" aria-controls="tab8" role="tab" data-bs-toggle="tab">Handbags</a>
                                </li>
                                <li><img src="client_views/img/banner/banner-5.jpg" alt=""></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="tab1">
                                <div class="product-slider carousel-margin">
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/1.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/2.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/1.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/2.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/3.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/4.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$170.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/9.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/10.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/5.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/6.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/11.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/12.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/21.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/22.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/3.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/16.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/19.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/20.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/13.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/14.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/25.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/26.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/18.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/2.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/15.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/16.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/17.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/18.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab2">
                                <div class="product-slider carousel-margin">
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/5.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/6.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/11.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/12.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/21.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/22.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$170.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/3.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/15.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/19.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/20.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/13.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/14.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/25.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/26.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/3.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/18.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/15.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/9.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/17.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/18.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/25.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/26.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/18.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/2.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab3">
                                <div class="product-slider carousel-margin">
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/25.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/26.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/23.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/24.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/22.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/21.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$170.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/18.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/19.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/17.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/18.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/15.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/16.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/13.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/14.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/11.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/12.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/9.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/10.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/7.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/8.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/5.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/6.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab4">
                                <div class="product-slider carousel-margin">
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/3.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/4.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/2.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/1.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/5.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/12.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$170.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/3.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/10.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/1.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/8.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/25.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/12.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/23.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/13.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/21.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/11.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/19.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/9.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab5">
                                <div class="product-slider carousel-margin">
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/17.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/8.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/15.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/7.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/13.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/2.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$170.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/12.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/22.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/19.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/20.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/21.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/14.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/23.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/16.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/14.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/12.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/11.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/19.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab6">
                                <div class="product-slider carousel-margin">
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/12.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/6.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/18.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/21.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/19.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/13.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$170.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/23.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/25.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/25.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/20.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/10.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/13.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/20.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/12.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$170.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/7.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/15.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab7">
                                <div class="product-slider carousel-margin">
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/5.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/6.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/11.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/12.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/21.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/22.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$170.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/3.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/15.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/19.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/20.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/13.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/14.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/21.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/22.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$170.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/3.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/15.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/19.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/20.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/13.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/14.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab8">
                                <div class="product-slider carousel-margin">
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/11.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/12.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/11.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/12.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/21.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/22.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$170.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/3.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/15.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/19.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/20.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
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
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/13.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/14.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/21.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/22.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$170.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="client_views/img/product/3.png" alt="" class="primary-img">
                                                    <img src="client_views/img/product/15.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>$800.00</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
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
    </div>
</div>
<!-- products area end -->
<!-- feature products area start -->
@include('client.layouts.product.product_feature')
<!-- feature products area end -->
<!-- another banner area start -->
@include('client.layouts.banner.banner1')
<!-- another banner area end -->
<!-- new products area start -->
@include('client.layouts.product.product_new')
<!-- new products area end -->
<!-- testimonial area start -->
<div class="testimonial-area">
    <div class="container">
        <div class="row">
            <div class="testimonial-slider">
                <div class="single-testimonial">
                    <div class="spech">
                        <a href="#">“ Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat ”</a>
                    </div>
                    <div class="avater">
                        <img src="client_views/img/testimonial/1.jpg" alt="">
                    </div>
                    <div class="post-by">
                        <span>Salim Rana</span>
                    </div>
                </div>
                <div class="single-testimonial">
                    <div class="spech">
                        <a href="#">“ Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat ”</a>
                    </div>
                    <div class="avater">
                        <img src="client_views/img/testimonial/2.jpg" alt="">
                    </div>
                    <div class="post-by">
                        <span>Hridoy Roy</span>
                    </div>
                </div>
                <div class="single-testimonial">
                    <div class="spech">
                        <a href="#">“ Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat ”</a>
                    </div>
                    <div class="avater">
                        <img src="client_views/img/testimonial/3.jpg" alt="">
                    </div>
                    <div class="post-by">
                        <span>themesplaza</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- testimonial area end -->
<!-- blog area start -->
@include('client.layouts.blog.blog')
<!-- blog area end -->
<!-- newsleter area start -->
@include('client.components.newsletter')
@endsection

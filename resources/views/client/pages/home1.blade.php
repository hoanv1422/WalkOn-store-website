@extends('client.layouts.app')
@section('title', 'trang chủ')
@section('content')

@include('client.layouts.partials.menu_header')
<div class="mainmenu-area home2 bg-color-tr product-items">
 @include('client.layouts.partials.menu_header1')
@include('client.layouts.slider.slider1')
<!-- slider area end -->
<!-- service area start -->
<div class="service-area">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="single-service">
                    <div class="sirvice-img">
                        <img src="client_views/img/service/icon-1.png" alt="">
                    </div>
                    <div class="service-info">
                        <h3>FREE SHIPPING</h3>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-service">
                    <div class="sirvice-img">
                        <img src="client_views/img/service/icon-1.png" alt="">
                    </div>
                    <div class="service-info">
                        <h3>FREE SHIPPING</h3>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-service">
                    <div class="sirvice-img">
                        <img src="client_views/img/service/icon-1.png" alt="">
                    </div>
                    <div class="service-info">
                        <h3>FREE SHIPPING</h3>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- service area end -->
<!-- sell area start -->
<div class="sell-area home2">
    <div class="sell-heading">
        <h2>Best seller</h2>
        <p>Subcribe to the Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat</p>
    </div>
    <div class="sell-slider">
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
            <div class="actions">
                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                <ul class="add-to-link">
                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                </ul>
            </div>
            <div class="product-price">
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
            </div>
        </div>
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
            <div class="actions">
                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                <ul class="add-to-link">
                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                </ul>
            </div>
            <div class="product-price">
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
            </div>
        </div>
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
            <div class="actions">
                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                <ul class="add-to-link">
                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                </ul>
            </div>
            <div class="product-price">
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
            </div>
        </div>
        <div class="single-product">
            <div class="level-pro-new">
                <span>new</span>
            </div>
            <div class="product-img">
                <a href="single-product.html">
                    <img src="client_views/img/product/7.png" alt="" class="primary-img">
                    <img src="client_views/img/product/8.png" alt="" class="secondary-img">
                </a>
            </div>
            <div class="actions">
                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                <ul class="add-to-link">
                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                </ul>
            </div>
            <div class="product-price">
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
            </div>
        </div>
        <div class="single-product">
            <div class="level-pro-new">
                <span>new</span>
            </div>
            <div class="product-img">
                <a href="single-product.html">
                    <img src="client_views/img/product/9.png" alt="" class="primary-img">
                    <img src="client_views/img/product/10.png" alt="" class="secondary-img">
                </a>
            </div>
            <div class="actions">
                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                <ul class="add-to-link">
                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                </ul>
            </div>
            <div class="product-price">
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
            </div>
        </div>
        <div class="single-product">
            <div class="level-pro-new">
                <span>new</span>
            </div>
            <div class="product-img">
                <a href="single-product.html">
                    <img src="client_views/img/product/11.png" alt="" class="primary-img">
                    <img src="client_views/img/product/12.png" alt="" class="secondary-img">
                </a>
            </div>
            <div class="actions">
                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                <ul class="add-to-link">
                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                </ul>
            </div>
            <div class="product-price">
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
            </div>
        </div>
        <div class="single-product">
            <div class="level-pro-new">
                <span>new</span>
            </div>
            <div class="product-img">
                <a href="single-product.html">
                    <img src="img/product/13.png" alt="" class="primary-img">
                    <img src="client_views/img/product/14.png" alt="" class="secondary-img">
                </a>
            </div>
            <div class="actions">
                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                <ul class="add-to-link">
                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                </ul>
            </div>
            <div class="product-price">
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
            </div>
        </div>
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
            <div class="actions">
                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                <ul class="add-to-link">
                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                </ul>
            </div>
            <div class="product-price">
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
            </div>
        </div>
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
            <div class="actions">
                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                <ul class="add-to-link">
                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                </ul>
            </div>
            <div class="product-price">
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
            </div>
        </div>
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
            <div class="actions">
                <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                <ul class="add-to-link">
                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                </ul>
            </div>
            <div class="product-price">
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
            </div>
        </div>
    </div>
</div>
<!-- sell area end -->
<!-- feature products area start -->
@include('client.layouts.product.product_feature1')
<!-- feature products area end -->
<!-- sell off product area start -->
<div class="sell-off-product home2">
    <div class="product-title">
        <h2>sale off</h2>
    </div>
    <div class="container-fluid">
        <div class="sell-off-slider">
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
                <div class="actions">
                    <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                    <ul class="add-to-link">
                        <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                        <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                        <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                    </ul>
                </div>
                <div class="product-price">
                    <div class="product-name">
                        <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                    </div>
                    <div class="price-rating">
                        <div class="ratings">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div>
                        <span>$170.00</span>
                    </div>
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
                <div class="actions">
                    <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                    <ul class="add-to-link">
                        <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                        <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                        <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                    </ul>
                </div>
                <div class="product-price">
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
                <div class="actions">
                    <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                    <ul class="add-to-link">
                        <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                        <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                        <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                    </ul>
                </div>
                <div class="product-price">
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
                </div>
            </div>
            <div class="single-product">
                <div class="level-pro-sale">
                    <span>sale</span>
                </div>
                <div class="product-img">
                    <a href="single-product.html">
                        <img src="client_views/img/product/17.png" alt="" class="primary-img">
                        <img src="client_views/img/product/18.png" alt="" class="secondary-img">
                    </a>
                </div>
                <div class="actions">
                    <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                    <ul class="add-to-link">
                        <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                        <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                        <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                    </ul>
                </div>
                <div class="product-price">
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
                </div>
            </div>
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
                <div class="actions">
                    <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                    <ul class="add-to-link">
                        <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                        <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                        <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                    </ul>
                </div>
                <div class="product-price">
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
                </div>
            </div>
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
                <div class="actions">
                    <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                    <ul class="add-to-link">
                        <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                        <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                        <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                    </ul>
                </div>
                <div class="product-price">
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
                </div>
            </div>
            <div class="single-product">
                <div class="level-pro-sale">
                    <span>sale</span>
                </div>
                <div class="product-img">
                    <a href="single-product.html">
                        <img src="client_views/img/product/24.png" alt="" class="primary-img">
                        <img src="client_views/img/product/25.png" alt="" class="secondary-img">
                    </a>
                </div>
                <div class="actions">
                    <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                    <ul class="add-to-link">
                        <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                        <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                        <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                    </ul>
                </div>
                <div class="product-price">
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
                <div class="actions">
                    <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                    <ul class="add-to-link">
                        <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                        <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                        <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                    </ul>
                </div>
                <div class="product-price">
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
                </div>
            </div>
        </div>
    </div>
</div>
<!-- sell off product area end -->
<!-- new products area start -->
@include('client.layouts.product.product_new')
<!-- new products area end -->
<!-- another banner area start -->
@include('client.layouts.banner.banner1')
<!-- another banner area end -->
<!-- blog area start -->
@include('client.layouts.blog.blog1')
<!-- blog area end -->
<!-- newsleter area start -->
@include('client.components.newsletter')
<!-- newsleter area end -->
@endsection
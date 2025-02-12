@extends('client.layouts.app')
@section('title', ' sản phẩm')
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
                <!-- product main items area end -->

                <div class="col-lg-9">
                    <div class="product-bar">
                        <ul class="nav product-navigation justify-content-center" role="tablist">
                            <li role="presentation" class="gird">
                                <a class="active" href="#gird" aria-controls="gird" role="tab" data-bs-toggle="tab">
                                    <span>
                                        <img class="primary" src="client_views/img/product/grid-primary.png" alt="">
                                        <img class="secondary" src="client_views/img/product/grid-secondary.png"
                                            alt="">
                                    </span>
                                    Gird
                                </a>
                            </li>
                            <li role="presentation" class="list">
                                <a href="#list" aria-controls="list" role="tab" data-bs-toggle="tab">
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
                    {{-- Sản phẩm --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product-content">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active fade show home2" id="gird">
                                        <div class="row">
                                            @foreach ($products as $product)
                                                <div class="col-lg-4 col-md-6">
                                                    <div class="single-product">
                                                        <div class="level-pro-new">
                                                            <span>new</span>
                                                        </div>
                                                        <div class="product-img">
                                                            <a href="single-product.html">
                                                                {{-- Ảnh Demo --}}
                                                                <img src="client_views/img/product/25.png" alt=""
                                                                    class="primary-img">
                                                                <img src="client_views/img/product/26.png" alt=""
                                                                    class="secondary-img">

                                                                <img src="{{ $product->image }}" alt=""
                                                                    class="primary-img">
                                                                <img src="{{ $product->image }}" alt=""
                                                                    class="secondary-img">
                                                            </a>
                                                        </div>
                                                        <div class="actions">
                                                            <form action="{{ route('cart.add') }}" method="POST"
                                                                style="display: inline;">
                                                                @csrf
                                                                <input type="hidden" name="product_id"
                                                                    value="{{ $product->id }}">
                                                                <button type="submit" class="cart-btn"
                                                                    title="Add to cart">add to cart</button>
                                                            </form>
                                                            <ul class="add-to-link">
                                                                <li><a class="modal-view" data-target="#productModal"
                                                                        data-bs-toggle="modal" href="#"> <i
                                                                            class="fa fa-search"></i></a></li>
                                                                <li><a href="#"> <i class="fa fa-heart-o"></i></a>
                                                                </li>
                                                                <li><a href="#"> <i class="fa fa-refresh"></i></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="product-price">
                                                            <div class="product-name">
                                                                <a href="single-product.html"
                                                                    title="{{ $product->name }}">{{ $product->name }}</a>
                                                            </div>
                                                            <div class="price-rating">
                                                                <span>{{ number_format($product->price, 0, ',', '.') }}
                                                                    VND</span>
                                                                <div class="ratings">
                                                                    @for ($i = 0; $i < 5; $i++)
                                                                        @if ($i < $product->average_rating)
                                                                            <i class="fa fa-star"></i>
                                                                        @else
                                                                            <i class="fa fa-star-half-o"></i>
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade home2 active show" id="list">
                                        <div class="product-catagory">
                                            @foreach ($products as $product)
                                                <div class="single-list-product row">
                                                    <div class="col-md-4">
                                                        <div class="list-product-img">
                                                            <a href="single-product.html">
                                                                <img src="{{ $product->image }}" alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="list-product-info">
                                                            <a href="single-product.html"
                                                                class="list-product-name">{{ $product->name }}</a>
                                                            <div class="price-rating">
                                                                <span
                                                                    class="old-price">{{ number_format($product->price_sale, 0, ',', '.') }}
                                                                    VND</span>
                                                                <span>{{ number_format($product->price, 0, ',', '.') }}
                                                                    VND</span>
                                                                <div class="ratings">
                                                                    @for ($i = 0; $i < 5; $i++)
                                                                        @if ($i < $product->average_rating)
                                                                            <i class="fa fa-star"></i>
                                                                        @else
                                                                            <i class="fa fa-star-half-o"></i>
                                                                        @endif
                                                                    @endfor
                                                                    <a href="#"
                                                                        class="review">{{ $product->reviews_count }}
                                                                        Review(s)</a>
                                                                    <a href="#" class="add-review">Add Your
                                                                        Review</a>
                                                                </div>
                                                            </div>
                                                            <div class="list-product-details">
                                                                <p>{{ $product->description }}
                                                                    <a href="single-product.html">Learn More</a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
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
    </div>
@endsection

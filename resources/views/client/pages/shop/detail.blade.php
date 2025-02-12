@extends('client.layouts.app')
@section('title', 'danh sách sản phẩm')
@section('content')


    @include('client.layouts.partials.menu_header')
    <div class="mainmenu-area home2 product-items">
        @include('client.layouts.partials.menu_header1')
        <!-- header area end -->
        <!-- single product area start -->
        <div class="Single-product-location home2">
            <div class="container">
                @include('client.components.breadcrumb')
            </div>
        </div>
        <!-- single product area end -->
        <!-- single product details start -->
        <div class="single-product-details">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="single-product-img tab-content">
                            <div class="single-pro-main-image tab-pane active" id="pro-large-img-1">
                                <a href="#"><img class="optima_zoom" src="client_views/img/product/7.png"
                                        data-zoom-image="client_views/img/product/7.png" alt="optima" /></a>
                            </div>
                            <div class="single-pro-main-image tab-pane" id="pro-large-img-2">
                                <a href="#"><img class="optima_zoom" src="client_views/img/product/2.png"
                                        data-zoom-image="client_views/img/product/2.png" alt="optima" /></a>
                            </div>
                            <div class="single-pro-main-image tab-pane" id="pro-large-img-3">
                                <a href="#"><img class="optima_zoom" src="client_views/img/product/8.png"
                                        data-zoom-image="client_views/img/product/8.png" alt="optima" /></a>
                            </div>
                            <div class="single-pro-main-image tab-pane" id="pro-large-img-4">
                                <a href="#"><img class="optima_zoom" src="client_views/img/product/1.png"
                                        data-zoom-image="client_views/img/product/1.png" alt="optima" /></a>
                            </div>
                            <div class="single-pro-main-image tab-pane" id="pro-large-img-5">
                                <a href="#"><img class="optima_zoom" src="client_views/img/product/9.png"
                                        data-zoom-image="client_views/img/product/9.png" alt="optima" /></a>
                            </div>
                        </div>
                        <div class="nav product-page-slider">
                            @foreach ($product->galleries as $key => $gallery)
                                <div class="single-product-slider">
                                    <a class="{{ $key === 0 ? 'active' : '' }}" href="#pro-large-img-{{ $key + 1 }}"
                                        data-bs-toggle="tab">
                                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="Product Image">
                                    </a>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <div class="single-product-details">
                            <!-- Tên sản phẩm -->
                            <a href="#" class="product-name">{{ $product->name }}</a>

                            <!-- Đánh giá sản phẩm -->
                            <div class="list-product-info">
                                <div class="price-rating">
                                    <div class="ratings">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= floor($product->average_rating))
                                                <i class="fa fa-star"></i> <!-- Sao đầy -->
                                            @elseif($i - 0.5 == $product->average_rating)
                                                <i class="fa fa-star-half-o"></i> <!-- Sao nửa -->
                                            @else
                                                <i class="fa fa-star-o"></i>
                                            @endif
                                        @endfor
                                        <a href="#" class="review">{{ $product->sold_quantity }} Review(s)</a>
                                        <a href="#" class="add-review">Add Your Review</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Tình trạng sản phẩm -->
                            <div class="avalable">
                                <p>Availability:
                                    @if ($product->quantity > 0)
                                        <span> In stock</span>
                                    @else
                                        <span style="color: red;"> Out of stock</span>
                                    @endif
                                </p>
                            </div>

                            <!-- Giá sản phẩm -->
                            <div class="item-price">
                                <span
                                    id="product-price">{{ number_format($product->price_sale ?? $product->price, 0, ',', '.') }}
                                    VNĐ</span>
                            </div>


                            <!-- Mô tả sản phẩm -->
                            <div class="single-product-info">
                                <p>{{ $product->description }}</p>
                            </div>

                            <!-- Chia sẻ sản phẩm -->
                            <div class="share">
                                <img src="{{ asset('client_views/img/product/share.png') }}" alt="">
                            </div>

                            <!-- Các thao tác với sản phẩm -->
                            <div class="action">
                                <ul class="add-to-links">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-refresh"></i></a></li>
                                    <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                                </ul>
                            </div>

                            <!-- Lựa chọn màu sắc -->
                            <div class="select-catagory">
                                <div class="color-select">
                                    <label class="required"><em>*</em> Color</label>
                                    <div class="input-box">
                                        <select id="select-1">
                                            <option value="">-- Please Select --</option>
                                            @foreach ($product->colors as $color)
                                                <option value="{{ $color->id }}">{{ ucfirst($color->color) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Lựa chọn kích thước -->
                                <div class="size-select">
                                    <label class="required"><em>*</em> Size</label>
                                    <div class="input-box">
                                        <select id="select-2">
                                            <option value="">-- Please Select --</option>
                                            @foreach ($product->sizes as $size)
                                                <option value="{{ $size->id }}">{{ strtoupper($size->size) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <!-- Thêm vào giỏ hàng -->
                            <div class="cart-item">
                                <div class="price-box">
                                    <span>{{ number_format($product->price_sale ?? $product->price, 0, ',', '.') }}
                                        VNĐ</span>
                                </div>
                                <div class="single-cart">
                                    <div class="cart-plus-minus">
                                        <label>Qty: </label>
                                        <input class="cart-plus-minus-box" type="number" name="qtybutton" value="1"
                                            min="1">
                                    </div>
                                    <button class="cart-btn">Add to cart</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- single product details end -->
        <!-- single product tab start -->
        <div class="single-product-tab-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="single-product-tab">
                            <ul class="nav single-product-tab-navigation" role="tablist">
                                <li role="presentation">
                                    <a class="active" href="#tab1" aria-controls="tab1" role="tab"
                                        data-bs-toggle="tab">Product Description</a>
                                </li>
                                <li role="presentation">
                                    <a href="#tab2" aria-controls="tab2" role="tab"
                                        data-bs-toggle="tab">reviews</a>
                                </li>
                                <li role="presentation">
                                    <a href="#tab3" aria-controls="tab3" role="tab" data-bs-toggle="tab">product
                                        tag</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content single-product-page">
                                <div role="tabpanel" class="tab-pane fade show active" id="tab1">
                                    <div class="single-p-tab-content">
                                        <p>Nunc facilisis sagittis ullamcorper. Proin lectus ipsum, gravida et mattis
                                            vulputate, tristique ut lectus. Sed et lorem nunc. Vestibulum ante ipsum primis
                                            in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean eleifend
                                            laoreet congue. Vivamus adipiscing nisl ut dolor dignissim semper. Nulla luctus
                                            malesuada tincidunt. Class aptent taciti sociosqu ad litora torquent per conubia
                                            nostra, per inceptos himenaeos. Integer enim purus, posuere at ultricies eu,
                                            placerat a felis. Suspendisse aliquet urna pretium eros convallis interdum.
                                            Quisque in arcu id dui vulputate mollis eget non arcu. Aenean et nulla purus.
                                            Mauris vel tellus non nunc mattis lobortis. </p>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab2">
                                    <div class="single-p-tab-content">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="product-review">
                                                    <p> <a href="#"> plaza</a> <span>Review by</span> plaza </p>
                                                    <div class="product-rating-info">
                                                        <p>value</p>
                                                        <div class="ratings">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="product-rating-info">
                                                        <p>Quality</p>
                                                        <div class="ratings">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="product-rating-info">
                                                        <p>Price</p>
                                                        <div class="ratings">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-half-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="review-date">
                                                        <p>plaza <em> (Posted on 8/27/2015)</em></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="rate-product hidden-xs">
                                                    <div class="rate-product-heading">
                                                        <h3>You're reviewing: Fusce aliquam</h3>
                                                        <h3>How do you rate this product? <em>*</em></h3>
                                                    </div>
                                                    <form action="#">
                                                        <table class="product-review-table">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>1 star</th>
                                                                    <th>2 star</th>
                                                                    <th>3 star</th>
                                                                    <th>4 star</th>
                                                                    <th>5 star</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <th>Price</th>
                                                                    <td> <input type="radio" class="radio"
                                                                            name="ratings[1]"> </td>
                                                                    <td> <input type="radio" class="radio"
                                                                            name="ratings[1]"> </td>
                                                                    <td> <input type="radio" class="radio"
                                                                            name="ratings[1]"> </td>
                                                                    <td> <input type="radio" class="radio"
                                                                            name="ratings[1]"> </td>
                                                                    <td> <input type="radio" class="radio"
                                                                            name="ratings[1]"> </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Value</th>
                                                                    <td> <input type="radio" class="radio"
                                                                            name="ratings[2]"> </td>
                                                                    <td> <input type="radio" class="radio"
                                                                            name="ratings[2]"> </td>
                                                                    <td> <input type="radio" class="radio"
                                                                            name="ratings[2]"> </td>
                                                                    <td> <input type="radio" class="radio"
                                                                            name="ratings[2]"> </td>
                                                                    <td> <input type="radio" class="radio"
                                                                            name="ratings[2]"> </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Quality</th>
                                                                    <td> <input type="radio" class="radio"
                                                                            name="ratings[3]"> </td>
                                                                    <td> <input type="radio" class="radio"
                                                                            name="ratings[3]"> </td>
                                                                    <td> <input type="radio" class="radio"
                                                                            name="ratings[3]"> </td>
                                                                    <td> <input type="radio" class="radio"
                                                                            name="ratings[3]"> </td>
                                                                    <td> <input type="radio" class="radio"
                                                                            name="ratings[3]"> </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <ul class="form-list">
                                                            <li>
                                                                <label> nickname <em>*</em> </label>
                                                                <input type="text">
                                                            </li>
                                                            <li>
                                                                <label> Summary of Your Review <em>*</em> </label>
                                                                <input type="text">
                                                            </li>
                                                            <li>
                                                                <label> Review <em>*</em> </label>
                                                                <textarea cols="3" rows="5"></textarea>
                                                            </li>
                                                        </ul>
                                                        <button type="submit"> submit review</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab3">
                                    <div class="single-p-tab-content">
                                        <div class="add-tab-title">
                                            <p> add your tag </p>
                                        </div>
                                        <div class="add-tag">
                                            <form action="#">
                                                <input type="text">
                                                <button type="submit">add tags</button>
                                            </form>
                                        </div>
                                        <p class="tag-rules">Use spaces to separate tags. Use single quotes (') for
                                            phrases.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single product tab end -->
        <!-- upsell product area start-->
        @include('client.layouts.product.product_upsell')
        <!-- upsell product area end-->
        <!-- related product area start-->
        @include('client.layouts.product.product_related')
        <!-- related product area end-->
        <!-- footer top area start -->
    @endsection
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let basePrice = {{ $product->price_sale ?? $product->price }};
            let variants = @json($product->variants);

            function updatePrice() {
                let selectedColor = document.getElementById("select-color").value;
                let selectedSize = document.getElementById("select-size").value;
                let extraPrice = 0;

                variants.forEach(variant => {
                    if (variant.color_id == selectedColor && variant.size_id == selectedSize) {
                        extraPrice = parseFloat(variant.price);
                    }
                });

                document.getElementById("product-price").innerText = extraPrice.toLocaleString("vi-VN") + " VNĐ";
            }

            document.getElementById("select-color").addEventListener("change", updatePrice);
            document.getElementById("select-size").addEventListener("change", updatePrice);
        });
    </script>

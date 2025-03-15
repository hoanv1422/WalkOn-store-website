php <!-- related product area start-->
@if ($relatedProducts->isNotEmpty())
    <div class="features-product-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-title">
                        <h2>Sản phẩm liên quan</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="feature-product-slider carousel-margin">
                    @foreach ($relatedProducts as $related)
                        <div class="col">
                            <div class="single-product">
                                <!-- Nhãn sản phẩm  -->
                                <div class="level-pro-new">
                                    <span>new</span>
                                </div>
                                <div class="product-img">
                                    <a href="{{ route('detail.index', $related->slug) }}">

                                        <img src="{{ Storage::url($related->image) }}" alt="{{ $related->name }}"
                                            class="primary-img">

                                        <img src="{{ Storage::url($related->secondary_image ?? $related->image) }}"
                                            alt="{{ $related->name }}" class="secondary-img">
                                    </a>
                                </div>
                                <div class="product-name">
                                    <a href="{{ route('detail.index', $related->slug) }}" title="{{ $related->name }}">
                                        {{ $related->name }}
                                    </a>
                                </div>
                                <div class="price-rating">
                                    <span class="old-price" style="color:red">
                                        {{ number_format($related->price, 0, ',', '.') }} VND
                                    </span>
                                    <span>
                                        {{ number_format($related->price_sale, 0, ',', '.') }} VND
                                    </span>
                                    <div class="ratings">
                                        <span>{{ $related->average_rating }}</span> <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <div class="actions">
                                    <button type="submit" class="cart-btn" title="Add to cart">thêm vào giỏ
                                        hàng</button>
                                    <ul class="add-to-link">
                                        <li>
                                            <a class="modal-view" data-target="#productModal" data-bs-toggle="modal"
                                                href="#">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-heart-o"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-refresh"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
=======

>>>>>>> 96e385d48da46bf74945da01bb8455bfab64fb5f
@endif
<!-- related product area end-->

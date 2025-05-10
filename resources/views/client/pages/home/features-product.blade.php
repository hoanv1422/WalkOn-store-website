<!-- feature products area start -->
<div class="features-product-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>ĐANG GIẢM GIÁ</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="feature-product-slider carousel-margin">
                @foreach ($topDiscountedProducts as $topDiscountedProduct)
                    <div class="col">
                        <div class="single-product">
                            <div class="level-pro-sale"><span>sale</span></div>
                            <div class="product-img">
                                <a href="{{ route('detail.index', $topDiscountedProduct->slug) }}">
                                    @if (Storage::exists($topDiscountedProduct->image))
                                        <img src="{{ Storage::url($topDiscountedProduct->image) }}" alt="{{ $topDiscountedProduct->name }}"
                                            class="primary-img">
                                    @else
                                        <img src="img/default-image.jpg" alt="{{ $topDiscountedProduct->name }}" class="primary-img">
                                    @endif
                                    @if ($topDiscountedProduct->variants->isNotEmpty() && Storage::exists($topDiscountedProduct->variants->first()->image))
                                        <img src="{{ Storage::url($topDiscountedProduct->variants->first()->image) }}"
                                            alt="{{ $topDiscountedProduct->name }}" class="secondary-img">
                                    @else
                                        <img src="img/default-image.jpg" alt="{{ $topDiscountedProduct->name }}"
                                            class="secondary-img">
                                    @endif
                                </a>
                            </div>
                            <div class="product-name">
                                <a href="{{ route('detail.index', $topDiscountedProduct->slug) }}"
                                    title="Fusce aliquam">{{ $topDiscountedProduct->name }}</a>
                            </div>
                            <div class="price-rating">
                                @if ($topDiscountedProduct->price_sale && $topDiscountedProduct->price_sale <= $topDiscountedProduct->price)
                                    <span class="old-price" style="color:red">{{ number_format($topDiscountedProduct->price) }}
                                        VND</span>
                                    <span>{{ number_format($topDiscountedProduct->price_sale) }}VND</span>
                                @else
                                    <span>{{ number_format($topDiscountedProduct->price) }}VND</span>
                                @endif
                                <div class="ratings">
                                    <span>{{ $topDiscountedProduct->average_rating }}</span> <i class="fa fa-star"></i>
                                </div>
                            </div>
                            <div class="actions d-flex justify-content-between">
                                <form class="add-to-cart-form" action="{{ route('get.product') }}" method="get">
                                    <input type="hidden" name="idProduct" value="{{ $topDiscountedProduct->id }}">
                                    <button type="submit" class="cart-btn" title="Thêm vào giỏ hàng"
                                        data-bs-toggle="modal" data-bs-target="#cartModal">
                                        Thêm vào giỏ hàng
                                    </button>
                                </form>
                                <ul class="add-to-link">
                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal"
                                            href="#"> <i class="fa fa-search"></i></a></li>
                                    <li>
                                        <a href="#" class="wishlist-action" data-id="{{ $topDiscountedProduct->id }}">
                                            <i class="fa fa-heart-o"></i> <!-- Giữ nguyên icon, không đổi màu -->
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
<!-- feature products area end -->

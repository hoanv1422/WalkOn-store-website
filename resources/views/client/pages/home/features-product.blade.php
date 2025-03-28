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
                @foreach ($products as $product)
                    <div class="col">
                        <div class="single-product">
                            <div class="level-pro-new">
                                <span>new</span>
                            </div>
                            <div class="product-img">
                                <a href="{{ route('detail.index', $product->slug) }}">
                                    @if (Storage::exists($product->image))
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                            class="primary-img">
                                    @else
                                        <img src="img/default-image.jpg" alt="{{ $product->name }}" class="primary-img">
                                    @endif
                                    @if ($product->variants->isNotEmpty() && Storage::exists($product->variants->first()->image))
                                        <img src="{{ Storage::url($product->variants->first()->image) }}"
                                            alt="{{ $product->name }}" class="secondary-img">
                                    @else
                                        <img src="img/default-image.jpg" alt="{{ $product->name }}"
                                            class="secondary-img">
                                    @endif
                                </a>
                            </div>
                            <div class="product-name">
                                <a href="{{ route('detail.index', $product->slug) }}"
                                    title="Fusce aliquam">{{ $product->name }}</a>
                            </div>
                            <div class="price-rating">
                                @if ($product->price_sale && $product->price_sale <= $product->price)
                                    <span class="old-price" style="color:red">{{ number_format($product->price) }}
                                        VND</span>
                                    <span>{{ number_format($product->price_sale) }}VND</span>
                                @else
                                    <span>{{ number_format($product->price) }}VND</span>
                                @endif
                                <div class="ratings">
                                    <span>{{ $product->average_rating }}</span> <i class="fa fa-star"></i>
                                </div>
                            </div>
                            <div class="actions">
                                <button type="submit" class="cart-btn" title="Add to cart">thêm vào giỏ hàng</button>
                                <ul class="add-to-link">
                                    <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal"
                                            href="#"> <i class="fa fa-search"></i></a></li>
                                    <li>
                                        <a href="#" class="wishlist-action" data-id="{{ $product->id }}">
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

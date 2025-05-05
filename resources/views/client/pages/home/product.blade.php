<!-- products area start -->



<div class="products-area">
    <div class="container">
        <div class="products">
            <div class="row">
                <div class="col-lg-3">
                    <div class="product-menu">
                        <div class="menu-title">
                            <h2>THƯƠNG HIỆU <strong>Nổi tiếng</strong></h2>
                        </div>
                        <div class="side-menu">
                            <!-- Nav tabs -->
                            <ul class="nav tab-navigation" role="tablist">
                                @foreach ($brands as $index => $brand)
                                    <li role="presentation">
                                        <a class="{{ $loop->first ? 'active' : '' }}" href="#tab{{ $index + 1 }}"
                                            aria-controls="tab{{ $index + 1 }}" role="tab" data-bs-toggle="tab">
                                            {{ $brand->name }}
                                        </a>
                                    </li>
                                @endforeach
                                {{-- <li role="presentation">
                                    <a href="#tab2" aria-controls="tab2" role="tab" data-bs-toggle="tab">men</a>
                                </li>
                                <li role="presentation">
                                    <a href="#tab3" aria-controls="tab3" role="tab"
                                        data-bs-toggle="tab">Footwear</a>
                                </li> --}}
                                
                                {{-- @foreach ($banners as $banner)
                                @if ($banner->position == 8) --}}
                                    
                                {{-- <li><img src="{{ asset('storage/' . $banner->image_url) }}" alt="banner8" width="262.5px" style="height: 280px"></li> --}}
                                {{-- @endif --}}
                            {{-- @endforeach --}}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <!-- Tab panes -->
                        @php
                            $tabIndex = 1;
                        @endphp
                        <div class="tab-content">
                            @foreach ($brands as $brand)
                                <div role="tabpanel" class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                    id="tab{{ $tabIndex }}">
                                    <div class="row">
                                        @foreach ($brand->products as $product)
                                            <div class="col-4">
                                                <div class="single-product">
                                                    @if ($product->is_sale)
                                                        <div class="level-pro-sale"><span>sale</span></div>
                                                    @elseif ($product->is_new)
                                                        <div class="level-pro-new"><span>new</span></div>
                                                    @elseif ($product->is_top_selling)
                                                        <div class="level-pro-hot"><span>hot</span></div>
                                                    @endif

                                                    <div class="product-img">
                                                        <a href="{{ route('detail.index', $product->slug) }}">
                                                            @if (Storage::exists($product->image))
                                                                <img src="{{ Storage::url($product->image) }}"
                                                                    alt="{{ $product->name }}" class="primary-img">
                                                            @else
                                                                <img src="img/default-image.jpg"
                                                                    alt="{{ $product->name }}" class="primary-img">
                                                            @endif
                                                            @if ($product->variants->isNotEmpty() && Storage::exists($product->variants->first()->image))
                                                                <img src="{{ Storage::url($product->variants->first()->image) }}"
                                                                    alt="{{ $product->name }}" class="secondary-img">
                                                            @else
                                                                <img src="img/default-image.jpg"
                                                                    alt="{{ $product->name }}" class="secondary-img">
                                                            @endif
                                                        </a>
                                                    </div>
                                                    <div class="product-name">
                                                        <a href="{{ route('detail.index', $product->slug) }}"
                                                            title="{{ $product->name }}">{{ $product->name }}</a>
                                                    </div>
                                                    <div class="price-rating">
                                                        @if ($product->price_sale && $product->price_sale <= $product->price)
                                                            <span
                                                                class="old-price">{{ number_format($product->price) }}
                                                                VND</span>
                                                            <span
                                                                style="color:red">{{ number_format($product->price_sale) }}VND</span>
                                                        @else
                                                            <span>{{ number_format($product->price) }}VND</span>
                                                        @endif

                                                        <div class="ratings">
                                                            <span>{{ $product->average_rating }}</span> <i
                                                                class="fa fa-star"></i>
                                                        </div>
                                                    </div>
                                                    <div class="actions d-flex justify-content-between">
                                                        <form class="add-to-cart-form"
                                                            action="{{ route('get.product') }}" method="get">
                                                            <input type="hidden" name="idProduct"
                                                                value="{{ $product->id }}">
                                                            <button type="submit" class="cart-btn"
                                                                title="Thêm vào giỏ hàng" data-bs-toggle="modal"
                                                                data-bs-target="#cartModal">
                                                                Thêm vào giỏ hàng
                                                            </button>
                                                        </form>
                                                        <ul class="add-to-link">
                                                            <li><a class="modal-view" title="Chi tiết sản phẩm"
                                                                    href="{{ route('detail.index', $product->slug) }}">
                                                                    <i class="fa fa-search"></i></a></li>
                                                            <li>
                                                                <a href="#" class="wishlist-action"
                                                                    title="Thêm vào danh sách yêu thích"
                                                                    data-id="{{ $product->id }}">
                                                                    <i class="fa fa-heart-o"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @php
                                    $tabIndex++;
                                @endphp
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

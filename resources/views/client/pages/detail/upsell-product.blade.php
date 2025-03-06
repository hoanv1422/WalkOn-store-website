<!-- upsell product area start-->
<div class="features-product-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Sản phẩm bán chạy</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="feature-product-slider carousel-margin">
                @foreach ($upSellProducts as $upSell)
                    <div class="col">
                        <div class="single-product">
                            <!-- Nhãn sản phẩm: hiển thị "hot" cho sản phẩm bán chạy -->
                            <div class="level-pro-new">
                                <span>hot</span>
                            </div>
                            <div class="product-img">
                                <a href="{{ route('detail.index', $upSell->slug) }}">
                                    <img src="{{ Storage::url($upSell->image) }}" alt="{{ $upSell->name }}" class="primary-img">
                                    <img src="{{ Storage::url($upSell->secondary_image ?? $upSell->image) }}" alt="{{ $upSell->name }}" class="secondary-img">
                                </a>
                            </div>
                            <div class="product-name">
                                <a href="{{ route('detail.index', $upSell->slug) }}" title="{{ $upSell->name }}">
                                    {{ $upSell->name }}
                                </a>
                            </div>
                            <div class="price-rating">
                                <span class="old-price" style="color:red">
                                    {{ number_format($upSell->price, 0, ',', '.') }} VND
                                </span>
                                <span>
                                    {{ number_format($upSell->price_sale, 0, ',', '.') }} VND
                                </span>
                                <div class="ratings">
                                    <span>{{ $upSell->average_rating }}</span> <i class="fa fa-star"></i>
                                </div>
                            </div>
                            <div class="actions">
                                <button type="submit" class="cart-btn" title="Thêm vào giỏ hàng">thêm vào giỏ hàng</button>
                                <ul class="add-to-link">
                                    <li>
                                        <a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#">
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


<!-- upsell product area end-->

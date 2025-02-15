@if ($relatedProducts->isNotEmpty())
    <div class="related-product home2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-title">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="related-slider">
                    @foreach ($relatedProducts as $related)
                        <div class="col-md-12">
                            <div class="single-product">
                                <div class="product-img">
                                    <a href="{{ route('product.detail', $related->slug) }}">
                                        <img src="{{ asset('storage/' .$related->image) }}" alt="" class="primary-img">
                                        <img src="{{ asset('storage/' .$related->image) }}" alt="" class="secondary-img">
                                    </a>
                                </div>
                                <div class="product-price">
                                    <div class="product-name">
                                        <a href="{{ route('product.detail', $related->slug) }}" 
                                           title="{{ $related->name }}">
                                           {{ $related->name }}
                                        </a>
                                    </div>
                                    <div class="price-rating">
                                        <span>{{ number_format($related->price, 0, ',', '.') }} VND</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif

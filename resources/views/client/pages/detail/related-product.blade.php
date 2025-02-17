<!-- related product area start-->
<<<<<<< HEAD
<div class="related-product home2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-title">
                    <h2>related products</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="related-slider">
                <div class="col-md-12">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="single-product.html">
                                <img src="img/product/25.png" alt="" class="primary-img">
                                <img src="img/product/26.png" alt="" class="secondary-img">
                            </a>
                        </div>
                        <div class="product-price">
                            <div class="product-name">
                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                            </div>
                            <div class="price-rating">
                                <span>$170.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="single-product.html">
                                <img src="img/product/23.png" alt="" class="primary-img">
                                <img src="img/product/24.png" alt="" class="secondary-img">
                            </a>
                        </div>
                        <div class="product-price">
                            <div class="product-name">
                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                            </div>
                            <div class="price-rating">
                                <span>$170.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="single-product.html">
                                <img src="img/product/21.png" alt="" class="primary-img">
                                <img src="img/product/22.png" alt="" class="secondary-img">
                            </a>
                        </div>
                        <div class="product-price">
                            <div class="product-name">
                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                            </div>
                            <div class="price-rating">
                                <span>$170.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="single-product.html">
                                <img src="img/product/19.png" alt="" class="primary-img">
                                <img src="img/product/20.png" alt="" class="secondary-img">
                            </a>
                        </div>
                        <div class="product-price">
                            <div class="product-name">
                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                            </div>
                            <div class="price-rating">
                                <span>$170.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="single-product.html">
                                <img src="img/product/17.png" alt="" class="primary-img">
                                <img src="img/product/18.png" alt="" class="secondary-img">
                            </a>
                        </div>
                        <div class="product-price">
                            <div class="product-name">
                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                            </div>
                            <div class="price-rating">
                                <span>$170.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="single-product.html">
                                <img src="img/product/15.png" alt="" class="primary-img">
                                <img src="img/product/16.png" alt="" class="secondary-img">
                            </a>
                        </div>
                        <div class="product-price">
                            <div class="product-name">
                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                            </div>
                            <div class="price-rating">
                                <span>$170.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="single-product.html">
                                <img src="img/product/13.png" alt="" class="primary-img">
                                <img src="img/product/14.png" alt="" class="secondary-img">
                            </a>
                        </div>
                        <div class="product-price">
                            <div class="product-name">
                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                            </div>
                            <div class="price-rating">
                                <span>$170.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="single-product.html">
                                <img src="img/product/11.png" alt="" class="primary-img">
                                <img src="img/product/12.png" alt="" class="secondary-img">
                            </a>
                        </div>
                        <div class="product-price">
                            <div class="product-name">
                                <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                            </div>
                            <div class="price-rating">
                                <span>$170.00</span>
                            </div>
                        </div>
                    </div>
=======
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
                                    <a href="{{ route('detail.index', $related->slug) }}">
                                        <img src="{{ asset('storage/app/' .$related->image) }}" alt="" class="primary-img">
                                        <img src="{{ asset('storage/app/' .$related->image) }}" alt="" class="secondary-img">
                                    </a>
                                </div>
                                <div class="product-price">
                                    <div class="product-name">
                                        <a href="{{ route('detail.index', $related->slug) }}" 
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
>>>>>>> hoa_dev
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
</div>
=======
@endif
>>>>>>> hoa_dev
<!-- related product area end-->

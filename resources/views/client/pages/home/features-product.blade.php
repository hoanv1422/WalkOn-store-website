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
                @foreach ($products as $product )
                    
                <div class="col">
                    <div class="single-product">
                        <div class="level-pro-new">
                            <span>new</span>
                        </div>
                        <div class="product-img">
                            <a href="{{route('detail.index', $product->slug)}}">
                                <img src="img/product/1.png" alt="" class="primary-img">
                                <img src="img/product/2.png" alt="" class="secondary-img">
                            </a>
                        </div>
                        <div class="product-name">
                            <a href="{{route('detail.index', $product->slug)}}" title="Fusce aliquam">{{$product->name}}</a>
                        </div>
                        <div class="price-rating">
                            <span class="old-price" style="color:red">{{$product->price}}</span>
                            <span >{{$product->price_sale}}</span>
                            <div class="ratings">
                                <span>{{$product->average_rating}}</span> <i class="fa fa-star"></i>
                                
                                
                            </div>
                        </div>
                        <div class="actions">
                            <button type="submit" class="cart-btn" title="Add to cart">thêm vào giỏ hàng</button>
                            <ul class="add-to-link">
                                <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal"
                                        href="#"> <i class="fa fa-search"></i></a></li>
                                <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach

                {{-- <div class="col">
                    <div class="single-product">
                        <div class="level-pro-sale">
                            <span>sale</span>
                        </div>
                        <div class="product-img">
                            <a href="single-product.html">
                                <img src="img/product/7.png" alt="" class="primary-img">
                                <img src="img/product/8.png" alt="" class="secondary-img">
                            </a>
                        </div>
                        <div class="product-name">
                            <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                        </div>
                        <div class="price-rating">
                            <span class="old-price">$700.00</span>
                            <span>$800.00</span>
                            <div class="ratings">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                            </div>
                        </div>
                        <div class="actions">
                            <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                            <ul class="add-to-link">
                                <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal"
                                        href="#"> <i class="fa fa-search"></i></a></li>
                                <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="single-product">
                        <div class="level-pro-sale">
                            <span>sale</span>
                        </div>
                        <div class="product-img">
                            <a href="single-product.html">
                                <img src="img/product/3.png" alt="" class="primary-img">
                                <img src="img/product/4.png" alt="" class="secondary-img">
                            </a>
                        </div>
                        <div class="product-name">
                            <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                        </div>
                        <div class="price-rating">
                            <span class="old-price">$700.00</span>
                            <span>$800.00</span>
                            <div class="ratings">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                            </div>
                        </div>
                        <div class="actions">
                            <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                            <ul class="add-to-link">
                                <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal"
                                        href="#"> <i class="fa fa-search"></i></a></li>
                                <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="single-product">
                        <div class="level-pro-sale">
                            <span>sale</span>
                        </div>
                        <div class="product-img">
                            <a href="single-product.html">
                                <img src="img/product/9.png" alt="" class="primary-img">
                                <img src="img/product/10.png" alt="" class="secondary-img">
                            </a>
                        </div>
                        <div class="product-name">
                            <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                        </div>
                        <div class="price-rating">
                            <span class="old-price">$700.00</span>
                            <span>$800.00</span>
                            <div class="ratings">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                            </div>
                        </div>
                        <div class="actions">
                            <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                            <ul class="add-to-link">
                                <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal"
                                        href="#"> <i class="fa fa-search"></i></a></li>
                                <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="single-product.html">
                                <img src="img/product/5.png" alt="" class="primary-img">
                                <img src="img/product/6.png" alt="" class="secondary-img">
                            </a>
                        </div>
                        <div class="product-name">
                            <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                        </div>
                        <div class="price-rating">
                            <span class="old-price">$700.00</span>
                            <span>$800.00</span>
                            <div class="ratings">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                            </div>
                        </div>
                        <div class="actions">
                            <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                            <ul class="add-to-link">
                                <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal"
                                        href="#"> <i class="fa fa-search"></i></a></li>
                                <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="single-product">
                        <div class="level-pro-new">
                            <span>new</span>
                        </div>
                        <div class="product-img">
                            <a href="single-product.html">
                                <img src="img/product/3.png" alt="" class="primary-img">
                                <img src="img/product/4.png" alt="" class="secondary-img">
                            </a>
                        </div>
                        <div class="product-name">
                            <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                        </div>
                        <div class="price-rating">
                            <span class="old-price">$700.00</span>
                            <span>$800.00</span>
                            <div class="ratings">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                            </div>
                        </div>
                        <div class="actions">
                            <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                            <ul class="add-to-link">
                                <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal"
                                        href="#"> <i class="fa fa-search"></i></a></li>
                                <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="single-product">
                        <div class="level-pro-sale">
                            <span>sale</span>
                        </div>
                        <div class="product-img">
                            <a href="single-product.html">
                                <img src="img/product/19.png" alt="" class="primary-img">
                                <img src="img/product/20.png" alt="" class="secondary-img">
                            </a>
                        </div>
                        <div class="product-name">
                            <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                        </div>
                        <div class="price-rating">
                            <span class="old-price">$700.00</span>
                            <span>$800.00</span>
                            <div class="ratings">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                            </div>
                        </div>
                        <div class="actions">
                            <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                            <ul class="add-to-link">
                                <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal"
                                        href="#"> <i class="fa fa-search"></i></a></li>
                                <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="single-product.html">
                                <img src="img/product/13.png" alt="" class="primary-img">
                                <img src="img/product/14.png" alt="" class="secondary-img">
                            </a>
                        </div>
                        <div class="product-name">
                            <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                        </div>
                        <div class="price-rating">
                            <span class="old-price">$700.00</span>
                            <span>$800.00</span>
                            <div class="ratings">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                            </div>
                        </div>
                        <div class="actions">
                            <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                            <ul class="add-to-link">
                                <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal"
                                        href="#"> <i class="fa fa-search"></i></a></li>
                                <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="single-product.html">
                                <img src="img/product/15.png" alt="" class="primary-img">
                                <img src="img/product/16.png" alt="" class="secondary-img">
                            </a>
                        </div>
                        <div class="product-name">
                            <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                        </div>
                        <div class="price-rating">
                            <span class="old-price">$700.00</span>
                            <span>$800.00</span>
                            <div class="ratings">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                            </div>
                        </div>
                        <div class="actions">
                            <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                            <ul class="add-to-link">
                                <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal"
                                        href="#"> <i class="fa fa-search"></i></a></li>
                                <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="single-product">
                        <div class="level-pro-new">
                            <span>new</span>
                        </div>
                        <div class="product-img">
                            <a href="single-product.html">
                                <img src="img/product/17.png" alt="" class="primary-img">
                                <img src="img/product/18.png" alt="" class="secondary-img">
                            </a>
                        </div>
                        <div class="product-name">
                            <a href="single-product.html" title="Fusce aliquam">Fusce aliquam</a>
                        </div>
                        <div class="price-rating">
                            <span class="old-price">$700.00</span>
                            <span>$800.00</span>
                            <div class="ratings">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                            </div>
                        </div>
                        <div class="actions">
                            <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                            <ul class="add-to-link">
                                <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal"
                                        href="#"> <i class="fa fa-search"></i></a></li>
                                <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
<!-- feature products area end -->

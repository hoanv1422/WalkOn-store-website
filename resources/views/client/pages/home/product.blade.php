<!-- products area start -->
<div class="products-area">
    <div class="container">
        <div class="products">
            <div class="row">
                <div class="col-lg-3">
                    <div class="product-menu">
                        <div class="menu-title">
                            <h2>Best seller <strong>Products</strong></h2>
                        </div>
                        <div class="side-menu">
                            <!-- Nav tabs -->
                            <ul class="nav tab-navigation" role="tablist">
                                <li role="presentation">
                                    <a class="active" href="#tab1" aria-controls="tab1" role="tab"
                                        data-bs-toggle="tab">Women</a>
                                </li>
                                <li role="presentation">
                                    <a href="#tab2" aria-controls="tab2" role="tab" data-bs-toggle="tab">men</a>
                                </li>
                                <li role="presentation">
                                    <a href="#tab3" aria-controls="tab3" role="tab"
                                        data-bs-toggle="tab">Footwear</a>
                                </li>
                                <li role="presentation">
                                    <a href="#tab4" aria-controls="tab4" role="tab"
                                        data-bs-toggle="tab">Jewelry</a>
                                </li>
                                <li role="presentation">
                                    <a href="#tab5" aria-controls="tab5" role="tab"
                                        data-bs-toggle="tab">Accessories</a>
                                </li>
                                <li role="presentation">
                                    <a href="#tab6" aria-controls="tab6" role="tab"
                                        data-bs-toggle="tab">Dresses</a>
                                </li>
                                <li role="presentation">
                                    <a href="#tab7" aria-controls="tab7" role="tab" data-bs-toggle="tab">shoes</a>
                                </li>
                                <li role="presentation">
                                    <a href="#tab8" aria-controls="tab8" role="tab"
                                        data-bs-toggle="tab">Handbags</a>
                                </li>
                                <li><img src="img/banner/banner-5.jpg" alt=""></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade show active" id="tab1">
                                <div class="row">
                                    {{-- class="product-slider carousel-margin " --}}
                                    @foreach ($products as $product )
                                    <div class="col-4">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="img/product/1.png" alt="" class="primary-img">
                                                    <img src="img/product/2.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">{{$product->name}}</a>
                                            </div>
                                            <div class="price-rating">
                                                <span>{{$product->price}}</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to
                                                    cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal"
                                                            data-bs-toggle="modal" href="#"> <i
                                                                class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        {{-- <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="img/product/1.png" alt="" class="primary-img">
                                                    <img src="img/product/2.png" alt=""
                                                        class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">{{$product->name}}</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>{{$product->price}}</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to
                                                    cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal"
                                                            data-bs-toggle="modal" href="#"> <i
                                                                class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div> --}}
                                    </div>
                                    @endforeach
                                    
                                  
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab2">
                                <div class="row">
                                    {{-- class="product-slider carousel-margin " --}}
                                    @foreach ($products as $product )
                                    <div class="col-4">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="img/product/1.png" alt="" class="primary-img">
                                                    <img src="img/product/2.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">{{$product->name}}</a>
                                            </div>
                                            <div class="price-rating">
                                                <span>{{$product->price}}</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to
                                                    cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal"
                                                            data-bs-toggle="modal" href="#"> <i
                                                                class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        {{-- <div class="single-product">
                                            <div class="level-pro-sale">
                                                <span>sale</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="img/product/1.png" alt="" class="primary-img">
                                                    <img src="img/product/2.png" alt=""
                                                        class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">{{$product->name}}</a>
                                            </div>
                                            <div class="price-rating">
                                                <span class="old-price">$700.00</span>
                                                <span>{{$product->price}}</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to
                                                    cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal"
                                                            data-bs-toggle="modal" href="#"> <i
                                                                class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div> --}}
                                    </div>
                                    @endforeach
                                    
                                  
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab3">
                                <div class="row">
                                    {{-- class="product-slider carousel-margin " --}}
                                    @foreach ($products as $product )
                                    <div class="col-4">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="img/product/1.png" alt="" class="primary-img">
                                                    <img src="img/product/2.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">{{$product->name}}</a>
                                            </div>
                                            <div class="price-rating">
                                                <span>{{$product->price}}</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to
                                                    cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal"
                                                            data-bs-toggle="modal" href="#"> <i
                                                                class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    @endforeach
                                    
                                  
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab4">
                                <div class="row">
                                    {{-- class="product-slider carousel-margin " --}}
                                    @foreach ($products as $product )
                                    <div class="col-4">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="img/product/1.png" alt="" class="primary-img">
                                                    <img src="img/product/2.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">{{$product->name}}</a>
                                            </div>
                                            <div class="price-rating">
                                                <span>{{$product->price}}</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to
                                                    cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal"
                                                            data-bs-toggle="modal" href="#"> <i
                                                                class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    @endforeach
                                    
                                  
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab5">
                                <div class="row">
                                    {{-- class="product-slider carousel-margin " --}}
                                    @foreach ($products as $product )
                                    <div class="col-4">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="img/product/1.png" alt="" class="primary-img">
                                                    <img src="img/product/2.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">{{$product->name}}</a>
                                            </div>
                                            <div class="price-rating">
                                                <span>{{$product->price}}</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to
                                                    cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal"
                                                            data-bs-toggle="modal" href="#"> <i
                                                                class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    @endforeach
                                    
                                  
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab6">
                                <div class="row">
                                    {{-- class="product-slider carousel-margin " --}}
                                    @foreach ($products as $product )
                                    <div class="col-4">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="img/product/1.png" alt="" class="primary-img">
                                                    <img src="img/product/2.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">{{$product->name}}</a>
                                            </div>
                                            <div class="price-rating">
                                                <span>{{$product->price}}</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to
                                                    cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal"
                                                            data-bs-toggle="modal" href="#"> <i
                                                                class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    @endforeach
                                    
                                  
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab7">
                                <div class="row">
                       
                                    @foreach ($products as $product )
                                    <div class="col-4">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="img/product/1.png" alt="" class="primary-img">
                                                    <img src="img/product/2.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">{{$product->name}}</a>
                                            </div>
                                            <div class="price-rating">
                                                <span>{{$product->price}}</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to
                                                    cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal"
                                                            data-bs-toggle="modal" href="#"> <i
                                                                class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    @endforeach
                                    
                                  
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab8">
                                <div class="row">
                                    {{-- class="product-slider carousel-margin " --}}
                                    @foreach ($products as $product )
                                    <div class="col-4">
                                        <div class="single-product">
                                            <div class="level-pro-new">
                                                <span>new</span>
                                            </div>
                                            <div class="product-img">
                                                <a href="single-product.html">
                                                    <img src="img/product/1.png" alt="" class="primary-img">
                                                    <img src="img/product/2.png" alt="" class="secondary-img">
                                                </a>
                                            </div>
                                            <div class="product-name">
                                                <a href="single-product.html" title="Fusce aliquam">{{$product->name}}</a>
                                            </div>
                                            <div class="price-rating">
                                                <span>{{$product->price}}</span>
                                                <div class="ratings">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half-o"></i>
                                                </div>
                                            </div>
                                            <div class="actions">
                                                <button type="submit" class="cart-btn" title="Add to cart">add to
                                                    cart</button>
                                                <ul class="add-to-link">
                                                    <li><a class="modal-view" data-target="#productModal"
                                                            data-bs-toggle="modal" href="#"> <i
                                                                class="fa fa-search"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                                    <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    @endforeach
                                    
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- products area end -->

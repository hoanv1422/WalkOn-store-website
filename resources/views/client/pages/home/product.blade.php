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
                                
                                <li><img src="img/banner/banner-5.jpg" alt=""></li>
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
                            @foreach ( $brands as $brand )
                            <div role="tabpanel" class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab{{ $tabIndex }}">
                                <div class="row">
                                    
                                        @foreach ($brand->products as $product)
                                        

                                            <div class="col-4">
                                                
                                                <div class="single-product">
                                                    <div class="level-pro-new">
                                                        <span>new</span>
                                                    </div>
                                                    <div class="product-img">
                                                        <a href="{{route('detail.index', $product->slug)}}">
                                                            <img src="img/product/1.png" alt="" class="primary-img">
                                                            <img src="img/product/2.png" alt=""
                                                                class="secondary-img">
                                                        </a>
                                                    </div>
                                                    <div class="product-name">
                                                        <a href="{{route('detail.index', $product->slug)}}"
                                                            title="Fusce aliquam">{{ $product->name }}</a>
                                                    </div>
                                                    <div class="price-rating">
                                                        <span>{{ $product->price }}</span>
                                                        <div class="ratings">
                                                            <span>{{$product->average_rating}}</span> <i class="fa fa-star"></i>
                                                        </div>
                                                    </div>
                                                    <div class="actions">
                                                        <button type="submit" class="cart-btn" title="Add to cart">Thêm vào
                                                            giỏ hàng</button>
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
                            @php
                                $tabIndex++;
                            @endphp
                            @endforeach
                            {{-- <div role="tabpanel" class="tab-pane fade" id="tab2">
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-4">
                                            <div class="single-product">
                                                <div class="level-pro-new">
                                                    <span>new</span>
                                                </div>
                                                <div class="product-img">
                                                    <a href="{{route('detail.index', $product->slug)}}">
                                                        <img src="img/product/1.png" alt=""
                                                            class="primary-img">
                                                        <img src="img/product/2.png" alt=""
                                                            class="secondary-img">
                                                    </a>
                                                </div>
                                                <div class="product-name">
                                                    <a href="{{route('detail.index', $product->slug)}}"
                                                        title="Fusce aliquam">{{ $product->name }}</a>
                                                </div>
                                                <div class="price-rating">
                                                    <span>{{ $product->price }}</span>
                                                    <div class="ratings">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    </div>
                                                </div>
                                                <div class="actions">
                                                    <button type="submit" class="cart-btn" title="Add to cart">Thêm
                                                        vào giỏ hàng</button>
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
                            <div role="tabpanel" class="tab-pane fade" id="tab3">
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-4">
                                            <div class="single-product">
                                                <div class="level-pro-new">
                                                    <span>new</span>
                                                </div>
                                                <div class="product-img">
                                                    <a href="{{route('detail.index', $product->slug)}}">
                                                        <img src="img/product/1.png" alt=""
                                                            class="primary-img">
                                                        <img src="img/product/2.png" alt=""
                                                            class="secondary-img">
                                                    </a>
                                                </div>
                                                <div class="product-name">
                                                    <a href="{{route('detail.index', $product->slug)}}"
                                                        title="Fusce aliquam">{{ $product->name }}</a>
                                                </div>
                                                <div class="price-rating">
                                                    <span>{{ $product->price }}</span>
                                                    <div class="ratings">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    </div>
                                                </div>
                                                <div class="actions">
                                                    <button type="submit" class="cart-btn" title="Add to cart">Thêm
                                                        vào giỏ hàng</button>
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
                                    
                                    @foreach ($products as $product)
                                        <div class="col-4">
                                            <div class="single-product">
                                                <div class="level-pro-new">
                                                    <span>new</span>
                                                </div>
                                                <div class="product-img">
                                                    <a href="{{route('detail.index', $product->slug)}}">
                                                        <img src="img/product/1.png" alt=""
                                                            class="primary-img">
                                                        <img src="img/product/2.png" alt=""
                                                            class="secondary-img">
                                                    </a>
                                                </div>
                                                <div class="product-name">
                                                    <a href="{{route('detail.index', $product->slug)}}"
                                                        title="Fusce aliquam">{{ $product->name }}</a>
                                                </div>
                                                <div class="price-rating">
                                                    <span>{{ $product->price }}</span>
                                                    <div class="ratings">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    </div>
                                                </div>
                                                <div class="actions">
                                                    <button type="submit" class="cart-btn" title="Add to cart">Thêm
                                                        vào giỏ hàng</button>
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
                                   
                                    @foreach ($products as $product)
                                        <div class="col-4">
                                            <div class="single-product">
                                                <div class="level-pro-new">
                                                    <span>new</span>
                                                </div>
                                                <div class="product-img">
                                                    <a href="{{route('detail.index', $product->slug)}}">
                                                        <img src="img/product/1.png" alt=""
                                                            class="primary-img">
                                                        <img src="img/product/2.png" alt=""
                                                            class="secondary-img">
                                                    </a>
                                                </div>
                                                <div class="product-name">
                                                    <a href="{{route('detail.index', $product->slug)}}"
                                                        title="Fusce aliquam">{{ $product->name }}</a>
                                                </div>
                                                <div class="price-rating">
                                                    <span>{{ $product->price }}</span>
                                                    <div class="ratings">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    </div>
                                                </div>
                                                <div class="actions">
                                                    <button type="submit" class="cart-btn" title="Add to cart">Thêm
                                                        vào giỏ hàng</button>
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
                                   
                                    @foreach ($products as $product)
                                        <div class="col-4">
                                            <div class="single-product">
                                                <div class="level-pro-new">
                                                    <span>new</span>
                                                </div>
                                                <div class="product-img">
                                                    <a href="{{route('detail.index', $product->slug)}}">
                                                        <img src="img/product/1.png" alt=""
                                                            class="primary-img">
                                                        <img src="img/product/2.png" alt=""
                                                            class="secondary-img">
                                                    </a>
                                                </div>
                                                <div class="product-name">
                                                    <a href="{{route('detail.index', $product->slug)}}"
                                                        title="Fusce aliquam">{{ $product->name }}</a>
                                                </div>
                                                <div class="price-rating">
                                                    <span>{{ $product->price }}</span>
                                                    <div class="ratings">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    </div>
                                                </div>
                                                <div class="actions">
                                                    <button type="submit" class="cart-btn" title="Add to cart">Thêm
                                                        vào giỏ hàng</button>
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

                                    @foreach ($products as $product)
                                        <div class="col-4">
                                            <div class="single-product">
                                                <div class="level-pro-new">
                                                    <span>new</span>
                                                </div>
                                                <div class="product-img">
                                                    <a href="{{route('detail.index', $product->slug)}}">
                                                        <img src="img/product/1.png" alt=""
                                                            class="primary-img">
                                                        <img src="img/product/2.png" alt=""
                                                            class="secondary-img">
                                                    </a>
                                                </div>
                                                <div class="product-name">
                                                    <a href="{{route('detail.index', $product->slug)}}"
                                                        title="Fusce aliquam">{{ $product->name }}</a>
                                                </div>
                                                <div class="price-rating">
                                                    <span>{{ $product->price }}</span>
                                                    <div class="ratings">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    </div>
                                                </div>
                                                <div class="actions">
                                                    <button type="submit" class="cart-btn" title="Add to cart">Thêm
                                                        vào giỏ hàng</button>
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
                                    @foreach ($products as $product)
                                        <div class="col-4">
                                            <div class="single-product">
                                                <div class="level-pro-new">
                                                    <span>new</span>
                                                </div>
                                                <div class="product-img">
                                                    <a href="{{route('detail.index', $product->slug)}}">
                                                        <img src="img/product/1.png" alt=""
                                                            class="primary-img">
                                                        <img src="img/product/2.png" alt=""
                                                            class="secondary-img">
                                                    </a>
                                                </div>
                                                <div class="product-name">
                                                    <a href="{{route('detail.index', $product->slug)}}"
                                                        title="Fusce aliquam">{{ $product->name }}</a>
                                                </div>
                                                <div class="price-rating">
                                                    <span>{{ $product->price }}</span>
                                                    <div class="ratings">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    </div>
                                                </div>
                                                <div class="actions">
                                                    <button type="submit" class="cart-btn" title="Add to cart">Thêm
                                                        vào giỏ hàng</button>
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
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- products area end -->

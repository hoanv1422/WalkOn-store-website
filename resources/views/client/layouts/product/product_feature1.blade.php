<div class="features-product home2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-title">
                    <h2>featured products</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="features-home2-slider">
                @foreach ($products as $product )
                <div class="col">
                    
                    <div class="single-product">
                        <div class="level-pro-new">
                            <span>new</span>
                        </div>
                        <div class="product-img">
                            <a href="single-product.html">
                                <img src="{{$product->image}}" alt="" class="primary-img">
                                <img src="{{$product->image}}" alt="" class="secondary-img">
                            </a>
                        </div>
                        <div class="actions">
                            <button type="submit" class="cart-btn" title="Add to cart">add to cart</button>
                            <ul class="add-to-link">
                                <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal" href="#"> <i class="fa fa-search"></i></a></li>
                                <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                <li><a href="#"> <i class="fa fa-refresh"></i></a></li>
                            </ul>
                        </div>
                        <div class="product-price">
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
                        </div>
                    </div>
                   
                </div>
                
                @endforeach
            </div>
        </div>
    </div>
</div>
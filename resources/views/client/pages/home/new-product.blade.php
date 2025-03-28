 <!-- new products area start -->
 <div class="new-products-area">
     <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <div class="section-heading">
                     <h2>SẢN PHẨM HOT NHẤT</h2>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="new-product-slider carousel-margin">
                 @foreach ($products_average_rating as $product_average_rating)
                     <div class="col">
                         <div class="single-product">
                             <div class="level-pro-new">
                                 <span>new</span>
                             </div>
                             <div class="product-img">
                                 <a href="{{ route('detail.index', $product_average_rating->slug) }}">
                                     @if (Storage::exists($product_average_rating->image))
                                         <img src="{{ Storage::url($product_average_rating->image) }}"
                                             alt="{{ $product_average_rating->name }}" class="primary-img">
                                     @else
                                         <img src="img/default-image.jpg" alt="{{ $product_average_rating->name }}"
                                             class="primary-img">
                                     @endif
                                     @if (
                                         $product_average_rating->variants->isNotEmpty() &&
                                             Storage::exists($product_average_rating->variants->first()->image))
                                         <img src="{{ Storage::url($product_average_rating->variants->first()->image) }}"
                                             alt="{{ $product_average_rating->name }}" class="secondary-img">
                                     @else
                                         <img src="img/default-image.jpg" alt="{{ $product_average_rating->name }}"
                                             class="secondary-img">
                                     @endif
                                 </a>
                             </div>
                             <div class="product-name">
                                 <a href="{{ route('detail.index', $product_average_rating->slug) }}"
                                     title="Fusce aliquam">{{ $product_average_rating->name }}</a>
                             </div>
                             <div class="price-rating">
                                 @if ($product_average_rating->price_sale && $product_average_rating->price_sale <= $product_average_rating->price)
                                     <span class="old-price"
                                         style="color:red">{{ number_format($product_average_rating->price) }}
                                         VND</span>
                                     <span>{{ number_format($product_average_rating->price_sale) }}VND</span>
                                 @else
                                     <span>{{ number_format($product_average_rating->price) }}VND</span>
                                 @endif
                                 <div class="ratings">
                                     <span>{{ $product_average_rating->average_rating }}</span> <i
                                         class="fa fa-star"></i>

                                 </div>
                             </div>
                             <div class="actions">
                                 <button type="submit" class="cart-btn" title="Add to cart">thêm vào giỏ hàng</button>
                                 <ul class="add-to-link">
                                     <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal"
                                             href="#"> <i class="fa fa-search"></i></a></li>
                                     <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                 @endforeach
             </div>
         </div>
     </div>
 </div>
 <!-- new products area end -->

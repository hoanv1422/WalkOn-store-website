 <!-- new products area start -->
 <div class="new-products-area">
     <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <div class="section-heading">
                     <h2>SẢN PHẨM HOT</h2>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="new-product-slider carousel-margin">
                 {{-- @foreach ($topRatedProducts as $topRatedProduct)
                     <div class="col">
                         <div class="single-product">
                             <div class="level-pro-hot">
                                 <span>hot</span>
                             </div>
                             <div class="product-img">
                                 <a href="{{ route('detail.index', $topRatedProduct->slug) }}">
                                     @if (Storage::exists($topRatedProduct->image))
                                         <img src="{{ Storage::url($topRatedProduct->image) }}"
                                             alt="{{ $topRatedProduct->name }}" class="primary-img">
                                     @else
                                         <img src="img/default-image.jpg" alt="{{ $topRatedProduct->name }}"
                                             class="primary-img">
                                     @endif
                                     @if (
                                         $topRatedProduct->variants->isNotEmpty() &&
                                             Storage::exists($topRatedProduct->variants->first()->image))
                                         <img src="{{ Storage::url($topRatedProduct->variants->first()->image) }}"
                                             alt="{{ $topRatedProduct->name }}" class="secondary-img">
                                     @else
                                         <img src="img/default-image.jpg" alt="{{ $topRatedProduct->name }}"
                                             class="secondary-img">
                                     @endif
                                 </a>
                             </div>
                             <div class="product-name">
                                 <a href="{{ route('detail.index', $topRatedProduct->slug) }}"
                                     title="Fusce aliquam">{{ $topRatedProduct->name }}</a>
                             </div>
                             <div class="price-rating">
                                 @if ($topRatedProduct->price_sale && $topRatedProduct->price_sale <= $topRatedProduct->price)
                                     <span class="old-price"
                                         style="color:red">{{ number_format($topRatedProduct->price) }}
                                         VND</span>
                                     <span>{{ number_format($topRatedProduct->price_sale) }}VND</span>
                                 @else
                                     <span>{{ number_format($topRatedProduct->price) }}VND</span>
                                 @endif
                                 <div class="ratings">
                                     <span>{{ $topRatedProduct->average_rating }}</span> <i
                                         class="fa fa-star"></i>

                                 </div>
                             </div>
                             <div class="actions d-flex justify-content-between">
                                 <form class="add-to-cart-form" action="{{ route('get.product') }}" method="get">
                                    <input type="hidden" name="idProduct" value="{{ $topRatedProduct->id }}">
                                    <button type="submit" class="cart-btn" title="Thêm vào giỏ hàng"
                                        data-bs-toggle="modal" data-bs-target="#cartModal">
                                        Thêm vào giỏ hàng
                                    </button>
                                </form>
                                 <ul class="add-to-link">
                                     <li><a class="modal-view" data-target="#productModal" data-bs-toggle="modal"
                                             href="#"> <i class="fa fa-search"></i></a></li>
                                     <li><a href="#"> <i class="fa fa-heart-o"></i></a></li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                 @endforeach --}}
             </div>
         </div>
     </div>
 </div>
 <!-- new products area end -->

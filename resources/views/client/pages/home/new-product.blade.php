 <!-- new products area start -->
 <div class="new-products-area">
     <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <div class="section-heading">
                     <h2>SẢN PHẨM MỚI NHẤT</h2>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="new-product-slider carousel-margin">
                 @foreach ($newProducts as $newProduct)
                     <div class="col">
                         <div class="single-product">
                             <div class="level-pro-new">
                                 <span>new</span>
                             </div>
                             <div class="product-img">
                                 <a href="{{ route('detail.index', $newProduct->slug) }}">
                                     @if (Storage::exists($newProduct->image))
                                         <img src="{{ Storage::url($newProduct->image) }}"
                                             alt="{{ $newProduct->name }}" class="primary-img">
                                     @else
                                         <img src="img/default-image.jpg" alt="{{ $newProduct->name }}"
                                             class="primary-img">
                                     @endif
                                     @if (
                                         $newProduct->variants->isNotEmpty() &&
                                             Storage::exists($newProduct->variants->first()->image))
                                         <img src="{{ Storage::url($newProduct->variants->first()->image) }}"
                                             alt="{{ $newProduct->name }}" class="secondary-img">
                                     @else
                                         <img src="img/default-image.jpg" alt="{{ $newProduct->name }}"
                                             class="secondary-img">
                                     @endif
                                 </a>
                             </div>
                             <div class="product-name">
                                 <a href="{{ route('detail.index', $newProduct->slug) }}"
                                     title="Fusce aliquam">{{ $newProduct->name }}</a>
                             </div>
                             <div class="price-rating">
                                 @if ($newProduct->price_sale && $newProduct->price_sale <= $newProduct->price)
                                     <span class="old-price"
                                         style="color:red">{{ number_format($newProduct->price) }}
                                         VND</span>
                                     <span>{{ number_format($newProduct->price_sale) }}VND</span>
                                 @else
                                     <span>{{ number_format($newProduct->price) }}VND</span>
                                 @endif
                                 <div class="ratings">
                                     <span>{{ $newProduct->average_rating }}</span> <i
                                         class="fa fa-star"></i>

                                 </div>
                             </div>
                             <div class="actions d-flex justify-content-between">
                                 <form class="add-to-cart-form" action="{{ route('get.product') }}" method="get">
                                    <input type="hidden" name="idProduct" value="{{ $newProduct->id }}">
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
                 @endforeach
             </div>
         </div>
     </div>
 </div>
 <!-- new products area end -->

<!-- product main items area start -->
<div class="product-main-items">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="product-sidebar">
                    <div class="sidebar-title">
                        <h2>Shopping Options</h2>
                    </div>

                    {{-- Form lọc sản phẩm --}}
                    <form action="{{ route('shop.filter') }}" method="GET">
                        {{-- Category --}}
                        <div class="single-sidebar">
                            <div class="single-sidebar-title">
                                <h3>Category</h3>
                            </div>
                            <div class="single-sidebar-content">
                                <ul>
                                    @foreach ($categories as $category)
                                        <li>
                                            <input type="checkbox" name="category[]" value="{{ $category->id }}"
                                                {{ request()->has('category') && in_array($category->id, (array) request()->category) ? 'checked' : '' }}>
                                            {{ $category->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        {{-- Color --}}
                        <div class="single-sidebar">
                            <div class="single-sidebar-title">
                                <h3>Color</h3>
                            </div>
                            <div class="single-sidebar-content">
                                <ul>
                                    @foreach ($colors as $color)
                                        <li>
                                            <input type="checkbox" name="color[]" value="{{ $color->id }}"
                                                {{ request()->has('color') && in_array($color->id, (array) request()->color) ? 'checked' : '' }}>
                                            {{ $color->color }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        {{-- Brand --}}
                        <div class="single-sidebar">
                            <div class="single-sidebar-title">
                                <h3>Manufacturer</h3>
                            </div>
                            <div class="single-sidebar-content">
                                <ul>
                                    @foreach ($brand as $brand)
                                        <li>
                                            <input type="checkbox" name="brand[]" value="{{ $brand->id }}"
                                                {{ request()->has('brand') && in_array($brand->id, (array) request()->brand) ? 'checked' : '' }}>
                                            {{ $brand->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        {{-- Price --}}
                        <div class="single-sidebar price">
                            <div class="single-sidebar-title">
                                <h3>Price</h3>
                            </div>
                            <div class="single-sidebar-content">
                                <input type="number" name="min_price" placeholder="Min Price"
                                    value="{{ request('min_price') }}">
                                <input type="number" name="max_price" placeholder="Max Price"
                                    value="{{ request('max_price') }}">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Search</button>
                    </form>

                    <div class="banner-left">
                        <a href="#"><img src="img/product/banner_left.jpg" alt=""></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="product-bar">
                    <ul class="nav product-navigation justify-content-center" role="tablist">
                        <li role="presentation" class="gird">
                            <a class="active" href="#gird" aria-controls="gird" role="tab" data-bs-toggle="tab">
                                <span>
                                    <img class="primary" src="img/product/grid-primary.png" alt="">
                                    <img class="secondary" src="img/product/grid-secondary.png" alt="">
                                </span>
                                Gird
                            </a>
                        </li>
                        <li role="presentation" class="list">
                            <a href="#list" aria-controls="list" role="tab" data-bs-toggle="tab">
                                <span>
                                    <img class="primary" src="img/product/list-primary.png" alt="">
                                    <img class="secondary" src="img/product/list-secondary.png" alt="">
                                </span>
                                List
                            </a>
                        </li>
                    </ul>
                    <div class="sort-by">
                        <label>Sort By</label>
                        <select name="sort">
                            <option value="#" selected>Position</option>
                            <option value="#">Name</option>
                            <option value="#">Price</option>
                        </select>
                        <a href="#" title="Set Descending Direction">
                            <img src="img/product/i_asc_arrow.gif" alt="">
                        </a>
                    </div>
                    <div class="limit-product">
                        <label>Show</label>
                        <select name="show">
                            <option value="#" selected>9</option>
                            <option value="#">12</option>
                            <option value="#">24</option>
                            <option value="#">36</option>
                        </select>
                        per page
                    </div>
                </div>
                <div class="row">
                    <div class="product-content">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active fade show home2" id="gird">
                                {{-- Hiển thị sản phẩm --}}
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-lg-4 col-md-6">
                                            <div class="single-product">
                                                <div class="level-pro-new">
                                                    <span>new</span>
                                                </div>
                                                <div class="product-img">
                                                    <a href="{{ route('detail.index', $product->slug) }}">
                                                        <img src="{{ Storage::url($product->image) }}" alt=""
                                                            class="primary-img">
                                                        <img src="{{ Storage::url($product->image) }}" alt=""
                                                            class="secondary-img">
                                                        <img src="img/product/25.png" alt="">
                                                    </a>
                                                </div>
                                                <div class="actions">
                                                    <form action="" method="" style="display: inline;">
                                                        @csrf
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $product->slug }}">
                                                        <button type="submit" class="cart-btn"
                                                            title="Add to cart">Add to cart</button>
                                                    </form>
                                                    <ul class="add-to-link">
                                                        <li><a class="modal-view" data-target="#productModal"
                                                                data-bs-toggle="modal" href="#"> <i
                                                                    class="fa fa-search"></i></a></li>
                                                        <li><a href="#"> <i class="fa fa-heart-o"></i></a>
                                                        </li>
                                                        <li><a href="#"> <i class="fa fa-refresh"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="product-price">
                                                    <div class="product-name">
                                                        <a href="" title="{{ $product->name }}">
                                                            {{ $product->name }}</a>
                                                    </div>
                                                    <div class="price-rating">
                                                        <span>{{ number_format($product->price, 0, ',', '.') }}
                                                            VND</span>
                                                        <div class="ratings">
                                                            @for ($i = 0; $i < 5; $i++)
                                                                @if ($i < $product->average_rating)
                                                                    <i class="fa fa-star"></i>
                                                                @else
                                                                    <i class="fa fa-star-half-o"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade home2" id="list">
                                <div class="product-catagory">
                                    @foreach ($products as $product)
                                        <div class="single-list-product row">
                                            <div class="col-md-4">
                                                <div class="list-product-img">
                                                    <a href="{{ route('detail.index', $product->slug) }}">
                                                        <img src="{{ Storage::url($product->image) }}" alt=""
                                                            class="primary-img">
                                                        <img src="{{ Storage::url($product->image) }}" alt=""
                                                            class="secondary-img">
                                                        <img src="img/product/25.png" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="list-product-info">
                                                    <a href="{{ url('single-product/' . $product->id) }}"
                                                        class="list-product-name">{{ $product->name }}</a>
                                                    <div class="price-rating">
                                                        <span
                                                            class="old-price">{{ number_format($product->price, 0, ',', '.') }}
                                                            VND</span>
                                                        <span class="text-danger">
                                                            {{ number_format($product->price_sale, 0, ',', '.') }}
                                                            VND</span>
                                                        <div class="ratings">
                                                            @for ($i = 0; $i < 5; $i++)
                                                                @if ($i < $product->average_rating)
                                                                    <i class="fa fa-star"></i>
                                                                @else
                                                                    <i class="fa fa-star-half-o"></i>
                                                                @endif
                                                            @endfor
                                                            <a href="#"
                                                                class="review">{{ $product->reviews_count }}
                                                                Review(s)</a>
                                                            <a href="#" class="add-review">Add Your Review</a>
                                                        </div>
                                                    </div>
                                                    <div class="list-product-details">
                                                        <p>{{ $product->description }}
                                                            <a href="{{ url('single-product/' . $product->id) }}">Learn
                                                                More</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="toolbar-bottom">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product main items area end -->

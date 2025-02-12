<div class="row">
    <div class="col-lg-3">
        <div class="">
            <div class="product-sidebar">
                <div class="sidebar-title">
                    <h2>Shopping Options</h2>
                </div>
                <div class="single-sidebar">
                    <div class="single-sidebar-title">
                        <h3>Category</h3>
                    </div>
                    <div class="single-sidebar-content">
                        <ul>
                            @foreach ($categories as $category)
                                {{-- <li><a href="#">{{ $category->name }}</a></li> --}}
                                <li><a
                                        href="{{ route('shop.filterByCategory', $category->id) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="single-sidebar">
                    <div class="single-sidebar-title">
                        <h3>Color</h3>
                    </div>
                    <div class="single-sidebar-content">
                        <ul>
                            @foreach ($colors as $color)
                                <li><a href="#">{{ $color->color }} </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="banner-left">
                    <a href="#">
                        <img src="client_views/img/product/banner_left.jpg" alt="">
                    </a>
                </div>
            </div>

            <div class="single-sidebar price">
                <div class="single-sidebar-title">
                    <h3>Price</h3>
                </div>
                <div class="single-sidebar-content">
                    <div class="price-range">
                        <div class="price-filter">
                            <div id="slider-range"></div>
                            <div class="price-slider-amount">
                                <input type="text" id="amount" name="price" placeholder="Add Your Price" />
                            </div>
                        </div>
                        <button type="submit"> <span>search</span> </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

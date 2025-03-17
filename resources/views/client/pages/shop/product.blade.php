<!-- product main items area start -->
<div class="product-main-items">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="product-sidebar">
                    <div class="sidebar-title">
                        <h2>BỘ LỌC TÌm kiếm</h2>
                    </div>

                    {{-- Form lọc sản phẩm --}}
                    <form action="{{ route('shop.filter') }}" method="GET">
                        {{-- Category --}}
                        <div class="single-sidebar">
                            <div class="single-sidebar-title">
                                <h3>danh mục</h3>
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
                                <h3>màu sắc</h3>
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
                                <h3>thương hiệu</h3>
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
                        {{-- Sizes --}}
                        <div class="single-sidebar">
                            <div class="single-sidebar-title">
                                <h3> Kích cỡ</h3>
                            </div>
                            <div class="single-sidebar-content">
                                <ul>
                                    @foreach ($sizes as $size)
    <li>
        <input type="checkbox" name="size[]" value="{{ $size->id }}" 
            {{ request()->has('size') && in_array($size->id, (array) request()->size) ? 'checked' : '' }}>
        {{ $size->size }}
    </li>
@endforeach
                                </ul>
                            </div>
                        </div>

                        {{-- Price --}}
                        <div class="single-sidebar price">
                            <div class="single-sidebar-title">
                                <h3>Khoảng Giá</h3>
                            </div>
                            <div class="d-flex align-items-center">
                                <!-- Ô nhập giá thấp nhất -->
                                <div class="input-group">
                                    <span class="input-group-text">₫</span>
                                    <input type="number" name="min_price" min="0" class="form-control" placeholder="TỪ" value="{{ request('min_price') }}">
                                </div>
                                
                                <span class="mx-2">–</span> 
                                
                                <!-- Ô nhập giá cao nhất -->
                                <div class="input-group">
                                    <span class="input-group-text">₫</span>
                                    <input type="number" name="max_price" min="0" class="form-control" placeholder="ĐẾN" value="{{ request('max_price') }}">
                                </div>
                            </div>
                            {{-- <div class="single-sidebar-content">
                                <input type="number" name="min_price" min="0" placeholder="Min Price" value="{{ request('min_price') }}">
                                <input type="number" name="max_price" min="0" placeholder="Max Price" value="{{ request('max_price') }}">
                            </div> --}}
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Search</button>
                    </form>

                    <div class="banner-left">
                        <a href="#"><img src="img/product/banner_left.jpg" alt=""></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="product-content">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active fade show home2" id="gird">
                                {{-- Hiển thị sản phẩm --}}
                                <div class="row">
                                    @if ($products->isEmpty())
                                        <p>Không có sản phẩm nào phù hợp với bộ lọc.</p>
                                    @else
                                        @foreach ($products as $product)
                                            <div class="col-lg-4 col-md-6">
                                                <div class="single-product">
                                                    <div class="level-pro-new">
                                                        <span>new</span>
                                                    </div>
                                                    <div class="product-img">
                                                        <a href="{{ route('detail.index', $product->slug) }}">
                                                            <img src="{{ Storage::url($product->image) }}" alt="" class="primary-img">
                                                            <img src="{{ Storage::url($product->image) }}" alt="" class="secondary-img">
                                                        </a>
                                                    </div>
                                                    <div class="product-price">
                                                        <a href="{{ route('detail.index', $product->slug) }}" title="{{ $product->name }}">{{ $product->name }}</a>
                                                        <span>{{ number_format($product->price, 0, ',', '.') }} VND</span>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                        @endforeach
                                    @endif
                                </div>
                              
                            </div>
                        </div>
                    </div>

                    {{-- Phân trang --}}
                    <div class="col-md-12 d-flex justify-content-center">
                        {{ $products->appends(request()->input())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- product main items area end -->

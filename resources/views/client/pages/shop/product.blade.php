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
                                                <div class="product-img product-img-enhanced">
                                                    <a href="{{ route('detail.index', $product->slug) }}"
                                                        class="product-img-link">
                                                        <img src="{{ Storage::url($product->image) }}"
                                                            alt="{{ $product->name }}" class="primary-img">
                                                        <img src="{{ Storage::url($product->image) }}"
                                                            alt="{{ $product->name }}" class="secondary-img">

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
                                                        <li><a href="#"> <i class="fa fa-heart-o"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="product-price">
                                                    <div class="product-name">
                                                        <a href="" title="{{ $product->name }}">
                                                            {{ $product->name }}</a>
                                                    </div>
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
                                                <div class="list-product-img list-product-img-enhanced">
                                                    <a href="{{ route('detail.index', $product->slug) }}"
                                                        class="product-img-link">
                                                        <img src="{{ Storage::url($product->image) }}"
                                                            alt="{{ $product->name }}" class="primary-img">
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
                                                        <p>
                                                            {{ $product->description }}
                                                        </p>
                                                        <a href="{{ url('single-product/' . $product->id) }}">Learn
                                                            More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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

<style>
    /* Cải thiện hiển thị ảnh trong chế độ lưới */
    .product-img-enhanced {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 15px;
        height: 280px;
        /* Chiều cao cố định cho ảnh */
    }

    .product-img-enhanced .primary-img,
    .product-img-enhanced .secondary-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Đảm bảo ảnh luôn đẹp và không bị méo */
        transition: all 0.5s ease;
    }

    .product-img-enhanced .secondary-img {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
    }

    .product-img-link {
        display: block;
        height: 100%;
        position: relative;
    }

    .product-img-enhanced:hover .primary-img {
        transform: scale(1.05);
    }

    .product-img-enhanced:hover .secondary-img {
        opacity: 1;
        transform: scale(1.05);
    }

    /* Overlay khi hover */
    .product-img-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .product-img-enhanced:hover .product-img-overlay {
        opacity: 1;
    }

    .view-details {
        color: white;
        background-color: rgba(0, 0, 0, 0.6);
        padding: 8px 15px;
        border-radius: 4px;
        font-weight: 500;
        transform: translateY(20px);
        transition: all 0.3s ease;
    }

    .product-img-enhanced:hover .view-details {
        transform: translateY(0);
    }

    /* Cải thiện hiển thị ảnh trong chế độ danh sách */
    .list-product-img-enhanced {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        height: 100%;
        min-height: 250px;
    }

    .list-product-img-enhanced .primary-img,
    .list-product-img-enhanced .secondary-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.5s ease;
    }

    .list-product-img-enhanced .secondary-img {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
    }

    .list-product-img-enhanced:hover .primary-img {
        transform: scale(1.05);
    }

    .list-product-img-enhanced:hover .secondary-img {
        opacity: 1;
        transform: scale(1.05);
    }

    /* Cải thiện hiển thị nhãn "new" */


    /* Hiệu ứng zoom khi hover */
    @keyframes zoomEffect {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }

        100% {
            transform: scale(1);
        }
    }

    .product-img-enhanced:hover,
    .list-product-img-enhanced:hover {
        animation: zoomEffect 5s infinite;
    }
</style>

<script>
    // Script chỉ tập trung vào cải thiện hiển thị ảnh sản phẩm
    document.addEventListener('DOMContentLoaded', function() {
        // Xử lý hiệu ứng hover cho ảnh sản phẩm
        const productImgs = document.querySelectorAll('.product-img-enhanced, .list-product-img-enhanced');

        productImgs.forEach(container => {
            const primaryImg = container.querySelector('.primary-img');
            const secondaryImg = container.querySelector('.secondary-img');

            // Nếu chỉ có một ảnh, tạo hiệu ứng zoom khi hover
            if (primaryImg && !secondaryImg) {
                container.addEventListener('mouseenter', () => {
                    primaryImg.style.transform = 'scale(1.05)';
                });

                container.addEventListener('mouseleave', () => {
                    primaryImg.style.transform = 'scale(1)';
                });
            }

            // Nếu có cả hai ảnh, tạo hiệu ứng chuyển đổi
            if (primaryImg && secondaryImg) {
                // Đảm bảo ảnh thứ hai được tải trước
                const preloadSecondaryImg = new Image();
                preloadSecondaryImg.src = secondaryImg.src;

                container.addEventListener('mouseenter', () => {
                    primaryImg.style.opacity = '0';
                    secondaryImg.style.opacity = '1';
                });

                container.addEventListener('mouseleave', () => {
                    primaryImg.style.opacity = '1';
                    secondaryImg.style.opacity = '0';
                });
            }
        });

        // Thêm hiệu ứng lazy load cho ảnh
        if ('IntersectionObserver' in window) {
            const imgOptions = {
                threshold: 0.1,
                rootMargin: "0px 0px 50px 0px"
            };

            const imgObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        const src = img.getAttribute('data-src');

                        if (src) {
                            img.src = src;
                            img.removeAttribute('data-src');
                        }

                        observer.unobserve(img);
                    }
                });
            }, imgOptions);

            const lazyImages = document.querySelectorAll('img[data-src]');
            lazyImages.forEach(img => {
                imgObserver.observe(img);
            });
        }
    });
</script>

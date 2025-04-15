<!-- header area start -->
<header>
    <div class="top-link">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-3 col-md-9 d-none d-md-block">
                    <div class="call-support">
                        <p>Hỗ Trợ Miễn Phí: <span> +8494422302</span></p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 position-relative">
                    <div class="dashboard">
                        <div class="account-menu">
                            <ul>
                                <li class="search">
                                    <a href="#">
                                        <i class="fa fa-search"></i>
                                    </a>
                                    <ul class="search">
                                        <li>
                                            <form id="header-search-form" action="{{ route('shop.index') }}"
                                                method="GET">
                                                <input type="text" name="keyword" id="header-search-input"
                                                    placeholder="Tìm kiếm sản phẩm..."
                                                    value="{{ request()->input('keyword') }}">
                                                <button type="submit"
                                                    style="border: none; background: none; padding: 0; cursor: pointer;">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                    <ul>
                                        <li><a href="{{ route('profile.index') }}">Tài Khoản</a></li>
                                        <li><a href="{{ route('wishlist.index') }}">Yêu Thích</a></li>
                                        <li><a href="{{ route('cart.index') }}">Giỏ Hàng</a></li>
                                        <li><a href="{{ route('blog.index') }}">Bài Viết</a></li>
                                        @auth
                                            <li>
                                                <a href="#"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    Đăng Xuất
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        @else
                                            <li><a href="{{ route('login') }}">Đăng Nhập</a></li>
                                        @endauth

                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="cart-menu">
                            <ul>
                                <li><a href="{{ route('cart.index') }}"> <img src="img/icon-cart.png" alt="">
                                        <span>{{ $cartCount }}</span> </a>
                                    <div class="cart-info">
                                        <ul>
                                            @foreach ($cartItems as $item)
                                                <li>
                                                    <div class="cart-img"
                                                        style="width: 50px; height: 50px; overflow:hidden">
                                                        @if (!empty($item->productVariant->image) && Storage::exists($item->productVariant->image))
                                                            <img src="{{ Storage::url($item->productVariant->image) }}"
                                                                alt="{{ $item->productVariant->product->name }}"
                                                                style="height: 100%; width: 100%; object-fit: cover;">
                                                        @else
                                                            <img src="{{ asset('img/default-image.jpg') }}"
                                                                alt="{{ $item->productVariant->product->name }}"
                                                                style="height: 100%; width: 100%; object-fit: cover;">
                                                        @endif

                                                    </div>
                                                    <div class="cart-details">
                                                        <a href="{{ route('detail.index', $item->productVariant->product->slug) }}"
                                                            title="{{ $item->productVariant->product->name }}">
                                                            {{ Str::limit($item->productVariant->product->name, 20, '...') }}
                                                        </a>

                                                        <p>{{ $item->quantity }} x
                                                            {{ $item->productVariant->price }} VND</p>

                                                        <p>{{ $item->productVariant->size->size }} x
                                                            {{ $item->productVariant->color->color }}</p>
                                                    </div>
                                                    <div class="d-flex">
                                                        <form action="{{ route('cart.delete', $item->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?');"
                                                            class="ms-auto">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-link p-0 border-0 text-danger">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>

                                                </li>
                                            @endforeach

                                            @if ($cartCount > 2)
                                                <a href="{{ route('cart.index') }}" class="small text-white">Xem
                                                    thêm</a>
                                            @endif
                                        </ul>
                                        <h3>Tổng: <span>{{ $subTotal }} VND</span></h3>
                                        <a href="{{ route('cart.index') }}" class="checkout">Go To Cart</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mainmenu-area product-items">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="logo">
                        <a href="{{ route('home.index') }}">
                            <img src="{{ asset('img/logo.png') }}" alt="" >
                        </a>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="mainmenu">
                        <nav>
                            <ul>
                                <li><a href="{{ route('home.index') }}">Trang Chủ</a></li>

                                <li class="mega-men">
                                    <a href="{{ route('shop.index') }}">Cửa Hàng</a>
                                    <div class="mega-menu men">
                                        @if ($categories->count() > 0)
                                            @foreach ($categories as $category)
                                                <span>
                                                    <a
                                                        href="{{ route('shop.index', ['category' => $category->id]) }}">{{ $category->name }}</a>
                                                </span>
                                            @endforeach
                                        @endif
                                    </div>
                                </li>
                                <li><a href="{{ route('contact.index') }}">Liên Hệ</a></li>
                                <li><a href="{{ route('about-us.index') }}">Về Chúng Tôi</a></li>
                                <li><a href="{{ route('blog.index') }}">Bài Viết</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>
<!-- header area end -->

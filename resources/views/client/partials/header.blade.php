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
                                        <li><a href="{{ route('order.list') }}">Đơn đã đặt</a></li>
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
                                            <li><a href="{{ route('login.form') }}">Đăng Nhập</a></li>
                                        @endauth

                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="cart-menu">
                            <ul>
                                <li><a href="{{ route('cart.index') }}"> <img src="{{asset('img/icon-cart.png')}}" alt="Cart">
                                        <span id="cart-count-header">0</span> </a>
                                    <div class="cart-info">
                                        <ul id="cart-items-header">
                                            <!-- Nơi hiển thị giỏ hàng -->
                                        </ul>
                                        <h3>Tổng: <span id="subtotal-header">0 VND
                                            </span></h3>
                                        <a href="{{ route('cart.index') }}" class="checkout">Tới Giỏ Hàng</a>
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
                            <img src="{{ asset('img/logoWalkOn.png') }}" alt="">
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
                                        <div class="row">
                                            <div class="col left">
                                                <h5 class="text-white">Danh mục</h5>
                                                @if ($categories->count())
                                                    @foreach ($categories as $category)
                                                        <span>
                                                            <a
                                                                href="{{ route('shop.index', ['category' => $category->id]) }}">
                                                                {{ $category->name }}
                                                            </a>
                                                        </span>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="col right">
                                                <h5 class="text-white">Thương hiệu</h5>
                                                @if ($brands->count())
                                                    @foreach ($brands as $brand)
                                                        <span>
                                                            <a
                                                                href="{{ route('shop.index', ['brand' => $brand->id]) }}">
                                                                {{ $brand->name }}
                                                            </a>
                                                        </span>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
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

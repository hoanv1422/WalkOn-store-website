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
                                            <form action="#">
                                                <input type="text">
                                                <button type="submit"> <i class="fa fa-search"></i> </button>
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
                                        <li><a href="{{ route('checkout.index') }}">Thanh Toán</a></li>
                                        <li><a href="{{ route('blog.index') }}">Bài Viết</a></li>
                                        <li><a href="{{ route('login') }}">Đăng Nhập</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="cart-menu">
                            <ul>
                                <li><a href="#"> <img src="img/icon-cart.png" alt="">
                                        <span>{{ $cartCount }}</span> </a>
                                    <div class="cart-info">
                                        <ul>
                                            @foreach ($cartItems as $item)
                                                <li>
                                                    <div class="cart-img">
                                                        <img src="{{ Storage::url($item->productVariant->product->image) }}"
                                                            alt="" width="65px">
                                                    </div>
                                                    <div class="cart-details">
                                                        <a href="#"
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
                        <a href="{{route('home.index')}}">
                            <img src="{{asset("img/logo.png")}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="mainmenu">
                        <nav>
                            <ul>
                                <li><a href="{{ route('home.index') }}">Trang Chủ</a></li>

                                <li class="mega-men"><a href="{{ route('shop.index') }}">Cửa Hàng</a>
                                    <div class="mega-menu men">
                                        @if ($categories->count() > 0)
                                            @foreach ($categories as $category)
                                                <span>
                                                    <a href="">{{ $category->name }}</a>
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
                <div class="col-sm-12">
                    <div class="mobile-menu">
                        <nav>
                            <ul>
                                <li><a href="index.html">Home</a>
                                    <ul>
                                        <li><a href="index.html">Home 1</a></li>
                                        <li><a href="index-2.html">Home 2</a></li>
                                    </ul>
                                </li>
                                <li><a href="shop.html">Women</a>
                                    <ul>
                                        <li><a href="#">Dresses</a>
                                            <ul>
                                                <li><a href="#">Coctail</a></li>
                                                <li><a href="#">day</a></li>
                                                <li><a href="#">evening</a></li>
                                                <li><a href="#">sports</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">shoes</a>
                                            <ul>
                                                <li><a href="#">Sports</a></li>
                                                <li><a href="#">run</a></li>
                                                <li><a href="#">sandals</a></li>
                                                <li><a href="#">boots</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">handbags</a>
                                            <ul>
                                                <li><a href="#">Blazers</a></li>
                                                <li><a href="#">table</a></li>
                                                <li><a href="#">coats</a></li>
                                                <li><a href="#">kids</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">clothing</a>
                                            <ul>
                                                <li><a href="#">T-shirts</a></li>
                                                <li><a href="#">coats</a></li>
                                                <li><a href="#">Jackets</a></li>
                                                <li><a href="#">jeans</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="shop.html">Men</a>
                                    <ul>
                                        <li><a href="#">Bags</a>
                                            <ul>
                                                <li><a href="#">Bootees bag</a></li>
                                                <li><a href="#">Blazers</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">clothing</a>
                                            <ul>
                                                <li><a href="#">coats</a></li>
                                                <li><a href="#">T-shirts</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Lingerie</a>
                                            <ul>
                                                <li><a href="#">Bands</a></li>
                                                <li><a href="#">Furniture</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="shop.html">Foorwear</a>
                                    <ul>
                                        <li><a href="#">footwear men</a>
                                            <ul>
                                                <li><a href="#">gifts</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">footwear women</a>
                                            <ul>
                                                <li><a href="#">boots</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="shop.html">Jewellery</a>
                                    <ul>
                                        <li><a href="#">Rings</a></li>
                                    </ul>
                                </li>
                                <li><a href="shop.html">Accessories</a></li>
                                <li><a href="#">Pages</a>
                                    <ul>
                                        <li><a href="about-us.html">About us</a></li>
                                        <li><a href="blog.html">Blog</a></li>
                                        <li><a href="blog-details.html">Blog Details</a></li>
                                        <li><a href="cart.html">Cart</a></li>
                                        <li><a href="checkout.html">Checkout</a></li>
                                        <li><a href="contact.html">Contact</a></li>
                                        <li><a href="my-account.html">My account</a></li>
                                        <li><a href="shop.html">Shop</a></li>
                                        <li><a href="shop-list.html">Shop list</a></li>
                                        <li><a href="single-product.html">Single Shop</a></li>
                                        <li><a href="wishlist.html">Wishlist</a></li>
                                        <li><a href="{{url('/login')}}">login page</a></li>
                                        <li><a href="{{url('/register')}}">register page</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header area end -->

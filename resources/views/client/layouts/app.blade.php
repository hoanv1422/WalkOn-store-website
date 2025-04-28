<!doctype html>
<html class="no-js" lang="">

<!-- Mirrored from htmldemo.net/james/james/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 18 Jan 2025 15:49:29 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Home || James </title>
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Đảm bảo dòng này có mặt -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon
        ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

    <!-- Google Fonts
        ============================================ -->
    <link href='https://fonts.googleapis.com/css?family=Norican' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- All css -->

    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href={{ asset('templates/client/css/bootstrap.min.css') }}>
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href={{ asset('templates/client/css/font-awesome.min.css') }}>
    <!-- owl.carousel CSS
        ============================================ -->
    <link rel="stylesheet" href={{ asset('templates/client/css/owl.carousel.css') }}>
    <link rel="stylesheet" href={{ asset('templates/client/css/owl.theme.css') }}>
    <link rel="stylesheet" href={{ asset('templates/client/css/owl.transitions.css') }}>
    <!-- jquery-ui CSS
        ============================================ -->
    <link rel="stylesheet" href={{ asset('templates/client/css/jquery-ui.css') }}>
    <!-- meanmenu CSS
        ============================================ -->
    <link rel="stylesheet" href={{ asset('templates/client/css/meanmenu.min.css') }}>
    <!-- nivoslider CSS
        ============================================ -->
    <link rel="stylesheet" href={{ asset('templates/client/lib/css/nivo-slider.css') }}>
    <link rel="stylesheet" href={{ asset('templates/client/lib/css/preview.css') }}>
    <!-- animate CSS
        ============================================ -->
    <link rel="stylesheet" href={{ asset('templates/client/css/animate.css') }}>
    <!-- magic CSS
        ============================================ -->
    <link rel="stylesheet" href={{ asset('templates/client/css/magic.css') }}>
    <!-- normalize CSS
        ============================================ -->
    <link rel="stylesheet" href={{ asset('templates/client/css/normalize.css') }}>
    <!-- main CSS
        ============================================ -->
    <link rel="stylesheet" href={{ asset('templates/client/css/main.css') }}>
    <!-- style CSS
        ============================================ -->
    <link rel="stylesheet" href={{ asset('templates/client/style.css') }}>
    <!-- responsive CSS
        ============================================ -->
    <link rel="stylesheet" href={{ asset('templates/client/css/responsive.css') }}>
    <!-- modernizr JS
        ============================================ -->
    <script src={{ asset('templates/client/js/vendor/modernizr-2.8.3.min.js') }}></script>


    <style>
        .message-container {
            position: fixed;
            top: 20px;
            right: 20px;
            max-width: 300px;
            z-index: 99999;
            overflow: hidden;
        }

        .message {
            background-color: #4CAF50;
            color: white;
            padding: 16px;
            border-radius: 4px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 10px;
            transform: translateX(100%);
            opacity: 1;
            transition: transform 0.5s ease, opacity 0.5s ease;
        }

        .message.show {
            transform: translateX(0);
            opacity: 1;
        }

        .message.hide {
            transform: translateX(100%);
            opacity: 0;
        }


        ul.cart-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        ul.cart-list li {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .cart-img {
            width: 50px;
            height: 50px;
            overflow: hidden;
            flex-shrink: 0;
            border-radius: 4px;
        }

        .cart-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .cart-details {
            flex: 1;
            padding-left: 10px;
        }

        .cart-details a {
            font-weight: bold;
            color: #fff;
            text-decoration: none;
            display: block;
            margin-bottom: 4px;
        }

        .cart-details a:hover {
            text-decoration: underline;
        }

        .cart-delete {
            padding-left: 10px;
            width: 10%;
            display: flex;
            justify-content: center;
        }

        .cart-delete button {
            cursor: pointer;
            background: none;
            border: none;
            color: #dc3545;
            font-size: 18px;
        }
    </style>
    @yield('style')
</head>

<body>

    <div class="message-container" id="messageContainer"></div>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <!-- Add your site or application content here -->
    @include('client.partials.header')


    @yield('content')





    <!-- quickview product start -->
    <div id="quickview-wrapper">
        <!-- Modal -->
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-product">
                            <div class="product-images">
                                <div class="main-image images">
                                    <img alt="" src="img/product/quick-view.jpg">
                                </div>
                            </div>

                            <div class="product-info">
                                <h1>Diam quis cursus</h1>
                                <div class="price-box">
                                    <p class="price"><span class="special-price"><span
                                                class="amount">$132.00</span></span></p>
                                </div>
                                <a href="shop.html" class="see-all">See all features</a>
                                <div class="quick-add-to-cart">
                                    <form method="post" class="cart">
                                        <div class="numbers-row">
                                            <input type="number" id="french-hens" value="3">
                                        </div>
                                        <button class="single_add_to_cart_button" type="submit">Add to cart</button>
                                    </form>
                                </div>
                                <div class="quick-desc">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec
                                        est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare
                                        lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus
                                        eu, suscipit id nulla.</p>
                                </div>
                                <div class="share-post">
                                    <div class="share-title">
                                        <h3>share this product</h3>
                                    </div>
                                    <div class="share-social">
                                        <ul>
                                            <li><a href="#"> <i class="fa fa-facebook"></i> </a></li>
                                            <li><a href="#"> <i class="fa fa-twitter"></i> </a></li>
                                            <li><a href="#"> <i class="fa fa-pinterest"></i> </a></li>
                                            <li><a href="#"> <i class="fa fa-google-plus"></i> </a></li>
                                            <li><a href="#"> <i class="fa fa-linkedin"></i> </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Thông Báo -->
        <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center p-4">
                    <div class="modal-body">
                        <!-- Icon Checkmark -->
                        <div class="d-flex justify-content-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="green"
                                class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                <path
                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM12.03 5.97a.75.75 0 0 0-1.06 0L7 9.94 5.03 7.97a.75.75 0 1 0-1.06 1.06l2.5 2.5a.75.75 0 0 0 1.06 0l4.5-4.5a.75.75 0 0 0 0-1.06z" />
                            </svg>
                        </div>
                        <h5 class="modal-title mb-3" id="notificationModalLabel">Thành Công!</h5>
                        <p id="notificationModalBody">Sản phẩm đã được thêm vào giỏ hàng.</p>
                    </div>
                </div>
            </div>
        </div>


        @if (session('verify'))
            <!-- Modal -->
            <div class="modal fade" id="verifyModal" tabindex="-1" aria-labelledby="verifyModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            {{ session('message') ?? 'Tài khoản của bạn chưa được xác thực' }}
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('verification.notice') }}" class="btn btn-danger">Xác thực ngay</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                id="cancelButton">Hủy</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif


        <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true"
            id="add-to-cart-form">
            <form method="POST" id="add-to-cart-api">
                @csrf
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header-1">
                            <h5 class="modal-title" id="cartModalLabel">Sản phẩm</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex align-items-start gap-4">
                                <input type="hidden" name="product_id" id="product-id-modal" value="">
                                <img src="img/default-image.jpg" alt="Ảnh sản phẩm" id="product-image-modal"
                                    class="img-fluid product-img-modal">

                                <div class="flex-grow-1">
                                    <h5 id="product-name-modal" class="fw-bold mb-2">Tên sản phẩm</h5>
                                    <div class="d-flex align-items-end">
                                        <p id="product-price-modal" class="text-secondary small fw-semibold "
                                            style="text-decoration: line-through"></p>
                                        <p id="product-price-sale-modal" class="text-danger fw-bold"></p>
                                    </div>
                                    <div class="">
                                        <p class="small" id="product-quantity-modal">Còn 0 sản phẩm</p>
                                    </div>

                                    <div class="mb-3">
                                        <!-- Chọn màu sắc -->
                                        <label class="form-label fw-medium">Màu sắc:</label>
                                        <input type="hidden" id="color-for-cart" name="color" value="">
                                        <div class="d-flex flex-wrap gap-3 mb-3" id="color-options">

                                        </div>

                                        <!-- Chọn kích cỡ -->
                                        <label class="form-label fw-medium">Kích cỡ:</label>
                                        <input type="hidden" id="size-for-cart" name="size" value="">
                                        <div class="d-flex flex-wrap gap-3" id="size-options">

                                        </div>
                                    </div>

                                    <p id="error-modal" class="text-danger" style="font-size: 13px"></p>
                                    <!-- Chọn số lượng -->
                                    <div>
                                        <label for="quantity" class="form-label fw-medium">Số lượng:</label>
                                        <input type="number" id="quantity" name="quantity"
                                            class="form-control w-25" value="1" min="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary px-4">Thêm vào giỏ hàng</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- quickview product start -->
    @include('client.partials.footer')
    <!-- jquery
        ============================================ -->
    <script src={{ asset('templates/client/js/vendor/jquery-1.12.4.min.js') }}></script>
    <!-- bootstrap JS
        ============================================ -->
    <script src={{ asset('templates/client/js/bootstrap.min.js') }}></script>
    <!-- wow JS
        ============================================ -->
    <script src={{ asset('templates/client/js/wow.min.js') }}></script>
    <!-- price-slider JS
        ============================================ -->
    <script src={{ asset('templates/client/js/jquery-price-slider.js') }}></script>
    <!-- nivoslider JS
        ============================================ -->
    <script src={{ asset('templates/client/lib/js/jquery.nivo.slider.js') }}></script>
    <script src={{ asset('templates/client/lib/home.js') }}></script>
    <!-- meanmenu JS
        ============================================ -->
    <script src={{ asset('templates/client/js/jquery.meanmenu.js') }}></script>
    <!-- owl.carousel JS
        ============================================ -->
    <script src={{ asset('templates/client/js/owl.carousel.min.js') }}></script>
    <!-- elevatezoom JS
        ============================================ -->
    <script src={{ asset('templates/client/js/jquery.elevatezoom.js') }}></script>
    <!-- scrollUp JS
        ============================================ -->
    <script src={{ asset('templates/client/js/jquery.scrollUp.min.js') }}></script>
    <!-- plugins JS
        ============================================ -->
    <script src={{ asset('templates/client/js/plugins.js') }}></script>
    <!-- main JS
        ============================================ -->
    <script src={{ asset('templates/client/js/main.js') }}></script>


    @yield('script')

    <script>
        function showMessage(message, bgColor) {
            // Lấy nội dung từ input nếu không có tham số message
            if (!message) {
                message = document.getElementById('messageInput').value;
            }

            // Kiểm tra kiểu dữ liệu
            if (typeof message !== 'string') {
                console.error('Lỗi: Nội dung thông báo phải là chuỗi');
                return;
            }

            // Tạo phần tử thông báo
            const messageElement = document.createElement('div');
            messageElement.className = 'message';
            messageElement.textContent = message;

            // Gán màu nền nếu có truyền vào
            if (bgColor && typeof bgColor === 'string') {
                messageElement.style.backgroundColor = bgColor;
            }

            // Thêm vào container
            const container = document.getElementById('messageContainer');
            container.appendChild(messageElement);

            // Hiệu ứng xuất hiện
            setTimeout(() => {
                messageElement.classList.add('show');
            }, 10);

            // Ẩn sau 2.5s
            setTimeout(() => {
                messageElement.classList.add('hide');
                messageElement.classList.remove('show');
            }, 1000000);

            // Xóa sau 3s
            setTimeout(() => {
                container.removeChild(messageElement);
            }, 1000000);
        }

        const routes = {
            cart: '/cart',
            product: '/detail/:slug',
        };

        function renderCart(data) {
            const cartItems = data.items || [];
            const cartCount = data.cartCount || 0;
            const subTotal = data.subTotal || 0;
            const cartList = document.getElementById('cart-items-header');
            const cartCountElement = document.getElementById('cart-count-header');
            const subtotalElement = document.getElementById('subtotal-header');

            // Clear existing items
            cartList.innerHTML = '';

            // Render each cart item
            cartItems.forEach(item => {

                const imageUrl = item.productVariant.image || "asset('/img/default-image.jpg')";
                const productName = item.productVariant.product.name.length > 18 ?
                    item.productVariant.product.name.substring(0, 18) + '...' :
                    item.productVariant.product.name;
                const productUrl = routes.product.replace(':slug', item.productVariant.product.slug);

                const li = document.createElement('li');
                li.innerHTML = `
                    <div class="cart-img"  style="width: 50px; height: 50px; overflow:hidden">
                        <img src="${imageUrl}" alt="${item.productVariant.product.name}" style="height: 100%; width: 100%; object-fit: cover;">
                    </div>
                    <div class="cart-details" style="width: 161px">
                        <a href="${productUrl}" title="${item.productVariant.product.name}">
                            ${productName}
                        </a>
                        <p>${item.quantity} x ${item.productVariant.price.toLocaleString('vi-VN')} VND</p>
                        <p>${item.productVariant.size.size} x ${item.productVariant.color.color}</p>
                    </div>
                    <div class="d-flex">
                        <button class="btn btn-link p-0 border-0 text-danger delete-btn" data-id="${item.id}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                `;
                cartList.appendChild(li);
            });

            // Render "Xem thêm" link if cartCount > 2
            if (cartCount > 2) {
                const viewMore = document.createElement('a');
                viewMore.href = routes.cart;
                viewMore.className = 'small text-white';
                viewMore.textContent = 'Xem thêm';
                cartList.appendChild(viewMore);
            }

            // Update cart count and subtotal
            cartCountElement.textContent = cartCount;
            subtotalElement.textContent = `${subTotal.toLocaleString('vi-VN')} VND`;

            // Add event listeners for delete buttons
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', () => deleteCartItem(button.dataset.id));
            });
        }

        async function fetchCart() {
            try {
                const response = await fetch('/api/get-cart', {
                    headers: {
                        'Accept': 'application/json',
                    },
                });
                if (!response.ok) throw new Error('Failed to fetch cart');
                const data = await response.json();
                renderCart(data);
            } catch (error) {
                console.error('Error fetching cart:', error);
                document.getElementById('cart-items').innerHTML = '<li>Không thể tải giỏ hàng</li>';
            }
        }

        async function deleteCartItem(id) {

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                const response = await fetch(`/api/cart/delete/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                });
                if (!response.ok) throw new Error('Failed to delete item');
                fetchCart();
            } catch (error) {
                console.error('Error deleting item:', error);
                alert('Không thể xóa sản phẩm');
            }

        }

        fetchCart();
        
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var verifyModal = new bootstrap.Modal(document.getElementById('verifyModal'));

            // Show the modal if it's set in session
            verifyModal.show();

            // Add event listener to 'Hủy' button to remove session
            document.getElementById('cancelButton').addEventListener('click', function() {
                // Gửi yêu cầu Ajax để xóa session
                fetch("{{ route('clear.verify.session') }}", {
                        method: "POST",
                        headers: {
                            "X-Requested-With": "XMLHttpRequest",
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            action: 'clear'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Đóng modal khi xóa session thành công
                            verifyModal.hide();
                        }
                    });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.wishlist-action').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault(); // Ngăn chặn load lại trang

                    let productId = this.getAttribute('data-id');

                    fetch('/wishlist/toggle', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                product_id: productId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.redirect) {
                                window.location.href = data
                                    .redirect; // Chuyển hướng đến trang wishlist
                            } else {
                                alert(data.message); // Hiển thị thông báo khi thêm thành công
                            }
                        })
                        .catch(error => console.error('Lỗi:', error));
                });
            });
        });
    </script>


</body>

<!-- Mirrored from htmldemo.net/james/james/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 18 Jan 2025 15:49:49 GMT -->

</html>

<!doctype html>
<html class="no-js" lang="">

<!-- Mirrored from htmldemo.net/james/james/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 18 Jan 2025 15:49:29 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Home || James </title>
    <meta name="description" content="">
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
    <link rel="stylesheet" href={{asset("templates/client/css/bootstrap.min.css")}}>
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href={{asset("templates/client/css/font-awesome.min.css")}}>
    <!-- owl.carousel CSS
        ============================================ -->
    <link rel="stylesheet" href={{asset("templates/client/css/owl.carousel.css")}}>
    <link rel="stylesheet" href={{asset("templates/client/css/owl.theme.css")}}>
    <link rel="stylesheet" href={{asset("templates/client/css/owl.transitions.css")}}>
    <!-- jquery-ui CSS
        ============================================ -->
    <link rel="stylesheet" href={{asset("templates/client/css/jquery-ui.css")}}>
    <!-- meanmenu CSS
        ============================================ -->
    <link rel="stylesheet" href={{asset("templates/client/css/meanmenu.min.css")}}>
    <!-- nivoslider CSS
        ============================================ -->
    <link rel="stylesheet" href={{asset("templates/client/lib/css/nivo-slider.css")}}>
    <link rel="stylesheet" href={{asset("templates/client/lib/css/preview.css")}}>
    <!-- animate CSS
        ============================================ -->
    <link rel="stylesheet" href={{asset("templates/client/css/animate.css")}}>
    <!-- magic CSS
        ============================================ -->
    <link rel="stylesheet" href={{asset("templates/client/css/magic.css")}}>
    <!-- normalize CSS
        ============================================ -->
    <link rel="stylesheet" href={{asset("templates/client/css/normalize.css")}}>
    <!-- main CSS
        ============================================ -->
    <link rel="stylesheet" href={{asset("templates/client/css/main.css")}}>
    <!-- style CSS
        ============================================ -->
    <link rel="stylesheet" href={{asset("templates/client/style.css")}}>
    <!-- responsive CSS
        ============================================ -->
    <link rel="stylesheet" href={{asset("templates/client/css/responsive.css")}}>
    <!-- modernizr JS
        ============================================ -->
    <script src={{asset("templates/client/js/vendor/modernizr-2.8.3.min.js")}}></script>

    @yield('css')
</head>

<body>
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
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                                    <p class="price"><span class="special-price"><span class="amount">$132.00</span></span></p>
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
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Donec non est at libero vulputate rutrum. Morbi ornare lectus quis justo gravida semper. Nulla tellus mi, vulputate adipiscing cursus eu, suscipit id nulla.</p>
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
    </div>
    <!-- quickview product start -->
    @include('client.partials.footer')
    <!-- src -->
    {{-- @if(session('error'))   
    <div id="custom-alert" class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 1000; display: none;color:red">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill me-2" viewBox="0 0 16 16">
            <path d="M7.938 2.016a.13.13 0 0 1 .125 0c.02.01.037.025.052.043l6.857 10.586c.066.102.075.23.025.34a.248.248 0 0 1-.222.136H1.225a.248.248 0 0 1-.222-.136.277.277 0 0 1 .025-.34L7.885 2.06a.146.146 0 0 1 .052-.043ZM8 5a.905.905 0 0 0-.9 1l.35 4.2a.55.55 0 0 0 1.1 0L8.9 6A.905.905 0 0 0 8 5Zm-.9 7.5a.9.9 0 1 0 1.8 0 .9.9 0 0 0-1.8 0Z" />
        </svg>
        <span id="alert-message">User không có quyền truy cập admin </span>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let alertBox = document.getElementById("custom-alert");
            if (alertBox) {
                alertBox.style.display = "block";
                setTimeout(() => {
                    let bsAlert = new bootstrap.Alert(alertBox);
                    bsAlert.close();
                }, 2000);
            }
        });
    </script>
    @endif --}}
    <!-- jquery
        ============================================ -->
    <script src={{asset("templates/client/js/vendor/jquery-1.12.4.min.js")}}></script>
    <!-- bootstrap JS
        ============================================ -->
    <script src={{asset("templates/client/js/bootstrap.min.js")}}></script>
    <!-- wow JS
        ============================================ -->
    <script src={{asset("templates/client/js/wow.min.js")}}></script>
    <!-- price-slider JS
        ============================================ -->
    <script src={{asset("templates/client/js/jquery-price-slider.js")}}></script>
    <!-- nivoslider JS
        ============================================ -->
    <script src={{asset("templates/client/lib/js/jquery.nivo.slider.js")}}></script>
    <script src={{asset("templates/client/lib/home.js")}}></script>
    <!-- meanmenu JS
        ============================================ -->
    <script src={{asset("templates/client/js/jquery.meanmenu.js")}}></script>
    <!-- owl.carousel JS
        ============================================ -->
    <script src={{asset("templates/client/js/owl.carousel.min.js")}}></script>
    <!-- elevatezoom JS
        ============================================ -->
    <script src={{asset("templates/client/js/jquery.elevatezoom.js")}}></script>
    <!-- scrollUp JS
        ============================================ -->
    <script src={{asset("templates/client/js/jquery.scrollUp.min.js")}}></script>
    <!-- plugins JS
        ============================================ -->
    <script src={{asset("templates/client/js/plugins.js")}}></script>
    <!-- main JS
        ============================================ -->
    <script src={{asset("templates/client/js/main.js")}}></script>
    

    @yield('script')
   
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.wishlist-action').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault(); // Ngăn chặn load lại trang

                let productId = this.getAttribute('data-id');

                fetch('/wishlist/toggle', {
                    method: 'POST',
                    headers: { 
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ product_id: productId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.redirect) {
                        window.location.href = data.redirect; // Chuyển hướng đến trang wishlist
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

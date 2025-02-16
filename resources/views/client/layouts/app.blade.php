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

        @yield('style')
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
    </body>

<!-- Mirrored from htmldemo.net/james/james/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 18 Jan 2025 15:49:49 GMT -->
</html>

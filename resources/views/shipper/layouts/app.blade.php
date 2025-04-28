<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Aug 2024 07:44:28 GMT -->

<head>

    <meta charset="utf-8" />
    <title>@yield('title') | WalkOn - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('templates/admin/assets/images/favicon.ico') }}">

    @yield('style')
    <link href="{{ asset('templates/admin/assets/libs/toast/toast.css') }}" rel="stylesheet">




    <!-- jsvectormap css -->
    <link href="{{ asset('templates/admin/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!--Swiper slider css-->
    <link href="{{ asset('templates/admin/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Layout config Js -->
    <script src="{{ asset('templates/admin/assets/js/layout.js') }}"></script>



    <!-- Bootstrap Css -->
    <link href="{{ asset('templates/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('templates/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('templates/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('templates/admin/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Thêm jQuery và DataTables JS -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('templates/admin/assets/libs/jquery/jquery.dataTables.min.css') }}">
    <script src="{{ asset('templates/admin/assets/libs/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('templates/admin/assets/libs/jquery/jquery.dataTables.min.js') }}"></script>
</head>

<body>


    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('admin.layouts.partials.header')



        <!-- removeNotificationModal -->
        <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="NotificationModalbtn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-2 text-center">
                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                            <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                <h4>Bạn có chắc không ?</h4>
                                <p class="text-muted mx-4 mb-0">Bạn có chắc muốn xóa thông báo này không ?</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Đóng</button>
                            <button type="button" class="btn w-sm btn-danger" id="delete-notification">Xóa</button>
                        </div>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- ========== App Menu ========== -->
        @include('admin.layouts.partials.sidebar')
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">


            @yield('content')
            <!-- End Page-content -->
            <!-- Hiển thị nếu tồn tại session -->
            @if (session()->has('success'))
                <div id="success-toast" class="toast-notification success">
                    <span>{{ session('success') }}</span>
                    <button class="close-toast">&times;</button>
                </div>
            @endif

            @if (session()->has('error'))
                <div id="error-toast" class="toast-notification error">
                    <span>{{ session('error') }}</span>
                    <button class="close-toast">&times;</button>
                </div>
            @endif

            @include('admin.layouts.partials.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <div class="customizer-setting d-none d-md-block">
        <div class="btn-info rounded-pill shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas"
            data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
            <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
        </div>
    </div>

    <!-- Theme Settings -->

    <!-- JAVASCRIPT -->

    <script src="{{ asset('templates/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('templates/admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('templates/admin/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('templates/admin/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('templates/admin/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('templates/admin/assets/js/plugins.js') }}"></script>


    <!-- apexcharts -->
    <script src="{{ asset('templates/admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ asset('templates/admin/assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('templates/admin/assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!--Swiper slider js-->
    <script src="{{ asset('templates/admin/assets/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Dashboard init -->
    <script src="{{ asset('templates/admin/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
    <script src="{{ asset('templates/admin/assets/libs/toast/toast.js') }}"></script>



    @yield('script')

    <!-- App js -->
    <script src="{{ asset('templates/admin/assets/js/app.js') }}"></script>


</body>

</html>

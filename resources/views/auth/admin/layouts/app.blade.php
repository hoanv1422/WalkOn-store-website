<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/auth-signin-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Aug 2024 07:46:58 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Sign In | WalkOn - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('templates/admin/assets/images/favicon.ico') }}">

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
    </style>
</head>

<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <div class="message-container" id="messageContainer"></div>

        @yield('content')

        @include('auth.admin.components.footer')

    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->

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
            }, 2500);

            // Xóa sau 3s
            setTimeout(() => {
                container.removeChild(messageElement);
            }, 3000);
        }
    </script>
    <script src="{{ asset('templates/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('templates/admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('templates/admin/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('templates/admin/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('templates/admin/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('templates/admin/assets/js/plugins.js') }}"></script>

    <!-- particles js -->
    <script src="{{ asset('templates/admin/assets/libs/particles.js/particles.js') }}"></script>
    <!-- particles app js -->
    <script src="{{ asset('templates/admin/assets/js/pages/particles.app.js') }}"></script>
    <!-- password-addon init -->
    <script src="{{ asset('templates/admin/assets/js/pages/password-addon.init.js') }}"></script>

    @yield('script')
</body>


<!-- Mirrored from themesbrand.com/velzon/html/master/auth-signin-basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Aug 2024 07:46:58 GMT -->

</html>

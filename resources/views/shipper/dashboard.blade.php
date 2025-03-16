<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ shipper  </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    .navbar-scroll .nav-link,
    .navbar-scroll .navbar-toggler-icon,
    .navbar-scroll .navbar-brand {
        color: #262626;
    }

    .navbar-scroll {
        background-color: #FFC017;
    }

    .navbar-scrolled .nav-link,
    .navbar-scrolled .navbar-toggler-icon,
    .navbar-scroll .navbar-brand {
        color: #262626;
    }

    .navbar-scrolled {
        background-color: #fff;
    }

    .navbar.navbar-scroll.navbar-scrolled {
        padding-top: auto;
        padding-bottom: auto;
    }

    .navbar-brand {
        font-size: unset;
        height: 3.5rem;
    }

    body {
        background: linear-gradient(135deg, #00c6ff, #0072ff);
        color: white;
        text-align: center;
        font-family: Arial, sans-serif;
    }

    .hero {
        padding: 80px 20px;
    }

    .hero h1 {
        font-size: 3rem;
        font-weight: bold;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
    }

    .btn-custom {
        background: #ff7300;
        color: white;
        padding: 12px 25px;
        font-size: 1.2rem;
        border-radius: 50px;
        transition: 0.3s;
    }

    .btn-custom:hover {
        background: #ff5200;
    }
</style>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#"><i class="fab fa-linkedin fa-2x"></i></a>
                <form class="input-group" style="width: 400px">
                    <input type="search" class="form-control" placeholder="Nhập thứ cần tìm" aria-label="Search" />
                    <button class="btn btn-outline-primary" type="button" data-mdb-ripple-init data-mdb-ripple-color="dark" style="padding: .45rem 1.5rem .35rem;">
                        Tìm kiếm
                    </button>
                </form>
                <button class="navbar-toggler" type="button" data-mdb-collapse-init
                    data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link d-flex flex-column text-center active" href="#">
                                <i class="fas fa-home fa-lg my-2"></i><span class="small">Trang chủ</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex flex-column text-center" href="#">
                                <i class="fas fa-briefcase fa-lg my-2"></i><span class="small">Công việc</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex flex-column text-center" href="#">
                                <i class="fas fa-comment-dots fa-lg my-2"></i><span class="small">Tin nhắn</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link d-flex flex-column text-center" href="#">
                                <i class="fas fa-bell fa-lg my-2"></i><span class="small">Thông báo</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="avatar1.png"
                                    class="rounded-circle" height="30" alt="" loading="lazy" style="margin-top:10px" />
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Tài khoản của tôi</a></li>
                                <li><a class="dropdown-item" href="#">Cài đặt</a></li>
                                <li>
                                    <form action="{{ route('shipper.logout') }}" method="POST" class="dropdown-item p-0">
                                        @csrf
                                        <button type="submit" class="btn btn-link text-danger w-100 text-start">Đăng xuất</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <header class="hero">
            <h1>🚚 Chào mừng {{ Auth::user()->name }}!! đến với trang Shipper</h1>
            <p class="lead">Nơi kết nối tài xế và khách hàng một cách dễ dàng và nhanh chóng.</p>
            <a href="#" class="btn btn-custom mt-3">Bắt đầu ngay</a>
        </header>
    </div>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

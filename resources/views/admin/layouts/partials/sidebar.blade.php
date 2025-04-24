<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('admin.index') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('templates/admin/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('templates/admin/assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('admin.index') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('templates/admin/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('templates/admin/assets/images/logo-admin.png') }}" alt="" height="35">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div class="dropdown sidebar-user m-1 rounded">
        <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <span class="d-flex align-items-center gap-2">
                <img class="rounded header-profile-user"
                    src="{{ asset('templates/admin/assets/images/users/avatar-1.jpg') }}" alt="Header Avatar">
                <span class="text-start">
                    <span class="d-block fw-medium sidebar-user-name-text">Anna Adame</span>
                    <span class="d-block fs-14 sidebar-user-name-sub-text"><i
                            class="ri ri-circle-fill fs-10 text-success align-baseline"></i> <span
                            class="align-middle">Online</span></span>
                </span>
            </span>
        </button>
        <div class="dropdown-menu dropdown-menu-end">
            <!-- item-->
            <h6 class="dropdown-header">Welcome Anna!</h6>
            <a class="dropdown-item" href="pages-profile.html"><i
                    class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                    class="align-middle">Profile</span></a>
            <a class="dropdown-item" href="apps-chat.html"><i
                    class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i> <span
                    class="align-middle">Messages</span></a>
            <a class="dropdown-item" href="apps-tasks-kanban.html"><i
                    class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i> <span
                    class="align-middle">Taskboard</span></a>
            <a class="dropdown-item" href="pages-faqs.html"><i
                    class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span
                    class="align-middle">Help</span></a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="pages-profile.html"><i
                    class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Balance :
                    <b>$5971.67</b></span></a>
            <a class="dropdown-item" href="pages-profile-settings.html"><span
                    class="badge bg-success-subtle text-success mt-1 float-end">New</span><i
                    class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span
                    class="align-middle">Settings</span></a>
            <a class="dropdown-item" href="auth-lockscreen-basic.html"><i
                    class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Lock
                    screen</span></a>
            <a class="dropdown-item" href="auth-logout-basic.html"><i
                    class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle"
                    data-key="t-logout">Logout</span></a>
        </div>
    </div>
    <div id="scrollbar">
        <div class="container-fluid">


            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
    <!-- Tiêu đề Menu: Bảng Điều Khiển -->
    <li class="menu-title"><span data-key="t-menu">Menu</span></li>
    <li class="nav-item">
        <a class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"
            aria-expanded="false" aria-controls="sidebarDashboards">
            <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Bảng Điều Khiển</span>
        </a>
        <div class="collapse menu-dropdown" id="sidebarDashboards">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a href="dashboard-analytics.html" class="nav-link" data-key="t-analytics">Phân Tích</a>
                </li>
                <li class="nav-item">
                    <a href="dashboard-crm.html" class="nav-link" data-key="t-crm">Quản Lý Khách Hàng</a>
                </li>
                <li class="nav-item">
                    <a href="index.html" class="nav-link" data-key="t-ecommerce">Thương Mại Điện Tử</a>
                </li>
            </ul>
        </div>
    </li>

    <!-- Tiêu đề Menu: Thương Mại Điện Tử -->
    <li class="nav-item">
        <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button"
            aria-expanded="false" aria-controls="sidebarApps">
            <i class="ri-apps-2-line"></i> <span data-key="t-apps">Thương Mại Điện Tử</span>
        </a>
        <div class="collapse menu-dropdown" id="sidebarApps">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a href="{{route('categories.index')}}" class="nav-link" data-key="t-category">Danh Mục</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('brands.index')}}" class="nav-link" data-key="t-brand">Thương Hiệu</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('attributes.index')}}" class="nav-link" data-key="t-attributes">Thuộc Tính</a>
                </li>
                <li class="nav-item">
                    <a href="#sidebarEcommerce" class="nav-link" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarEcommerce" data-key="t-ecommerce">Sản Phẩm</a>
                    <div class="collapse menu-dropdown" id="sidebarEcommerce">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('products.index')}}" class="nav-link" data-key="t-products">Danh Sách Sản Phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('products.create')}}" class="nav-link" data-key="t-product-create">Tạo Sản Phẩm</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{route('coupons.index')}}" class="nav-link" data-key="t-coupons">Mã Giảm Giá</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('inventory.index')}}" class="nav-link" data-key="t-inventories">Kho Hàng</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('orders.index')}}" class="nav-link" data-key="t-orders">Đơn Hàng</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('users.index')}}" class="nav-link" data-key="t-user">Người Dùng</a>
                </li>
            </ul>
        </div>
    </li>

    <!-- Tiêu đề Menu: Quản Lý Trang -->
    <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Quản Lý Trang</span></li>
    <li class="nav-item">
        <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button"
            aria-expanded="false" aria-controls="sidebarAuth">
            <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Xác Thực</span>
        </a>
        <div class="collapse menu-dropdown" id="sidebarAuth">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a href="auth-signin-basic.html" class="nav-link" data-key="t-signin">Đăng Nhập</a>
                </li>
                <li class="nav-item">
                    <a href="auth-signup-basic.html" class="nav-link" data-key="t-signup">Đăng Ký</a>
                </li>
                <li class="nav-item">
                    <a href="auth-pass-reset-basic.html" class="nav-link" data-key="t-password-reset">Đặt Lại Mật Khẩu</a>
                </li>
                <li class="nav-item">
                    <a href="auth-logout-basic.html" class="nav-link" data-key="t-logout">Đăng Xuất</a>
                </li>
            </ul>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link menu-link" href="#sidebarPages" data-bs-toggle="collapse" role="button"
            aria-expanded="false" aria-controls="sidebarPages">
            <i class="ri-pages-line"></i> <span data-key="t-pages">Trang</span>
        </a>
        <div class="collapse menu-dropdown" id="sidebarPages">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a href="pages-profile.html" class="nav-link" data-key="t-profile">Hồ Sơ</a>
                </li>
                <li class="nav-item">
                    <a href="pages-faqs.html" class="nav-link" data-key="t-faqs">Câu Hỏi Thường Gặp</a>
                </li>
                <li class="nav-item">
                    <a href="pages-pricing.html" class="nav-link" data-key="t-pricing">Bảng Giá</a>
                </li>
            </ul>
        </div>
    </li>
</ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>

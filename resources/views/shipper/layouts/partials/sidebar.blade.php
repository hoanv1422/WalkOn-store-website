<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('shippers.index') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('img/image-Photoroom.png') }}" alt="" height="50">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('img/image-Photoroom.png') }}" alt="" height="40">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('admin.index') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('img/image-Photoroom.png') }}" alt="" height="50">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('img/image-Photoroom.png') }}" alt="" height="40">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>
    <!-- Sidebar -->

    <div class="sidebar-background"></div>
</div>

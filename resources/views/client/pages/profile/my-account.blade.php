<div class="account-area py-5">
    <!-- Thông báo  -->
    <div id="notification" class="container mb-4">
        @if (session('success') || session('error'))
            <div class="row justify-content-end">
                <div class="col-lg-4 col-md-5 col-sm-6">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show shadow border border-success-subtle rounded-3"
                            role="alert">
                            <i class="fa fa-check-circle me-2 text-success"></i>
                            <strong class="fw-bold text-success">Thành công!</strong>
                            <span class="ms-1">{{ session('success') }}</span>
                            @if (session('updatedFields'))
                                <ul class="mt-2 mb-0 ps-4 list-unstyled">
                                    @foreach (session('updatedFields') as $field)
                                        <li class="d-flex align-items-center">
                                            <i class="fa fa-check me-2 text-success"></i>
                                            <span>{{ $field }} đã được cập nhật.</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show shadow border border-danger-subtle rounded-3"
                            role="alert">
                            <i class="fa fa-exclamation-circle me-2 text-danger"></i>
                            <strong class="fw-bold text-danger">Lỗi!</strong>
                            <span class="ms-1">{{ session('error') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                    <div class="card-body p-0">
                        <div class="text-center p-4 bg-light">
                            <div class="sidebar-avatar-container">
                                <img id="sidebar-avatar"
                                    src="{{ $user->avatar ? Storage::url($user->avatar) : asset('default-avatar.png') }}"
                                    alt="Avatar" class="rounded-circle img-fluid">
                            </div>
                            <h5 id="sidebar-name" class="fw-bold mb-1 mt-3">{{ $user->name }}</h5>
                            <p class="text-muted small mb-0">{{ $user->email }}</p>
                        </div>
                        <div class="list-group list-group-flush">
                            <a href="{{ route('profile.index') }}"
                                class="list-group-item list-group-item-action active d-flex align-items-center">
                                <i class="fa fa-user me-3"></i> Thông tin cá nhân
                            </a>
                            <a href="{{ route('profile.orders') }}"
                                class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="fa fa-list-ol me-3"></i> Đơn hàng của bạn
                            </a>
                            <a href="{{ route('home.index') }}"
                                class="list-group-item list-group-item-action d-flex align-items-center">
                                <i class="fa fa-home me-3"></i> Trang chủ
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <div class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-1">Hồ Sơ Của Tôi</h4>
                        <p class="text-muted mb-4">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                        <hr class="my-4">

                        <form id="profile-update-form" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-8">
                                    <!-- Thông tin người dùng -->
                                    <div class="mb-4 row align-items-center">
                                        <label for="username"
                                            class="col-sm-4 col-form-label fw-medium text-secondary">Tên đăng
                                            nhập</label>
                                        <div class="col-sm-8">
                                            <div class="readonly-field-container">
                                                <input type="text" class="form-control-plaintext fw-medium"
                                                    id="username" value="{{ $user->username }}" readonly>
                                                <div class="readonly-badge">
                                                    <i class="fa fa-lock me-1"></i>Không thể sửa
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label for="name"
                                            class="col-sm-4 col-form-label fw-medium text-secondary">Tên</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control bg-white" id="name"
                                                name="name" value="{{ $user->name }}">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label for="email"
                                            class="col-sm-4 col-form-label fw-medium text-secondary">Email</label>
                                        <div class="col-sm-8">
                                            <div class="readonly-field-container">
                                                <input type="email" class="form-control-plaintext fw-medium"
                                                    id="email" value="{{ $user->email }}" readonly>
                                                <div class="readonly-badge">
                                                    <i class="fa fa-lock me-1"></i>Không thể sửa
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label for="phone"
                                            class="col-sm-4 col-form-label fw-medium text-secondary">Số điện
                                            thoại</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control bg-white" id="phone"
                                                name="phone" value="{{ $user->phone }}">
                                        </div>
                                    </div>

                                    <div class="mb-4 row">
                                        <label for="address"
                                            class="col-sm-4 col-form-label fw-medium text-secondary">Địa chỉ</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control bg-white address-field" id="address" name="address" rows="3">{{ $user->address }}</textarea>
                                            <small class="text-muted mt-1">Vui lòng nhập địa chỉ đầy đủ để thuận tiện
                                                cho việc giao hàng</small>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-8 offset-sm-4">
                                            <button type="submit" class="btn btn-primary px-4 py-2">Lưu</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 text-center">
                                    <div class="avatar-upload mb-3">
                                        <div class="avatar-container mb-3">
                                            <img id="avatar-preview"
                                                src="{{ $user->avatar ? Storage::url($user->avatar) : asset('default-avatar.png') }}"
                                                alt="Avatar">
                                        </div>

                                        <div class="d-grid">
                                            <label for="avatar" class="btn btn-outline-secondary">
                                                <i class="fa fa-camera me-2"></i>Chọn Ảnh
                                            </label>
                                            <input type="file" class="d-none" id="avatar" name="avatar"
                                                accept="image/*">
                                        </div>
                                        <p class="small text-muted mt-2">
                                            Dung lượng file tối đa 1 MB<br>
                                            Định dạng: JPEG, PNG
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS tối ưu hóa -->
<style>
    .account-area {
        background-color: #ffffff;
        min-height: 100vh;
        padding: 30px 0;
    }

    .card {
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05) !important;
        border-radius: 8px !important;
    }

    .form-control {
        border: 1px solid #e0e0e0;
        padding: 0.6rem 0.75rem;
        border-radius: 6px;
        transition: all 0.2s ease;
        color: #333;
        background-color: #f9f9f9;
    }

    .form-control:focus {
        border-color: #aaaaaa;
        box-shadow: 0 0 0 0.2rem rgba(170, 170, 170, 0.15);
        background-color: #ffffff;
    }

    .form-control-plaintext {
        color: #333333;
        background-color: transparent;
        border: none;
        padding-left: 0;
        font-weight: 500;
    }

    .readonly-field-container {
        position: relative;
        padding-bottom: 20px;
    }

    .readonly-badge {
        position: absolute;
        bottom: 0;
        left: 0;
        font-size: 12px;
        color: #777;
        background-color: #f5f5f5;
        padding: 2px 8px;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
    }

    .address-field {
        background-color: #f9f9f9;
        border: 1px solid #e0e0e0;
        border-left: 3px solid #666666;
        transition: all 0.2s ease;
    }

    .address-field:focus {
        background-color: #ffffff;
        border-left: 3px solid #333333;
    }

    /* Completely revised avatar styles */
    .avatar-container {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 160px;
        height: 160px;
        margin: 0 auto;
        border-radius: 50%;
        background-color: #f5f5f5;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border: 5px solid #fff;
    }

    .avatar-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    /* Sidebar avatar container */
    .sidebar-avatar-container {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100px;
        height: 100px;
        margin: 0 auto;
        border-radius: 50%;
        background-color: #f5f5f5;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border: 3px solid #fff;
    }

    .sidebar-avatar-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Add spacing between avatar containers */
    .avatar-container+.avatar-container,
    .sidebar-avatar-container+.sidebar-avatar-container {
        margin-top: 20px;
    }

    /* Increase spacing between form fields */
    .mb-4.row {
        margin-bottom: 2rem !important;
    }

    .btn-primary {
        background-color: #444444;
        border-color: #444444;
        padding: 0.5rem 1.5rem;
        font-weight: 500;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #333333;
        border-color: #333333;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-outline-secondary {
        border-color: #d1d1d1;
        color: #555555;
        background-color: #f9f9f9;
        border-radius: 6px;
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
    }

    .btn-outline-secondary:hover {
        background-color: #eeeeee;
        color: #333333;
        border-color: #bbbbbb;
    }

    hr {
        background-color: #e0e0e0;
        opacity: 0.6;
    }

    .text-secondary {
        color: #555555 !important;
    }

    .text-muted {
        color: #777777 !important;
    }

    .list-group-item-action.active {
        background-color: #f8f9fa;
        border-left: 3px solid #444444;
        color: #333;
        font-weight: 500;
    }

    @media (max-width: 767.98px) {
        .col-form-label {
            margin-bottom: 0.5rem;
            padding-bottom: 0;
        }

        .avatar-container {
            width: 130px;
            height: 130px;
        }

        .sidebar-avatar-container {
            width: 80px;
            height: 80px;
        }

        .card-body {
            padding: 1.25rem;
        }
    }
</style>

<!-- JavaScript để xử lý xem trước ảnh -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const avatarInput = document.getElementById('avatar');
        const avatarPreview = document.getElementById('avatar-preview');
        const sidebarAvatar = document.getElementById('sidebar-avatar');
        const sidebarName = document.getElementById('sidebar-name');
        const nameInput = document.getElementById('name');

        // Xử lý xem trước ảnh khi chọn file
        if (avatarInput) {
            avatarInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        avatarPreview.src = e.target.result;
                        sidebarAvatar.src = e.target.result;
                    };

                    reader.readAsDataURL(this.files[0]);
                }
            });
        }

        // Cập nhật tên trong sidebar khi thay đổi
        if (nameInput && sidebarName) {
            nameInput.addEventListener('input', function() {
                sidebarName.textContent = this.value;
            });
        }
    });
</script>

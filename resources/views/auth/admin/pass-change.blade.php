@extends('auth.admin.layouts.app')

@section('title', 'Thay Đổi Mật Khẩu')

@section('content')
    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-sm-5 mb-4 text-white-50">
                        <div>
                            <a href="index.html" class="d-inline-block auth-logo">
                                <img src="assets/images/logo-light.png" alt="" height="20">
                            </a>
                        </div>
                        <p class="mt-3 fs-15 fw-medium">Premium Admin & Dashboard Template</p>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4 card-bg-fill">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Tạo mật khẩu mới</h5>
                                <p class="text-muted">Mật khẩu mới của bạn phải khác với mật khẩu cũ.</p>
                            </div>

                            <div class="p-2">
                                <form id="change-password-admin-form" action="{{ route('api.change.password.admin') }}"
                                    method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="password-input">Mật Khẩu</label>
                                        <div class="position-relative auth-pass-inputgroup">
                                            <input type="password" class="form-control pe-5 password-input"
                                                placeholder="Nhập mật khẩu" id="new-password-admin">
                                            <button
                                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none"
                                                type="button" id="password-addon"><i
                                                    class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                        <div id="passwordInput" class="form-text">Mật khẩu phải có ít nhất 8 ký tự, tối đa
                                            20 ký tự, bao gồm chữ hoa, số và ký tự đặc biệt.</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="confirm-password-input">Xác Nhận Mật Khẩu</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control pe-5 password-input"
                                                placeholder="Xác nhận mật khẩu" id="confirm-password-admin">
                                            <button
                                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none"
                                                type="button"><i class="ri-eye-fill align-middle"></i></button>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <button class="btn btn-success w-100" type="submit">Tạo Mới Mật Khẩu</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="mt-4 text-center">
                        <p class="mb-0">Đợi đã, tôi nhớ mật khẩu của mình... <a href="{{ route('admin.login.index') }}"
                                class="fw-semibold text-primary text-decoration-underline"> Nhấn vào đây </a> </p>
                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const message = sessionStorage.getItem('message');
            const color = sessionStorage.getItem('messageColor');
            if (message && color) {
                showMessage(message, color);
                // Xóa thông báo sau khi hiển thị để tránh hiển thị lại khi tải lại trang
                sessionStorage.removeItem('message');
                sessionStorage.removeItem('messageColor');
            }

            const changePasswordForm = document.getElementById('change-password-admin-form');
            const newPassword = document.getElementById('new-password-admin');
            const confirmPassword = document.getElementById('confirm-password-admin');
            const token1 = '{{ $token }}';

            changePasswordForm.addEventListener('submit', async function(event) {
                event.preventDefault();
                clearAllErrors();
                const submitButton = changePasswordForm.querySelector('button[type="submit"]');

                try {
                    submitButton.disabled = true;
                    submitButton.textContent = 'Đang xử lý...';
                    const response = await fetch('/admin/api/change-password', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            token: token1,
                            password: newPassword.value,
                            password_confirmation: confirmPassword.value
                        })
                    });

                    const data = await response.json();

                    if (response.ok) {
                        sessionStorage.setItem('message', 'Đổi mật khẩu thành công. Hãy đăng nhập!');
                        sessionStorage.setItem('messageColor', '#4CAF50');
                        window.location.href = '/admin/login';
                    } else if (response.status === 422) {
                        if (data.errors) {
                            if (data.errors.password) {
                                showError('new-password-admin', data.errors.password[0]);
                            }
                        }
                    } else {
                        alert(data.message || 'Có lỗi xảy ra. Vui lòng thử lại.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert(error.message);
                } finally {
                    submitButton.disabled = false;
                    submitButton.textContent = 'Tạo Mới Mật Khẩu';
                }
            });

            function showError(fieldId, errorMessage) {
                const field = document.getElementById(fieldId);
                if (!field) return;

                // Thêm class is-invalid cho input
                // Tạo phần tử thông báo lỗi
                const errorDiv = document.createElement('span');
                errorDiv.className = 'invalid-feedback d-block';
                errorDiv.textContent = errorMessage;

                // Thêm thông báo lỗi vào sau input (hoặc input-group nếu có)
                const parentElement = field.closest('.input-group') || field;
                parentElement.parentNode.appendChild(errorDiv);
            }

            function clearAllErrors() {
                const errorElements = document.querySelectorAll('.invalid-feedback');
                errorElements.forEach(element => element.remove());
            }
        });
    </script>
@endsection

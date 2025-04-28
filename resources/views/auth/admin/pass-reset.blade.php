@extends('auth.admin.layouts.app')

@section('title', 'Quên Mật Khẩu')

@section('content')
    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-sm-5 mb-4 text-white-50">
                        <div>
                            <a href="" class="d-inline-block auth-logo">
                                <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="20">
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
                                <h5 class="text-primary">Quên Mật Khẩu?</h5>
                                <p class="text-muted">Đặt lại mật khẩu WalkOn</p>

                                <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop"
                                    colors="primary:#0ab39c" class="avatar-xl"></lord-icon>

                            </div>

                            <div class="alert border-0 alert-warning text-center mb-2 mx-2" role="alert">
                                Nhập email của bạn và tin nhắn để lấy lại mật khẩu sẽ về email của bạn!
                            </div>
                            <div class="p-2">
                                <form id="mail-password-reset-form-admin">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Nhập Email">
                                        <div id="email-error" class="text-danger" style="display: none;"></div>
                                    </div>
                                    <div class="text-center mt-4">
                                        <button class="btn btn-success w-100" type="submit">Gửi Liên Kết Đặt Lại</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="mt-4 text-center">
                        <p class="mb-0">Đợi đã, tôi nhớ mật khẩu của mình...<a href="{{ route('admin.login.index') }}"
                                class="fw-semibold text-primary text-decoration-underline"> Nhấn vào đây </a> </p>
                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>


@endsection

@section('script')
    <script>
        const MailResetPasswordForm = document.getElementById('mail-password-reset-form-admin');
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('email-error');


        MailResetPasswordForm.addEventListener('submit', async function(event) {
            event.preventDefault();

            // Ẩn thông báo lỗi trước đó nếu có
            emailError.style.display = "none";

            const submitButton = MailResetPasswordForm.querySelector("button");
            
            try {
                submitButton.disabled = true;
                submitButton.textContent = "Đang gửi...";

                const response = await fetch('/admin/api/mail-reset-password', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        email: emailInput.value
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    if (data.token) {
                        localStorage.setItem('reset_token', data.token);
                        localStorage.setItem('reset_email', emailInput.value);
                    }

                    window.location.href = '/admin/pass-confirm/'+ data.token;
                } else if (response.status === 422) {
                    // Xử lý lỗi validation
                    if (data.errors && data.errors.email) {
                        showError(emailError, data.errors.email[0]);
                    } else if (data.message) {
                        showError(emailError, data.message);
                    } else {
                        showError(emailError, "Dữ liệu không hợp lệ");
                    }
                } else {
                    showError(emailError, data.message || "Đã có lỗi xảy ra");
                }
            } catch (error) {
                console.error("Error:", error);
                showError(emailError, "Không thể kết nối đến server");
            } finally {
                submitButton.disabled = false;
                submitButton.textContent = "Gửi Liên Kết Đặt Lại";
            }
        });


        function showError(element, message) {
            element.textContent = message;
            element.style.display = "block";
        }
    </script>
@endsection

@extends('auth.admin.layouts.app')

@section('title', 'Đăng Nhập')

@section('content')
    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-sm-5 mb-4 text-white-50">
                        <div>
                            <a href="index.html" class="d-inline-block auth-logo">
                                <img src="" alt="" height="20">
                            </a>
                        </div>
                        <p class="mt-3 fs-15 fw-medium">Premium Admin & Dashboard Template</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4 card-bg-fill">
                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Chào Mừng Trở Lại !</h5>
                                <p class="text-muted">Đăng nhập để vào WalkOn-Admin.</p>
                            </div>
                            <div class="p-2 mt-4">
                                <form id="sign-in-form-admin">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" name="email" class="form-control" id="email"
                                            placeholder="Nhập email">
                                        <span class="text-danger" id="email-error" style="display:none;"></span>

                                    </div>

                                    <div class="mb-3">
                                        <div class="float-end">
                                            <a href="{{ route('pass-reset.index') }}" class="text-muted">Quên Mật Khẩu?</a>
                                        </div>
                                        <label class="form-label" for="password">Mật Khẩu</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" name="password" id="password"
                                                class="form-control pe-5 password-input" placeholder="Nhập mật khẩu">
                                            <button
                                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none"
                                                type="button" id="password-addon"><i
                                                    class="ri-eye-fill align-middle"></i></button>
                                            <span class="text-danger" id="password-error" style="display:none;"></span>
                                        </div>
                                    </div>

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="remember">
                                        <label class="form-check-label" for="remember">Ghi nhớ tài khoản</label>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-success w-100" type="submit">Đăng Nhập</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
        </div>
    </div>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Script xử lý đăng nhập -->


@endsection
@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const message = sessionStorage.getItem('message');
            const color = sessionStorage.getItem('messageColor');
            if (message && color) {
                showMessage(message, color);
                sessionStorage.removeItem('message');
                sessionStorage.removeItem('messageColor');
            }

            const emailField = document.getElementById("email");
            const passwordField = document.getElementById("password");
            const rememberCheckbox = document.getElementById("remember");
            const emailError = document.getElementById("email-error");
            const passwordError = document.getElementById("password-error");
            const signInForm = document.getElementById("sign-in-form-admin");


            const savedEmail = localStorage.getItem("email");
            const savedPassword = localStorage.getItem("password");
            const isRemembered = localStorage.getItem("remember") === "true";

            if (isRemembered && savedEmail && savedPassword) {
                emailField.value = savedEmail;
                passwordField.value = savedPassword;
                rememberCheckbox.checked = true;
            }

            emailField.addEventListener("input", function() {
                if (this.value !== savedEmail || !isRemembered) {
                    passwordField.value = "";
                } else if (this.value === savedEmail && isRemembered) {
                    passwordField.value = savedPassword;
                }
            });

            signInForm.addEventListener("submit", async function(e) {
                e.preventDefault();

                // Reset lỗi
                emailError.style.display = "none";
                passwordError.style.display = "none";

                const email = emailField.value;
                const password = passwordField.value;
                const remember = rememberCheckbox && rememberCheckbox.checked;

                try {
                    const response = await fetch("{{ route('api.admin.signin') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                .content,
                        },
                        body: JSON.stringify({
                            email,
                            password
                        }),
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        localStorage.setItem("auth_token", data.token);

                        if (remember) {
                            localStorage.setItem("email", email);
                            localStorage.setItem("password", password);
                            localStorage.setItem("remember", "true");
                        } else {
                            localStorage.removeItem("email");
                            localStorage.removeItem("password");
                            localStorage.removeItem("remember");
                        }

                        window.location.href = data.redirect;
                    } else if (response.status === 422) {
                        // Lỗi validate
                        if (data.errors) {
                            if (data.errors.email) {
                                emailError.textContent = data.errors.email[0];
                                emailError.style.display = "block";
                            }
                            if (data.errors.password) {
                                passwordError.textContent = data.errors.password[0];
                                passwordError.style.display = "block";
                            }
                        }
                    } else {
                        // Lỗi logic (sai mật khẩu, chưa active, chưa verify)
                        emailError.textContent = data.message;
                        emailError.style.display = "block";
                    }
                } catch (error) {
                    console.error("Đăng nhập thất bại:", error);
                    emailError.textContent = "Đã có lỗi xảy ra. Vui lòng thử lại.";
                    emailError.style.display = "block";
                }
            });
        });
    </script>
@endsection

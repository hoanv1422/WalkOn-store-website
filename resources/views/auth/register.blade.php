@extends('client.layouts.app')
@section('title', 'register')
@section('content')
    @include('client.components.breadcrumb')

    <div class="login-area ptb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-md-3 text-center">
                    <div class="login">
                        <div class="login-form-container">
                            <div class="login-text">
                                <h2>Đăng kí tài khoản</h2>
                                <span>Vui lòng đăng kí bằng thông tin tài khoản của bạn</span>
                            </div>
                            <div class="login-form">
                                <form id="registerForm">
                                    @csrf

                                    <input type="text" name="username" placeholder="Nhập tên người dùng">
                                    <span class="error-message" id="username-error"></span>

                                    <input type="text" name="name" placeholder="Nhập họ tên">
                                    <span class="error-message" id="name-error"></span>

                                    <input name="email" placeholder="Nhập email" type="email">
                                    <span class="error-message" id="email-error"></span>

                                    <div class="password-wrapper">
                                        <input type="password" id="password" name="password" placeholder="Nhập mật khẩu">
                                        <span class="toggle-password" onclick="togglePassword('password')">
                                            <i class="fa fa-eye" style="margin-bottom:15px"></i>
                                        </span>
                                    </div>
                                    <span class="error-message" id="password-error"></span>

                                    <div class="password-wrapper mt-3">
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            placeholder="Nhập lại mật khẩu">

                                        <span class="toggle-password" onclick="togglePassword('password_confirmation')">
                                            <i class="fa fa-eye" style="margin-bottom:15px"></i>
                                        </span>
                                    </div>
                                    <span class="error-message" id="password_confirmation-error"></span>

                                    <div class="button-box">
                                        <button type="submit" class="default-btn">Đăng ký</button>
                                    </div>

                                    <div class="login-link mt-2">
                                        <p>Bạn đã có tài khoản? <a href="{{ url('login') }}">Đăng nhập</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-wrapper input {
            width: 100%;
            padding-right: 40px;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            cursor: pointer;
            font-size: 18px;
            color: #666;
        }

        .toggle-password:hover {
            color: #000;
        }

        .error-message {
            color: red;
            font-size: 14px;
            display: block;
            text-align: left;
            margin-bottom: 10px;
        }
    </style>

    <script>
        function togglePassword(fieldId) {
            let input = document.getElementById(fieldId);
            let icon = input.nextElementSibling.querySelector('i');
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const registerForm = document.getElementById("registerForm");

            registerForm.addEventListener("submit", async function(e) {
                e.preventDefault();

                // Xóa lỗi cũ
                ['username', 'name', 'email', 'password', 'password_confirmation'].forEach(field => {
                    document.getElementById(`${field}-error`).textContent = '';
                });

                const formData = new FormData(registerForm);
                const payload = Object.fromEntries(formData.entries());

                try {
                    const response = await fetch("{{ route('api.register') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                .content,
                        },
                        body: JSON.stringify(payload),
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        localStorage.setItem("auth_token", data.token);
                        window.location.href = data.redirect;
                    } else if (data.errors) {
                        // Gán lỗi cụ thể cho từng trường
                        Object.entries(data.errors).forEach(([key, messages]) => {
                            const errorSpan = document.getElementById(`${key}-error`);
                            if (errorSpan) {
                                errorSpan.textContent = messages[0];
                            }
                        });
                    } else {
                        alert(data.message || "Đã có lỗi xảy ra.");
                    }

                } catch (error) {
                    console.error("Lỗi đăng ký:", error);
                    alert("Không thể kết nối đến máy chủ.");
                }
            });
        });
    </script>
@endsection

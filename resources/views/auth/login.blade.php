@extends('client.layouts.app')
@section('title', 'login')
@section('content')
@section('style')
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

        .alert {
            color: red;
            font-size: 14px;
            display: none;
            text-align: center;
        }
    </style>
@endsection
@include('client.components.breadcrumb')
<div class="login-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 text-center">
                <div class="login">
                    <div class="login-form-container">
                        <div class="login-text">
                            <h2>Đăng nhập tài khoản</h2>
                            <span>Vui lòng đăng nhập bằng thông tin tài khoản của bạn</span>
                        </div>
                        <div class="login-form">
                            <form id="loginForm">
                                <input type="email" id="email" name="email" placeholder="Nhập email">
                                <div class="password-wrapper">
                                    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu"
                                        >
                                    <span class="toggle-password" onclick="togglePassword('password')">
                                        <i class="fa fa-eye" style="margin-bottom:25px"></i>
                                    </span>
                                </div>
                                 <span class="alert" id="email-error"></span>
                                <span class="alert" id="password-error"></span>

                                <div class="button-box">
                                    <div class="login-toggle-btn">
                                        <input type="checkbox" id="remember">
                                        <label for="remember">Ghi nhớ thông tin đăng nhập</label>
                                        <a href="{{ url('/forgot_password') }}">Quên mật khẩu?</a>
                                    </div>
                                    <button type="submit" class="default-btn">Đăng nhập</button>
                                </div>
                            </form>

                            <div class="register-link mt-2">
                                <p>Bạn chưa có tài khoản? <a href="{{ url('/register') }}">Đăng ký ngay</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const emailField = document.getElementById("email");
        const passwordField = document.getElementById("password");
        const rememberCheckbox = document.getElementById("remember");
        const emailError = document.getElementById("email-error");
        const passwordError = document.getElementById("password-error");
        const loginForm = document.getElementById("loginForm");

        // Load saved credentials if "remember" is checked
        const savedEmail = localStorage.getItem("email");
        const savedPassword = localStorage.getItem("password");
        const isRemembered = localStorage.getItem("remember") === "true";

        if (isRemembered && savedEmail && savedPassword) {
            emailField.value = savedEmail;
            passwordField.value = savedPassword;
            rememberCheckbox.checked = true;
        }

        // Clear password if email changes
        emailField.addEventListener("input", function() {
            if (this.value !== savedEmail || !isRemembered) {
                passwordField.value = "";
            } else if (this.value === savedEmail && isRemembered) {
                passwordField.value = savedPassword;
            }
        });

        // Handle form submission with API
        loginForm.addEventListener("submit", async function(e) {
            e.preventDefault();

            // Clear previous errors
            emailError.style.display = "none";
            passwordError.style.display = "none";

            const email = emailField.value;
            const password = passwordField.value;
            const remember = rememberCheckbox.checked;

            try {
                const response = await fetch("{{ route('api.login') }}", {
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

                if (data.success) {
                    // Store token for authenticated requests
                    localStorage.setItem("auth_token", data.token);

                    // Handle "remember me"
                    if (remember) {
                        localStorage.setItem("email", email);
                        localStorage.setItem("password", password);
                        localStorage.setItem("remember", "true");
                    } else {
                        localStorage.removeItem("email");
                        localStorage.removeItem("password");
                        localStorage.removeItem("remember");
                    }

                    // Handle verification prompt
                    if (data.verify) {
                        window.location.href = data.redirect;
                    } else {
                        window.location.href = data.redirect;
                    }
                } else {
                    emailError.textContent = data.message;
                    emailError.style.display = "block";
                }
            } catch (error) {
                console.error("Login error:", error);
                emailError.textContent = "Đã có lỗi xảy ra. Vui lòng thử lại.";
                emailError.style.display = "block";
            }
        });
    });

    function togglePassword(id) {
        const input = document.getElementById(id);
        const icon = input.nextElementSibling.querySelector("i");
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
</script>
@endsection

@extends('client.layouts.app')
@section('title', 'login')
@section('content')
@include('client.components.breadcrumb')
<div class="login-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 text-center">
                <div class="login">
                    <div class="login-form-container">
                        @if (session()->has('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger text-center">
                                {{ session('error') }}
                            </div>
                            @endif
                        <div class="login-text">
                            <h2>Đăng nhập tài khoản</h2>
                            <span>Vui lòng đăng nhập bằng thông tin tài khoản của bạn</span>
                        </div>
                        <div class="login-form">
                            <form action="{{ route('login') }}" method="post" id="loginForm">
                                @csrf
                                <input type="email" id="email" name="email" placeholder="Nhập email" required>
                                @error('email')
                                <span class="alert-alert-danger text-center">{{ $message }}</span>
                                @enderror

                                <div class="password-wrapper">
                                    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
                                    <span class="toggle-password" onclick="togglePassword('password')">
                                        <i class="fa fa-eye" style="margin-bottom:25px"></i>
                                    </span>
                                </div>
                                @error('password')
                                <span class="alert-alert-danger text-center">{{ $message }}</span>
                                @enderror

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
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let emailField = document.getElementById("email");
        let passwordField = document.getElementById("password");
        let rememberCheckbox = document.getElementById("remember");
        let savedEmail = localStorage.getItem("email");
        let savedPassword = localStorage.getItem("password");
        let isRemembered = localStorage.getItem("remember") === "true";

        if (isRemembered && savedEmail && savedPassword) {
            emailField.value = savedEmail;
            passwordField.value = savedPassword;
            rememberCheckbox.checked = true;
        }
        emailField.addEventListener("input", function() {
            if (this.value === savedEmail && isRemembered) {
                passwordField.value = savedPassword;
            } else {
                passwordField.value = "";
            }
        });
        document.getElementById("loginForm").addEventListener("submit", function() {
            let email = emailField.value;
            let password = passwordField.value;
            let remember = rememberCheckbox.checked;

            if (remember) {
                localStorage.setItem("email", email);
                localStorage.setItem("password", password);
                localStorage.setItem("remember", "true");
            } else {
                localStorage.removeItem("email");
                localStorage.removeItem("password");
                localStorage.removeItem("remember");
            }
        });
    });

    function togglePassword(id) {
        let input = document.getElementById(id);
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
</script>
@endsection

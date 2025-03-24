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
                            <form action="{{ route('register') }}" method="post">
                                @csrf
                                <input type="text" name="username" placeholder="Nhập tên người dùng">
                                @error('username')
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

                                <input type="text" name="name" placeholder="Nhập họ tên">
                                @error('name')
                                <span class="alert-alert-danger text-center">{{ $message }}</span>
                                @enderror

                                <input name="email" placeholder="Nhập email" type="email">
                                @error('email')
                                <span class="alert-alert-danger text-center">{{ $message }}</span>
                                @enderror

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
        position: relative; display: flex; align-items: center;
    }
    .password-wrapper input {
        width: 100%; padding-right: 40px;
    }
    .toggle-password {
        position: absolute; right: 10px; cursor: pointer; font-size: 18px; color: #666;
    }
    .toggle-password:hover {
        color: #000;
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
</script>
@endsection

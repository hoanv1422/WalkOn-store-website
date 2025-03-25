@extends('client.layouts.app')
@section('title', 'Đặt lại mật khẩu')
@section('content')
@include('client.components.breadcrumb')
<div class="login-area ptb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-md-3 text-center">
                <div class="login">
                    <div class="login-form-container">
                        <div class="login-text">
                            <h2>Đặt lại mật khẩu</h2>
                            <span>Bạn hãy nhập mật khẩu mới và xác nhận mật khẩu vừa nhập </span>
                        </div>
                        <div class="login-form">
                            <form action="{{ route('password.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <input type="hidden" name="email" value="{{ request('email') }}">
                                @if($errors->has('password'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('password') }}
                                </div>
                                @endif
                                <div class="password-wrapper">
                                    <input type="password" id="password" name="password" placeholder="Mật khẩu mới" required>
                                    <span class="toggle-password" onclick="togglePassword('password')">
                                        <i class="fa fa-eye" style="margin-bottom:25px"></i>
                                    </span>
                                </div>
                                <div class="password-wrapper">
                                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Xác nhận mật khẩu" required>
                                    <span class="toggle-password" onclick="togglePassword('password_confirmation')">
                                        <i class="fa fa-eye" style="margin-bottom:25px"></i>
                                    </span>
                                </div>
                                @if($errors->has('password_confirmation'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('password_confirmation') }}
                                </div>
                                @endif

                                <div class="button-box">
                                    <button type="submit" class="default-btn">Đặt lại mật khẩu</button>
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

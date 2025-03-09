@extends('client.layouts.app')
@section('title', 'forgot-password')
@section('content')
@include('client.components.breadcrumb')
<div class="login-area ptb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-md-3 text-center">
                @if(session()->has('password_reset_requested'))
                <?php session()->forget('password_reset_requested'); ?>
                @endif
                <div class="login">
                    <div class="login-form-container">
                        <div class="login-text">
                            <h2>Email để lấy lại mật khẩu của bạn đã được gửi đi </h2>
                            <span>Bạn hãy đăng nhập vào email của mình để xem tin nhắn và lấy lại mật khẩu nhé 😗😗</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

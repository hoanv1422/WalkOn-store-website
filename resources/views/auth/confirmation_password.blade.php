@extends('client.layouts.app')
@section('title', 'Forgot Password')
@section('content')
@include('client.components.breadcrumb')
<div class="login-area ptb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 text-center">
                @if(session()->has('password_reset_requested'))
                    <?php session()->forget('password_reset_requested'); ?>
                @endif
                <div class="login card shadow-lg border-0">
                    <div class="login-form-container card-body p-5">
                        <div class="login-text">
                            <h2 class="mb-3 fw-bold d-flex justify-content-between align-items-center">
                                Email lấy lại mật khẩu đã được gửi đi!
                            </h2>
                            <p class="text-muted mb-4">Vui lòng kiểm tra email của bạn để xem hướng dẫn cách lấy lại mật khẩu tài khoản.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .login.card {
        border-radius: 15px;
        animation: fadeIn 0.5s ease-in-out;
    }
    .login-text h2 {
        color: #343a40;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @media (max-width: 768px) {
        .login.card {
            margin: 0 15px;
            padding: 20px;
        }
        .login-text h2 {
            font-size: 1.5rem;
        }
    }
</style>
@endsection

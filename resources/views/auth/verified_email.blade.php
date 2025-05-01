@extends('client.layouts.app')
@section('title', 'Xác thực email ok rồi')
@section('content')
@include('client.components.breadcrumb')
<div class="login-area ptb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 text-center">
                <div class="login card shadow-lg border-0">
                    <div class="login-form-container card-body p-5">
                        <div class="login-text">
                            <h2 class="align-items-center"> Email của bạn đã được xác thực thành công!</h2>
                            <p class="text-muted mb-4 mt-2">Bạn hãy quay lại trang web, hiện tại email của bạn đã được xác thực.</p>
                            <div class="button-box">
                            <a href="{{ url('/') }}" class="default-btn mt-4">Quay trở về trang chủ</a>
                            </div>
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
        font-size: 2rem;
        font-weight: 600;
    }
    .check-icon {
        color: #28a745;
    }
    .text-muted {
        color: #7f8c8d !important;
        line-height: 1.6;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @media (max-width: 768px) {
        .login.card {
            margin: 0 15px;
        }
        .login-text h2 {
            font-size: 1.5rem;
        }
        .check-icon.fs-2 {
            font-size: 1.75rem;
        }
        .default-btn {
            padding: 12px 24px;
            font-size: 14px;
        }
    }
</style>
@endsection

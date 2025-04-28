@extends('client.layouts.app')
@section('title', 'Xác thực email đã được gửi')
@section('content')
@include('client.components.breadcrumb')
<div class="login-area ptb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 text-center">
                <div class="login card shadow-lg border-0">
                    <div class="login-form-container card-body p-5">
                        <div class="login-text">
                            <h2 class="align-items-center">
                                Email xác thực tài khoản đã được gửi!
                                <span class="email-icon fs-2 text-primary">✉️</span>
                            </h2>
                            <p class="text-muted mb-4">Kiểm tra email của bạn để xác thực tài khoản.</p>
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
    .email-icon {
        color: #007bff;
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
        .email-icon.fs-2 {
            font-size: 1.75rem;
        }
    }
</style>
@endsection

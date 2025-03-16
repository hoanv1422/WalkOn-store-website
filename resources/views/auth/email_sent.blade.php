@extends('client.layouts.app')
@section('title', 'Xác thực email đã được gửi')
@section('content')
@include('client.components.breadcrumb')
<div class="login-area ptb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-md-3 text-center">
                <div class="login">
                    <div class="login-form-container">
                        <div class="login-text">
                            <h2>Email xác thực đã được gửi  ✅✅</h2>
                            <span>Kiểm tra email của bạn để xác thực tài khoản ✉ </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

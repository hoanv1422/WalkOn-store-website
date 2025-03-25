@extends('client.layouts.app')
@section('title', 'Xác thực email ok rồi ')
@section('content')
@include('client.components.breadcrumb')
<div class="login-area ptb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-md-3 text-center">
                <div class="login">
                    <div class="login-form-container">
                        <div class="login-text">
                            <h2>Email của bạn đã được xác thực thành công!  </h2>
                            <span>Bạn hãy quay lại trang web và hiện tại email của bạn đã được xác thực rồi</span>
                            <div class="button-box">
                                <button type="submit" class="default-btn"><a href="{{ url(path: '/') }}">Quay trở về trang chủ</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

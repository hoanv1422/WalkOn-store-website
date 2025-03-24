@section('content')
@extends('client.layouts.app')
@section('title', 'xác thực remail')
@include('client.components.breadcrumb')
<div class="login-area ptb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-md-3 text-center">
                <div class="login">
                    <div class="login-form-container">
                        <div class="login-text">
                            <h2>Xác thực Email của bạn ngay và luôn 👇👇 </h2>
                            <span>Bạn hãy bấm nút xác thực email dưới đây để xác thực email ngay</span>
                            <div class="button-box">
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <button type="submit" class="default-btn">Gửi email xác thực</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

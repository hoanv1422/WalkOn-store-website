@extends('client.layouts.app')
@section('title', 'forgot-password')
@section('content')
    @include('client.components.breadcrumb')
    <div class="login-area ptb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-md-3 text-center">
                    <div class="login">
                        <div class="login-form-container">
                            <div class="login-text">
                                <h2>Lấy lại mật khẩu đã quên</h2>
                                <span>Bạn hãy điền email vào để chúng tôi cho bạn đổi mật khẩu.</span>
                            </div>
                            <div class="login-form">
                                <form action="{{ route('password.email') }}" method="POST">
                                    @csrf
                                    <input name="email" placeholder="Nhập email" type="email" required>
                                    <div class="button-box">
                                        <button type="submit" class="default-btn">Lấy lại mật khẩu</button>
                                    </div>
                                </form>
                            </div>
                            <div class="login-links mt-2">
                                <a href="{{ url('/login') }}">Quay trở về đăng nhập nếu đã nhớ mật khẩu rồi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

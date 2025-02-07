@extends('client.layouts.app')
@section('title', 'login')
@section('content')

<div class="mainmenu-area home2 product-items">
    @include('client.layouts.partials.menu_header1')
    <!-- header area end -->
    <!-- cart item area start -->
    <div class="shopping-cart">
        <div class="container">
            @include('client.components.breadcrumb')
        </div>
    </div>
    <div class="login-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 text-center">
                    <div class="login">
                        <div class="login-form-container">
                            @if(session('status'))
                            <div class="alert alert-success mt-2">
                                {{ session('status') }}
                            </div>
                            @endif
                            <div class="login-text">
                                <h2>Login</h2>
                                <span>Please login using account detail below.</span>
                            </div>
                            <div class="login-form">
                                <form action="{{ route('login') }}" method="post">
                                    @csrf
                                    <input type="text" name="username" placeholder="Username">
                                    @error('username') <span class="alert-alert-danger text-center">{{$message}}</span> @enderror

                                    <input type="password" name="password" placeholder="Password">
                                    @error('password') <span class="alert-alert-danger text-center">{{$message}}</span> @enderror

                                    <div class="button-box">
                                        <div class="login-toggle-btn">
                                            <input type="checkbox" id="remember">
                                            <label for="remember">Remember me</label>
                                            <a href="{{url('/forgot_password')}}">Forgot Password?</a>
                                        </div>
                                        <button type="submit" class="default-btn">Login</button>
                                    </div>
                                </form>
                                <div class="register-link mt-2">
                                    <p>Bạn chưa có tài khoản? <a href="{{url('/register')}}">Đăng ký ngay</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer top area start -->

    @endsection

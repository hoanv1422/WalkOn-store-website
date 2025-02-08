@extends('client.layouts.app')
@section('title', 'register')
@section('content')

<div class="mainmenu-area home2 product-items">
    @include('client.layouts.partials.menu_header1')
    <div class="shopping-cart">
        <div class="container">
            @include('client.components.breadcrumb')
        </div>
    </div>
    <div class="login-area ptb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-md-3 text-center">
                    <div class="login">
                        <div class="login-form-container">
                            <div class="login-text">
                                <h2>Register</h2>
                                <span>Please Register using account detail bellow.</span>
                            </div>
                            <div class="login-form">
                                <form action="{{ route('register') }}" method="post">
                                    @csrf
                                    <input type="text" name="username" placeholder="Username">
                                    @error('username') <span class="alert-alert-danger text-center">{{$message}}</span> @enderror

                                    <input type="password" name="password" placeholder="Password">
                                    @error('password') <span class="alert-alert-danger text-center">{{$message}}</span> @enderror

                                    <input type="text" name="name" placeholder="Name">
                                    @error('name') <span class="alert-alert-danger text-center">{{$message}}</span> @enderror

                                    <input name="mail" placeholder="Mail" type="email">
                                    @error('mail') <span class="alert-alert-danger text-center">{{$message}}</span> @enderror
                                    
                                    <div class="button-box">
                                        <button type="submit" class="default-btn">Register</button>
                                    </div>
                                    <div class="login-link mt-2">
                                        <p>Bạn đẫ có tài khoản? <a href="{{url('login')}}">Đăng nhập</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

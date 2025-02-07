@extends('client.layouts.app')
@section('title', 'forgot-password')
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
                                            <h2>Reset Password</h2>
                                            <span>Please enter your email to receive a password reset link.</span>
                                        </div>
                                        <div class="login-form">
                                            <form action="#" method="POST">
                                                @csrf
                                                <input name="email" placeholder="Enter your email" type="email" required>
                                                <div class="button-box">
                                                    <button type="submit" class="default-btn">Send Reset Link</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="login-links mt-2">
                                            <a href="{{url('/login')}}">Back to Login</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

@endsection

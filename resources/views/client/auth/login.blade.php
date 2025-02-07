@extends('client.layouts.app')
@section('title', 'login')
@section('content')

@include('client.layouts.partials.menu_header')

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
                                <div class="login-text">
                                    <h2>login</h2>
                                    <span>Please login using account detail bellow.</span>
                                </div>
                                <div class="login-form">
                                    <form action="#" method="post">
                                        <input type="text" name="user-name" placeholder="Username">
                                        <input type="password" name="user-password" placeholder="Password">
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <input type="checkbox" id="remember">
                                                <label for="remember">Remember me</label>
                                                <a href="#">Forgot Password?</a>
                                            </div>
                                            <button type="submit" class="default-btn">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer top area start -->
      
@endsection
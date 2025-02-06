@extends('client.layouts.app')
@section('title', 'register')
@section('content')

@include('client.layouts.partials.menu_header')

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
                                            <form action="#" method="post">
                                                <input type="text" name="user-name" placeholder="Username">
                                                <input type="password" name="user-password" placeholder="Password">
                                                <input name="user-email" placeholder="Email" type="email">
                                                <div class="button-box">
                                                    <button type="submit" class="default-btn">Register</button>
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
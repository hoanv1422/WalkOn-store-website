@extends('client.layouts.app')
@section('title', 'login')
@section('content')
@include('client.components.breadcrumb')
<div class="login-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 text-center">
                <div class="login">
                    <div class="login-form-container">
                        @if(session('status'))
                        <div id="custom-alert" class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 1000; display: none;color:red">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill me-2" viewBox="0 0 16 16">
                                <path d="M7.938 2.016a.13.13 0 0 1 .125 0c.02.01.037.025.052.043l6.857 10.586c.066.102.075.23.025.34a.248.248 0 0 1-.222.136H1.225a.248.248 0 0 1-.222-.136.277.277 0 0 1 .025-.34L7.885 2.06a.146.146 0 0 1 .052-.043ZM8 5a.905.905 0 0 0-.9 1l.35 4.2a.55.55 0 0 0 1.1 0L8.9 6A.905.905 0 0 0 8 5Zm-.9 7.5a.9.9 0 1 0 1.8 0 .9.9 0 0 0-1.8 0Z" />
                            </svg>
                            <span id="alert-message">{{ session('status') }}</span>
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                let alertBox = document.getElementById("custom-alert");
                                if (alertBox) {
                                    alertBox.style.display = "block";
                                    setTimeout(() => {
                                        let bsAlert = new bootstrap.Alert(alertBox);
                                        bsAlert.close();
                                    }, 2000);
                                }
                            });
                        </script>
                        @endif
                        @if(session('success'))
                        <div id="success-alert" class="alert alert-warning alert-dismissible fade show d-flex align-items-center"
                            role="alert"
                            style="position: fixed; top: 20px; right: 20px; z-index: 1000; display: none;
               background-color: #fffae6; color: #856404; border: 1px solid #ffeeba;
               padding: 12px 18px; border-radius: 10px; box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.15);
               font-weight: 500; font-size: 15px;">

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="green" class="bi bi-check-circle-fill me-2" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0ZM6.97 11.03l-2.47-2.47a.75.75 0 0 1 1.06-1.06l1.41 1.42 3.54-3.53a.75.75 0 0 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0Z" />
                            </svg>

                            <span id="success-message">{{ session('success') }}</span>
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                let alertBox = document.getElementById("success-alert");
                                if (alertBox) {
                                    alertBox.style.display = "block";
                                    setTimeout(() => {
                                        let bsAlert = new bootstrap.Alert(alertBox);
                                        bsAlert.close();
                                    }, 2000);
                                }
                            });
                        </script>
                        @endif

                        <div class="login-text">
                            <h2>Đăng nhập tài khoản</h2>
                            <span>Vui lòng đăng nhập bằng thông tin tài khoản của bạn</span>
                        </div>
                        <div class="login-form">
                            <form action="{{ route('login') }}" method="post">
                                @csrf
                                <input type="email" name="mail" placeholder="Mail">
                                @error('mail')
                                <span class="alert-alert-danger text-center">{{ $message }}</span>
                                @enderror

                                <input type="password" name="password" placeholder="Password">
                                @error('password')
                                <span class="alert-alert-danger text-center">{{ $message }}</span>
                                @enderror

                                <div class="button-box">
                                    <div class="login-toggle-btn">
                                        <input type="checkbox" id="remember">
                                        <label for="remember">Ghi nhớ</label>
                                        <a href="{{ url('/forgot_password') }}">Forgot Password?</a>
                                    </div>
                                    <button type="submit" class="default-btn">Login</button>
                                </div>
                            </form>
                            <div class="register-link mt-2">
                                <p>Bạn chưa có tài khoản? <a href="{{ url('/register') }}">Đăng ký ngay</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

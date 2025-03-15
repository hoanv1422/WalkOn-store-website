@extends('auth.admin.layouts.app')

@section('title', 'Xác Nhận Mã')

@section('content')
    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-sm-5 mb-4 text-white-50">
                        <div>
                            <a href="index.html" class="d-inline-block auth-logo">
                                <img src="{{asset('templates/admin/assets/images/logo-light.png')}}" alt="" height="20">
                            </a>
                        </div>
                        <p class="mt-3 fs-15 fw-medium">Premium Admin & Dashboard Template</p>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4 card-bg-fill">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Xác Nhận Mã?</h5>
                            </div>

                            <div class="alert border-0 alert-warning text-center mb-2 mx-2" role="alert">
                                Mã xác nhận đã được gửi vào Email của bạn!
                            </div>
                            <div class="p-2">
                                <form>
                                    <div class="mb-4">
                                        <input type="text" class="form-control" name="code" id="code"
                                            placeholder="Nhập mã">
                                    </div>
                                    @error('code')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="text-center mt-4">
                                        <button class="btn btn-success w-100" type="submit">Xác Nhận</button>
                                    </div>
                                </form><!-- end form -->

                                <!-- Nút gửi lại mã -->
                                <div class="text-center mt-3">
                                    <button id="resend-code" class="btn btn-link text-primary">Gửi lại mã</button>
                                    <p id="resend-message" class="text-success mt-2" style="display: none;">Mã xác nhận đã
                                        được gửi lại!</p>
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="mt-4 text-center">
                        <p class="mb-0">Đợi đã, tôi nhớ mật khẩu của mình...<a href="{{ route('signin.index') }}"
                                class="fw-semibold text-primary text-decoration-underline"> Nhấn vào đây </a> </p>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->
@endsection

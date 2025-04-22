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
                                <img src="{{ asset('templates/admin/assets/images/logo-light.png') }}" alt=""
                                    height="20">
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
                                <form id="confirm-reset-password-code-form">
                                    @csrf
                                    <div class="mb-4">
                                        <input type="text" class="form-control" name="code" id="code"
                                            placeholder="Nhập mã">
                                        <div id="code-error" class="text-danger" style="display: none;"></div>
                                    </div>
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
                        <p class="mb-0">Đợi đã, tôi nhớ mật khẩu của mình...<a href="{{ route('admin.login.index') }}"
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
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const confirmForm = document.getElementById('confirm-reset-password-code-form');
            const codeInput = document.getElementById('code');
            const codeError = document.getElementById('code-error');
            const resendButton = document.getElementById('resend-code'); // Existing resend button
            const resendMessage = document.getElementById('resend-message'); // Existing resend button
            const token1 = '{{ $token }}';

            confirmForm.addEventListener('submit', async function(event) {
                event.preventDefault();
                const submitButton = confirmForm.querySelector('button[type="submit"]');

                try {
                    submitButton.disabled = true;
                    submitButton.textContent = 'Đang xử lý...';
                    const response = await fetch('/admin/api/confirm-code', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            token: token1,
                            code: codeInput.value
                        })
                    });

                    const data = await response.json();

                    if (response.ok) {
                        sessionStorage.setItem('message', 'Mời nhập mật khẩu mới!');
                        sessionStorage.setItem('messageColor', '#4CAF50');
                        window.location.href = '/admin/pass-change/' + data.token;
                    } else if (response.status === 422) {
                        if (data.errors && data.errors.code) {
                            showError(codeError, data.errors.code[0]);
                        } else if (data.message) {
                            showError(codeError, data.message);
                        } else {
                            showError(codeError, "Dữ liệu không hợp lệ");
                        }
                    } else {
                        alert(data.message || 'Có lỗi xảy ra. Vui lòng thử lại.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert(error.message);
                } finally {
                    submitButton.disabled = false;
                    submitButton.textContent = 'Xác Nhận';
                }
            });

            // Handle existing resend button click
            resendButton.addEventListener('click', async function() {

                try {
                    // Disable button during processing
                    resendButton.disabled = true;
                    resendButton.textContent = 'Đang gửi...';

                    // Gọi route web
                    const response = await fetch('/admin/api/resend-code', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            token: token1
                        })
                    });

                    const data = await response.json();

                    if (response.ok) {
                        resendMessage.style.display = 'block';
                        setTimeout(() => {
                            resendMessage.style.display = 'none';
                        }, 5000);
                    } else {
                        alert(data.message || 'Không thể gửi lại mã xác nhận');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi kết nối đến server');
                } finally {
                    setTimeout(() => {
                        resendButton.disabled = false;
                        resendButton.textContent = 'Gửi lại mã';
                    }, 30000); // Vô hiệu hóa trong 30 giây để tránh spam
                }
            });

            function showError(element, message) {
                element.textContent = message;
                element.style.display = message ? "block" : "none";
            }

            function disableForm() {
                codeInput.disabled = true;
                confirmForm.querySelector('button[type="submit"]').disabled = true;
            }
        });
    </script>
@endsection

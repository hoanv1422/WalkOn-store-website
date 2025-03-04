@extends('client.layouts.app')

@section('title', 'Checkout')

@section('content')
    @include('client.components.breadcrumb')
    @include('client.pages.checkout.checkout')
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const payNowButton = document.getElementById("pay-now");
            const checkoutForm = document.getElementById("checkout-form");
            const paymentMethods = document.querySelectorAll('input[name="payment_method"]');

            // Sự kiện thay đổi phương thức thanh toán
            paymentMethods.forEach(radio => {
                radio.addEventListener("change", function() {
                    if (this.value === "VNPAY") {
                        payNowButton.innerText = "Thanh toán với VNPAY";
                    } else {
                        payNowButton.innerText = "Đặt hàng";
                    }
                });
            });

            // Sự kiện click nút thanh toán
            payNowButton.addEventListener("click", function(event) {
                event.preventDefault(); // Ngăn form gửi đi ngay lập tức

                const selectedPaymentMethod = document.querySelector(
                'input[name="payment_method"]:checked');

                if (!selectedPaymentMethod) {
                    alert("Vui lòng chọn phương thức thanh toán!");
                    return;
                }

                // Cập nhật action dựa vào phương thức thanh toán
                if (selectedPaymentMethod.value === "COD") {
                    checkoutForm.action = "/checkout/cod"; // Route xử lý COD
                } else if (selectedPaymentMethod.value === "VNPAY") {
                    checkoutForm.action = "/checkout/vnpay"; // Route xử lý VNPAY
                }

                checkoutForm.submit(); // Gửi form
            });
        });
    </script>


@endsection

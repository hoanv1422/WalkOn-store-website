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
        });
    </script>


@endsection

@extends('client.layouts.app')

@section('title', 'Giỏ Hàng')

@section('content')
    @include('client.components.breadcrumb')
    @include('client.pages.cart.shopping-cart')
@endsection

@section('script')
    <script>
        function changeQty(cartItemId, change) {
            let qtyInput = document.getElementById("qtyInput-" + cartItemId);
            let newQty = parseInt(qtyInput.value) + change;

            if (newQty > 0) {
                qtyInput.value = newQty;

                clearTimeout(qtyInput.dataset.timeout);
                qtyInput.dataset.timeout = setTimeout(() => {
                    qtyInput.form.submit();
                }, 500);
            }
        }

        document.querySelectorAll(".qtyInput").forEach(input => {
            input.addEventListener("change", function() {
                clearTimeout(this.dataset.timeout);
                this.dataset.timeout = setTimeout(() => {
                    this.form.submit();
                }, 500);
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const selectAll = document.getElementById("selectAll");
            const checkboxes = document.querySelectorAll(".cartItemCheckbox");
            const cartItemsInput = document.getElementById("cartItems");
            const cartItemsForCouponInput = document.getElementById("cartItemsForCoupon");
            const totalPriceInput = document.getElementById("totalPrice");
            const displayTotalPrice = document.getElementById("displayTotalPrice");
            const finalPriceInput = document.getElementById("finalPrice");
            const displayFinalPrice = document.getElementById("displayFinalPrice");
            const inputShippingFee = document.getElementById("shippingFee");
            const totalPriceForCouponInput = document.getElementById("totalPriceForCoupon");
            totalPriceForCoupon
            selectAll.checked = true;
            checkboxes.forEach(checkbox => {
                checkbox.checked = true;
            });

            function updateTotalPrice() {
                let totalPrice = 0;

                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        let price = parseFloat(checkbox.dataset.price) || 0;
                        totalPrice += price;
                    }
                });

                const shippingFee = parseFloat(inputShippingFee.value) || 0;
                totalPriceInput.value = totalPrice;
                totalPriceForCouponInput.value = totalPrice;
                displayTotalPrice.textContent = new Intl.NumberFormat('vi-VN').format(totalPrice) + " VND";
                displayFinalPrice.textContent = new Intl.NumberFormat('vi-VN').format(totalPrice + shippingFee) +
                    " VND";
                finalPriceInput.value = totalPrice + shippingFee;
            }

            function updateSelectedIds() {
                let selectedIds = Array.from(checkboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);

                cartItemsInput.value = selectedIds.join(",");
                cartItemsForCoupon.value = selectedIds.join(",");
                updateTotalPrice();
            }

            selectAll.addEventListener("change", function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAll.checked;
                });
                updateSelectedIds();
            });

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("change", updateSelectedIds);
            });

            updateSelectedIds();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JavaScript xử lý -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Hàm định dạng số tiền sang VND
            function formatVND(amount) {
                return new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(amount);
            }

            // Giá trị ban đầu
            let originalTotalPrice = parseInt($('#totalPrice').val()) || 0;
            let originalShippingFee = parseInt($('#shippingFee').val()) || 20000;

            // Cập nhật giao diện ban đầu
            $('#displayTotalPrice').text(formatVND(originalTotalPrice));
            $('#displayShippingFee').text(formatVND(originalShippingFee));
            $('#displayFinalPrice').text(formatVND(originalTotalPrice + originalShippingFee));
            $('#finalPrice').val(originalTotalPrice + originalShippingFee);
            $('#totalPriceForCoupon').val(originalTotalPrice);

            // Xử lý submit form
            $('#couponForm').on('submit', function(event) {
                event.preventDefault();

                let formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#couponMessage').html('<p class="text-success">' + response.message +
                            '</p>');

                        // Cập nhật các giá trị từ phản hồi
                        let discount = response.discount || 0;
                        let shippingDiscount = response.shipping_discount || 0;
                        let finalPrice = response.finalPrice || 0;

                        // Cập nhật giao diện
                        $('#displayDiscount').text('-' + formatVND(discount +
                            shippingDiscount));
                        $('#discountAmount').val(discount + shippingDiscount);
                        let newShippingFee = originalShippingFee - shippingDiscount;
                        $('#displayShippingFee').text(formatVND(newShippingFee));
                        $('#shippingFee').val(newShippingFee);
                        $('#displayFinalPrice').text(formatVND(finalPrice));
                        $('#finalPrice').val(finalPrice);

                        // Cập nhật mã giảm giá vào input couponCodeForOrder
                        let couponCode = $('#couponCodeInput').val();
                        $('#couponCodeForOrder').val(couponCode);

                        // Vô hiệu hóa ô nhập mã giảm giá
                        $('#couponCodeInput').prop('disabled', true);
                    },
                    error: function(xhr) {
                        let errorMessage = xhr.responseJSON?.message || 'Đã xảy ra lỗi!';
                        $('#couponMessage').html('<p class="text-danger">' + errorMessage +
                            '</p>');
                        // Nếu lỗi, vẫn cho phép nhập lại
                        $('#couponCodeInput').prop('disabled', false);
                    }
                });
            });

            // Xử lý nút "Xóa"
            $('#clearCoupon').on('click', function(event) {
                event.preventDefault();
                $('#couponCodeInput').val(''); // Xóa giá trị trong ô nhập
                $('#couponMessage').html(''); // Xóa thông báo
                $('#couponCodeForOrder').val('');
                // Reset về giá trị ban đầu
                $('#displayDiscount').text('-0 VND');
                $('#discountAmount').val(0);
                $('#displayShippingFee').text(formatVND(originalShippingFee));
                $('#shippingFee').val(originalShippingFee);
                $('#displayFinalPrice').text(formatVND(originalTotalPrice + originalShippingFee));
                $('#finalPrice').val(originalTotalPrice + originalShippingFee);

                // Kích hoạt lại ô nhập mã giảm giá
                $('#couponCodeInput').prop('disabled', false);
            });
        });
    </script>
@endsection

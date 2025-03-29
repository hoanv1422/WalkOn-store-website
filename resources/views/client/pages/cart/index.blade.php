@extends('client.layouts.app')

@section('title', 'Giỏ Hàng')
@section('breadcrumb', 'Giỏ Hàng')

@section('content')
    @include('client.components.breadcrumb')
    @include('client.pages.cart.shopping-cart')
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Xử lý khi bấm nút + hoặc -
            $(".input-group").on("click", "button", function() {
                var $button = $(this);
                var $input = $button.siblings("input"); // Lấy input gần nhất trong cùng nhóm
                var oldValue = parseInt($input.val());

                if ($button.text() === "+") {
                    var newVal = oldValue + 1;
                } else {
                    newVal = oldValue > 1 ? oldValue - 1 : 1; // Không cho phép nhỏ hơn 1
                }

                $input.val(newVal);
            });

            // Xử lý khi người dùng nhập số trực tiếp
            $(".input-group input").on("blur", function() {
                var $input = $(this);
                var value = parseInt($input.val());

                if (isNaN(value) || value < 1) {
                    $input.val(1); // Nếu nhập sai, reset về 1
                }
            });
        });
    </script>
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
            const totalPriceInput = document.getElementById("totalPrice");
            const displayTotalPrice = document.getElementById("displayTotalPrice");

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

                displayTotalPrice.textContent = new Intl.NumberFormat('vi-VN').format(totalPrice) + " VND";
            }

            function updateSelectedIds() {
                let selectedIds = Array.from(checkboxes)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);

                cartItemsInput.value = selectedIds.join(",");
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
@endsection

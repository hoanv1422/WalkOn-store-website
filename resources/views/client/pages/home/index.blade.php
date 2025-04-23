@extends('client.layouts.app')

@section('title', 'Trang chủ')

@section('style')
    <style>
        .modal-content {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .modal-header-1 {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-title {
            color: #333;
            font-weight: 600;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .product-img-modal {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #eee;
        }

        .form-select,
        .form-control {
            border-radius: 6px;
            border: 1px solid #ddd;
            padding: 0.5rem;
        }

        .form-select:focus,
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 0.5rem 1.5rem;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-outline-secondary {
            border-color: #ccc;
            color: #666;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s;
        }

        .btn-outline-secondary:hover {
            background-color: #f8f9fa;
            border-color: #999;
            color: #333;
        }

        .text-danger {
            font-size: 1.1rem;
        }

        .form-label {
            margin-bottom: 0.3rem;
            color: #555;
        }
    </style>
    <style>
        .btn-outline-secondary {
            transition: all 0.2s;
        }

        .btn-outline-secondary.active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .btn-outline-secondary:hover:not(.active) {
            background-color: #f8f9fa;
            color: #333;
        }

        .btn-outline-secondary:focus {
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        .color-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 2px solid #ddd;
            margin: 4px;
            cursor: pointer;
            outline: none;
            transition: transform 0.2s ease;
        }

        .color-btn:hover {
            transform: scale(1.1);
            border-color: #999;
        }

        .color-btn.active {
            border: 2px solid #000;
        }
    </style>
@endsection

@section('content')
    @foreach (['slider', 'banner', 'features-product', 'new-product', 'hot-product', 'product', 'another-banner', 'testimonial', 'blog', 'newsletter'] as $section)
        @include("client.pages.home.$section")
    @endforeach
@endsection
@section('script')

    <!-- products area end -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const forms = document.querySelectorAll('.add-to-cart-form');
            const modalElement = document.getElementById('cartModal');
            const modal = new bootstrap.Modal(modalElement);

            forms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    const formData = new FormData(form);
                    const url = form.action + '?' + new URLSearchParams(formData).toString();

                    fetch(url, {
                            method: 'GET',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById('product-id-modal').value = data.data
                                    .id;
                                document.getElementById('product-name-modal').textContent = data
                                    .data.name;
                                document.getElementById('product-quantity-modal').textContent =
                                    'Còn ' + data.data.quantity + ' sản phẩm';
                                const initialQuantity = data.data.quantity;
                                document.getElementById('product-image-modal').setAttribute(
                                    'src', 'http://127.0.0.1:8000/storage/' + data.data.image);
                                const priceProduct = Number(data.data.price);
                                const priceSaleProduct = Number(data.data.price_sale);
                                if (priceSaleProduct > 0 && priceSaleProduct < priceProduct) {
                                    document.getElementById('product-price-modal').textContent =
                                        `${priceProduct.toLocaleString('vi-VN')} VND`;
                                    document.getElementById('product-price-sale-modal')
                                        .textContent =
                                        `${priceSaleProduct.toLocaleString('vi-VN')} VND`;
                                } else {
                                    document.getElementById('product-price-sale-modal')
                                        .textContent =
                                        `${priceProduct.toLocaleString('vi-VN')} VND`;
                                    document.getElementById('product-price-modal').textContent =
                                        '';
                                }


                                // Đổ màu sắc
                                const colorOptions = document.getElementById('color-options');
                                const colorForCart = document.getElementById('color-for-cart');
                                const sizeForCart = document.getElementById('size-for-cart');
                                colorOptions.innerHTML = '';
                                data.data.colors.forEach((color, index) => {
                                    const active = index === 0 ? 'active' : '';
                                    colorOptions.innerHTML += `
                                <button type="button" name="color" style="background-color: ${color.code};"  class=" color-btn" data-value="${color.id}" value="${color.id}"></button>
                            `;
                                });

                                // Đổ kích cỡ
                                const sizeOptions = document.getElementById('size-options');
                                sizeOptions.innerHTML = '';
                                data.data.sizes.forEach((size, index) => {
                                    const active = index === 0 ? 'active' : '';
                                    sizeOptions.innerHTML += `
                                <button type="button" name="size" class="btn btn-outline-secondary size-btn" data-value="${size.id}" value="${size.id}">${size.size}</button>
                            `;
                                });

                                // Hàm kiểm tra và đặt lại số lượng
                                function updateQuantityDisplay() {
                                    const activeColor = document.querySelector(
                                        '.color-btn.active');
                                    const activeSize = document.querySelector(
                                        '.size-btn.active');
                                    if (!activeColor && !activeSize) {
                                        document.getElementById('product-quantity-modal')
                                            .textContent = 'Còn ' + initialQuantity +
                                            ' sản phẩm';
                                        if (priceSaleProduct > 0 && priceSaleProduct <
                                            priceProduct) {
                                            document.getElementById('product-price-modal')
                                                .textContent =
                                                `${priceProduct.toLocaleString('vi-VN')} VND`;
                                            document.getElementById('product-price-sale-modal')
                                                .textContent =
                                                `${priceSaleProduct.toLocaleString('vi-VN')} VND`;
                                        } else {
                                            document.getElementById('product-price-sale-modal')
                                                .textContent =
                                                `${priceProduct.toLocaleString('vi-VN')} VND`;
                                            document.getElementById('product-price-modal')
                                                .textContent = '';
                                        }
                                        document.getElementById('product-image-modal')
                                            .setAttribute('src',
                                                'http://127.0.0.1:8000/storage/' + data.data
                                                .image);
                                    }
                                }

                                // Hàm cập nhật trạng thái kích cỡ dựa trên màu
                                function updateSizeAvailability(selectedColorId) {
                                    const sizeButtons = document.querySelectorAll('.size-btn');
                                    sizeButtons.forEach(button => {
                                        const sizeId = button.getAttribute(
                                            'data-value');
                                        const variant = data.data.variants.find(v =>
                                            v.color_id == selectedColorId && v
                                            .size_id == sizeId
                                        );

                                        if (variant && variant.quantity > 0) {
                                            const priceVariant = Number(variant.price);
                                            const priceSaleVariant = Number(variant
                                                .price_sale);

                                            button.disabled = false;
                                            button.classList.remove('btn-disabled');
                                            if (button.classList.contains('active')) {
                                                document.getElementById(
                                                        'product-quantity-modal')
                                                    .textContent = 'Còn ' + variant
                                                    .quantity + ' sản phẩm';
                                                if (priceSaleVariant > 0 &&
                                                    priceSaleVariant < priceVariant) {
                                                    document.getElementById(
                                                            'product-price-modal')
                                                        .textContent =
                                                        `${priceVariant.toLocaleString('vi-VN')} VND`;
                                                    document.getElementById(
                                                            'product-price-sale-modal')
                                                        .textContent =
                                                        `${priceSaleVariant.toLocaleString('vi-VN')} VND`;
                                                } else {
                                                    document.getElementById(
                                                            'product-price-sale-modal')
                                                        .textContent =
                                                        `${priceVariant.toLocaleString('vi-VN')} VND`;
                                                    document.getElementById(
                                                            'product-price-modal')
                                                        .textContent = '';
                                                }
                                                document.getElementById(
                                                        'product-image-modal')
                                                    .setAttribute('src',
                                                        'http://127.0.0.1:8000/storage/' +
                                                        variant.image);
                                            }
                                        } else {
                                            button.disabled = true;
                                            button.classList.add('btn-disabled');
                                            button.classList.remove('active');
                                        }
                                    });

                                    const activeSize = document.querySelector(
                                        '.size-btn.active');
                                    if (!activeSize || activeSize.disabled) {
                                        const firstAvailableSize = document.querySelector(
                                            '.size-btn:not(.btn-disabled)');
                                        if (firstAvailableSize) {
                                            sizeButtons.forEach(btn => btn.classList.remove(
                                                'active'));
                                        }
                                    }
                                    updateQuantityDisplay(); // Kiểm tra sau khi cập nhật
                                }

                                // Hàm cập nhật trạng thái màu dựa trên kích cỡ
                                function updateColorAvailability(selectedSizeId) {
                                    const colorButtons = document.querySelectorAll(
                                        '.color-btn');
                                    colorButtons.forEach(button => {
                                        const colorId = button.getAttribute(
                                            'data-value');
                                        const variant = data.data.variants.find(v =>
                                            v.color_id == colorId && v.size_id ==
                                            selectedSizeId
                                        );

                                        if (variant && variant.quantity > 0) {
                                            const priceVariant = Number(variant.price);
                                            const priceSaleVariant = Number(variant
                                                .price_sale);
                                            button.disabled = false;
                                            button.classList.remove('btn-disabled');
                                            if (button.classList.contains('active')) {
                                                document.getElementById(
                                                        'product-quantity-modal')
                                                    .textContent = 'Còn ' + variant
                                                    .quantity + ' sản phẩm';
                                                if (priceSaleVariant > 0 &&
                                                    priceSaleVariant < priceVariant) {
                                                    document.getElementById(
                                                            'product-price-modal')
                                                        .textContent =
                                                        `${priceVariant.toLocaleString('vi-VN')} VND`;
                                                    document.getElementById(
                                                            'product-price-sale-modal')
                                                        .textContent =
                                                        `${priceSaleVariant.toLocaleString('vi-VN')} VND`;
                                                } else {
                                                    document.getElementById(
                                                            'product-price-sale-modal')
                                                        .textContent =
                                                        `${priceVariant.toLocaleString('vi-VN')} VND`;
                                                    document.getElementById(
                                                            'product-price-modal')
                                                        .textContent = '';
                                                }
                                                document.getElementById(
                                                        'product-image-modal')
                                                    .setAttribute('src',
                                                        'http://127.0.0.1:8000/storage/' +
                                                        variant.image);
                                            }
                                        } else {
                                            button.disabled = true;
                                            button.classList.add('btn-disabled');
                                            button.classList.remove('active');
                                        }
                                    });

                                    const activeColor = document.querySelector(
                                        '.color-btn.active');
                                    if (!activeColor || activeColor.disabled) {
                                        const firstAvailableColor = document.querySelector(
                                            '.color-btn:not(.btn-disabled)');
                                        if (firstAvailableColor) {
                                            colorButtons.forEach(btn => btn.classList.remove(
                                                'active'));
                                        }
                                    }
                                    updateQuantityDisplay(); // Kiểm tra sau khi cập nhật
                                }

                                // Quản lý màu sắc với toggle
                                const colorButtons = document.querySelectorAll('.color-btn');
                                 colorButtons.forEach(button => {
                                    button.addEventListener('click', function() {
                                        if (!this.disabled) {
                                            const isActive = this.classList
                                                .contains('active');
                                            colorButtons.forEach(btn => btn
                                                .classList.remove('active'));
                                            if (!isActive) {
                                                this.classList.add('active');
                                                const selectedColorId = this
                                                    .getAttribute('data-value');
                                                colorForCart.value =
                                                    selectedColorId;
                                                updateSizeAvailability(
                                                    selectedColorId);
                                            } else {
                                                colorForCart.value = '';
                                                const sizeButtons = document
                                                    .querySelectorAll(
                                                        '.size-btn');
                                                sizeButtons.forEach(button => {
                                                    button.disabled =
                                                        false;
                                                    button.classList
                                                        .remove(
                                                            'btn-disabled'
                                                        );
                                                });
                                                updateQuantityDisplay
                                                    (); // Cập nhật số lượng khi bỏ chọn
                                            }
                                        }
                                    });
                                });

                                // Quản lý kích cỡ với toggle
                                const sizeButtons = document.querySelectorAll('.size-btn');
                                 sizeButtons.forEach(button => {
                                    button.addEventListener('click', function() {
                                        if (!this.disabled) {
                                            const isActive = this.classList
                                                .contains('active');
                                            sizeButtons.forEach(btn => btn
                                                .classList.remove('active'));
                                            if (!isActive) {
                                                this.classList.add('active');
                                                const selectedSizeId = this
                                                    .getAttribute('data-value');
                                                sizeForCart.value =
                                                    selectedSizeId;
                                                updateColorAvailability(
                                                    selectedSizeId);
                                            } else {
                                                sizeForCart.value = '';
                                                const colorButtons = document
                                                    .querySelectorAll(
                                                        '.color-btn');
                                                colorButtons.forEach(button => {
                                                    button.disabled =
                                                        false;
                                                    button.classList
                                                        .remove(
                                                            'btn-disabled'
                                                        );
                                                });
                                                updateQuantityDisplay
                                                    (); // Cập nhật số lượng khi bỏ chọn
                                            }
                                        }
                                    });
                                });

                                modal.show();
                            } else {
                                console.error('Lỗi:', data.message);
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Lỗi:', error);
                            alert('Đã có lỗi xảy ra!');
                        });
                });
            });

            // Xử lý khi modal đóng
            modalElement.addEventListener('hidden.bs.modal', function() {
                forms.forEach(form => form.reset());
                const backdrops = document.querySelectorAll('.modal-backdrop');
                backdrops.forEach(backdrop => backdrop.remove());
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            });
        });
    </script>

    <script>
        document.getElementById('add-to-cart-api').addEventListener('submit', function(e) {
            e.preventDefault();


            const formData = new FormData(this);
            console.log(formData);
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content ||
                document.querySelector('input[name="_token"]').value;

            fetch("{{ route('cartApi.add') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    const errorModal = document.getElementById('error-modal');
                    errorModal.innerHTML = ''; // Xóa lỗi cũ

                    if (data.status === 'success') {

                        document.getElementById('notificationModalBody').innerText = data.message;

                        const notificationModalEl = document.getElementById('notificationModal');

                        const notificationModal = new bootstrap.Modal(notificationModalEl);
                        notificationModal.show();

                        setTimeout(() => {
                            notificationModal.hide();
                        }, 1000);

                        bootstrap.Modal.getInstance(document.getElementById('cartModal')).hide();
                        fetchCart();
                    } else {
                        if (data.errors) {
                            let errorMessages = '';
                            Object.values(data.errors).forEach(error => {
                                errorMessages += error[0] + '<br>';
                            });
                            errorModal.innerHTML = errorMessages;
                        } else {
                            errorModal.innerHTML = data.message;
                        }
                    }
                })



                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('error-modal').innerHTML =
                        'Đã xảy ra lỗi khi thêm sản phẩm vào giỏ hàng!';
                });
        });
    </script>
@endsection

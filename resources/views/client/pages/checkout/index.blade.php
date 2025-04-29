@extends('client.layouts.app')

@section('title', 'Checkout')
@section('breadcrumb', 'Thanh Toán')

@section('style')
    <style>
        .address-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .address-item:hover {
            border-color: #3498db;
            background: #f8f9fa;
        }

        .address-item.selected {
            border-color: #3498db;
            background: #eef5ff;
        }

        .address-content {
            flex: 1;
        }

        .address-actions {
            display: flex;
            gap: 8px;
            margin-left: 15px;
        }

        .address-actions button {
            padding: 4px 12px;
            font-size: 0.85rem;
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
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .modal-body {
            max-height: 400px;
            overflow-y: auto;
            padding: 15px;
        }

        .btn-close {
            background-color: transparent;
            border: none;
            opacity: 0.7;
            transition: opacity 0.2s ease-in-out;
        }

        .btn-close:hover {
            opacity: 1;
        }


        .checkout-container {
            max-width: 1200px;
            margin: 40px auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .section-title {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 25px;
            position: relative;
        }

        .section-title::after {
            content: '';
            width: 50px;
            height: 3px;
            background: #3498db;
            position: absolute;
            bottom: -10px;
            left: 0;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        .address-display {
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            background: #f8f9fa;
        }

        .address-item {
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .address-item:hover {
            border-color: #3498db;
            background: #f8f9fa;
        }

        .address-item.selected {
            border-color: #3498db;
            background: #eef5ff;
        }

        .coupon-area {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .coupon-wrapper {
            display: flex;
            align-items: stretch;
        }

        .coupon-input {
            border-radius: 25px 0 0 25px;
        }

        .coupon-btn {
            border-radius: 0 25px 25px 0;
            background: #2ecc71;
            border: none;
            padding: 12px 25px;
            position: relative;
            overflow: hidden;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            z-index: 1;
        }

        .coupon-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
            z-index: -1;
        }

        .coupon-btn:hover {
            background: #27ae60;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(46, 204, 113, 0.4);
        }

        .coupon-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .coupon-btn:active {
            transform: translateY(1px);
            box-shadow: 0 2px 5px rgba(46, 204, 113, 0.2);
        }

        .checkout-btn {
            background: #3498db;
            border: none;
            padding: 15px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .checkout-btn:hover {
            background: #2980b9;
        }

        .total-amount {
            color: #e74c3c;
            font-size: 24px;
            font-weight: 700;
        }

        .change-address-btn {
            background: #3498db;
            border: none;
            padding: 8px 20px;
            border-radius: 20px;
            color: white;
            transition: all 0.3s ease;
        }

        .change-address-btn:hover {
            background: #2980b9;
        }

        .payment-option {
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            margin-bottom: 10px;
        }


        .address-modal-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .address-modal-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            background-color: #fff;
            transition: background-color 0.2s ease;
        }

        .address-modal-item:hover {
            background-color: #f5f5f5;
        }

        .address-modal-item.active {
            border-color: #007bff;
            background-color: #e7f1ff;
        }

        .address-modal-info {
            cursor: pointer;
            flex: 1;
        }

        .address-modal-info strong {
            font-size: 16px;
            color: #333;
            display: block;
            margin-bottom: 4px;
        }


        .address-modal-actions {
            display: flex;
            gap: 8px;
        }

        #submit-checkout-button.loading {
            background-color: #0056b3;
            cursor: not-allowed;
            opacity: 0.8;

            position: relative;
        }

        #submit-checkout-button.loading::after {
            content: '';
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid white;
            border-top: 2px solid transparent;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin-left: 8px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
@endsection

@section('content')
    @include('client.components.breadcrumb')
    @include('client.pages.checkout.checkout')
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            let checkoutData = {
                cartItems: [],
                cartItemIds: [],
                totalPrice: 0,
                addresses: [],
                addressDefault: null
            };

            function init() {
                fetchCheckoutData();
            }

            init();

            function fetchCheckoutData() {
                const urlParams = new URLSearchParams(window.location.search);
                const cartItems = urlParams.get('cartItems') || '';

                fetch(`/api/checkout?cartItems=${encodeURIComponent(cartItems)}`, {
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + localStorage.getItem(
                                'token') // Adjust based on your auth method
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.status === 'success') {
                            checkoutData = data.data;
                            console.log('Checkout Data:', checkoutData);
                            renderCheckout();
                        } else {

                        }
                    })
                    .catch(error => {
                        console.error('Fetch Error:', error);
                    });
            }

            function renderCheckout() {
                // Render default address
                const currentAddress = document.getElementById('current-address');
                const selectedAddress = document.getElementById('selected-address');
                const selectedLat = document.getElementById('selected-lat');
                const selectedLon = document.getElementById('selected-lon');

                if (checkoutData.addressDefault && currentAddress && selectedAddress) {
                    currentAddress.innerHTML = `
                    <strong class="d-block">${checkoutData.addressDefault.type_label || 'N/A'}</strong>
                    <span class="d-block">${checkoutData.addressDefault.full_address || 'N/A'}</span>
                `;
                    selectedAddress.value = checkoutData.addressDefault.full_address || '';
                    selectedLat.value = checkoutData.addressDefault.latitude || '';
                    selectedLon.value = checkoutData.addressDefault.longitude || '';
                    const initialLat = selectedLat.value;
                    const initialLon = selectedLon.value;
                    if (initialLat && initialLon) {
                        calculateDistance(initialLat, initialLon).then(() => updatePrices());
                    } else {
                        document.getElementById('distance-display').innerHTML =
                            'Không có thông tin khoảng cách (thiếu tọa độ)';
                    }
                } else {
                    console.warn('Warning: addressDefault or address DOM elements not found');
                    if (currentAddress) {
                        currentAddress.innerHTML = '<span class="text-muted">No default address</span>';
                    }
                }

                // Render cart items
                const orderItemsCheckout = document.querySelector('.order-items');
                if (!orderItemsCheckout) {
                    console.error('Error: .order-items element not found in the DOM');
                    return;
                }

                if (checkoutData.cartItems && Array.isArray(checkoutData.cartItems)) {
                    if (checkoutData.cartItems.length === 0) {
                        orderItemsCheckout.innerHTML = '<div class="text-center text-muted">No items in cart</div>';
                        console.log('Info: cartItems is empty');
                        return;
                    }

                    try {
                        const cartItemsHtml = checkoutData.cartItems.map((cartItem, index) => {
                            console.log(`CartItem ${index}:`, cartItem);
                            const productName = cartItem?.product_variant?.product?.name ||
                                'Unknown Product';
                            const imageUrl = cartItem?.product_variant?.image || '';
                            const quantity = cartItem?.quantity || 0;
                            const color = cartItem?.product_variant?.color?.color || 'N/A';
                            const size = cartItem?.product_variant?.size?.size || 'N/A';
                            const price = cartItem?.formatted_price || 0;

                            return `
                    <input type="hidden" name="cartItemIds[]" class="cartItemIds" value="${cartItem.id || ''}">
                    <div class="order-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="${imageUrl}" 
                                 alt="${productName}" 
                                 class="me-3" 
                                 style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                            <div>
                                <span>${productName} × ${quantity}</span>
                                <div class="text-muted small">
                                    Màu: ${color} | Size: ${size}
                                </div>
                            </div>
                        </div>
                        <span>${price.toLocaleString('vi-VN')} VND</span>
                    </div>
                `;
                        }).join('');
                        orderItemsCheckout.innerHTML = cartItemsHtml;
                    } catch (error) {
                        console.error('Error rendering cart items:', error);
                        orderItemsCheckout.innerHTML =
                            '<div class="text-center text-danger">Error loading cart items</div>';
                    }
                } else {
                    console.warn('Warning: checkoutData.cartItems is not an array or is undefined', checkoutData);
                    orderItemsCheckout.innerHTML = '<div class="text-center text-muted">No items in cart</div>';
                }

                document.getElementById('totalPriceForCoupon').value = checkoutData.totalPrice;

                const cartItemsForCouponDisplay = document.getElementById('cart-items-for-coupon');
                if (checkoutData.cartItems && Array.isArray(checkoutData.cartItems)) {
                    try {
                        const cartItemsForCoupon = checkoutData.cartItems.map(cartItem => {
                            return `<input type="hidden" name="cartItemsForCoupon[]"
                        value="${cartItem.id}" form="coupon-form">`;
                        }).join('');
                        cartItemsForCouponDisplay.innerHTML = cartItemsForCoupon;
                    } catch (error) {
                        console.error('Error rendering cart items:', error);
                    }
                } else {
                    console.warn('Warning: checkoutData.cartItems is not an array or is undefined', checkoutData);
                }

                document.getElementById('displayTotalPrice').textContent = formatVND(checkoutData.totalPrice);
                document.getElementById('totalPrice').value = checkoutData.totalPrice;

                // Render addresses using the new function
                const addressesDisplay = document.getElementById('address-list');
                renderAddresses(checkoutData.addresses, addressesDisplay);
            }


            $('#coupon-form').on('submit', function(event) {
                event.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                    url: '/api/coupon-apply',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#couponMessage').html('<p class="text-success">' + response.message +
                            '</p>');

                        let discount = response.discount || 0;
                        let shippingDiscount = response.shipping_discount || 0;
                        let finalPrice = response.finalPrice || 0;

                        $('#displayDiscount').text('-' + formatVND(discount +
                            shippingDiscount));
                        $('#discountAmount').val(discount + shippingDiscount);
                        let newShippingFee = parseInt($('#shippingFee').val()) -
                            shippingDiscount;
                        $('#displayShippingFee').text(formatVND(newShippingFee));
                        $('#shippingFee').val(newShippingFee);
                        $('#displayFinalPrice').text(formatVND(finalPrice));
                        $('#finalPrice').val(finalPrice);

                        let couponCode = $('#couponCodeInput').val();
                        $('#couponCodeForOrder').val(couponCode);
                        $('#couponCodeInput').prop('disabled', true);
                    },
                    error: function(xhr) {
                        let errorMessage = xhr.responseJSON?.message || 'Đã xảy ra lỗi!';
                        $('#couponMessage').html('<p class="text-danger">' + errorMessage +
                            '</p>');
                        $('#couponCodeInput').prop('disabled', false);
                    }
                });
            });

            // Sự kiện xóa mã giảm giá
            $('#clearCoupon').on('click', function(event) {
                event.preventDefault();
                $('#couponCodeInput').val('');
                $('#couponMessage').html('');
                $('#couponCodeForOrder').val('');
                $('#displayDiscount').text('-0 VND');
                $('#discountAmount').val(0);
                updatePrices();
                $('#couponCodeInput').prop('disabled', false);
            });



            // Sự kiện modal
            document.getElementById('').addEventListener('hidden.bs.modal', () => {
                document.getElementById('newAddressName').value = '';
                document.getElementById('newAddressDetail').value = '';
            });

            document.getElementById('addressModal').addEventListener('show.bs.modal', () => {
                const firstAddress = document.querySelector('.address-item');
                if (firstAddress && !selectedAddressElement) {
                    selectAddress(firstAddress);
                }
            });

            initAddressForm();
        });

        const checkoutForm = document.getElementById('checkout-form');
        if (checkoutForm) {
            checkoutForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const cartItemIds = [];
                const receiverName = document.getElementById('receiver-name')?.value || '';
                const receiverEmail = document.getElementById('receiver-email')?.value || '';
                const receiverPhone = document.getElementById('receiver-phone')?.value || '';
                const receiverAddress = document.getElementById('selected-address')?.value || '';
                const cartItemIdsCheckout = document.querySelectorAll('.cartItemIds');
                const couponName = document.getElementById('couponCodeForOrder')?.value || '';
                const totalPrice = document.getElementById('totalPrice')?.value || '0';
                const discountAmount = document.getElementById('discountAmount')?.value || '0';
                const shippingFee = document.getElementById('shippingFee')?.value || '0';
                const finalPrice = document.getElementById('totalPrice')?.value || '0';
                const paymentMethod = document.querySelector('input[name="payment_method"]:checked')?.value || '';
                const noteCheckout = document.getElementById('code')?.value || '';
                const submitCheckoutButton = document.getElementById('submit-checkout-button');

                cartItemIdsCheckout.forEach(cartItemId => {
                    if (cartItemId.value) {
                        cartItemIds.push(cartItemId.value);
                    }
                });

                clearAllErrors();

                if (!submitCheckoutButton) {
                    console.error('Submit button not found');
                    showMessage('Đã xảy ra lỗi', '#F44336');
                    return;
                }

                // Check if form is already being processed
                if (submitCheckoutButton.dataset.isSubmitting === 'true') {
                    return; // Prevent multiple submissions
                }

                submitCheckoutButton.dataset.isSubmitting = 'true';
                submitCheckoutButton.classList.add('loading');
                submitCheckoutButton.textContent = 'Đang tạo đơn...';

                fetch('/checkout', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                                'content') || ''
                        },
                        body: JSON.stringify({
                            receiver_name: receiverName,
                            receiver_email: receiverEmail,
                            receiver_phone: receiverPhone,
                            receiver_address: receiverAddress,
                            note: noteCheckout,
                            cartItemIds: cartItemIds,
                            couponCodeForOrder: couponName,
                            totalPrice: totalPrice,
                            discountAmount: discountAmount,
                            shippingFee: shippingFee,
                            finalPrice: finalPrice,
                            payment_method: paymentMethod
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success === true) {
                            if (data.redirect_url) {
                                window.location.assign(data.redirect_url);
                            } else {
                                window.location.href = '/order-list';
                            }
                        } else {
                            if (data.errors) {
                                if (data.errors.receiver_name) {
                                    showError('receiver-name', data.errors.receiver_name[0]);
                                }
                                if (data.errors.receiver_email) {
                                    showError('receiver-email', data.errors.receiver_email[0]);
                                }
                                if (data.errors.receiver_phone) {
                                    showError('receiver-phone', data.errors.receiver_phone[0]);
                                }
                                if (data.errors.receiver_address) {
                                    showError('selected-address', data.errors.receiver_address[0]);
                                }
                                if (data.errors.note) {
                                    showError('note', data.errors.note[0]);
                                }
                            } else if (data.message) {
                                showMessage(data.message, '#F44336');
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showMessage('Đã xảy ra lỗi', '#F44336');
                    })
                    .finally(() => {
                        // Reset submitting state and button appearance
                        submitCheckoutButton.dataset.isSubmitting = 'false';
                        submitCheckoutButton.classList.remove('loading');
                        submitCheckoutButton.textContent = 'Đặt Hàng Ngay';
                    });
            });
        }

        function showError(fieldId, errorMessage) {
            const field = document.getElementById(fieldId);
            if (!field) return;

            // Thêm class is-invalid cho input
            field.classList.add('is-invalid');

            // Tạo phần tử thông báo lỗi
            const errorDiv = document.createElement('span');
            errorDiv.className = 'invalid-feedback d-block';
            errorDiv.textContent = errorMessage;

            // Thêm thông báo lỗi vào sau input (hoặc input-group nếu có)
            const parentElement = field;
            parentElement.parentNode.appendChild(errorDiv);
        }

        function clearAllErrors() {
            const errorElements = document.querySelectorAll('.invalid-feedback');
            errorElements.forEach(element => element.remove());

            const invalidInputs = document.querySelectorAll('.is-invalid');
            invalidInputs.forEach(input => input.classList.remove('is-invalid'));
        }

        function renderAddresses(addresses, addressesDisplay) {
            if (addresses && Array.isArray(addresses)) {
                try {
                    const addressList = addresses.map(address => {
                        return `<div class="address-item" data-address="${address.full_address}" 
                        data-lat="${address.latitude}" data-lon="${address.longitude}"
                        onclick="selectAddress(this)">
                        <div class="address-content">
                            <strong>${address.type_label}</strong><br>
                            <span>${address.full_address}</span>
                        </div>
                        <div class="address-actions">
                            <button class="btn btn-sm btn-outline-primary edit-btn" 
                                    onclick="editAddress(${address.id}, '${address.city_code}', '${address.district_code}', '${address.ward_code}', '${address.address_line}', '${address.latitude}' , '${address.longitude}', '${address.type}', ${address.is_default})">Sửa</button>
                            <button class="btn btn-sm btn-outline-danger delete-btn" 
                                    data-bs-toggle="modal" data-bs-target="#deleteAddressModal" 
                                    onclick="setModalAddressId('delete-address-id', ${address.id})">Xóa</button>
                        </div>
                    </div>`;
                    }).join('');
                    addressesDisplay.innerHTML = addressList;
                } catch (error) {
                    console.error('Error rendering addresses:', error);
                    addressesDisplay.innerHTML = '<div class="text-center text-danger">Error loading addresses</div>';
                }
            } else {
                console.warn('Warning: addresses is not an array or is undefined', addresses);
                addressesDisplay.innerHTML = '<div class="text-center text-muted">No addresses available</div>';
            }
        }
    </script>

    <script>
        let selectedAddressElement = null;
        const defaultLat = 21.0285;
        const defaultLon = 105.8542;

        function formatVND(amount) {
            return new Intl.NumberFormat('vi-VN', {
                maximumFractionDigits: 0
            }).format(amount) + ' VND';
        }

        function selectAddress(element) {
            document.querySelectorAll('.address-item').forEach(item => {
                item.classList.remove('selected');
            });
            element.classList.add('selected');
            selectedAddressElement = element;
        }

        async function confirmAddress() {
            if (selectedAddressElement) {
                const addressText = selectedAddressElement.getAttribute('data-address');
                const addressName = selectedAddressElement.querySelector('strong').textContent;
                const lat = selectedAddressElement.getAttribute('data-lat');
                const lon = selectedAddressElement.getAttribute('data-lon');
                const shippingFee = document.getElementById('shippingFee');
                const displayShippingFee = document.getElementById('displayShippingFee');

                document.getElementById('current-address').innerHTML =
                    `<strong>${addressName}</strong><br><span>${addressText}</span>`;
                document.getElementById('selected-address').value = addressText;
                const latitude = document.getElementById('selected-lat').value = lat || '';
                const longitude = document.getElementById('selected-lon').value = lon || '';

                const modal = bootstrap.Modal.getInstance(document.getElementById('addressModal'));
                modal.hide();

                if (latitude && longitude) {
                    await calculateDistance(latitude, longitude);
                    updatePrices();
                } else {
                    document.getElementById('distance-display').innerHTML =
                        'Không có thông tin khoảng cách (thiếu tọa độ)';
                    shippingFee.value = 0;
                    displayShippingFee.innerHTML = formatVND(0);
                    updatePrices();
                }
            } else {
                alert('Vui lòng chọn một địa chỉ!');
            }
        }

        function hideAddressModal() {
            const addressModal = bootstrap.Modal.getInstance(document.getElementById('addressModal'));
            addressModal.hide();
        }

        function showAddressModal() {
            // Reset the form for a new address
            document.getElementById('address-form').reset();
            document.getElementById('address-id').value = '';
            document.getElementById('AddressModalLabel').textContent = 'Thêm Địa Chỉ Mới';

            // Load provinces
            loadProvinces();

            // Reset other fields
            document.getElementById('district').innerHTML = '<option value="">-- Chọn Quận/Huyện --</option>';
            document.getElementById('district').disabled = true;
            document.getElementById('ward').innerHTML = '<option value="">-- Chọn Phường/Xã --</option>';
            document.getElementById('ward').disabled = true;

            // Clear hidden fields
            document.getElementById('provinceName').value = '';
            document.getElementById('districtName').value = '';
            document.getElementById('wardName').value = '';
            document.getElementById('latitude').value = '';
            document.getElementById('longitude').value = '';
        }

        async function calculateDistance(lat2, lon2) {
            const apiKey = '8c5e66d0-53b9-4218-af36-3223f27769ec';
            const url =
                `https://graphhopper.com/api/1/route?point=${defaultLat},${defaultLon}&point=${lat2},${lon2}&vehicle=car&locale=vi&key=${apiKey}`;
            const distanceDisplay = document.getElementById('distance-display');
            const shippingFee = document.getElementById('shippingFee');
            const displayShippingFee = document.getElementById('displayShippingFee');
            const shippingFeeForCoupon = document.getElementById('shippingFeeForCoupon');

            try {
                const response = await fetch(url);
                const data = await response.json();

                if (data.paths && data.paths.length > 0) {
                    const distance = parseFloat((data.paths[0].distance / 1000).toFixed(2));
                    distanceDisplay.innerHTML = `Khoảng cách từ Hà Nội: ${distance} km`;
                    shippingFee.value = calculateShippingFee(distance);
                    shippingFeeForCoupon.value = calculateShippingFee(distance);
                    displayShippingFee.innerHTML = formatVND(shippingFee.value);
                } else {
                    distanceDisplay.innerHTML = 'Không thể tính khoảng cách!';
                    shippingFee.value = 0;
                    displayShippingFee.innerHTML = formatVND(0);
                }
            } catch (error) {
                distanceDisplay.innerHTML = 'Lỗi khi tính khoảng cách!';
                shippingFee.value = 0;
                displayShippingFee.innerHTML = formatVND(0);
                console.error(error);
            }
        }

        function calculateShippingFee(distance) {
            if (distance <= 10) return distance * 300;
            else if (distance <= 50) return (10 * 300) + ((distance - 10) * 500);
            else return (10 * 300) + (40 * 500) + ((distance - 50) * 700);
        }

        function updatePrices() {
            let originalTotalPrice = parseInt($('#totalPrice').val()) || 0;
            let shippingFee = parseInt($('#shippingFee').val()) || 0;
            let discount = parseInt($('#discountAmount').val()) || 0;
            let finalPrice = originalTotalPrice + shippingFee - discount;

            $('#displayTotalPrice').text(formatVND(originalTotalPrice));
            $('#displayShippingFee').text(formatVND(shippingFee));
            $('#displayDiscount').text('-' + formatVND(discount));
            $('#displayFinalPrice').text(formatVND(finalPrice));
            $('#finalPrice').val(finalPrice);
            $('#totalPriceForCoupon').val(originalTotalPrice);
        }
    </script>

    <script>
        // Main address handling functions
        const GRAPH_HOPPER_API_KEY = "8c5e66d0-53b9-4218-af36-3223f27769ec";

        document.addEventListener("DOMContentLoaded", function() {
            // Initialize address form and setup event listeners
            initAddressForm();

            // Set up form submission handlers
            const addressForm = document.getElementById('address-form');
            if (addressForm) {
                addressForm.addEventListener('submit', handleAddAddress);
            }

            const deleteForm = document.querySelector('#deleteAddressModal form');
            if (deleteForm) {
                deleteForm.addEventListener('submit', handleDeleteAddress);
            }

            // Setup initial modal event listeners
            setupModalListeners();
            openAddressModal();

        });


        function openAddressModal() {
            // Mở AddressModal mà không tạo backdrop mới
            $('#AddressModal').modal({
                backdrop: false // Không tạo backdrop để tránh che khuất addressModal
            });

            // Đặt z-index cho AddressModal cao hơn addressModal
            $('#AddressModal').css('z-index', 1060);

            // Đảm bảo backdrop chung (nếu có) có z-index thấp hơn cả hai modal
            $('.modal-backdrop').css('z-index', 1040);
        }

        // Initialize the address form with event listeners
        function initAddressForm() {
            // Load provinces initially
            loadProvinces();

            // Set up change event listeners for dropdowns
            const provinceSelect = document.getElementById('province');
            const districtSelect = document.getElementById('district');
            const wardSelect = document.getElementById('ward');

            if (provinceSelect && districtSelect && wardSelect) {
                provinceSelect.addEventListener('change', () => {
                    loadDistricts();
                    updateHiddenInputs();
                });

                districtSelect.addEventListener('change', () => {
                    loadWards();
                    updateHiddenInputs();
                });

                wardSelect.addEventListener('change', () => {
                    updateHiddenInputs();
                    getCoordinates();
                });
            }
        }

        // Load provinces from API
        async function loadProvinces() {
            const provinceSelect = document.getElementById('province');
            if (!provinceSelect) return Promise.resolve();

            try {
                const response = await fetch('https://provinces.open-api.vn/api/p/');
                const provinces = await response.json();

                provinceSelect.innerHTML = '<option value="">-- Chọn Tỉnh/Thành phố --</option>';
                provinces.forEach(prov => {
                    const option = document.createElement('option');
                    option.value = prov.code;
                    option.text = prov.name;
                    provinceSelect.appendChild(option);
                });

                return Promise.resolve();
            } catch (error) {
                console.error('Lỗi khi tải tỉnh/thành:', error);
                return Promise.reject(error);
            }
        }

        // Load districts based on selected province
        async function loadDistricts() {
            const provinceCode = document.getElementById('province').value;
            const districtSelect = document.getElementById('district');
            const wardSelect = document.getElementById('ward');

            districtSelect.innerHTML = '<option value="">-- Chọn Quận/Huyện --</option>';
            wardSelect.innerHTML = '<option value="">-- Chọn Phường/Xã --</option>';
            districtSelect.disabled = true;
            wardSelect.disabled = true;

            if (provinceCode) {
                try {
                    const response = await fetch(`https://provinces.open-api.vn/api/p/${provinceCode}?depth=2`);
                    const data = await response.json();
                    const districts = data.districts;

                    districts.forEach(dist => {
                        const option = document.createElement('option');
                        option.value = dist.code;
                        option.text = dist.name;
                        districtSelect.appendChild(option);
                    });

                    districtSelect.disabled = false;
                } catch (error) {
                    console.error('Lỗi khi tải quận/huyện:', error);
                }
            }
        }

        // Load wards based on selected district
        async function loadWards() {
            const districtCode = document.getElementById('district').value;
            const wardSelect = document.getElementById('ward');

            wardSelect.innerHTML = '<option value="">-- Chọn Phường/Xã --</option>';
            wardSelect.disabled = true;

            if (districtCode) {
                try {
                    const response = await fetch(`https://provinces.open-api.vn/api/d/${districtCode}?depth=2`);
                    const data = await response.json();
                    const wards = data.wards;

                    wards.forEach(ward => {
                        const option = document.createElement('option');
                        option.value = ward.code;
                        option.text = ward.name;
                        wardSelect.appendChild(option);
                    });

                    wardSelect.disabled = false;
                } catch (error) {
                    console.error('Lỗi khi tải phường/xã:', error);
                }
            }
        }

        // Get coordinates from address using GraphHopper API
        async function getCoordinates() {
            const province = document.getElementById('province').options[document.getElementById('province')
                .selectedIndex]?.text || '';
            const district = document.getElementById('district').options[document.getElementById('district')
                .selectedIndex]?.text || '';
            const ward = document.getElementById('ward').options[document.getElementById('ward').selectedIndex]?.text ||
                '';

            if (!province || !district || !ward) return;

            const query = `${ward}, ${district}, ${province}, Vietnam`;

            try {
                const response = await fetch(
                    `https://graphhopper.com/api/1/geocode?q=${encodeURIComponent(query)}&key=${GRAPH_HOPPER_API_KEY}`
                );
                const data = await response.json();

                if (data.hits && data.hits.length > 0) {
                    const {
                        lat,
                        lng
                    } = data.hits[0].point;
                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lng;
                } else {
                    document.getElementById('latitude').value = '';
                    document.getElementById('longitude').value = '';
                }
            } catch (error) {
                console.error('Lỗi khi lấy tọa độ:', error);
                document.getElementById('latitude').value = '';
                document.getElementById('longitude').value = '';
            }
        }

        // Update hidden inputs with location names
        function updateHiddenInputs() {
            const province = document.getElementById('province').options[document.getElementById('province').selectedIndex]
                ?.text || '';
            const district = document.getElementById('district').options[document.getElementById('district').selectedIndex]
                ?.text || '';
            const ward = document.getElementById('ward').options[document.getElementById('ward').selectedIndex]?.text || '';

            document.getElementById('provinceName').value = province;
            document.getElementById('districtName').value = district;
            document.getElementById('wardName').value = ward;
        }

        // Setup modal event listeners
        function setupModalListeners() {
            // Add new address button click
            const addNewAddressBtn = document.querySelector('[data-bs-target="#AddressModal"]');
            if (addNewAddressBtn) {
                addNewAddressBtn.addEventListener('click', showAddressModal);
            }

            // Address modal events
            const addressModal = document.getElementById('AddressModal');
            if (addressModal) {
                addressModal.addEventListener('hidden.bs.modal', function() {
                    document.getElementById('address-form').reset();
                    document.getElementById('address-error').classList.add('d-none');
                });
            }
        }

        // Function to prepare modal for adding a new address
        function showAddressModal() {
            // Reset the form
            document.getElementById('address-form').reset();
            document.getElementById('address-error').classList.add('d-none');

            // Clear address ID and set modal title
            document.getElementById('address-id').value = '';
            document.getElementById('AddressModalLabel').textContent = 'Thêm Địa Chỉ Mới';

            // Load provinces
            loadProvinces();

            // Reset other fields
            document.getElementById('district').innerHTML = '<option value="">-- Chọn Quận/Huyện --</option>';
            document.getElementById('district').disabled = true;
            document.getElementById('ward').innerHTML = '<option value="">-- Chọn Phường/Xã --</option>';
            document.getElementById('ward').disabled = true;

            // Clear hidden fields
            document.getElementById('provinceName').value = '';
            document.getElementById('districtName').value = '';
            document.getElementById('wardName').value = '';
            document.getElementById('latitude').value = '';
            document.getElementById('longitude').value = '';

            const addressModal = new bootstrap.Modal(document.getElementById('AddressModal'));
            addressModal.show();
        }

        // Function to prepare modal for editing an address
        function editAddress(addressId, provinceCode, districtCode, wardCode, addressLine, latitude, longitude, addressType,
            isDefault) {
            // Set address ID
            document.getElementById('address-id').value = addressId;

            // Change modal title
            document.getElementById('AddressModalLabel').textContent = 'Sửa Địa Chỉ';

            // Set address details
            document.getElementById('newAddressDetail').value = addressLine;

            // Set address type
            const typeRadios = document.querySelectorAll('input[name="addressType"]');
            typeRadios.forEach(radio => {
                radio.checked = radio.value === addressType;
            });

            // Set default checkbox
            document.getElementById('check-default').checked = isDefault;

            // Reset error message
            document.getElementById('address-error').classList.add('d-none');

            // Load provinces first, then select the correct province
            loadProvinces().then(() => {
                const provinceSelect = document.getElementById('province');
                provinceSelect.value = provinceCode;

                // Load districts for this province, then select the correct district
                loadDistricts().then(() => {
                    const districtSelect = document.getElementById('district');
                    districtSelect.value = districtCode;

                    // Load wards for this district, then select the correct ward
                    loadWards().then(() => {
                        const wardSelect = document.getElementById('ward');
                        wardSelect.value = wardCode;
                        updateHiddenInputs();

                        // Set coordinates
                        document.getElementById('latitude').value = latitude;
                        document.getElementById('longitude').value = longitude;
                    });
                });
            });

            // Open the modal
            const addressModal = new bootstrap.Modal(document.getElementById('AddressModal'));
            addressModal.show();
        }

        // Set address ID in modal forms
        function setModalAddressId(inputId, addressId) {
            const input = document.getElementById(inputId);
            if (input) input.value = addressId;
        }

        // Handle adding or updating an address
        async function handleAddAddress(e) {
            e.preventDefault();

            const errorDiv = document.getElementById('address-error');
            errorDiv.classList.add('d-none');
            errorDiv.innerHTML = '';

            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData);

            if (!data.province_name || !data.city_code || !data.district_name || !data.address_line) {
                errorDiv.innerHTML = 'Vui lòng nhập đầy đủ thông tin bắt buộc.';
                errorDiv.classList.remove('d-none');
                return;
            }

            // Get the address ID to determine if this is an add or edit operation
            const addressId = document.getElementById('address-id').value;
            const isEdit = addressId && addressId.trim() !== '';

            const endpoint = isEdit ? `/api/addresses/${addressId}` : '/api/save-address';
            const method = isEdit ? 'PUT' : 'POST';

            try {
                const response = await fetch(endpoint, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify(data)
                });
                const result = await response.json();

                if (!response.ok) {
                    // Handle validation errors (422) or server errors (500)
                    let errorMessage = result.message || 'Có lỗi xảy ra khi lưu địa chỉ';

                    if (response.status === 422 && result.errors) {
                        // Validation errors
                        errorMessage = Object.values(result.errors)
                            .flat()
                            .map(msg => msg)
                            .join('<br>');
                    } else if (result.error) {
                        // Server error details
                        errorMessage += `: ${result.error}`;
                    }

                    // Show error in modal
                    errorDiv.innerHTML = errorMessage;
                    errorDiv.classList.remove('d-none');
                    return; // Keep modal open
                }

                // Show success message
                showMessage("Lưu địa chỉ thành công!", '#4CAF50');

                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('AddressModal'));
                modal.hide();
                renderAddresses();
            } catch (error) {
                // Network or unexpected errors
                console.error('Error saving address:', error);
                errorDiv.innerHTML = 'Không thể kết nối đến server. Vui lòng thử lại.';
                errorDiv.classList.remove('d-none');
            }
        }

        // Handle address deletion
        async function handleDeleteAddress(event) {
            event.preventDefault();

            const addressId = document.getElementById('delete-address-id').value;
            if (!addressId) return;

            try {
                const response = await fetch(`/api/addresses/${addressId}`, {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute(
                            'content')
                    }
                });
                const result = await response.json();

                if (!response.ok) {
                    throw new Error('Failed to delete address');
                }

                // Show success message
                showMessage("Xóa địa chỉ thành công!", '#4CAF50');

                // Close modal
                const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteAddressModal'));
                if (deleteModal) deleteModal.hide();

                // Refresh address list if fetchAddresses function exists
                if (typeof fetchAddresses === 'function') {
                    fetchAddresses();
                } else {
                    // Alternative: reload the page
                    window.location.reload();
                }
            } catch (error) {
                console.error('Error deleting address:', error);
                showMessage("Lỗi khi xóa địa chỉ.", '#dc3545');
            }
        }

        // Utility function to show messages
        function showMessage(message, color) {
            // Check if toast container exists, create if not
            let toastContainer = document.getElementById('toast-container');
            if (!toastContainer) {
                toastContainer = document.createElement('div');
                toastContainer.id = 'toast-container';
                toastContainer.className = 'position-fixed bottom-0 end-0 p-3';
                document.body.appendChild(toastContainer);
            }

            // Create toast element
            const toastId = 'toast-' + Date.now();
            const toast = document.createElement('div');
            toast.className = 'toast';
            toast.id = toastId;
            toast.setAttribute('role', 'alert');
            toast.setAttribute('aria-live', 'assertive');
            toast.setAttribute('aria-atomic', 'true');

            toast.innerHTML = `
                <div class="toast-header" style="background-color: ${color}; color: white;">
                    <strong class="me-auto">Thông báo</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    ${message}
                </div>
            `;

            toastContainer.appendChild(toast);

            // Show toast
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();

            // Remove after shown
            toast.addEventListener('hidden.bs.toast', function() {
                toast.remove();
            });
        }
    </script> --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Constants
            const GRAPH_HOPPER_API_KEY = "8c5e66d0-53b9-4218-af36-3223f27769ec";
            const defaultLat = 21.0285;
            const defaultLon = 105.8542;

            // Global state
            let checkoutData = {
                cartItems: [],
                cartItemIds: [],
                totalPrice: 0,
                addresses: [],
                addressDefault: null
            };
            let selectedAddressElement = null;

            // Utility Functions
            function formatVND(amount) {
                return new Intl.NumberFormat('vi-VN', {
                    maximumFractionDigits: 0
                }).format(amount) + ' VND';
            }

            function showMessage(message, color) {
                let toastContainer = document.getElementById('toast-container');
                if (!toastContainer) {
                    toastContainer = document.createElement('div');
                    toastContainer.id = 'toast-container';
                    toastContainer.className = 'position-fixed bottom-0 end-0 p-3';
                    document.body.appendChild(toastContainer);
                }

                const toastId = 'toast-' + Date.now();
                const toast = document.createElement('div');
                toast.className = 'toast';
                toast.id = toastId;
                toast.setAttribute('role', 'alert');
                toast.setAttribute('aria-live', 'assertive');
                toast.setAttribute('aria-atomic', 'true');
                toast.innerHTML = `
                        <div class="toast-header" style="background-color: ${color}; color: white;">
                            <strong class="me-auto">Thông báo</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">${message}</div>
                    `;
                toastContainer.appendChild(toast);
                const bsToast = new bootstrap.Toast(toast);
                bsToast.show();
                toast.addEventListener('hidden.bs.toast', () => toast.remove());
            }

            function showError(fieldId, errorMessage) {
                const field = document.getElementById(fieldId);
                if (!field) return;
                field.classList.add('is-invalid');
                const errorDiv = document.createElement('span');
                errorDiv.className = 'invalid-feedback d-block';
                errorDiv.textContent = errorMessage;
                field.parentNode.appendChild(errorDiv);
            }

            function clearAllErrors() {
                document.querySelectorAll('.invalid-feedback').forEach(element => element.remove());
                document.querySelectorAll('.is-invalid').forEach(input => input.classList.remove('is-invalid'));
            }

            // Checkout Functions
            function fetchCheckoutData() {
                const urlParams = new URLSearchParams(window.location.search);
                const cartItems = urlParams.get('cartItems') || '';
                fetch(`/api/checkout?cartItems=${encodeURIComponent(cartItems)}`, {
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + localStorage.getItem('token')
                        }
                    })
                    .then(response => {
                        if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                        return response.json();
                    })
                    .then(data => {
                        if (data.status === 'success') {
                            checkoutData = data.data;
                            console.log('Checkout Data:', checkoutData);
                            renderCheckout();
                        }
                    })
                    .catch(error => console.error('Fetch Error:', error));
            }

            function renderCheckout() {
                // Render default address
                const currentAddress = document.getElementById('current-address');
                const selectedAddress = document.getElementById('selected-address');
                const selectedLat = document.getElementById('selected-lat');
                const selectedLon = document.getElementById('selected-lon');

                if (checkoutData.addressDefault && currentAddress && selectedAddress) {
                    currentAddress.innerHTML = `
                <strong class="d-block">${checkoutData.addressDefault.type_label || 'N/A'}</strong>
                <span class="d-block">${checkoutData.addressDefault.full_address || 'N/A'}</span>
                `;
                    selectedAddress.value = checkoutData.addressDefault.full_address || '';
                    selectedLat.value = checkoutData.addressDefault.latitude || '';
                    selectedLon.value = checkoutData.addressDefault.longitude || '';
                    if (selectedLat.value && selectedLon.value) {
                        calculateDistance(selectedLat.value, selectedLon.value).then(() => updatePrices());
                    } else {
                        document.getElementById('distance-display').innerHTML =
                            'Không có thông tin khoảng cách (thiếu tọa độ)';
                    }
                } else {
                    console.warn('Warning: addressDefault or address DOM elements not found');
                    if (currentAddress) {
                        currentAddress.innerHTML = '<span class="text-muted">No default address</span>';
                    }
                }

                // Render cart items
                const orderItemsCheckout = document.querySelector('.order-items');
                if (!orderItemsCheckout) {
                    console.error('Error: .order-items element not found in the DOM');
                    return;
                }

                if (checkoutData.cartItems && Array.isArray(checkoutData.cartItems)) {
                    if (checkoutData.cartItems.length === 0) {
                        orderItemsCheckout.innerHTML = '<div class="text-center text-muted">No items in cart</div>';
                        return;
                    }

                    try {
                        const cartItemsHtml = checkoutData.cartItems.map(cartItem => {
                            const productName = cartItem?.product_variant?.product?.name ||
                                'Unknown Product';
                            const imageUrl = cartItem?.product_variant?.image || '';
                            const quantity = cartItem?.quantity || 0;
                            const color = cartItem?.product_variant?.color?.color || 'N/A';
                            const size = cartItem?.product_variant?.size?.size || 'N/A';
                            const price = cartItem?.formatted_price || 0;

                            return `
                        <input type="hidden" name="cartItemIds[]" class="cartItemIds" value="${cartItem.id || ''}">
                        <div class="order-item d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="${imageUrl}" alt="${productName}" class="me-3" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                <div>
                                    <span>${productName} × ${quantity}</span>
                                    <div class="text-muted small">Màu: ${color} | Size: ${size}</div>
                                </div>
                            </div>
                            <span>${price.toLocaleString('vi-VN')} VND</span>
                        </div>
                    `;
                        }).join('');
                        orderItemsCheckout.innerHTML = cartItemsHtml;
                    } catch (error) {
                        console.error('Error rendering cart items:', error);
                        orderItemsCheckout.innerHTML =
                            '<div class="text-center text-danger">Error loading cart items</div>';
                    }
                } else {
                    orderItemsCheckout.innerHTML = '<div class="text-center text-muted">No items in cart</div>';
                }

                // Render coupon inputs
                document.getElementById('totalPriceForCoupon').value = checkoutData.totalPrice;
                const cartItemsForCouponDisplay = document.getElementById('cart-items-for-coupon');
                if (checkoutData.cartItems && Array.isArray(checkoutData.cartItems)) {
                    const cartItemsForCoupon = checkoutData.cartItems.map(cartItem => {
                        return `<input type="hidden" name="cartItemsForCoupon[]" value="${cartItem.id}" form="coupon-form">`;
                    }).join('');
                    cartItemsForCouponDisplay.innerHTML = cartItemsForCoupon;
                }

                // Update price displays
                document.getElementById('displayTotalPrice').textContent = formatVND(checkoutData.totalPrice);
                document.getElementById('totalPrice').value = checkoutData.totalPrice;

                // Render addresses
                const addressesDisplay = document.getElementById('address-list');
                renderAddresses(checkoutData.addresses, addressesDisplay);
            }

            function updatePrices() {
                const originalTotalPrice = parseInt($('#totalPrice').val()) || 0;
                const shippingFee = parseInt($('#shippingFee').val()) || 0;
                const discount = parseInt($('#discountAmount').val()) || 0;
                const finalPrice = originalTotalPrice + shippingFee - discount;

                $('#displayTotalPrice').text(formatVND(originalTotalPrice));
                $('#displayShippingFee').text(formatVND(shippingFee));
                $('#displayDiscount').text('-' + formatVND(discount));
                $('#displayFinalPrice').text(formatVND(finalPrice));
                $('#finalPrice').val(finalPrice);
                $('#totalPriceForCoupon').val(originalTotalPrice);
            }

            async function calculateDistance(lat2, lon2) {
                const url =
                    `https://graphhopper.com/api/1/route?point=${defaultLat},${defaultLon}&point=${lat2},${lon2}&vehicle=car&locale=vi&key=${GRAPH_HOPPER_API_KEY}`;
                const distanceDisplay = document.getElementById('distance-display');
                const shippingFee = document.getElementById('shippingFee');
                const displayShippingFee = document.getElementById('displayShippingFee');
                const shippingFeeForCoupon = document.getElementById('shippingFeeForCoupon');

                try {
                    const response = await fetch(url);
                    const data = await response.json();
                    if (data.paths && data.paths.length > 0) {
                        const distance = parseFloat((data.paths[0].distance / 1000).toFixed(2));
                        distanceDisplay.innerHTML = `Khoảng cách từ Hà Nội: ${distance} km`;
                        const fee = calculateShippingFee(distance);
                        shippingFee.value = fee;
                        shippingFeeForCoupon.value = fee;
                        displayShippingFee.innerHTML = formatVND(fee);
                    } else {
                        distanceDisplay.innerHTML = 'Không thể tính khoảng cách!';
                        shippingFee.value = 0;
                        displayShippingFee.innerHTML = formatVND(0);
                    }
                } catch (error) {
                    distanceDisplay.innerHTML = 'Lỗi khi tính khoảng cách!';
                    shippingFee.value = 0;
                    displayShippingFee.innerHTML = formatVND(0);
                    console.error(error);
                }
            }

            function calculateShippingFee(distance) {
                if (distance <= 10) return distance * 300;
                else if (distance <= 50) return (10 * 300) + ((distance - 10) * 500);
                else return (10 * 300) + (40 * 500) + ((distance - 50) * 700);
            }

            // Address Management Functions
            async function loadProvinces() {
                const provinceSelect = document.getElementById('province');
                if (!provinceSelect) return;
                try {
                    const response = await fetch('https://provinces.open-api.vn/api/p/');
                    const provinces = await response.json();
                    provinceSelect.innerHTML = '<option value="">-- Chọn Tỉnh/Thành phố --</option>';
                    provinces.forEach(prov => {
                        const option = document.createElement('option');
                        option.value = prov.code;
                        option.text = prov.name;
                        provinceSelect.appendChild(option);
                    });
                } catch (error) {
                    console.error('Lỗi khi tải tỉnh/thành:', error);
                }
            }

            async function loadDistricts() {
                const provinceCode = document.getElementById('province').value;
                const districtSelect = document.getElementById('district');
                const wardSelect = document.getElementById('ward');

                districtSelect.innerHTML = '<option value="">-- Chọn Quận/Huyện --</option>';
                wardSelect.innerHTML = '<option value="">-- Chọn Phường/Xã --</option>';
                districtSelect.disabled = true;
                wardSelect.disabled = true;

                if (provinceCode) {
                    try {
                        const response = await fetch(
                            `https://provinces.open-api.vn/api/p/${provinceCode}?depth=2`);
                        const data = await response.json();
                        const districts = data.districts;
                        districts.forEach(dist => {
                            const option = document.createElement('option');
                            option.value = dist.code;
                            option.text = dist.name;
                            districtSelect.appendChild(option);
                        });
                        districtSelect.disabled = false;
                    } catch (error) {
                        console.error('Lỗi khi tải quận/huyện:', error);
                    }
                }
            }

            async function loadWards() {
                const districtCode = document.getElementById('district').value;
                const wardSelect = document.getElementById('ward');

                wardSelect.innerHTML = '<option value="">-- Chọn Phường/Xã --</option>';
                wardSelect.disabled = true;

                if (districtCode) {
                    try {
                        const response = await fetch(
                            `https://provinces.open-api.vn/api/d/${districtCode}?depth=2`);
                        const data = await response.json();
                        const wards = data.wards;
                        wards.forEach(ward => {
                            const option = document.createElement('option');
                            option.value = ward.code;
                            option.text = ward.name;
                            wardSelect.appendChild(option);
                        });
                        wardSelect.disabled = false;
                    } catch (error) {
                        console.error('Lỗi khi tải phường/xã:', error);
                    }
                }
            }

            async function getCoordinates() {
                const province = document.getElementById('province').options[document.getElementById('province')
                    .selectedIndex]?.text || '';
                const district = document.getElementById('district').options[document.getElementById('district')
                    .selectedIndex]?.text || '';
                const ward = document.getElementById('ward').options[document.getElementById('ward')
                    .selectedIndex]?.text || '';

                if (!province || !district || !ward) return;

                const query = `${ward}, ${district}, ${province}, Vietnam`;
                try {
                    const response = await fetch(
                        `https://graphhopper.com/api/1/geocode?q=${encodeURIComponent(query)}&key=${GRAPH_HOPPER_API_KEY}`
                    );
                    const data = await response.json();
                    if (data.hits && data.hits.length > 0) {
                        const {
                            lat,
                            lng
                        } = data.hits[0].point;
                        document.getElementById('latitude').value = lat;
                        document.getElementById('longitude').value = lng;
                    } else {
                        document.getElementById('latitude').value = '';
                        document.getElementById('longitude').value = '';
                    }
                } catch (error) {
                    console.error('Lỗi khi lấy tọa độ:', error);
                    document.getElementById('latitude').value = '';
                    document.getElementById('longitude').value = '';
                }
            }

            function updateHiddenInputs() {
                const province = document.getElementById('province').options[document.getElementById('province')
                    .selectedIndex]?.text || '';
                const district = document.getElementById('district').options[document.getElementById('district')
                    .selectedIndex]?.text || '';
                const ward = document.getElementById('ward').options[document.getElementById('ward').selectedIndex]
                    ?.text || '';

                document.getElementById('provinceName').value = province;
                document.getElementById('districtName').value = district;
                document.getElementById('wardName').value = ward;
            }

            function renderAddresses(addresses, addressesDisplay) {
                if (addresses && Array.isArray(addresses)) {
                    try {
                        const addressList = addresses.map(address => {
                            // Kiểm tra nếu is_default là true thì không hiển thị nút Xóa
                            const deleteButton = address.is_default ? '' : `
                    <button class="btn btn-sm btn-outline-danger delete-btn" 
                            data-bs-toggle="modal" 
                            data-id="${address.id}" 
                            data-bs-target="#deleteAddressModal">Xóa</button>
                `;

                            return `
                    <div class="address-item"
                        data-id="${address.id}"
                        data-address="${address.full_address}"
                        data-lat="${address.latitude}" 
                        data-lon="${address.longitude}"
                        data-city-code="${address.city_code}"
                        data-district-code="${address.district_code}"
                        data-ward-code="${address.ward_code}"
                        data-address-line="${address.address_line}"
                        data-type="${address.type}"
                        data-is-default="${address.is_default}">
                        <div class="address-content">
                            <strong>${address.type_label}</strong><br>
                            <span>${address.full_address}</span>
                        </div>
                        <div class="address-actions">
                            <button class="btn btn-sm btn-outline-primary edit-btn">Sửa</button>
                            ${deleteButton}
                        </div>
                    </div>
                `;
                        }).join('');
                        addressesDisplay.innerHTML = addressList;

                        // Gắn sự kiện cho các nút .edit-btn
                        const editAddressBtns = addressesDisplay.querySelectorAll('.edit-btn');
                        editAddressBtns.forEach(btn => {
                            btn.addEventListener('click', () => {
                                const addressItem = btn.closest('.address-item');
                                const addressId = addressItem.dataset.id;
                                const provinceCode = addressItem.dataset.cityCode;
                                const districtCode = addressItem.dataset.districtCode;
                                const wardCode = addressItem.dataset.wardCode;
                                const addressLine = addressItem.dataset.addressLine;
                                const latitude = addressItem.dataset.lat;
                                const longitude = addressItem.dataset.lon;
                                const addressType = addressItem.dataset.type;
                                const isDefault = addressItem.dataset.isDefault === 'true';

                                editAddress(
                                    addressId,
                                    provinceCode,
                                    districtCode,
                                    wardCode,
                                    addressLine,
                                    latitude,
                                    longitude,
                                    addressType,
                                    isDefault
                                );
                            });
                        });

                        // Gắn sự kiện cho các nút .delete-btn (chỉ áp dụng cho các địa chỉ không phải mặc định)
                        const deleteAddressBtns = addressesDisplay.querySelectorAll('.delete-btn');
                        deleteAddressBtns.forEach(btn => {
                            btn.addEventListener('click', () => {
                                const addressId = btn.getAttribute(
                                'data-id'); // Lấy data-id từ nút delete-btn
                                console.log('data-id:', addressId); // Log ra data-id
                                // Lưu addressId vào input delete-address-id trong modal
                                const deleteAddressInput = document.getElementById(
                                    'delete-address-id');
                                if (deleteAddressInput) {
                                    deleteAddressInput.value = addressId;
                                }
                            });
                        });

                    } catch (error) {
                        console.error('Error rendering addresses:', error);
                        addressesDisplay.innerHTML =
                            '<div class="text-center text-danger">Error loading addresses</div>';
                    }
                } else {
                    addressesDisplay.innerHTML = '<div class="text-center text-muted">No addresses available</div>';
                }
            }

            function selectAddress(element) {
                document.querySelectorAll('.address-item').forEach(item => {
                    item.classList.remove('selected');
                });
                element.classList.add('selected');
                selectedAddressElement = element;
            }


            async function confirmAddress() {
                if (selectedAddressElement) {
                    const addressText = selectedAddressElement.getAttribute('data-address');
                    const addressName = selectedAddressElement.querySelector('strong').textContent;
                    const lat = selectedAddressElement.getAttribute('data-lat');
                    const lon = selectedAddressElement.getAttribute('data-lon');
                    const shippingFee = document.getElementById('shippingFee');
                    const displayShippingFee = document.getElementById('displayShippingFee');

                    document.getElementById('current-address').innerHTML =
                        `<strong>${addressName}</strong><br><span>${addressText}</span>`;
                    document.getElementById('selected-address').value = addressText;
                    document.getElementById('selected-lat').value = lat || '';
                    document.getElementById('selected-lon').value = lon || '';

                    const modal = bootstrap.Modal.getInstance(document.getElementById('addressModalList'));
                    modal.hide();

                    if (lat && lon) {
                        await calculateDistance(lat, lon);
                        updatePrices();
                    } else {
                        document.getElementById('distance-display').innerHTML =
                            'Không có thông tin khoảng cách (thiếu tọa độ)';
                        shippingFee.value = 0;
                        displayShippingFee.innerHTML = formatVND(0);
                        updatePrices();
                    }
                } else {
                    alert('Vui lòng chọn một địa chỉ!');
                }
            }

            function showAddressModal() {
                document.getElementById('address-form').reset();
                document.getElementById('address-error').classList.add('d-none');
                document.getElementById('address-id').value = '';
                document.getElementById('AddressModalLabel').textContent = 'Thêm Địa Chỉ Mới';
                loadProvinces();
                document.getElementById('district').innerHTML = '<option value="">-- Chọn Quận/Huyện --</option>';
                document.getElementById('district').disabled = true;
                document.getElementById('ward').innerHTML = '<option value="">-- Chọn Phường/Xã --</option>';
                document.getElementById('ward').disabled = true;
                document.getElementById('provinceName').value = '';
                document.getElementById('districtName').value = '';
                document.getElementById('wardName').value = '';
                document.getElementById('latitude').value = '';
                document.getElementById('longitude').value = '';
                const addressModal = new bootstrap.Modal(document.getElementById('address-modal'));
                addressModal.show();
            }

            function editAddress(addressId, provinceCode, districtCode, wardCode, addressLine, latitude, longitude,
                addressType, isDefault) {
                document.getElementById('address-id').value = addressId;
                document.getElementById('AddressModalLabel').textContent = 'Sửa Địa Chỉ';
                document.getElementById('newAddressDetail').value = addressLine;
                document.querySelectorAll('input[name="addressType"]').forEach(radio => {
                    radio.checked = radio.value === addressType;
                });
                document.getElementById('check-default').checked = isDefault;
                document.getElementById('address-error').classList.add('d-none');

                loadProvinces().then(() => {
                    document.getElementById('province').value = provinceCode;
                    loadDistricts().then(() => {
                        document.getElementById('district').value = districtCode;
                        loadWards().then(() => {
                            document.getElementById('ward').value = wardCode;
                            updateHiddenInputs();
                            document.getElementById('latitude').value = latitude;
                            document.getElementById('longitude').value = longitude;
                        });
                    });
                });

                const addressModal = new bootstrap.Modal(document.getElementById('address-modal'));
                addressModal.show();
            }


            function setModalAddressId(inputId, addressId) {
                document.getElementById(inputId).value = addressId;
            }

            async function handleAddAddress(e) {
                e.preventDefault();
                const errorDiv = document.getElementById('address-error');
                errorDiv.classList.add('d-none');
                errorDiv.innerHTML = '';

                const formData = new FormData(e.target);
                const data = Object.fromEntries(formData);

                if (!data.province_name || !data.city_code || !data.district_name || !data.address_line) {
                    errorDiv.innerHTML = 'Vui lòng nhập đầy đủ thông tin bắt buộc.';
                    errorDiv.classList.remove('d-none');
                    return;
                }

                const addressId = document.getElementById('address-id').value;
                const isEdit = addressId && addressId.trim() !== '';
                const endpoint = isEdit ? `/api/addresses/${addressId}` : '/api/save-address';
                const method = isEdit ? 'PUT' : 'POST';

                try {
                    const response = await fetch(endpoint, {
                        method: method,
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        },
                        body: JSON.stringify(data)
                    });
                    const result = await response.json();

                    if (!response.ok) {
                        let errorMessage = result.message || 'Có lỗi xảy ra khi lưu địa chỉ';
                        if (response.status === 422 && result.errors) {
                            errorMessage = Object.values(result.errors).flat().map(msg => msg).join('<br>');
                        } else if (result.error) {
                            errorMessage += `: ${result.error}`;
                        }
                        errorDiv.innerHTML = errorMessage;
                        errorDiv.classList.remove('d-none');
                        return;
                    }

                    showMessage("Lưu địa chỉ thành công!", '#4CAF50');
                    const modal = bootstrap.Modal.getInstance(document.getElementById('address-modal'));
                    modal.hide();
                    fetchCheckoutData();
                } catch (error) {
                    console.error('Error saving address:', error);
                    errorDiv.innerHTML = 'Không thể kết nối đến server. Vui lòng thử lại.';
                    errorDiv.classList.remove('d-none');
                }
            }

            async function handleDeleteAddress(event) {
                event.preventDefault();
                const addressId = document.getElementById('delete-address-id').value;
                console.log(addressId);

                if (!addressId) return;

                try {
                    const response = await fetch(`/api/addresses/${addressId}`, {
                        method: 'DELETE',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                ?.getAttribute('content')
                        }
                    });
                    const result = await response.json();

                    if (!response.ok) throw new Error('Failed to delete address');

                    showMessage("Xóa địa chỉ thành công!", '#4CAF50');
                    const deleteModal = bootstrap.Modal.getInstance(document.getElementById(
                        'deleteAddressModal'));
                    if (deleteModal) deleteModal.hide();
                    fetchCheckoutData();
                } catch (error) {
                    console.error('Error deleting address:', error);
                    showMessage("Lỗi khi xóa địa chỉ.", '#dc3545');
                }
            }

            // Coupon Handling
            $('#coupon-form').on('submit', function(event) {
                event.preventDefault();
                const formData = $(this).serialize();

                $.ajax({
                    url: '/api/coupon-apply',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#couponMessage').html('<p class="text-success">' + response.message +
                            '</p>');
                        const discount = response.discount || 0;
                        const shippingDiscount = response.shipping_discount || 0;
                        const finalPrice = response.finalPrice || 0;

                        $('#displayDiscount').text('-' + formatVND(discount +
                            shippingDiscount));
                        $('#discountAmount').val(discount + shippingDiscount);
                        const newShippingFee = parseInt($('#shippingFee').val()) -
                            shippingDiscount;
                        $('#displayShippingFee').text(formatVND(newShippingFee));
                        $('#shippingFee').val(newShippingFee);
                        $('#displayFinalPrice').text(formatVND(finalPrice));
                        $('#finalPrice').val(finalPrice);

                        const couponCode = $('#couponCodeInput').val();
                        $('#couponCodeForOrder').val(couponCode);
                        $('#couponCodeInput').prop('disabled', true);
                    },
                    error: function(xhr) {
                        const errorMessage = xhr.responseJSON?.message || 'Đã xảy ra lỗi!';
                        $('#couponMessage').html('<p class="text-danger">' + errorMessage +
                            '</p>');
                        $('#couponCodeInput').prop('disabled', false);
                    }
                });
            });

            $('#clearCoupon').on('click', function(event) {
                event.preventDefault();
                $('#couponCodeInput').val('');
                $('#couponMessage').html('');
                $('#couponCodeForOrder').val('');
                $('#displayDiscount').text('-0 VND');
                $('#discountAmount').val(0);
                updatePrices();
                $('#couponCodeInput').prop('disabled', false);
            });

            // Form Submission
            const checkoutForm = document.getElementById('checkout-form');
            if (checkoutForm) {
                checkoutForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const cartItemIds = [];
                    const receiverName = document.getElementById('receiver-name')?.value || '';
                    const receiverEmail = document.getElementById('receiver-email')?.value || '';
                    const receiverPhone = document.getElementById('receiver-phone')?.value || '';
                    const receiverAddress = document.getElementById('selected-address')?.value || '';
                    const cartItemIdsCheckout = document.querySelectorAll('.cartItemIds');
                    const couponName = document.getElementById('couponCodeForOrder')?.value || '';
                    const totalPrice = document.getElementById('totalPrice')?.value || '0';
                    const discountAmount = document.getElementById('discountAmount')?.value || '0';
                    const shippingFee = document.getElementById('shippingFee')?.value || '0';
                    const finalPrice = document.getElementById('finalPrice')?.value || '0';
                    const paymentMethod = document.querySelector('input[name="payment_method"]:checked')
                        ?.value || '';
                    const noteCheckout = document.getElementById('code')?.value || '';
                    const submitCheckoutButton = document.getElementById('submit-checkout-button');

                    cartItemIdsCheckout.forEach(cartItemId => {
                        if (cartItemId.value) cartItemIds.push(cartItemId.value);
                    });

                    clearAllErrors();

                    if (!submitCheckoutButton) {
                        console.error('Submit button not found');
                        showMessage('Đã xảy ra lỗi', '#F44336');
                        return;
                    }

                    if (submitCheckoutButton.dataset.isSubmitting === 'true') return;

                    submitCheckoutButton.dataset.isSubmitting = 'true';
                    submitCheckoutButton.classList.add('loading');
                    submitCheckoutButton.textContent = 'Đang tạo đơn...';

                    fetch('/checkout', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    ?.getAttribute('content') || ''
                            },
                            body: JSON.stringify({
                                receiver_name: receiverName,
                                receiver_email: receiverEmail,
                                receiver_phone: receiverPhone,
                                receiver_address: receiverAddress,
                                note: noteCheckout,
                                cartItemIds: cartItemIds,
                                couponCodeForOrder: couponName,
                                totalPrice: totalPrice,
                                discountAmount: discountAmount,
                                shippingFee: shippingFee,
                                finalPrice: finalPrice,
                                payment_method: paymentMethod
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success === true) {
                                if (data.redirect_url) {
                                    window.location.assign(data.redirect_url);
                                } else {
                                    window.location.href = '/order-list';
                                }
                            } else {
                                if (data.errors) {
                                    if (data.errors.receiver_name) showError('receiver-name', data
                                        .errors.receiver_name[0]);
                                    if (data.errors.receiver_email) showError('receiver-email', data
                                        .errors.receiver_email[0]);
                                    if (data.errors.receiver_phone) showError('receiver-phone', data
                                        .errors.receiver_phone[0]);
                                    if (data.errors.receiver_address) showError('selected-address', data
                                        .errors.receiver_address[0]);
                                    if (data.errors.note) showError('note', data.errors.note[0]);
                                } else if (data.message) {
                                    showMessage(data.message, '#F44336');
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showMessage('Đã xảy ra lỗi', '#F44336');
                        })
                        .finally(() => {
                            submitCheckoutButton.dataset.isSubmitting = 'false';
                            submitCheckoutButton.classList.remove('loading');
                            submitCheckoutButton.textContent = 'Đặt Hàng Ngay';
                        });
                });
            }


            // Modal and Event Listeners
            function initAddressForm() {
                loadProvinces();
                const provinceSelect = document.getElementById('province');
                const districtSelect = document.getElementById('district');
                const wardSelect = document.getElementById('ward');

                if (provinceSelect && districtSelect && wardSelect) {
                    provinceSelect.addEventListener('change', () => {
                        loadDistricts();
                        updateHiddenInputs();
                    });
                    districtSelect.addEventListener('change', () => {
                        loadWards();
                        updateHiddenInputs();
                    });
                    wardSelect.addEventListener('change', () => {
                        updateHiddenInputs();
                        getCoordinates();
                    });
                }
            }

            function setupModalListeners() {
                const addNewAddressBtn = document.getElementById('btn-create-address');
                if (addNewAddressBtn) addNewAddressBtn.addEventListener('click', showAddressModal);

                const addressModal = document.getElementById('address-modal');
                if (addressModal) {
                    addressModal.addEventListener('hidden.bs.modal', function() {
                        document.getElementById('address-form').reset();
                        document.getElementById('address-error').classList.add('d-none');
                    });
                }

                const addressModalList = document.getElementById('addressModalList');
                if (addressModalList) {
                    addressModalList.addEventListener('show.bs.modal', () => {
                        const firstAddress = document.querySelector('.address-item');
                        if (firstAddress && !selectedAddressElement) {
                            selectAddress(firstAddress);
                        }

                        document.querySelectorAll('.address-item').forEach(item => {
                            item.addEventListener('click', () => {
                                selectAddress(item);
                            });
                        });
                    });
                }

                document.getElementById('btn-confirm-address').addEventListener('click', () => {
                    confirmAddress();
                });
            }



            // Initialize
            function init() {
                fetchCheckoutData();
                initAddressForm();
                setupModalListeners();


                const addressForm = document.getElementById('address-form');
                if (addressForm) addressForm.addEventListener('submit', handleAddAddress);

                const deleteForm = document.querySelector('#deleteAddressModal form');
                if (deleteForm) deleteForm.addEventListener('submit', handleDeleteAddress);
            }
            init();
        });
    </script>


@endsection

@extends('client.layouts.app')

@section('title', 'Chi Tiết Đơn Hàng')
@section('breadcrumb', 'Chi Tiết Đơn Hàng')
@section('style')
    <style>
        .spee__main-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .spee__top-nav {
            padding: 15px;
            border-bottom: 1px solid #e8e8e8;
            display: flex;
            align-items: center;
        }

        .spee__return-link {
            color: #757575;
            display: flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
            font-size: 14px;
        }

        .spee__order-id-badge {
            margin-left: auto;
            font-size: 14px;
        }

        #order-detail-status {
            color: #ee4d2d;
        }

        .spee__flow-visualizer {
            padding: 25px 40px;
            position: relative;
        }

        .spee__flow-stages {
            display: flex;
            justify-content: space-between;
            position: relative;
            z-index: 1;
        }

        .spee__progress-connector {
            position: absolute;
            top: 50px;
            left: 90px;
            right: 90px;
            height: 3px;
            background-color: #26bd5f;
            z-index: 0;
            width: 0px;
            transition: width 0.5s ease;
        }

        .spee__milestone {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 80px;
        }

        .spee__milestone-bubble {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 3px solid #333;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .spee__milestone-bubble.active {
            background-color: #fff;
            border: 3px solid #26bd5f;
            color: #26bd5f;
        }

        .spee__milestone-bubble.last-active {
            background-color: #26bd5f;
            border: 3px solid #26bd5f;
            color: #fff;
        }


        .spee__milestone-bubble svg {
            width: 28px;
            height: 28px;
            fill: white;
        }

        .spee__milestone-label {
            font-size: 12px;
            max-width: 90px;
            line-height: 1.3;
        }

        .spee__milestone-label.active {
            color: #26bd5f;
        }

        .spee__milestone-timestamp {
            font-size: 11px;
            color: #888;
            margin-top: 5px;
        }

        .spee__action-panel {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #e8e8e8;
        }

        .spee__gratitude-text {
            color: #757575;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .spee__repurchase-btn {
            background-color: #ee4d2d;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 3px;
            font-size: 14px;
            cursor: pointer;
        }

        .spee__vendor-contact-btn {
            background-color: white;
            color: #555;
            border: 1px solid #d5d5d5;
            padding: 8px 20px;
            border-radius: 3px;
            font-size: 14px;
            cursor: pointer;
            margin-top: 10px;
        }

        .spee__shipment-details {
            padding: 15px;
            border-bottom: 8px solid #f5f5f5;
        }

        .spee__block-heading {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .spee__recipient-info {
            font-size: 14px;
            margin-bottom: 15px;
        }

        .spee__recipient-name {
            font-weight: 500;
        }

        .spee__recipient-phone,
        .spee__recipient-location {
            color: #757575;
            margin-top: 5px;
        }

        .spee__transit-history {
            margin-top: 20px;
        }

        .spee__transit-event {
            display: flex;
            position: relative;
            padding-bottom: 15px;
        }

        .spee__event-indicator {
            width: 24px;
            margin-right: 15px;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .spee__status-dot {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background-color: #26bd5f;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 3px;
            z-index: 1;
        }

        .spee__status-dot.spee__status--completed {
            background-color: #26bd5f;
        }

        .spee__status-dot.spee__status--default {
            background-color: #c8c8c8;
            width: 12px;
            height: 12px;
        }

        .spee__status-dot svg {
            width: 12px;
            height: 12px;
            fill: white;
        }

        .spee__timeline-connector {
            position: absolute;
            top: 18px;
            left: 50%;
            width: 2px;
            height: calc(100% - 14px);
            background-color: #e8e8e8;
            transform: translateX(-50%);
        }

        .spee__event-description {
            flex: 1;
        }

        .spee__event-timestamp {
            color: #757575;
            font-size: 13px;
            margin-bottom: 3px;
        }

        .spee__event-message {
            font-size: 14px;
        }

        .spee__event-cta {
            color: #1a9cb7;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
            margin-top: 5px;
        }

        .spee__item-details {
            padding: 15px;
            border-bottom: 1px solid #f5f5f5;
        }

        .spee__shop-badge {
            display: inline-block;
            background-color: #f6644f;
            color: white;
            font-size: 12px;
            padding: 2px 5px;
            border-radius: 3px;
            margin-bottom: 10px;
        }

        .spee__chat-badge {
            display: inline-block;
            background-color: white;
            border: 1px solid #d5d5d5;
            color: #757575;
            font-size: 12px;
            padding: 2px 8px;
            border-radius: 3px;
            margin-left: 5px;
        }

        .spee__shop-link-badge {
            display: inline-block;
            background-color: white;
            border: 1px solid #d5d5d5;
            color: #757575;
            font-size: 12px;
            padding: 2px 8px;
            border-radius: 3px;
            margin-left: 5px;
        }

        .spee__product-card {
            display: flex;
            padding: 10px 0;
        }

        .spee__product-thumbnail {
            width: 80px;
            height: 80px;
            border: 1px solid #e8e8e8;
            margin-right: 15px;
        }

        .spee__product-specs {
            flex: 1;
        }

        .spee__product-title {
            font-size: 14px;
            margin-bottom: 5px;
            color: #222;
            line-height: 1.3;
        }

        .spee__product-options {
            font-size: 13px;
            color: #757575;
            margin-bottom: 10px;
        }

        .spee__product-current-price {
            font-size: 14px;
            color: #ee4d2d;
            text-align: right;
        }

        .spee__product-original-price {
            font-size: 13px;
            color: #757575;
            text-decoration: line-through;
            text-align: right;
            margin-bottom: 3px;
        }

        .spee__cost-breakdown {
            padding: 15px;
            border-bottom: 1px solid #f5f5f5;
        }

        .spee__cost-line {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .spee__cost-line:last-child {
            margin-bottom: 0;
        }

        .spee__cost-label {
            color: #757575;
        }

        .spee__cost-amount {
            color: #222;
        }

        .spee__discount-amount {
            color: #26bd5f;
        }

        .spee__final-cost {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: #ee4d2d;
            padding-top: 10px;
            border-top: 1px dashed #e8e8e8;
            margin-top: 5px;
        }

        .spee__alert-box {
            background-color: #fff9dc;
            border: 1px solid #f5e49c;
            padding: 10px 15px;
            font-size: 13px;
            color: #cd9403;
            margin: 15px;
            border-radius: 3px;
            display: flex;
            align-items: center;
        }

        .spee__alert-icon {
            margin-right: 10px;
            color: #cd9403;
        }

        .spee__payment-info {
            padding: 15px;
            font-size: 14px;
            text-align: right;
            color: #757575;
        }

        .spee__cancelled-status {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background-color: #f8f8f8;
            border-radius: 8px;
            color: #777;
        }

        .spee__cancelled-icon {
            margin-right: 12px;
            color: #d32f2f;
        }

        .spee__cancelled-message {
            font-size: 16px;
            font-weight: 500;
        }
    </style>
@endsection

@section('content')
    @include('client.components.breadcrumb')
    @include('client.pages.order.order-detail.order-detail')
@endsection

@section('script')
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            const statusMapping = {
                pending: "Đang chờ xử lý",
                confirmed: "Đã xác nhận",
                processing: "Đang chuẩn bị hàng",
                ready: "Chuẩn bị xong",
                picking_up: "Người vận chuyển đang lấy hàng",
                shipping: "Đang giao hàng",
                delivered: "Đã giao hàng",
                cancelled: "Đã hủy",
                completed: "Hoàn thành",
                returned: "Hoàn Hàng",
                refunded: "Hoàn tiền"
            };

            function getStatusInVietnamese(status) {
                return statusMapping[status] || status; // Nếu status không tồn tại trong mapping, trả về nguyên gốc
            }

            function formatPrice(price) {
                // Nếu price là null, undefined hoặc không hợp lệ, trả về '0 VNĐ'
                if (!price || (typeof price !== 'string' && typeof price !== 'number')) {
                    return '0 VNĐ';
                }

                // Chuyển price thành chuỗi nếu là số
                const priceString = typeof price === 'number' ? price.toString() : price;

                // Loại bỏ ký hiệu ₫ và các ký tự không phải số hoặc dấu chấm
                const cleanPrice = parseFloat(priceString.replace(/[^0-9.]/g, ''));

                // Nếu cleanPrice không hợp lệ, trả về '0 VNĐ'
                if (isNaN(cleanPrice)) {
                    return '0 VNĐ';
                }

                // Định dạng số với dấu chấm phân cách hàng nghìn
                return cleanPrice.toLocaleString('vi-VN') + ' VNĐ';
            }

            async function getOrderDetailsFromUrl() {
                try {
                    // Extract orderCode from query parameters
                    const url = window.location.pathname;
                    const pathSegments = url.split('/').filter(segment => segment);
                    const orderCode = pathSegments[pathSegments.length - 1];

                    if (!orderCode) {
                        throw new Error('Order code not found in URL');
                    }

                    // Make the API request
                    const response = await fetch(`/api/order-detail/${orderCode}`, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                        }
                    });

                    const data = await response.json();

                    if (response.ok) {
                        const order = data.data;
                        const orderCodeDisplay = document.getElementById('order-detail-code');
                        const orderStatusDisplay = document.getElementById('order-detail-status');
                        const vietnameseStatus = getStatusInVietnamese(order.status);

                        console.log('Order Details:', order);
                        activeVisualizer(order.status);
                        renderShipmentDetail(order);
                        renderCartItems(order);
                        renderFinalPrice(order);
                        renderPaymentMethod(order);

                        orderCodeDisplay.innerText = order.order_code;
                        orderStatusDisplay.innerText = vietnameseStatus.toUpperCase();
                    } else {
                        throw new Error(data.message || 'Failed to fetch order details');
                    }
                } catch (error) {
                    console.error('Request failed:', error.message);
                    throw error;
                }
            }

            function activeVisualizer(orderStatus) {
                const container = document.querySelector('.spee__flow-visualizer');

                // Check if order is cancelled
                if (orderStatus === 'cancelled') {
                    // Create replacement div for cancelled orders
                    const cancelledDiv = document.createElement('div');
                    cancelledDiv.className = 'spee__cancelled-status';
                    cancelledDiv.innerHTML = `
                        <div class="spee__cancelled-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                                <line x1="7" y1="7" x2="17" y2="17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <line x1="17" y1="7" x2="7" y2="17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div class="spee__cancelled-message">Đơn Hàng Đã Hủy</div>
                    `;

                    // Replace the entire flow visualizer with the cancelled div
                    container.parentNode.replaceChild(cancelledDiv, container);
                    return;
                }

                // Original functionality for non-cancelled orders
                const bubbles = document.querySelectorAll('.spee__milestone-bubble');
                const labels = document.querySelectorAll('.spee__milestone-label');
                const connector = document.querySelector('.spee__progress-connector');

                const statusOrder = [
                    'pending',
                    'confirmed',
                    'processing',
                    'ready',
                    'picking_up',
                    'shipping',
                    'delivered',
                    'completed'
                ];

                // Clear previous active states
                bubbles.forEach(bubble => bubble.classList.remove('active', 'last-active'));
                labels.forEach(label => label.classList.remove('active'));

                // Find current status index
                const currentStatusIndex = statusOrder.indexOf(orderStatus);

                // Activate appropriate bubbles and labels
                bubbles.forEach((bubble, index) => {
                    const milestone = bubble.closest('.spee__milestone');
                    const bubbleStatusAttr = milestone.getAttribute('data-status');
                    const label = labels[index];

                    // Handle multiple statuses in a single attribute (comma-separated)
                    const bubbleStatuses = bubbleStatusAttr.split(',');

                    // Check if any of the milestone's statuses should be active
                    let shouldBeActive = false;
                    let isCurrentStatus = false;

                    for (const status of bubbleStatuses) {
                        const statusIndex = statusOrder.indexOf(status);

                        // If this status should be active based on current order status
                        if (statusIndex !== -1 && statusIndex <= currentStatusIndex) {
                            shouldBeActive = true;
                        }

                        // Check if this is the current status
                        if (status === orderStatus) {
                            isCurrentStatus = true;
                        }
                    }

                    // For the "pending" milestone - it's always active if the order exists
                    if (bubbleStatusAttr === 'pending') {
                        shouldBeActive = true;
                    }

                    if (shouldBeActive) {
                        bubble.classList.add('active');
                        label.classList.add('active');

                        if (isCurrentStatus) {
                            bubble.classList.add('last-active');
                        }
                    }
                });

                // Update connector width based on the last active bubble
                const lastActiveBubble = document.querySelector('.spee__milestone-bubble.last-active');

                if (lastActiveBubble) {
                    const containerRect = container.getBoundingClientRect();
                    const lastActiveRect = lastActiveBubble.getBoundingClientRect();

                    const distance = lastActiveRect.left + (lastActiveRect.width / 2) - containerRect.left - 90;
                    connector.style.width = `${distance}px`;
                } else {
                    connector.style.width = '0px';
                }
            }

            function renderShipmentDetail(orderData) {
                const shipmentContainer = document.querySelector('.spee__shipment-details');

                if (!shipmentContainer) {
                    return;
                }

                const {
                    receiver_name,
                    receiver_phone,
                    receiver_address,
                } = orderData || {};

                // Create HTML for recipient info
                const recipientHTML = `
                    <h3 class="spee__block-heading">Địa Chỉ Nhận Hàng</h3>
                    <div class="spee__recipient-info">
                        <div class="spee__recipient-name">${receiver_name || 'Không có tên người nhận'}</div>
                        <div class="spee__recipient-phone">${receiver_phone}</div>
                        <div class="spee__recipient-location">${receiver_address}</div>
                    </div>
                `;

                // Update the container content
                shipmentContainer.innerHTML = recipientHTML;

            }

            function renderCartItems(orderData) {
                // Get the container for item details
                const itemsContainer = document.querySelector('.spee__item-details');

                // If container doesn't exist, create it
                if (!itemsContainer) {
                    return; // Don't proceed if container doesn't exist in the DOM
                }

                // Get cart items from order data
                const cartItems = orderData.order_items || [];

                // Check if there are any items
                if (cartItems.length === 0) {
                    itemsContainer.innerHTML =
                        '<div class="spee__empty-cart">Không có sản phẩm nào trong đơn hàng</div>';
                    return;
                }

                // Generate HTML for all cart items
                let itemsHTML = '';

                cartItems.forEach(item => {
                    const {
                        price,
                        price_sale,
                        quantity
                    } = item;

                    const {
                        image: variantImage,
                        color,
                        size,
                    } = item.product_variant || {};

                    const {
                        slug,
                        name: productName,
                        image: productImage,
                    } = item.product || {};

                    const imageUrl = variantImage || productImage || 'default-image.jpg';
                    const product_name = productName || 'Sản phẩm không tên';
                    const variant_name = [color, size].filter(Boolean).join(' - ');

                    // Create HTML for each product card
                    const productCardHTML = `
                        <div class="spee__product-card">
                            <img src="${imageUrl}" alt="${product_name}" class="spee__product-thumbnail">
                            <div class="spee__product-specs">
                                <a href="/detail/${slug}">
                                    <div class="spee__product-title">${product_name}${quantity > 1 ? ` - x${quantity}` : ''}</div>
                                    ${variant_name ? `<div class="spee__product-options">Phân loại hàng: ${variant_name}</div>` : ''}
                                    </a>
                                </div>
                            <div>
                                ${price_sale && price_sale < price ? 
                                    `<div class="spee__product-original-price">${formatPrice(price)}</div>` : ''}
                                <div class="spee__product-current-price">${formatPrice(price_sale)}</div>
                            </div>
                        </div>
                    `;

                    itemsHTML += productCardHTML;
                });


                // Update the container content
                itemsContainer.innerHTML = itemsHTML;
            }

            function renderFinalPrice(orderData) {
                // Get the container for item details
                const itemsContainer = document.querySelector('.spee__cost-breakdown');

                // If container doesn't exist, create it
                if (!itemsContainer) {
                    return;
                }

                const {
                    total_price,
                    shipping_fee,
                    discount_amount,
                    final_price,
                } = orderData || {};

                const priceFinalHTML = `
                    <div class="spee__cost-line">
                        <span class="spee__cost-label">Tổng tiền hàng</span>
                        <span class="spee__cost-amount">${formatPrice(total_price)}</span>
                    </div>
                    <div class="spee__cost-line">
                        <span class="spee__cost-label">Phí vận chuyển</span>
                        <span class="spee__cost-amount">${formatPrice(shipping_fee)}</span>
                    </div>
                    <div class="spee__cost-line">
                        <span class="spee__cost-label">Giảm giá từ Mã</span>
                        <span class="spee__discount-amount">${formatPrice(discount_amount)}</span>
                    </div>
                    <div class="spee__final-cost">
                        <span>Thành tiền</span>
                        <span>${formatPrice(final_price)}</span>
                    </div>
                `;


                // Update the container content
                itemsContainer.innerHTML = priceFinalHTML;
            }

            function renderPaymentMethod(orderData) {
                const itemsContainer = document.querySelector('.spee__payment-info');

                if (!itemsContainer) {
                    return;
                }

                const {
                    payment_method,
                    payment_status,
                    status,
                } = orderData || {};

                // Check if the order is cancelled
                console.log(orderData.cancellation.reason);

                if (status === 'cancelled') {
                    // Check if there's a custom reason first
                    const cancellationReason = orderData.cancellation?.custom_reason ||
                        orderData.cancellation?.reason?.name ||
                        'Không có lý do';

                    const cancellationHTML = `
                        <div style="margin-top: 10px; font-weight: 500; color: #d32f2f;">
                            Lý do hủy đơn: ${cancellationReason}
                        </div>
                    `;
                    itemsContainer.innerHTML = cancellationHTML;
                    return;
                }

                // Original functionality for non-cancelled orders
                let methodText = '';

                switch (payment_method) {
                    case 'COD':
                        methodText = 'Thanh toán khi nhận hàng';
                        break;
                    case 'VNPAY':
                        methodText = 'Thanh toán qua VNPAY';
                        break;
                    default:
                        methodText = 'Không xác định';
                }

                if (payment_status === 'paid') {
                    methodText += ' - Đã thanh toán';
                }

                const paymentInfoHTML = `
                    <div style="margin-top: 10px; font-weight: 500; color: #222;">
                        ${methodText}
                    </div>
                `;

                itemsContainer.innerHTML = paymentInfoHTML;
            }

            getOrderDetailsFromUrl();
        });
    </script>

@endsection

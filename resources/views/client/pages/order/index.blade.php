@extends('client.layouts.app')

@section('title', 'Đơn Hàng Đã Đặt')
@section('breadcrumb', 'Đơn Hàng Đã Đặt')
@section('style')
    <style>
        .order-container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: transparent;
        }

        .order-tab-container {
            display: flex;
            border-bottom: 1px solid #e8e8e8;
            margin-bottom: 100;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .order-tab {
            padding: 15px 30px;
            text-align: center;
            cursor: pointer;
            font-size: 14px;
            color: #555;
            text-decoration: none;
        }

        .order-tab--active {
            color: #ee4d2d;
            border-bottom: 2px solid #ee4d2d;
        }

        .order-search-bar {
            padding-top: 15px;
        }

        .order-search-input {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #e8e8e8;
            border-radius: 4px;
            font-size: 14px;
            color: #757575;
            background-color: #f5f5f5;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .order-search-input::placeholder {
            color: #999;
        }

        .order-search-input:focus {
            outline: none;
        }

        .order-section {
            margin: 20px 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .shop-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #e8e8e8;
        }

        .shop-info-wrapper {
            display: flex;
            align-items: center;
        }

        .shop-icon {
            margin-right: 10px;
            font-size: 18px;
            color: #555;
        }

        .shop-name {
            font-weight: bold;
            font-size: 14px;
            color: #333;
            margin-right: 15px;
        }

        .shop-chat-btn {
            background-color: #ee4d2d;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 2px;
            font-size: 12px;
            cursor: pointer;
            margin-right: 10px;
        }

        .shop-view-btn {
            border: 1px solid #ccc;
            background-color: white;
            padding: 5px 10px;
            border-radius: 2px;
            font-size: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .order-delivery-status {
            display: flex;
            align-items: center;
            color: #26aa99;
            font-size: 14px;
        }

        .order-status {
            font-weight: bold;
            color: #ee4d2d;
            margin-left: 15px;
        }

        .product-item-container a {
            padding: 15px;
            border-bottom: 1px solid #e8e8e8;
            display: flex;
        }

        .product-item-image {
            width: 80px;
            height: 80px;
            border: 1px solid #e8e8e8;
            margin-right: 15px;
        }

        .product-item-details {
            flex: 1;
        }

        .product-item-name {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .product-item-category {
            font-size: 12px;
            color: #757575;
            margin-bottom: 10px;
        }

        .product-item-quantity {
            font-size: 14px;
            color: #757575;
        }

        .product-item-price {
            text-align: right;
        }

        .product-item-price-old {
            text-decoration: line-through;
            color: #757575;
            font-size: 12px;
        }

        .product-item-price-new {
            color: #ee4d2d;
            font-weight: bold;
            font-size: 14px;
        }

        .order-summary {
            padding: 15px;
            text-align: right;
            border-bottom: 1px solid #e8e8e8;
        }

        .order-summary-label {
            font-size: 14px;
            color: #333;
        }

        .order-summary-amount {
            font-size: 20px;
            color: #ee4d2d;
            font-weight: bold;
        }

        .order-action-section {
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .order-review-info {
            font-size: 12px;
            color: #757575;
        }

        .order-review-link {
            color: #4080ee;
            text-decoration: none;
            cursor: pointer;
        }

        .order-action-buttons {
            display: flex;
        }

        .order-btn {
            padding: 8px 20px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            margin-left: 10px;
        }

        .order-btn--outline {
            border: 1px solid #ccc;
            background-color: white;
            color: #555;
        }

        .order-btn--primary {
            background-color: #ee4d2d;
            color: white;
            border: none;
            transition: background-color 0.3s ease;
        }

        .order-btn--primary:hover {
            background-color: #ff6347;
            /* Màu đỏ cam sáng hơn khi hover */
            cursor: pointer;
        }

        .order-btn--cancel {
            background-color: #9E9E9E;
            color: white;
            outline: none;
            border: none;
            margin-left: 10px;
            transition: background-color 0.3s ease;
        }

        .order-btn--cancel:hover {
            background-color: #757575;
            /* Màu xám đậm hơn khi hover */
            cursor: pointer;
        }

        .order-icon {
            margin-right: 5px;
        }

        .order-status-icon {
            color: #26aa99;
            margin-right: 5px;
        }


        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 0;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 500px;
            animation: modalFadeIn 0.3s;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            padding: 15px 20px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }

        .close-modal {
            color: #aaa;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.2s;
        }

        .close-modal:hover {
            color: #555;
        }

        .modal-body {
            padding: 20px;
        }

        .cancel-reason-options {
            margin-bottom: 20px;
        }

        .cancel-reason-item {
            padding: 10px 15px;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
        }

        .cancel-reason-item:last-child {
            border-bottom: none;
        }

        .cancel-reason-item input[type="radio"] {
            margin-right: 10px;
        }

        .cancel-reason-item label {
            margin: 0;
            cursor: pointer;
            flex: 1;
            font-size: 14px;
        }

        #otherReasonGroup {
            margin-top: 15px;
            padding: 0 15px;
        }

        #otherReason {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            min-height: 80px;
            resize: vertical;
        }

        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .loading-reasons {
            text-align: center;
            padding: 20px;
            color: #666;
        }

        .order-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s;
        }

        .order-btn--primary {
            background-color: #f25862;
            color: white;
        }

        .order-btn--primary:hover {
            background-color: #e74c3c;
        }

        .order-btn--cancel {
            background-color: #e9ecef;
            color: #333;
        }

        .order-btn--cancel:hover {
            background-color: #dee2e6;
        }

        .order-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
    </style>
@endsection

@section('content')
    @include('client.components.breadcrumb')
    @include('client.pages.order.order')
    <div id="cancelOrderModal" class="modal">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Hủy Đơn Hàng</h2>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body">
                <p>Vui lòng cho chúng tôi biết lý do bạn muốn hủy đơn hàng:</p>
                <form id="cancelOrderForm">
                    @csrf
                    <!-- Container để chứa danh sách lý do từ API -->
                    <div id="cancelReasonContainer" class="cancel-reason-options">
                        <!-- Các lựa chọn sẽ được render động từ API -->
                        <div class="loading-reasons">
                            <i class="fa fa-spinner fa-spin"></i> Đang tải danh sách lý do...
                        </div>
                    </div>

                    <!-- Phần nhập lý do khác -->
                    <div class="form-group" id="otherReasonGroup" style="display: none;">
                        <label for="otherReason">Chi tiết lý do:</label>
                        <textarea id="otherReason" placeholder="Vui lòng nhập lý do của bạn" class="form-control"></textarea>
                    </div>

                    <!-- Input ẩn để lưu ID đơn hàng -->
                    <input type="hidden" id="orderIdToCancel" value="">

                    <!-- Thông báo lỗi -->
                    <div id="cancelErrorMessage" class="error-message" style="display: none; color: red; margin: 10px 0;">
                    </div>

                    <!-- Nhóm nút -->
                    <div class="button-group">
                        <button type="button" id="confirmCancel" class="order-btn order-btn--primary">Xác nhận hủy</button>
                        <button type="button" id="closeModal" class="order-btn order-btn--cancel">Đóng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabs = document.querySelectorAll('.order-tab');
            const orderList = document.getElementById('order-list');

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

            function getDeliveryStatus(status) {
                if (status === 'completed') {
                    return "Giao hàng thành công";
                } else if (['picking_up', 'shipping'].includes(status)) {
                    return "Đang giao hàng";
                }
                return ""; // Các trạng thái khác không hiển thị
            }

            // Biến để lưu trữ trạng thái hiện tại
            let currentStatus = 'all';
            let currentSearch = '';

            // Biến để lưu trữ danh sách lí do hủy đơn hàng từ API
            let cancelReasons = [];

            // Hàm chuyển đổi giá từ ₫299956.00 (hoặc số) thành 299.956 VNĐ
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

            // Hàm để tải danh sách đơn hàng
            async function loadOrders(status, search = '') {
                try {
                    currentStatus = status;
                    currentSearch = search;

                    // Tạo query string
                    let queryString = '';
                    if (status !== 'all') {
                        const statuses = status.split(',');
                        queryString = statuses.map(s => `status[]=${s}`).join('&');
                    } else {
                        queryString = 'status=all';
                    }

                    if (search) {
                        queryString += `&search=${encodeURIComponent(search)}`;
                    }

                    // Gửi yêu cầu API
                    const response = await fetch(`/api/orders?${queryString}`);
                    const data = await response.json();
                    const orders = data.data;

                    console.log(orders);


                    // Xóa danh sách cũ
                    orderList.innerHTML = '';

                    // Thêm thanh tìm kiếm với form
                    const searchBarDiv = document.createElement('div');
                    searchBarDiv.className = 'order-search-bar';
                    searchBarDiv.innerHTML = `
                        <form class="search-form">
                            <input type="text" class="order-search-input" 
                            placeholder="Bạn có thể tìm kiếm theo ID đơn hàng hoặc Tên Sản phẩm, nhấn Enter để tìm" 
                            value="${search}">
                       
                        </form>
                    `;
                    orderList.appendChild(searchBarDiv);

                    // Thêm container cho danh sách đơn hàng
                    const ordersSection = document.createElement('div');
                    ordersSection.className = 'orders-section';
                    orderList.appendChild(ordersSection);

                    // Hiển thị danh sách đơn hàng
                    if (orders.length === 0) {
                        ordersSection.innerHTML = `
                            <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 300px; width: 100%; background-color: #f5f5f5; margin-top: 20px">
                                <i class="fa fa-shopping-bag" style="font-size: 80px; color: #ccc;"></i>
                                <p style="color: #666; font-size: 16px; margin-top: 20px;">Chưa có đơn hàng</p>
                            </div>
                        `;
                    } else {
                        renderOrderItems(orders, ordersSection);
                    }

                    // Thêm sự kiện lắng nghe cho input tìm kiếm (chỉ khi nhấn Enter)
                    const searchInput = orderList.querySelector('.order-search-input');
                    searchInput.addEventListener('keypress', (e) => {
                        if (e.key === 'Enter') {
                            e.preventDefault(); // Ngăn chặn hành vi mặc định của form (nếu có)
                            loadOrders(currentStatus, e.target.value);
                        }
                    });

                    // Thêm một form wrapper để xử lý submit
                    const searchForm = document.createElement('form');
                    searchForm.addEventListener('submit', (e) => {
                        e.preventDefault();
                        loadOrders(currentStatus, searchInput.value);
                    });

                    // Thay thế input bằng form chứa input
                    searchInput.parentNode.replaceChild(searchForm, searchInput);
                    searchForm.appendChild(searchInput);
                } catch (error) {
                    console.error('Lỗi khi tải đơn hàng:', error);
                    orderList.innerHTML = '<p>Có lỗi xảy ra, vui lòng thử lại.</p>';
                }
            }

            function renderOrderItems(orders, container) {
                orders.forEach(order => {
                    const orderItem = document.createElement('div');
                    orderItem.className = 'order-section';
                    const vietnameseStatus = getStatusInVietnamese(order.status);
                    let cancelledAt = '';

                    if (order.cancellation != null && order.cancellation.cancelled_at) {
                        // Parse the timestamp and format it
                        const date = new Date(order.cancellation.cancelled_at);
                        cancelledAt = date.toLocaleString('vi-VN', {
                            day: '2-digit',
                            month: '2-digit',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit',
                        }); // e.g., "05/05/2025, 10:00"
                    }


                    const deliveryStatus = getDeliveryStatus(order.status);

                    const shopSection = document.createElement('div');
                    shopSection.className = 'shop-section';
                    shopSection.innerHTML = `
                        <div class="shop-info-wrapper">
                            <div class="shop-icon"><i class="fa fa-shopping-bag" style="color: #f25862"></i></div>
                            <div class="shop-name">WalkOn - Mã Đơn Hàng: ${order.order_code}</div>
                        </div>
                        <div class="order-delivery-status">
                            <span class="order-status-icon"></span>
                            <span>${deliveryStatus}</span>
                            <span class="order-status">${vietnameseStatus.toUpperCase()} <span> ${cancelledAt}</span></span>
                        </div>
                    `;
                    orderItem.appendChild(shopSection);

                    // Hiển thị sản phẩm trong đơn hàng
                    if (order.order_items && order.order_items.length > 0) {
                        order.order_items.forEach(item => {
                            const productContainer = document.createElement('div');
                            productContainer.className = 'product-item-container';

                            // Lấy thông tin sản phẩm
                            const product = item.product || {};
                            const slug = product.slug;
                            const variant = item.product_variant || {};
                            const image = variant.image || '/img/default-image.jpg';
                            const name = product.name || 'Sản phẩm';
                            const oldPrice = item.price || 0;
                            const price = item.price_sale || 0;
                            const quantity = item.quantity || 1;

                            // Tạo các phần tử hiển thị thông tin sản phẩm
                            productContainer.innerHTML = `
                                <a href="/order-detail/${order.order_code}">
                                    <img src="${image}" alt="${name}" class="product-item-image">
                                    <div class="product-item-details">
                                        <div class="product-item-name">${name}</div>
                                        <div class="product-item-category">Phân loại hàng: 
                                            <span>${variant.color || ''}</span>
                                            ${variant.size ? `, <span>${variant.size}</span>` : ''}
                                        </div>
                                        <div class="product-item-quantity">x${quantity}</div>
                                    </div>
                                    <div class="product-item-price">
                                        ${oldPrice > price ? `<div class="product-item-price-old">${formatPrice(oldPrice)}</div>` : ''}
                                        <div class="product-item-price-new">${formatPrice(price)}</div>
                                    </div>
                                </a>
                            `;
                            orderItem.appendChild(productContainer);
                        });
                    }

                    // Hiển thị tổng tiền
                    const orderSummary = document.createElement('div');
                    orderSummary.className = 'order-summary';
                    orderSummary.innerHTML = `
                        <span class="order-summary-label">Thành tiền: </span>
                        <span class="order-summary-amount">${formatPrice(order.final_price)}</span>
                    `;
                    orderItem.appendChild(orderSummary);

                    // Hiển thị thông tin đặt hàng và nút thao tác
                    const actionSection = document.createElement('div');
                    actionSection.className = 'order-action-section';

                    // Tạo phần hiển thị ngày đặt hàng
                    const orderDate = `<div class="order-review-info">
                        Ngày đặt: <span>${new Date(order.created_at).toLocaleDateString('vi-VN')}</span>
                    </div>`;

                    // Tạo phần nút với điều kiện kiểm tra status
                    let buttons =
                        `<button class="order-btn order-btn--primary" data-order-id="${order.id}">Xem Chi Tiết</button>`;

                    // Thêm nút hủy đơn hàng nếu trạng thái là pending
                    if (order.status === 'pending') {
                        buttons +=
                            `<button class="order-btn order-btn--cancel" data-order-id="${order.id}">Hủy Đặt Hàng</button>`;
                    }

                    // Kết hợp các phần tử
                    actionSection.innerHTML = `
                        ${orderDate}
                        <div class="order-action-buttons">
                            ${buttons}
                        </div>
                    `;

                    orderItem.appendChild(actionSection);

                    // Thêm sự kiện cho nút xem chi tiết
                    setTimeout(() => {
                        const detailButton = actionSection.querySelector('.order-btn--primary');
                        if (detailButton) {
                            detailButton.addEventListener('click', () => {
                                window.location.href = `/order-detail/${order.order_code}`;
                            });
                        }
                    }, 0);

                    container.appendChild(orderItem);
                });
            }

            // Lấy các lí do hủy đơn từ API
            async function loadCancelReasons() {
                try {
                    const response = await fetch('/api/order-cancel-reasons');
                    const data = await response.json();
                    if (data.success == true) {
                        cancelReasons = data.data;
                        return data.data;
                    } else {
                        console.error('Không thể tải lí do hủy đơn:', data.message || 'Định dạng không hợp lệ');
                        return [];
                    }
                } catch (error) {
                    console.error('Lỗi khi tải lí do hủy đơn:', error);
                    return [];
                }
            }

            // Chọn các phần tử DOM
            const modal = document.getElementById('cancelOrderModal');
            const closeModalBtn = document.querySelector('.close-modal');
            const closeModalBtnBottom = document.getElementById('closeModal');
            const confirmCancelBtn = document.getElementById('confirmCancel');
            const orderIdInput = document.getElementById('orderIdToCancel');
            const cancelReasonContainer = document.getElementById('cancelReasonContainer');
            const otherReasonGroup = document.getElementById('otherReasonGroup');

            // Hàm tạo danh sách lí do hủy đơn
            function renderCancelReasons(reasons) {
                let reasonsHtml = '';

                if (reasons && reasons.length > 0) {

                    reasons.forEach((reason, index) => {
                        reasonsHtml += `
                            <div class="cancel-reason-item">
                                <input type="radio" name="cancelReason" id="reason${index}" value="${reason.id}" ${index === 0 ? 'checked' : ''}>
                                <label for="reason${index}">${reason.reason}</label>
                            </div>
                        `;
                    });
                } else {
                    // Nếu không có dữ liệu từ API, hiển thị các lí do mặc định
                    reasonsHtml = `
                        <div class="cancel-reason-item">
                            <input type="radio" name="cancelReason" id="reason1" value="change_mind" checked>
                            <label for="reason1">Tôi muốn thay đổi sản phẩm</label>
                        </div>
                        <div class="cancel-reason-item">
                            <input type="radio" name="cancelReason" id="reason2" value="better_price">
                            <label for="reason2">Tôi tìm thấy giá tốt hơn</label>
                        </div>
                        <div class="cancel-reason-item">
                            <input type="radio" name="cancelReason" id="reason3" value="mistake">
                            <label for="reason3">Tôi đặt nhầm</label>
                        </div>
                    `;
                }

                // Luôn thêm tùy chọn "Lí do khác"
                reasonsHtml += `
                    <div class="cancel-reason-item">
                        <input type="radio" name="cancelReason" id="reasonOther" value="other">
                        <label for="reasonOther">Lí do khác</label>
                    </div>
                `;

                // Cập nhật nội dung HTML
                cancelReasonContainer.innerHTML = reasonsHtml;

                // Thêm lại sự kiện cho các radio button
                document.querySelectorAll('input[name="cancelReason"]').forEach(function(radio) {
                    radio.addEventListener('change', function() {
                        if (this.value === 'other') {
                            otherReasonGroup.style.display = 'block';
                        } else {
                            otherReasonGroup.style.display = 'none';
                        }
                    });
                });
            }

            // Thêm sự kiện cho tất cả các nút "Hủy đặt hàng"
            document.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('order-btn--cancel')) {
                    const orderId = e.target.getAttribute('data-order-id');
                    if (orderId) {
                        openCancelModal(orderId);
                    }
                }
            });

            // Hàm mở modal
            async function openCancelModal(orderId) {
                orderIdInput.value = orderId;

                // Tải lí do hủy đơn từ API (nếu chưa tải)
                if (cancelReasons.length === 0) {
                    const reasons = await loadCancelReasons();
                    console.log(reasons);


                    renderCancelReasons(reasons);
                }

                modal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            }

            // Đóng modal khi nhấp vào nút X
            closeModalBtn.addEventListener('click', closeModal);

            // Đóng modal khi nhấp vào nút Đóng
            closeModalBtnBottom.addEventListener('click', closeModal);

            // Đóng modal khi nhấp bên ngoài modal
            window.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

            // Hàm đóng modal
            function closeModal() {
                modal.style.display = 'none';
                document.body.style.overflow = ''; // Khôi phục cuộn trang
                resetForm();
            }

            // Xử lý khi nhấn nút xác nhận hủy
            confirmCancelBtn.addEventListener('click', function() {
                const orderId = orderIdInput.value;
                const selectedReasonInput = document.querySelector('input[name="cancelReason"]:checked');

                if (!selectedReasonInput) {
                    alert('Vui lòng chọn lý do hủy đơn hàng');
                    return;
                }

                const selectedReason = selectedReasonInput.value;
                let cancelReason = selectedReason;
                console.log(cancelReason);

                let cancelReasonText = selectedReasonInput.nextElementSibling.textContent.trim();

                // Nếu chọn lý do khác, lấy giá trị từ textarea
                if (selectedReason === 'other') {
                    const otherReasonText = document.getElementById('otherReason').value.trim();
                    if (!otherReasonText) {
                        alert('Vui lòng nhập lý do hủy đơn hàng');
                        return;
                    }
                    cancelReason = null;
                    cancelReasonText = otherReasonText;
                }

                // Gửi yêu cầu hủy đơn hàng
                cancelOrder(orderId, cancelReason, cancelReasonText);
            });

            // Hàm gửi yêu cầu API hủy đơn hàng
            function cancelOrder(orderId, reasonCode, reasonText) {
                // Hiển thị loading nếu cần
                confirmCancelBtn.textContent = 'Đang xử lý...';
                confirmCancelBtn.disabled = true;


                // Gọi API hủy đơn hàng
                fetch('/api/orders/' + orderId + '/cancel', {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            reason_code: reasonCode,
                            reason_text: reasonText
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success == true) {
                            showMessage('Đơn Hàng Được Hủy Thành Công', '#4CAF50');
                            closeModal();
                            loadOrders('all');
                        } else {
                            alert('Không thể hủy đơn hàng: ' + (data.message || 'Đã có lỗi xảy ra'));
                            confirmCancelBtn.textContent = 'Xác nhận hủy';
                            confirmCancelBtn.disabled = false;
                        }
                    })
                    .catch(err => {
                        console.error('Lỗi khi hủy đơn hàng:', err);
                        alert('Đã xảy ra lỗi khi hủy đơn hàng. Vui lòng thử lại sau.');
                        confirmCancelBtn.textContent = 'Xác nhận hủy';
                        confirmCancelBtn.disabled = false;
                    });
            }

            // Reset form khi đóng modal
            function resetForm() {
                document.getElementById('cancelOrderForm').reset();
                otherReasonGroup.style.display = 'none';
                confirmCancelBtn.textContent = 'Xác nhận hủy';
                confirmCancelBtn.disabled = false;
            }

            // Xử lý sự kiện click cho từng tab
            tabs.forEach(tab => {
                tab.addEventListener('click', (e) => {
                    e.preventDefault();

                    // Xóa class active khỏi tất cả tab
                    tabs.forEach(t => t.classList.remove('order-tab--active'));

                    // Thêm class active cho tab được click
                    tab.classList.add('order-tab--active');

                    // Lấy trạng thái từ data-status
                    const status = tab.getAttribute('data-status');

                    // Tải danh sách đơn hàng theo trạng thái
                    loadOrders(status, currentSearch);
                });
            });

            // Tải danh sách "Tất cả" khi trang được load
            loadOrders('all');

            // Tải danh sách lí do hủy đơn khi trang được load
            // loadCancelReasons();
        });
    </script>
@endsection

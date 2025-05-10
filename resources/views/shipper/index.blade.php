@extends('shipper.layouts.app')
@section('title', 'Giao Hàng')
@section('content')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        .complete-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .complete-btn:hover {
            background-color: #218838;
        }

        .order-item {
            display: flex;
            gap: 15px;
            border-bottom: 1px solid #e0e0e0;
            padding: 15px 0;
        }

        .order-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }

        .order-details {
            flex-grow: 1;
        }

        .order-details h3 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .order-details p {
            font-size: 14px;
            color: #666;
            margin-bottom: 3px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .dashboard-header {
            margin-bottom: 30px;
        }

        .dashboard-header h1 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
        }

        .dashboard-header p {
            color: #6c757d;
            font-size: 14px;
        }

        .user-avatar {
            float: right;
            background-color: #f0f0f0;
            color: #666;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-top: -40px;
        }

        .stats-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            flex: 1;
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #eee;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon svg {
            width: 30px;
            height: 30px;
        }

        .stat-title {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: bold;
            color: #333;
        }

        .tabs {
            display: flex;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 20px;
        }

        .tab {
            padding: 12px 20px;
            cursor: pointer;
            font-size: 14px;
            color: #495057;
            background-color: #f8f9fa;
            border: none;
            border-radius: 4px 4px 0 0;
            margin-right: 5px;
        }

        .tab.active {
            background-color: white;
            color: #333;
            border: 1px solid #e9ecef;
            border-bottom: 2px solid white;
            margin-bottom: -1px;
            font-weight: 500;
        }

        .tab-content {
            padding: 20px;
            background-color: white;
            border-radius: 0 0 4px 4px;
            min-height: 300px;
        }

        .order-list {
            display: none;
        }

        .order-list.active {
            display: block;
        }

        .empty-state {
            text-align: center;
            padding: 50px 0;
            color: #6c757d;
        }

        .empty-state p {
            margin-top: 10px;
            font-size: 14px;
        }

        /* Icon colors */
        .icon-blue {
            color: #007bff;
        }

        .icon-orange {
            color: #fd7e14;
        }

        .icon-green {
            color: #20c997;
        }

        .icon-purple {
            color: #6f42c1;
        }
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container">
        <div class="dashboard-header">
            <h1>Shipper Dashboard</h1>
            <p>Manage your delivery orders</p>
            <div class="user-avatar">SH</div>
        </div>

        <div class="stats-container">
            <!-- Chờ xác nhận -->
            <div class="stat-card" data-bs-toggle="modal" data-bs-target="#shipperOrdersModal" data-status="ready">
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#fd7e14"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                </div>
                <div class="stat-title">Chờ xác nhận</div>
                <div class="stat-value" id="count-order-ready">0</div>
            </div>

            <div class="stat-card" data-bs-toggle="modal" data-bs-target="#shipperOrdersModal" data-status="picking_up">
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#fd7e14"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path
                            d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4a2 2 0 0 0 1-1.73z">
                        </path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                </div>
                <div class="stat-title">Đang nhận hàng</div>
                <div class="stat-value" id="count-order-picking-up">0</div>
            </div>
            <!-- Đang giao -->
            <div class="stat-card" data-bs-toggle="modal" data-bs-target="#shipperOrdersModal" data-status="shipping">
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#fd7e14"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="1" y="3" width="15" height="13"></rect>
                        <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                        <circle cx="5.5" cy="18.5" r="2.5"></circle>
                        <circle cx="18.5" cy="18.5" r="2.5"></circle>
                    </svg>
                </div>
                <div class="stat-title">Đang giao</div>
                <div class="stat-value" id="count-order-shipping">0</div>
            </div>
            <!-- Đã hoàn thành -->
            <div class="stat-card" data-bs-toggle="modal" data-bs-target="#shipperOrdersModal" data-status="delivered">
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#20c997"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <div class="stat-title">Đã hoàn thành</div>
                <div class="stat-value" id="count-order-delivered">0</div>
            </div>
        </div>
        <div class="tabs">

            <button class="tab" data-tab="delivering">
                {{-- Đang giao <span>{{ $count_shipped }}</span> --}}
            </button>
            <button class="tab" data-tab="completed">
                {{-- Đã hoàn thành <span>{{ $count_delivered }}</span> --}}
            </button>
        </div>

        <div class="tab-content">
            <!-- Delivering orders -->

            <div id="delivering" class="order-list active">
                {{-- @foreach ($orders_shipped as $order)
          <div class="order-item">
              <img src="{{ Storage::url($order->product_image) }}" alt="{{ $order->product_name }}" class="img-fluid d-block">
              <div class="order-details">
                  <h3>{{ $order->product_name }}</h3>
                  <p>Size: {{ $order->variant_size_name }}</p>
                  <p>Màu sắc: {{ $order->variant_color_name }}</p>
                  <p>Số lượng: {{ $order->quantity }}</p>
                  <p>Mã đơn hàng: {{ $order->order_code }}</p>
                  <p>Địa chỉ: {{ $order->receiver_address }}</p>
                  <p>SĐT: {{ $order->receiver_phone }}</p>
                  <p>Giá: {{ number_format($order->final_price, 0, ',', '.') }} VND</p>
                  <form action="{{ route('shippers.delivered', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Hoàn Thành</button>
                </form>
                
                
              </div>
          </div>
          @endforeach --}}
            </div>

            <!-- Completed orders -->
            <div id="completed" class="order-list">
                {{-- @foreach ($orders_delivered as $order_delivered)
                    <div class="order-item">
                        <img src="{{ Storage::url($order_delivered->product_image) }}"
                            alt="{{ $order_delivered->product_name }}" class="img-fluid d-block">
                        <div class="order-details">
                            <h3>{{ $order_delivered->product_name }}</h3>
                            <p>Size: {{ $order_delivered->variant_size_name }}</p>
                            <p>Màu sắc: {{ $order_delivered->variant_color_name }}</p>
                            <p>Số lượng: {{ $order_delivered->quantity }}</p>
                            <p>Mã đơn hàng: {{ $order_delivered->order_code }}</p>
                            <p>Địa chỉ: {{ $order_delivered->receiver_address }}</p>
                            <p>SĐT: {{ $order_delivered->receiver_phone }}</p>
                            <p>Giá: {{ number_format($order_delivered->final_price, 0, ',', '.') }} VND</p>
                            <p style="color: #007bff;font-size:18px">Đã giao</p>

                        </div>
                    </div>
                @endforeach --}}
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="shipperOrdersModal" tabindex="-1" aria-labelledby="shipperOrdersModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shipperOrdersModalLabel">Danh sách đơn hàng cần giao</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Khách hàng</th>
                                <th>Địa chỉ giao</th>
                                <th>Số điện thoại</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody id="shipperOrdersList">
                            <!-- Dữ liệu đơn hàng sẽ được đổ vào đây -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        // Simple tab switching functionality
        document.addEventListener("DOMContentLoaded", function() {
            const tabs = document.querySelectorAll(".tab");
            const orderLists = document.querySelectorAll(".order-list");

            tabs.forEach((tab) => {
                tab.addEventListener("click", function() {
                    // Remove active class from all tabs
                    tabs.forEach((t) => t.classList.remove("active"));

                    // Add active class to clicked tab
                    this.classList.add("active");

                    // Hide all order lists
                    orderLists.forEach((list) => list.classList.remove("active"));

                    // Show the corresponding order list
                    const tabId = this.getAttribute("data-tab");
                    document.getElementById(tabId).classList.add("active");
                });
            });
        });
    </script> --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function fetchOrdersForShipper(statusFilter = '') {
                fetch('/api/order/shipper', {
                        method: 'GET',
                        headers: {
                            'Authorization': `Bearer ${localStorage.getItem('token')}`,
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            console.error(data.message);
                            return;
                        }


                        const dataOrder = data.data.orders;

                        console.log(dataOrder);


                        // Tính toán số lượng đơn hàng theo trạng thái
                        const countReady = dataOrder.filter(order => order.order_status === 'ready').length;
                        const countPickingUp = dataOrder.filter(order => order.order_status === 'picking_up')
                            .length;
                        const countShipping = dataOrder.filter(order => order.order_status === 'shipping')
                            .length;
                        const countDelivered = dataOrder.filter(order => order.order_status === 'delivered')
                            .length;

                        // Cập nhật số liệu vào stat-value
                        document.getElementById('count-order-ready').textContent = countReady;
                        document.getElementById('count-order-picking-up').textContent = countPickingUp;
                        document.getElementById('count-order-shipping').textContent = countShipping;
                        document.getElementById('count-order-delivered').textContent = countDelivered;

                        // Lọc đơn hàng theo trạng thái (nếu có)
                        const filteredOrders = statusFilter ?
                            dataOrder.filter(order => order.order_status === statusFilter) :
                            dataOrder;

                        // Cập nhật bảng trong modal
                        const tbody = document.getElementById('shipperOrdersList');
                        tbody.innerHTML = '';
                        if (filteredOrders.length === 0) {
                            tbody.innerHTML =
                                '<tr><td colspan="6" class="text-center">Không có đơn hàng phù hợp</td></tr>';
                            return;
                        }

                        filteredOrders.forEach(order => {

                            let actionButton = '';
                            if (order.order_status === 'ready') {
                                actionButton =
                                    `<button class="btn btn-success btn-sm" onclick="updateOrderStatus('${order.id}', 'picking_up')">Xác nhận giao</button>`;
                            } else if (order.order_status === 'picking_up') {
                                actionButton =
                                    `<button class="btn btn-success btn-sm" onclick="updateOrderStatus('${order.id}', 'shipping')">Bắt đầu giao hàng</button>`;
                            } else if (order.order_status === 'shipping') {
                                actionButton =
                                    `<button class="btn btn-secondary btn-sm" onclick="updateOrderStatus('${order.id}', 'delivered')" >Đã hoàn thành</button>`;
                            } else if (order.order_status === 'delivered') {
                                actionButton =
                                    `<button class="btn btn-secondary btn-sm" disabled>Đã hoàn thành</button>`;
                            }
                            tbody.innerHTML += `
                            <tr>
                                <td>${order.order_code}</td>
                                <td>${order.receiver_name}</td>
                                <td>${order.receiver_address}</td>
                                <td>${order.receiver_phone}</td>
                                <td>
                                    ${actionButton}
                                </td>
                            </tr>
                        `;
                        });
                    })
                    .catch(error => {
                        console.error('Lỗi khi lấy danh sách đơn hàng:', error);
                    });
            }

            // Hàm cập nhật trạng thái đơn hàng
            window.updateOrderStatus = async function(orderId, newStatus) {
                try {
                    console.log('Updating order:', orderId, 'to status:', newStatus);

                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
                    if (!csrfToken) {
                        throw new Error('CSRF token not found');
                    }

                    // Show loading state (e.g., disable button or show spinner)
                    const button = document.querySelector(`[data-order-id="${orderId}"]`);
                    button?.setAttribute('disabled', 'true');

                    const response = await fetch(`/api/order/${orderId}/update-status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({
                            status: newStatus
                        }),
                    });

                    const data = await response.json();

                    if (!response.ok || !data.success) {
                        throw new Error(data.message || `HTTP error! Status: ${response.status}`);
                    }

                    // Show success notification (replace alert with a better UI)
                    showToast('Cập nhật trạng thái thành công!', 'success');

                    // Refresh orders
                    const statusFilter = document.querySelector('.modal.show')?.dataset?.status || '';
                    await fetchOrdersForShipper(statusFilter);
                } catch (error) {
                    console.error('Error updating order status:', error);
                    showToast(`Lỗi: ${error.message}`, 'error');
                } finally {
                    // Hide loading state
                    const button = document.querySelector(`[data-order-id="${orderId}"]`);
                    button?.removeAttribute('disabled');
                }
            };

            // Example toast notification function (using a library like SweetAlert2)
            function showToast(message, type) {
                // Replace with your preferred notification library
                alert(message); // Fallback for now
            }

            var shipperOrdersModal = document.getElementById('shipperOrdersModal');
            shipperOrdersModal.addEventListener('show.bs.modal', function(event) {
                const statusFilter = event.relatedTarget.dataset.status || '';
                fetchOrdersForShipper(statusFilter);
            });



            fetchOrdersForShipper();
        });
    </script>

@endsection

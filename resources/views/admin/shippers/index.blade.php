@extends('admin.layouts.app')
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
      <!-- Delivering -->
      <div class="stat-card">
        <div class="stat-icon">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="none"
            stroke="#fd7e14"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <rect x="1" y="3" width="15" height="13"></rect>
            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
            <circle cx="5.5" cy="18.5" r="2.5"></circle>
            <circle cx="18.5" cy="18.5" r="2.5"></circle>
          </svg>
        </div>
        <div class="stat-title">Đang giao</div>
        <div class="stat-value">{{$count_shipped}}</div>
      </div>

      <!-- Completed -->
      <div class="stat-card">
        <div class="stat-icon">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="none"
            stroke="#20c997"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
          </svg>
        </div>
        <div class="stat-title">Đã hoàn thành</div>
        <div class="stat-value">{{$count_delivered}}</div>
      </div>

      <!-- Total orders -->
      <div class="stat-card">
        <div class="stat-icon">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            fill="none"
            stroke="#6f42c1"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <circle cx="12" cy="12" r="10"></circle>
            <polyline points="12 6 12 12 16 14"></polyline>
          </svg>
        </div>
        <div class="stat-title">Tổng đơn</div>
        <div class="stat-value">{{$count_shipped+$count_delivered}}</div>
      </div>
    </div>

    <div class="tabs">
      
      <button class="tab" data-tab="delivering">
        Đang giao <span>{{$count_shipped}}</span>
      </button>
      <button class="tab" data-tab="completed">
        Đã hoàn thành <span>{{$count_delivered}}</span>
      </button>
    </div>

    <div class="tab-content">
      <!-- Delivering orders -->
      
        
      
        
          
       
        <div id="delivering" class="order-list active">
          @foreach ($orders_shipped as $order)
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
          @endforeach
      </div>
      

      <!-- Completed orders -->
      <div id="completed" class="order-list">
        @foreach ($orders_delivered as $order_delivered)
          <div class="order-item">
              <img src="{{ Storage::url($order_delivered->product_image) }}" alt="{{ $order_delivered->product_name }}" class="img-fluid d-block">
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
          @endforeach
      </div>
    </div>
  </div>

  <script>
    // Simple tab switching functionality
    document.addEventListener("DOMContentLoaded", function () {
      const tabs = document.querySelectorAll(".tab");
      const orderLists = document.querySelectorAll(".order-list");

      tabs.forEach((tab) => {
        tab.addEventListener("click", function () {
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
    
  </script>

@endsection
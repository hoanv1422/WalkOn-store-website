@extends('admin.layouts.app')
@section('title', 'Đơn hàng')
@section('style')
    <!-- nouisliderribute css -->
    <link rel="stylesheet" href="{{ asset('templates/admin/assets/libs/nouislider/nouislider.min.css') }}">
    <!-- gridjs css -->
    {{-- <link rel="stylesheet" href="{{ asset('templates/admin/assets/libs/gridjs/theme/mermaid.min.css') }}"> --}}
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Orders</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Ecommerce</a></li>
                                <li class="breadcrumb-item active">Orders</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <!-- Thông báo từ session -->
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
                </div>
            @endif

            <!-- Thông báo từ session -->
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
                </div>
            @endif

            <!-- Toast Container cho thông báo dùng JS -->
            <div id="toastContainer" class="toast-container position-fixed bottom-0 end-0 p-3"></div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="orderList">
                        <div class="card-header border-0">
                            <div class="row align-items-center gy-3">
                                <div class="col-sm">
                                    <h5 class="card-title mb-0">Order History</h5>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex gap-1 flex-wrap">
                                        <!-- Nút mở modal thêm đơn hàng (hiện đang comment, bỏ comment nếu muốn hiển thị) -->
                                        {{-- <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                            id="add-btn" data-bs-target="#addOrderModal">
                                            <i class="ri-add-line align-bottom me-1"></i> Thêm đơn hàng
                                        </button> --}}
                                        {{-- <button type="button" class="btn btn-info">
                                            <i class="ri-file-download-line align-bottom me-1"></i> Nhập từ file
                                        </button> --}}
                                        <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()">
                                            <i class="ri-delete-bin-2-line"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Filter Form -->
                        <div class="card-body border border-dashed border-end-0 border-start-0">
                            <form id="filterForm">
                                <div class="row g-3">
                                    <div class="col-xxl-5 col-sm-6">
                                        <div class="search-box">
                                            <input type="text" name="search" class="form-control search"
                                                placeholder="Tìm kiếm theo mã đơn, khách hàng, trạng thái đơn hàng, v.v..." />
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                    <div class="col-xxl-2 col-sm-6">
                                        <div class="input-group">
                                            <input type="text" name="date" class="form-control" data-date-format="d M, Y"
                                                id="demo-datepicker" placeholder="Chọn ngày" />
                                            <button type="button" id="clear-datepicker" class="btn btn-outline-secondary">
                                                Bỏ chọn
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-xxl-2 col-sm-4">
                                        <select name="order_status" class="form-control" data-choices data-choices-search-false
                                            id="idStatus">
                                            <option value="">Trạng thái</option>
                                            <option value="all" selected>Tất cả</option>
                                            <option value="pending">Chờ xử lý</option>
                                            <option value="confirmed">Đã xác nhận</option>
                                            <option value="processing">Đang xử lý</option>
                                            <option value="ready">Đã chuẩn bị xong</option>
                                            <option value="shipped">Đang giao</option>
                                            <option value="delivered">Đã giao</option>
                                            <option value="cancelled">Đã hủy</option>
                                            <option value="completed">Đã hoàn thành công</option>
                                        </select>
                                    </div>
                                    <div class="col-xxl-2 col-sm-4">
                                        <select name="payment_method" class="form-control" data-choices data-choices-search-false
                                            id="idPayment">
                                            <option value="">Chọn thanh toán</option>
                                            <option value="all" selected>Tất cả</option>
                                            <option value="Mastercard">Mastercard</option>
                                            <option value="Paypal">Paypal</option>
                                            <option value="Visa">Visa</option>
                                            <option value="COD">COD</option>
                                            <option value="Bank Card">Bank card</option>
                                        </select>
                                    </div>
                                    <div class="col-xxl-1 col-sm-4">
                                        <button type="button" class="btn btn-primary w-100" onclick="searchData();">
                                            <i class="ri-equalizer-fill me-1 align-bottom"></i> Bộ lọc
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Order Table -->
                        <div class="card-body pt-0">
                            <div>
                                @include('admin.orders._orderTable')
                            </div>
                            <!-- Modal cập nhật đơn hàng -->
                            @include('admin.orders._orderTableUpdate')
                            <!-- Modal Xóa đơn hàng (nếu có) -->
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- container-fluid -->
    </div><!-- End Page-content -->
@endsection
<!-- Bao gồm flatpickr CSS và JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Bao gồm flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

@section('script')
    <!-- nouisliderribute js -->
    <script src="{{ asset('templates/admin/assets/libs/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('templates/admin/assets/libs/wnumb/wNumb.min.js') }}"></script>
    <!-- Flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/vi.js"></script>
    <!-- gridjs js -->
    {{-- <script src="{{ asset('templates/admin/assets/libs/gridjs/gridjs.umd.js') }}"></script> --}}
    <script src="../../../../unpkg.com/gridjs%406.2.0/plugins/selection/dist/selection.umd.js"></script>

    <script>
        // Hàm hiển thị thông báo sử dụng Bootstrap Toast
        function showNotification(message, type) {
            // Xác định lớp màu theo loại thông báo: success (xanh) hay error (đỏ)
            var bgClass = type === 'success' ? 'success' : 'danger';
            var toastHTML = `
                <div class="toast align-items-center text-bg-${bgClass} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            ${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>`;
            $('#toastContainer').append(toastHTML);
            var toastEl = $('#toastContainer .toast').last()[0];
            var toast = new bootstrap.Toast(toastEl, { delay: 3000 });
            toast.show();
            setTimeout(function() {
                $(toastEl).remove();
            }, 4000);
        }

        $(document).ready(function() {
            $('table.dataTable').each(function() {
                $(this).DataTable({
                    "paging": true,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "pageLength": 10,
                    "lengthChange": false
                });
            });
        });

        $(document).on('click', '.dropdown-item.remove-list', function() {
            var actionUrl = $(this).data('action');
            $('#deleteForm').attr('action', actionUrl);
        });

        // Đặt locale tiếng Việt cho flatpickr
        flatpickr.localize(flatpickr.l10ns.vi);
        // Khởi tạo flatpickr cho input chọn ngày
        var fpInstance = flatpickr("#demo-datepicker", {
            dateFormat: "d M, Y",
            locale: "vi"
        });
        // Sự kiện cho nút "Bỏ chọn" để xóa giá trị đã chọn
        document.getElementById("clear-datepicker").addEventListener("click", function() {
            fpInstance.clear();
        });

        function searchData() {
            var formData = $("#filterForm").serialize();
            $.ajax({
                url: '/admin/orders',
                type: 'GET',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    $("#orderTableContainer").html(response.html);
                    showNotification("Tìm kiếm thành công.", "success");
                },
                error: function(xhr, status, error) {
                    var errorMsg = "Có lỗi xảy ra khi tìm kiếm.";
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        errorMsg = xhr.responseJSON.error;
                    }
                    showNotification(errorMsg, "error");
                }
            });
        }

        $('#updateOrderModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var orderCode = button.data('order_code');
            var customerName = button.data('customer_name');
            var orderDate = button.data('order_date');
            var totalPrice = button.data('total_price');
            var paymentMethod = button.data('payment_method');
            var orderStatus = button.data('order_status');

            var modal = $(this);
            modal.find('#id-field').val(id);
            modal.find('#orderId').val(orderCode);
            modal.find('#customername-field').val(customerName);
            modal.find('#date-field').val(orderDate);
            modal.find('#amount-field').val(totalPrice);
            modal.find('#payment-field').val(paymentMethod);
            modal.find('#delivered-status').val(orderStatus);

            modal.find('form').attr('action', '/admin/orders/' + orderCode);
        });

        $('#updateOrderModal form').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                url: form.attr('action'),
                type: 'PUT', // SỬA THÀNH PUT
                data: form.serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        showNotification(response.success, "success");
                        setTimeout(() => location.reload(), 1500);
                    }
                },
                error: function(xhr) {
                    var errorMsg = "Lỗi không xác định";
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        errorMsg = xhr.responseJSON.error;
                    }
                    showNotification(errorMsg, "error");
                }
            });
        });
    </script>
@endsection

<style>
    /* CSS bổ sung nếu cần cho thông báo (Toast) */
    #notification {
        display: none;
        position: fixed;
        top: 80px;
        right: 20px;
        z-index: 1060;
        min-width: 250px;
        max-width: 300px;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    }
</style>

@extends('admin.layouts.app')
@section('title', 'Đơn hàng')
@section('style')
    <!-- nouisliderribute css -->
    <link rel="stylesheet" href="{{ asset('templates/admin/assets/libs/nouislider/nouislider.min.css') }}">
    <!-- gridjs css -->
    {{-- <link rel="stylesheet" href="{{ asset('templates/admin/assets/libs/gridjs/theme/mermaid.min.css') }}"> --}}
@endsection

@section('content')

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

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
                            <form>
                                <div class="row g-3">
                                    <div class="col-xxl-5 col-sm-6">
                                        <div class="search-box">
                                            <input type="text" class="form-control search"
                                                placeholder="Tìm kiếm theo mã đơn, khách hàng, trạng thái đơn hàng, v.v..." />
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                    <div class="col-xxl-2 col-sm-6">
                                        <div>
                                            <input type="text" class="form-control" data-provider="flatpickr"
                                                data-date-format="d M, Y" data-range-date="true" id="demo-datepicker"
                                                placeholder="Chọn ngày" />
                                        </div>
                                    </div>
                                    <div class="col-xxl-2 col-sm-4">
                                        <div>
                                            <select class="form-control" data-choices data-choices-search-false name="order_status" id="idStatus">
                                                <option value="">Trạng thái</option>
                                                <option value="all" selected>Tất cả</option>
                                                <option value="pending">Chờ xử lý</option>
                                                <option value="confirmed">Đã xác nhận</option>
                                                <option value="processing">Đang xử lý</option>
                                                <option value="shipped">Đang giao</option>
                                                <option value="delivered">Đã giao</option>
                                                <option value="cancelled">Đã hủy</option>
                                                <option value="returned">Trả hàng</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xxl-2 col-sm-4">
                                        <div>
                                            <select class="form-control" data-choices data-choices-search-false name="payment_method" id="idPayment">
                                                <option value="">Chọn thanh toán</option>
                                                <option value="all" selected>Tất cả</option>
                                                <option value="Mastercard">Mastercard</option>
                                                <option value="Paypal">Paypal</option>
                                                <option value="Visa">Visa</option>
                                                <option value="COD">COD</option>
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="col-xxl-1 col-sm-4">
                                        <div>
                                            <button type="button" class="btn btn-primary w-100" onclick="SearchData();">
                                                <i class="ri-equalizer-fill me-1 align-bottom"></i> Bộ lọc
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Order Table -->
                        <div class="card-body pt-0">
                            <div>
                                <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active All py-3" data-bs-toggle="tab" id="All"
                                            href="#home1" role="tab" aria-selected="true">
                                            <i class="ri-store-2-fill me-1 align-bottom"></i> Tất cả đơn hàng
                                        </a>
                                    </li>
                                    <!-- Các tab trạng thái khác nếu cần -->
                                </ul>
                                <div class="table-responsive table-card mb-1">
                                    <table class="table table-nowrap align-middle" id="orderTable">
                                        <thead class="text-muted table-light">
                                            <tr class="text-uppercase">
                                                <th scope="col" style="width: 25px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                                    </div>
                                                </th>
                                                <th class="sort" data-sort="order_code">Mã đơn hàng</th>
                                                <th class="sort" data-sort="customer_name">Khách hàng</th>
                                                <th class="sort" data-sort="product_name">Sản phẩm</th>
                                                <th class="sort" data-sort="date">Ngày đặt</th>
                                                <th class="sort" data-sort="amount">Tổng tiền</th>
                                                <th class="sort" data-sort="payment">Phương thức thanh toán</th>
                                                <th class="sort" data-sort="status">Trạng thái giao hàng</th>
                                                <th class="sort" data-sort="action">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            @forelse ($orders as $order)
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="checkAll" value="{{ $order->id }}">
                                                        </div>
                                                    </th>
                                                    <td class="order_code">
                                                        <a href="{{ route('orders.show', $order) }}" class="fw-medium link-primary">
                                                            {{ $order->order_code }}
                                                        </a>
                                                    </td>
                                                    <td class="customer_name">
                                                        {{ $order->user_name ?? ($order->user->name ?? 'N/A') }}
                                                    </td>
                                                    <td class="product_name">
                                                        @if ($order->orderItems->isNotEmpty())
                                                            @foreach ($order->orderItems as $orderItem)
                                                                <div>
                                                                    {{ $orderItem->product_name }}
                                                                    @if ($orderItem->variant_color_name || $orderItem->variant_size_name)
                                                                        ({{ $orderItem->variant_color_name ?? '' }}{{ $orderItem->variant_size_name ? '- ' . $orderItem->variant_size_name : '' }})
                                                                    @endif
                                                                    <br>
                                                                    <small>SKU: {{ $orderItem->product_sku }}</small>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div>N/A</div>
                                                        @endif
                                                    </td>
                                                    <td class="date">
                                                        {{ $order->created_at->format('d M, Y') }}
                                                        <small class="text-muted">{{ $order->created_at->format('h:i A') }}</small>
                                                    </td>
                                                    <td class="amount">
                                                        {{ number_format($order->total_price, 0, ',', '.') }} VNĐ
                                                    </td>
                                                    <td class="payment">
                                                        {{ ucfirst($order->payment_method) }}
                                                    </td>
                                                    <td class="status">
                                                        @if ($order->order_status == 'pending')
                                                            <span class="badge bg-warning-subtle text-warning">Chờ xử lý</span>
                                                        @elseif($order->order_status == 'processing')
                                                            <span class="badge bg-info-subtle text-info">Đang xử lý</span>
                                                        @elseif($order->order_status == 'cancelled')
                                                            <span class="badge bg-danger-subtle text-danger">Đã hủy</span>
                                                        @elseif($order->order_status == 'delivered')
                                                            <span class="badge bg-success-subtle text-success">Đã giao</span>
                                                        @else
                                                            <span class="badge bg-secondary-subtle text-secondary">{{ $order->order_status }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="action">
                                                        <ul class="list-inline hstack gap-2 mb-0">
                                                            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Xem">
                                                                <a href="{{ route('orders.show', $order) }}" class="text-primary d-inline-block">
                                                                    <i class="ri-eye-fill fs-16"></i>
                                                                </a>
                                                            </li>
                                                            <li class="list-inline-item edit" data-bs-toggle="modal" data-bs-target="#updateOrderModal"
                                                                data-id="{{ $order->id }}"
                                                                data-order_code="{{ $order->order_code }}"
                                                                data-customer_name="{{ $order->user_name ?? ($order->user->name ?? 'N/A') }}"
                                                                data-order_date="{{ $order->created_at->format('Y-m-d') }}"
                                                                data-total_price="{{ $order->total_price }}"
                                                                data-payment_method="{{ $order->payment_method }}"
                                                                data-order_status="{{ $order->order_status }}">
                                                                <a href="javascript:void(0);" class="text-primary d-inline-block" title="Chỉnh sửa">
                                                                    <i class="ri-pencil-fill fs-16"></i>
                                                                </a>
                                                            </li>
                                                            {{-- <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa">
                                                                <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteOrder"
                                                                    data-id="{{ $order->id }}">
                                                                    <i class="ri-delete-bin-5-fill fs-16"></i>
                                                                </a>
                                                            </li> --}}
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="9" class="text-center">Không tìm thấy đơn hàng nào.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div class="noresult" style="display: none">
                                        <div class="text-center">
                                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                                colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px"></lord-icon>
                                            <h5 class="mt-2">Rất tiếc! Không tìm thấy kết quả.</h5>
                                            <p class="text-muted">Chúng tôi đã tìm kiếm qua hơn 150+ đơn hàng nhưng không tìm thấy kết quả nào.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="pagination-wrap hstack gap-2">
                                        <a class="page-item pagination-prev disabled" href="#">Trước</a>
                                        <ul class="pagination listjs-pagination mb-0"></ul>
                                        <a class="page-item pagination-next" href="#">Tiếp theo</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal cập nhật đơn hàng -->
                            <div class="modal fade" id="updateOrderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="orderModalLabel">Cập nhật đơn hàng</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng" id="close-modal"></button>
                                        </div>
                                        <form action="" method="POST" class="tablelist-form" autocomplete="off">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <input type="hidden" id="id-field" name="id" />
                                                <div class="mb-3" id="modal-id">
                                                    <label for="orderId" class="form-label">Mã đơn hàng</label>
                                                    <input type="text" id="orderId" name="order_code" class="form-control" readonly />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="customername-field" class="form-label">Tên khách hàng</label>
                                                    <input type="text" id="customername-field" name="customer_name" class="form-control" placeholder="Nhập tên khách hàng" required />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="date-field" class="form-label">Ngày đặt hàng</label>
                                                    <input type="date" id="date-field" name="order_date" class="form-control" data-provider="flatpickr" required data-date-format="d M, Y" data-enable-time placeholder="Chọn ngày" />
                                                </div>
                                                <div class="row gy-4 mb-3">
                                                    <div class="col-md-6">
                                                        <div>
                                                            <label for="amount-field" class="form-label">Tổng số tiền</label>
                                                            <input type="text" id="amount-field" name="total_price" class="form-control" placeholder="Nhập tổng số tiền" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div>
                                                            <label for="payment-field" class="form-label">Phương thức thanh toán</label>
                                                            <select class="form-control" data-trigger name="payment_method" id="payment-field" required>
                                                                <option value="">Chọn phương thức thanh toán</option>
                                                                <option value="Mastercard">Mastercard</option>
                                                                <option value="Visa">Visa</option>
                                                                <option value="COD">COD</option>
                                                                <option value="Paypal">Paypal</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label for="delivered-status" class="form-label">Trạng thái giao hàng</label>
                                                    <select class="form-control" data-trigger name="order_status" id="delivered-status" required>
                                                        <option value="">Chọn trạng thái giao hàng</option>
                                                        <option value="pending">Chờ xử lý</option>
                                                        <option value="processing">Đang xử lý</option>
                                                        <option value="cancelled">Đã hủy</option>
                                                        <option value="shipped">Đang giao</option>
                                                        <option value="delivered">Đã giao</option>
                                                        <option value="returned">Trả hàng</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-success">Cập nhật đơn hàng</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Xóa đơn hàng -->
                            {{-- <div class="modal fade flip" id="deleteOrder" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body p-5 text-center">
                                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                                colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                                            <div class="mt-4 text-center">
                                                <h4>Bạn sắp xóa đơn hàng?</h4>
                                                <p class="text-muted fs-15 mb-4">Việc xóa đơn hàng sẽ xóa tất cả thông tin liên quan trong cơ sở dữ liệu.</p>
                                                <div class="hstack gap-2 justify-content-center remove">
                                                    <button class="btn btn-link link-success fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal">
                                                        <i class="ri-close-line me-1 align-middle"></i> Đóng
                                                    </button>
                                                    <button class="btn btn-danger" id="delete-record">Vâng, Xóa nó</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <!--end modal -->
                        </div>
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div><!-- container-fluid -->
    </div><!-- End Page-content -->

@endsection

@section('script')
    <!-- nouisliderribute js -->
    <script src="{{ asset('templates/admin/assets/libs/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('templates/admin/assets/libs/wnumb/wNumb.min.js') }}"></script>

    <!-- gridjs js -->
    {{-- <script src="{{ asset('templates/admin/assets/libs/gridjs/gridjs.umd.js') }}"></script> --}}
    <script src="../../../../unpkg.com/gridjs%406.2.0/plugins/selection/dist/selection.umd.js"></script>
    <!-- ecommerce product list -->
    <script>
        $(document).ready(function() {
            $('table.dataTable').each(function() {
                $(this).DataTable({
                    "paging": true, // Hiển thị phân trang
                    "searching": false, // Tắt tìm kiếm
                    "ordering": true, // Bật sắp xếp
                    "info": true, // Hiển thị thông tin tổng
                    "pageLength": 10, // Giới hạn số lượng bản ghi mỗi trang
                    "lengthChange": false
                });
            });
        });

        $(document).on('click', '.dropdown-item.remove-list', function() {
            var actionUrl = $(this).data('action');
            $('#deleteForm').attr('action', actionUrl);
        });

        // Khi modal update được mở, set giá trị cho form
        $('#updateOrderModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Lấy nút kích hoạt modal
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

            // Cập nhật lại action của form
            modal.find('form').attr('action', '/admin/orders/' + id);
        });

        // AJAX xử lý form update để không chuyển trang
        $('#updateOrderModal form').on('submit', function(e) {
            e.preventDefault(); // Ngăn form submit theo cách truyền thống
            var form = $(this);
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                success: function(response) {
                    alert('Cập nhật đơn hàng thành công');
                    location.reload();
                },
                error: function(xhr) {
                    alert('Có lỗi xảy ra khi cập nhật đơn hàng.');
                }
            });
        });

        // // AJAX xử lý xóa đơn hàng
        // $('#delete-record').on('click', function() {
        //     var orderId = $('#deleteOrder').find('.remove-item-btn').data('id') || '';
        //     $.ajax({
        //         url: '/admin/orders/' + orderId,
        //         type: 'DELETE',
        //         data: {
        //             _token: '{{ csrf_token() }}'
        //         },
        //         success: function(response) {
        //             alert('Xóa đơn hàng thành công');
        //             location.reload();
        //         },
        //         error: function(xhr) {
        //             alert('Có lỗi xảy ra khi xóa đơn hàng.');
        //         }
        //     });
        // });
    </script>
    {{-- <script src="{{ asset('templates/admin/assets/js/pages/ecommerce-product-list.init.js') }}"></script> --}}
@endsection

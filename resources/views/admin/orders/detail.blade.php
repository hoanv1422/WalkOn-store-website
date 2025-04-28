@extends('admin.layouts.app')
@section('title', 'Chi tiết đơn hàng')
@section('style')
    <!-- nouisliderribute css -->
    <link rel="stylesheet" href="{{ asset('templates/admin/assets/libs/nouislider/nouislider.min.css') }}">
    <!-- gridjs css -->
    {{-- <link rel="stylesheet" href="{{ asset('templates/admin/assets/libs/gridjs/theme/mermaid.min.css') }}"> --}}
@endsection

@section('content')

    <div class="page-content">
        <div class="container-fluid">
            <!-- Tiêu đề trang -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Chi tiết đơn hàng</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Thương mại điện tử</a></li>
                                <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Kết thúc tiêu đề trang -->

            <div class="row">
                <!-- Cột trái: Thông tin đơn hàng & Timeline -->
                <div class="col-xl-9">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <!-- Hiển thị mã đơn hàng từ dữ liệu động -->
                                <h5 class="card-title flex-grow-1 mb-0">Đơn hàng #{{ $order->order_code }}</h5>
                                <div class="flex-shrink-0">
                                    <!-- Link tải Invoice (route cần được định nghĩa trong web.php) -->
                                    {{-- <a href="{{ route('orders.invoice', $order->id) }}" class="btn btn-success btn-sm">
                                    <i class="ri-download-2-fill align-middle me-1"></i> Tải hóa đơn
                                </a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Bảng danh sách sản phẩm trong đơn hàng -->
                            <div class="table-responsive table-card">
                                <table class="table table-nowrap align-middle table-borderless mb-0">
                                    <thead class="table-light text-muted">
                                        <tr>
                                            <th scope="col">Chi tiết sản phẩm</th>
                                            <th scope="col">Đơn giá</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Đánh giá</th>
                                            <th scope="col" class="text-end">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderItems as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                            <img src="{{ Storage::url($item->product_image) }}"
                                                                alt="{{ $item->product_name }}" class="img-fluid d-block">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h5 class="fs-15">
                                                                <a href="{{ route('products.show', $item->product_variant_id) }}"
                                                                    class="link-primary">
                                                                    {{ $item->product_name }}
                                                                </a>
                                                            </h5>
                                                            <p class="text-muted mb-0">
                                                                Màu sắc: <span
                                                                    class="fw-medium">{{ $item->variant_color_name ?? 'N/A' }}</span>
                                                            </p>
                                                            <p class="text-muted mb-0">
                                                                Kích cỡ: <span
                                                                    class="fw-medium">{{ $item->variant_size_name ?? 'N/A' }}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>${{ number_format($item->product_price, 2) }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>
                                                    <div class="text-warning fs-15">
                                                        @for ($i = 1; $i <= floor($item->rating ?? 0); $i++)
                                                            <i class="ri-star-fill"></i>
                                                        @endfor
                                                        @if (($item->rating ?? 0) - floor($item->rating ?? 0) > 0)
                                                            <i class="ri-star-half-fill"></i>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="fw-medium text-end">
                                                    ${{ number_format($item->product_price * $item->quantity, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr class="border-top border-top-dashed">
                                            <td colspan="3"></td>
                                            <td colspan="2" class="fw-medium p-0">
                                                <!-- Bảng tổng hợp đơn hàng -->
                                                <table class="table table-borderless mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td>Tạm tính :</td>
                                                            <td class="text-end">
                                                                ${{ number_format($order->subtotal, 2) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Giảm giá
                                                                <span class="text-muted">
                                                                    ({{ $order->coupon ?? '-' }})
                                                                </span> :
                                                            </td>
                                                            <td class="text-end">
                                                                -${{ number_format($order->discount, 2) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Phí vận chuyển :</td>
                                                            <td class="text-end">
                                                                ${{ number_format($order->shipping_charge, 2) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Thuế ước tính :</td>
                                                            <td class="text-end">
                                                                ${{ number_format($order->tax, 2) }}
                                                            </td>
                                                        </tr>
                                                        <tr class="border-top border-top-dashed">
                                                            <th scope="row">Tổng cộng (USD) :</th>
                                                            <th class="text-end">
                                                                ${{ number_format($order->total_price, 2) }}
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--end card-->

                    <!-- Card: Trạng thái đơn hàng -->
                    <div class="card">
                        <div class="card-header">
                            <div class="d-sm-flex align-items-center">
                                <h5 class="card-title flex-grow-1 mb-0">Trạng thái đơn hàng</h5>
                                <div class="flex-shrink-0 mt-2 mt-sm-0">
                                    <!-- Nút cập nhật trạng thái (mở modal Update Status) -->
                                    <a href="javascript:void(0);" class="btn btn-soft-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#updateStatusModal">
                                        <i class="ri-map-pin-line align-middle me-1"></i> Cập nhật trạng thái
                                    </a>
                                    <!-- Nút hủy đơn hàng -->
                                    <a href="javascript:void(0);" class="btn btn-soft-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#cancelOrderModal">
                                        <i class="mdi mdi-archive-remove-outline align-middle me-1"></i> Hủy đơn hàng
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @php
                                $statusMapping = [
                                    'pending' => 'Chờ xử lý',
                                    'confirmed' => 'Đã xác nhận',
                                    'processing' => 'Đang xử lý',
                                    'shipped' => 'Đang giao',
                                    'delivered' => 'Đã giao',
                                    'cancelled' => 'Đã hủy',
                                    'returned' => 'Hoàn hàng',
                                    'completed' => 'Hoàn tất',
                                ];

                                $statusAudits = $order->auditsCustom
                                    ->where('field_name', 'order_status')
                                    ->sortByDesc('created_at');

                            @endphp
                            @if ($statusAudits->count() > 0)
                                <div class="timeline">
                                    @foreach ($statusAudits as $audit)
                                        <div class="timeline-item">
                                            <div class="timeline-time">
                                                {{ $audit->created_at->format('d/m/Y - H:i') }}
                                            </div>
                                            <div class="timeline-content">
                                                <p class="mb-1">
                                                    Trạng thái thay đổi từ
                                                    <strong>{{ $statusMapping[$audit->old_value] ?? $audit->old_value }}</strong>
                                                    sang
                                                    <strong>{{ $statusMapping[$audit->new_value] ?? $audit->new_value }}</strong>
                                                </p>
                                                <p class="mb-0 text-muted">
                                                    bởi {{ $audit->user->name ?? 'Hệ thống' }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>Không có lịch sử thay đổi trạng thái nào.</p>
                            @endif
                        </div>
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->

                <!-- Cột phải: Thông tin khác -->
                <div class="col-xl-3">
                    <!-- Card: Thông tin vận chuyển (Logistics) -->
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <h5 class="card-title flex-grow-1 mb-0">
                                    <i class="mdi mdi-truck-fast-outline align-middle me-1 text-muted"></i> Thông tin vận
                                    chuyển
                                </h5>
                                <div class="flex-shrink-0">
                                    <a href="javascript:void(0);" class="badge bg-primary-subtle text-primary fs-11">
                                        Theo dõi đơn hàng
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <lord-icon src="https://cdn.lordicon.com/uetqnvvg.json" trigger="loop"
                                    colors="primary:#405189,secondary:#0ab39c" style="width:80px;height:80px">
                                </lord-icon>
                                <h5 class="fs-16 mt-2">RQK Logistics</h5>
                                {{-- <p class="text-muted mb-0">ID: {{ $order->logistics_id ?? 'N/A' }}</p>
                            <p class="text-muted mb-0">Phương thức thanh toán: {{ $order->logistics_payment_mode ?? 'N/A' }}</p> --}}
                            </div>
                        </div>
                    </div>
                    <!--end card-->

                    <!-- Card: Thông tin khách hàng -->
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <h5 class="card-title flex-grow-1 mb-0">Thông tin khách hàng</h5>
                                <div class="flex-shrink-0">
                                    <a href="{{ route('users.index', $order->user_id) }}" class="link-secondary">
                                        Xem hồ sơ
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0 vstack gap-3">
                                <li>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="{{ Storage::url($order->user->avatar ?? 'default.jpg') }}"
                                                alt="" class="avatar-sm rounded">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fs-14 mb-1">
                                                {{ $order->user_name ?? ($order->user->name ?? 'N/A') }}
                                            </h6>
                                            <p class="text-muted mb-0">Khách hàng</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>
                                    {{ $order->user->mail ?? 'N/A' }}
                                </li>
                                <li>
                                    <i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>
                                    {{ $order->user->phone ?? 'N/A' }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--end card-->
                    <!-- Modal cập nhật trạng thái đơn hàng -->
                    <div class="modal fade" id="updateStatusModal" tabindex="-1"
                        aria-labelledby="updateStatusModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateStatusModalLabel">Cập nhật trạng thái đơn hàng</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Đóng"></button>
                                </div>
                                <form id="updateStatusForm" action="{{ route('orders.updateStatus', $order) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="order_status" class="form-label">Chọn trạng thái mới</label>
                                            <select name="order_status" id="order_status" class="form-control" required>
                                                <option value="">-- Chọn trạng thái --</option>
                                                <option value="pending">Chờ xử lý</option>
                                                <option value="confirmed">Đã xác nhận</option>
                                                <option value="processing">Đang xử lý</option>
                                                <option value="shipped">Đang giao</option>
                                                <option value="delivered">Đã giao</option>
                                                <option value="cancelled">Đã hủy</option>
                                                <option value="returned">Hoàn hàng</option>
                                                <option value="completed">Hoàn tất</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Đóng</button>
                                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal hủy đơn hàng -->
                    <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="cancelOrderModalLabel">Hủy đơn hàng</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Đóng"></button>
                                </div>
                                <form id="cancelOrderForm" action="{{ route('orders.cancel', $order) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <p>Bạn có chắc chắn muốn hủy đơn hàng <strong>#{{ $order->order_code }}</strong>
                                            không?</p>
                                        <p><small>Lưu ý: Hành động này không thể hoàn tác.</small></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Đóng</button>
                                        <button type="submit" class="btn btn-danger">Xác nhận hủy</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- Card: Địa chỉ giao hàng -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="ri-map-pin-line align-middle me-1 text-muted"></i> Địa chỉ giao hàng
                            </h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                                <li class="fw-medium fs-14">{{ $order->receiver_name ?? 'N/A' }}</li>
                                <li>{{ $order->receiver_email ?? 'N/A' }}</li>
                                <li>{{ $order->receiver_phone ?? 'N/A' }}</li>
                                <li>{{ $order->receiver_address ?? 'N/A' }}</li>
                                <li>{{ $order->coupon ?? 'N/A' }}</li>
                            </ul>
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
            // Nếu bạn có bảng DataTables, cấu hình tại đây
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
    </script>
    {{-- <script src="{{ asset('templates/admin/assets/js/pages/ecommerce-product-list.init.js') }}"></script> --}}
@endsection

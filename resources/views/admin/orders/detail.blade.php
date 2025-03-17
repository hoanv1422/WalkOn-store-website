@extends('admin.layouts.app')
@section('title', 'detail-order')
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
                    <h4 class="mb-sm-0">Order Details</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Ecommerce</a></li>
                            <li class="breadcrumb-item active">Order Details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <!-- Left Column: Order Details & Timeline -->
            <div class="col-xl-9">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <!-- Hiển thị mã đơn hàng từ dữ liệu động -->
                            <h5 class="card-title flex-grow-1 mb-0">Order #{{ $order->order_code }}</h5>
                            <div class="flex-shrink-0">
                                <!-- Link tải Invoice (route cần được định nghĩa trong web.php) -->
                                {{-- <a href="{{ route('orders.invoice', $order->id) }}" class="btn btn-success btn-sm">
                                    <i class="ri-download-2-fill align-middle me-1"></i> Invoice
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
                                        <th scope="col">Product Details</th>
                                        <th scope="col">Item Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Rating</th>
                                        <th scope="col" class="text-end">Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                        
                                                        <img src="{{ Storage::url($item->product_image) }}" alt="{{ $item->product_name }}" class="img-fluid d-block">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h5 class="fs-15">
                                                            <a href="{{ route('products.show', $item->product_variant_id) }}" class="link-primary">
                                                                {{ $item->product_name }}
                                                            </a>
                                                        </h5>
                                                        <p class="text-muted mb-0">
                                                            Color: <span class="fw-medium">{{ $item->variant_color_name ?? 'N/A' }}</span>
                                                        </p>
                                                        <p class="text-muted mb-0">
                                                            Size: <span class="fw-medium">{{ $item->variant_size_name ?? 'N/A' }}</span>
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
                                                    @if(($item->rating ?? 0) - floor($item->rating ?? 0) > 0)
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
                                                        <td>Sub Total :</td>
                                                        <td class="text-end">${{ number_format($order->subtotal, 2) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Discount <span class="text-muted">({{ $order->coupon ?? '-' }})</span> :</td>
                                                        <td class="text-end">-${{ number_format($order->discount, 2) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shipping Charge :</td>
                                                        <td class="text-end">${{ number_format($order->shipping_charge, 2) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Estimated Tax :</td>
                                                        <td class="text-end">${{ number_format($order->tax, 2) }}</td>
                                                    </tr>
                                                    <tr class="border-top border-top-dashed">
                                                        <th scope="row">Total (USD) :</th>
                                                        <th class="text-end">${{ number_format($order->total_price, 2) }}</th>
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

                <!-- Card: Order Status Timeline -->
                <div class="card">
                    <div class="card-header">
                        <div class="d-sm-flex align-items-center">
                            <h5 class="card-title flex-grow-1 mb-0">Order Status</h5>
                            <div class="flex-shrink-0 mt-2 mt-sm-0">
                                <!-- Nút cập nhật trạng thái (mở modal Update Status) -->
                                <a href="javascript:void(0);" class="btn btn-soft-info btn-sm" data-bs-toggle="modal" data-bs-target="#updateStatusModal">
                                    <i class="ri-map-pin-line align-middle me-1"></i> Update Status
                                </a>
                                <!-- Nút hủy đơn hàng -->
                                <a href="javascript:void(0);" class="btn btn-soft-danger btn-sm" data-bs-toggle="modal" data-bs-target="#cancelOrderModal">
                                    <i class="mdi mdi-archive-remove-outline align-middle me-1"></i> Cancel Order
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Timeline đơn hàng -->
                        <div class="profile-timeline">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item border-0">
                                    <div class="accordion-header" id="headingOne">
                                        <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 avatar-xs">
                                                    <div class="avatar-title bg-success rounded-circle">
                                                        <i class="ri-shopping-bag-line"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="fs-15 mb-0 fw-semibold">Order Placed - <span class="fw-normal">{{ $order->created_at->format('D, d M Y') }}</span></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body ms-2 ps-5 pt-0">
                                            <h6 class="mb-1">An order has been placed.</h6>
                                            <p class="text-muted">{{ $order->created_at->format('D, d M Y - h:i A') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Thêm các bước khác vào timeline nếu có -->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end card-->
            </div>
            <!--end col-->

            <!-- Right Column: Additional Details -->
            <div class="col-xl-3">
                <!-- Card: Logistics Details -->
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <h5 class="card-title flex-grow-1 mb-0">
                                <i class="mdi mdi-truck-fast-outline align-middle me-1 text-muted"></i> Logistics Details
                            </h5>
                            <div class="flex-shrink-0">
                                <a href="javascript:void(0);" class="badge bg-primary-subtle text-primary fs-11">Track Order</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <lord-icon src="https://cdn.lordicon.com/uetqnvvg.json" trigger="loop" colors="primary:#405189,secondary:#0ab39c" style="width:80px;height:80px"></lord-icon>
                            <h5 class="fs-16 mt-2">RQK Logistics</h5>
                            {{-- <p class="text-muted mb-0">ID: {{ $order->logistics_id ?? 'N/A' }}</p>
                            <p class="text-muted mb-0">Payment Mode: {{ $order->logistics_payment_mode ?? 'N/A' }}</p> --}}
                        </div>
                    </div>
                </div>
                <!--end card-->

                <!-- Card: Customer Details -->
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <h5 class="card-title flex-grow-1 mb-0">Customer Details</h5>
                            <div class="flex-shrink-0">
                                <a href="{{ route('users.index', $order->user_id) }}" class="link-secondary">View Profile</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0 vstack gap-3">
                            <li>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ Storage::url($order->user->avatar ?? 'default.jpg') }}" alt="" class="avatar-sm rounded">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-14 mb-1">{{ $order->user_name ?? ($order->user->name ?? 'N/A') }}</h6>
                                        <p class="text-muted mb-0">Customer</p>
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

                <!-- Card: Billing Address -->
                {{-- <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="ri-map-pin-line align-middle me-1 text-muted"></i> Billing Address
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                            <li class="fw-medium fs-14">{{ $order->billing_name ?? 'N/A' }}</li>
                            <li>{{ $order->billing_phone ?? 'N/A' }}</li>
                            <li>{{ $order->billing_address ?? 'N/A' }}</li>
                            <li>{{ $order->billing_city ?? 'N/A' }} - {{ $order->billing_postal ?? 'N/A' }}</li>
                            <li>{{ $order->billing_country ?? 'N/A' }}</li>
                        </ul>
                    </div>
                </div> --}}
                <!--end card-->

                <!-- Card: Shipping Address -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="ri-map-pin-line align-middle me-1 text-muted"></i> Shipping Address
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                            <li class="fw-medium fs-14">{{ $order->receiver_name ?? 'N/A' }}</li>
                            <li>{{ $order->receiver_email ?? 'N/A' }}</li>
                            <li>{{ $order->receiver_phone	 ?? 'N/A' }}</li>
                            <li>{{ $order->receiver_address ?? 'N/A' }}</li>
                            <li>{{ $order->coupon?? 'N/A' }}</li>
                            {{-- <li>{{ $order->shipping_city ?? 'N/A' }} - {{ $order->shipping_postal ?? 'N/A' }}</li>
                            <li>{{ $order->shipping_country ?? 'N/A' }}</li> --}}
                        </ul>
                    </div>
                </div>
                <!--end card-->

                <!-- Card: Payment Details -->
                {{-- <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="ri-secure-payment-line align-bottom me-1 text-muted"></i> Payment Details
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0">
                                <p class="text-muted mb-0">Transactions:</p>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-0">{{ $order->transaction_id ?? 'N/A' }}</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0">
                                <p class="text-muted mb-0">Payment Method:</p>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-0">{{ ucfirst($order->payment_method) }}</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0">
                                <p class="text-muted mb-0">Card Holder Name:</p>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-0">{{ $order->card_holder_name ?? 'N/A' }}</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0">
                                <p class="text-muted mb-0">Card Number:</p>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-0">
                                    {{ $order->card_number ? 'xxxx xxxx xxxx ' . substr($order->card_number, -4) : 'N/A' }}
                                </h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <p class="text-muted mb-0">Total Amount:</p>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <h6 class="mb-0">${{ number_format($order->total_price, 2) }}</h6>
                            </div>
                        </div>
                    </div>
                </div> --}}
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
            // var itemId = $(this).data('id'); 

            $('#deleteForm').attr('action', actionUrl);
            // $('#deleteItemId').val(itemId); 
        });
    </script>
    {{-- <script src="{{ asset('templates/admin/assets/js/pages/ecommerce-product-list.init.js') }}"></script> --}}
@endsection

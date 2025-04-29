@extends('client.layouts.app')

@section('title', 'Lịch Sử Đơn Hàng')

@section('content')
    @include('client.components.breadcrumb')
    <div class="account-area py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <!-- Sidebar -->
                <div class="col-lg-3 mb-4">
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                        <div class="card-body p-0">
                            <div class="text-center p-4 bg-white">
                                <div class="position-relative d-inline-block mb-3">
                                    <div class="rounded-circle p-3891 bg-light border border-primary-subtle">
                                        <img src="{{ $user->avatar ? Storage::url($user->avatar) : asset('default-avatar.png') }}"
                                            alt="Avatar" class="rounded-circle img-fluid shadow-sm"
                                            style="width: 100px; height: 100px; object-fit: cover;">
                                    </div>
                                </div>
                                <h5 class="fw-bold mb-1 text-dark">{{ $user->name }}</h5>
                                <p class="text-muted small mb-0">{{ $user->email }}</p>
                            </div>
                            <div class="list-group list-group-flush">
                                <a href="{{ route('profile.index') }}"
                                    class="list-group-item list-group-item-action d-flex align-items-center py-3 px-4 text-dark border-0">
                                    <i class="fa fa-user-circle me-3 text-secondary"></i>
                                    <span>Thông tin cá nhân</span>
                                </a>
                                <a href="{{ route('profile.orders') }}"
                                    class="list-group-item list-group-item-action active d-flex align-items-center py-3 px-4 border-0">
                                    <i class="fa fa-shopping-bag me-3"></i>
                                    <span>Lịch sử đơn hàng</span>
                                </a>
                                <a href="{{ route('home.index') }}"
                                    class="list-group-item list-group-item-action d-flex align-items-center py-3 px-4 text-dark border-0">
                                    <i class="fa fa-home me-3 text-secondary"></i>
                                    <span>Trang chủ</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Nội dung chính -->
                <div class="col-lg-9">
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden bg-white">
                        <div class="card-header bg-white border-0 pt-4 pb-0">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                                    <i class="fa fa-shopping-bag text-primary"></i>
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-1 text-dark">Lịch Sử Đơn Hàng</h4>
                                    <p class="text-muted mb-0">Xem lại tất cả đơn hàng bạn đã đặt từ khi tạo tài khoản.</p>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            @if ($orders->isEmpty())
                                <div class="text-center py-5">
                                    <div
                                        class="rounded-circle bg-light p-4 d-inline-flex mb-4 border border-secondary-subtle">
                                        <i class="fa fa-shopping-cart fa-2x text-secondary"></i>
                                    </div>
                                    <h5 class="fw-bold mb-3 text-dark">Bạn chưa đặt đơn hàng nào</h5>
                                    <p class="text-muted mb-4">Hãy khám phá các sản phẩm của chúng tôi và đặt hàng ngay!</p>
                                    <a href="{{ route('home.index') }}"
                                        class="btn btn-primary px-4 py-2 shadow-sm rounded-pill">
                                        <i class="fa fa-shopping-cart me-2"></i> Mua sắm ngay
                                    </a>
                                </div>
                            @else
                                <div class="row mb-4 g-3">
                                    <div class="col-md-4">
                                        <form id="statusFilterForm" method="GET" action="{{ route('profile.orders') }}">
                                            <select class="form-select border rounded-pill py-2 px-3 shadow-sm"
                                                name="status" onchange="this.form.submit()">
                                                <option value="" {{ request('status') === '' ? 'selected' : '' }}>Tất
                                                    cả trạng thái</option>
                                                <option value="pending"
                                                    {{ request('status') === 'pending' ? 'selected' : '' }}>Đang chờ xử lý
                                                </option>
                                                <option value="processing"
                                                    {{ request('status') === 'processing' ? 'selected' : '' }}>Đang xử lý
                                                </option>
                                                <option value="shipped"
                                                    {{ request('status') === 'shipped' ? 'selected' : '' }}>Đang giao hàng
                                                </option>
                                                <option value="delivered"
                                                    {{ request('status') === 'delivered' ? 'selected' : '' }}>Đã giao hàng
                                                </option>
                                                <option value="cancelled"
                                                    {{ request('status') === 'cancelled' ? 'selected' : '' }}>Đã hủy bỏ
                                                </option>
                                                <option value="returned"
                                                    {{ request('status') === 'returned' ? 'selected' : '' }}>Đã trả hàng
                                                </option>
                                            </select>
                                        </form>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="input-group shadow-sm rounded-pill overflow-hidden">
                                            <input type="text" class="form-control border-0 py-2 ps-4"
                                                placeholder="Tìm kiếm theo mã đơn hàng..." id="orderSearch">
                                            <button class="btn btn-primary px-3" type="button">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div id="no-orders-found" class="alert alert-info d-none rounded-4 shadow-sm mb-4">
                                    <div class="d-flex align-items-center">
                                        <i class="fa fa-info-circle me-3 fs-4"></i>
                                        <div>Không tìm thấy đơn hàng nào phù hợp với bộ lọc.</div>
                                    </div>
                                </div>

                                <div class="order-list">
                                    @foreach ($orders as $order)
                                        <div class="order-item mb-4">
                                            <div
                                                class="card border-0 shadow-sm rounded-4 overflow-hidden order-card
                                            @switch($order->order_status)
                                                @case('pending') border-start border-secondary border-4 @break
                                                @case('processing') border-start border-warning border-4 @break
                                                @case('shipped') border-start border-info border-4 @break
                                                @case('delivered') border-start border-success border-4 @break
                                                @case('cancelled') border-start border-danger border-4 @break
                                                @case('returned') border-start border-dark border-4 @break
                                            @endswitch">
                                                <div
                                                    class="card-header bg-white d-flex justify-content-between align-items-center py-3 px-4 border-bottom border-light">
                                                    <div>
                                                        <span
                                                            class="badge bg-dark bg-opacity-75 me-2 fw-medium px-3 py-2 rounded-pill">{{ $order->order_code }}</span>
                                                        <span class="text-muted small">
                                                            <i class="fa fa-calendar-o me-1"></i>
                                                            {{ $order->created_at->format('d/m/Y H:i') }}
                                                        </span>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <span
                                                            class="badge fw-medium px-3 py-2 rounded-pill
                                                        @switch($order->order_status)
                                                            @case('pending') bg-secondary bg-opacity-75 @break
                                                            @case('processing') bg-warning bg-opacity-75 text-dark @break
                                                            @case('shipped') bg-info bg-opacity-75 text-white @break
                                                            @case('delivered') bg-success bg-opacity-75 @break
                                                            @case('cancelled') bg-danger bg-opacity-75 @break
                                                            @case('returned') bg-dark bg-opacity-75 @break
                                                        @endswitch me-2">
                                                            @switch($order->order_status)
                                                                @case('pending')
                                                                    Đang chờ xử lý
                                                                @break

                                                                @case('processing')
                                                                    Đang xử lý
                                                                @break

                                                                @case('shipped')
                                                                    Đang giao hàng
                                                                @break

                                                                @case('delivered')
                                                                    Đã giao hàng
                                                                @break

                                                                @case('cancelled')
                                                                    Đã hủy bỏ
                                                                @break

                                                                @case('returned')
                                                                    Đã trả hàng
                                                                @break
                                                            @endswitch
                                                        </span>
                                                        <button
                                                            class="btn btn-sm btn-light rounded-circle p-2 shadow-sm toggle-details"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#order-details-{{ $order->id }}"
                                                            aria-expanded="false">
                                                            <i class="fa fa-chevron-down"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="card-body py-3 px-4">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-2 text-center mb-3 mb-md-0">
                                                            <div class="order-icon rounded-circle p-3 mx-auto
                                                            @switch($order->order_status)
                                                                @case('pending') bg-secondary bg-opacity-10 @break
                                                                @case('processing') bg-warning bg-opacity-10 @break
                                                                @case('shipped') bg-info bg-opacity-10 @break
                                                                @case('delivered') bg-success bg-opacity-10 @break
                                                                @case('cancelled') bg-danger bg-opacity-10 @break
                                                                @case('returned') bg-dark bg-opacity-10 @break
                                                            @endswitch"
                                                                style="width: 60px; height: 60px;">
                                                                @switch($order->order_status)
                                                                    @case('pending')
                                                                        <i class="fa fa-clock-o fa-lg text-secondary"></i>
                                                                    @break

                                                                    @case('processing')
                                                                        <i class="fa fa-cogs fa-lg text-warning"></i>
                                                                    @break

                                                                    @case('shipped')
                                                                        <i class="fa fa-truck fa-lg text-info"></i>
                                                                    @break

                                                                    @case('delivered')
                                                                        <i class="fa fa-check-circle fa-lg text-success"></i>
                                                                    @break

                                                                    @case('cancelled')
                                                                        <i class="fa fa-times-circle fa-lg text-danger"></i>
                                                                    @break

                                                                    @case('returned')
                                                                        <i class="fa fa-undo fa-lg text-dark"></i>
                                                                    @break
                                                                @endswitch
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7 mb-3 mb-md-0">
                                                            <div class="d-flex flex-wrap">
                                                                @foreach ($order->orderItems->take(3) as $item)
                                                                    <div class="position-relative me-3 mb-2">
                                                                        <div class="rounded-3 overflow-hidden border shadow-sm product-thumbnail"
                                                                            style="width: 55px; height: 55px;">
                                                                            <img src="{{ Storage::url($item->product_image) }}"
                                                                                alt="{{ $item->product_name }}"
                                                                                class="w-100 h-100 object-fit-cover">
                                                                        </div>
                                                                        <span
                                                                            class="position-absolute bottom-0 end-0 badge rounded-pill bg-primary fw-medium shadow-sm">
                                                                            {{ $item->quantity }}
                                                                        </span>
                                                                    </div>
                                                                @endforeach
                                                                @if ($order->orderItems->count() > 3)
                                                                    <div class="position-relative me-3 mb-2 d-flex align-items-center justify-content-center bg-light rounded-3 border shadow-sm"
                                                                        style="width: 55px; height: 55px;">
                                                                        <span
                                                                            class="text-primary fw-medium">+{{ $order->orderItems->count() - 3 }}</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 text-md-end">
                                                            <div class="fw-bold text-primary mb-2 fs-5">
                                                                {{ number_format($order->total_price, 0, ',', '.') }} VND
                                                            </div>
                                                            <span
                                                                class="badge fw-medium px-3 py-2 rounded-pill
                                                            @switch($order->payment_status)
                                                                @case('unpaid') bg-warning bg-opacity-75 text-dark @break
                                                                @case('paid') bg-success bg-opacity-75 @break
                                                                @case('refunded') bg-danger bg-opacity-75 @break
                                                            @endswitch">
                                                                @switch($order->payment_status)
                                                                    @case('unpaid')
                                                                        Chưa thanh toán
                                                                    @break

                                                                    @case('paid')
                                                                        Đã thanh toán
                                                                    @break

                                                                    @case('refunded')
                                                                        Đã hoàn tiền
                                                                    @break
                                                                @endswitch
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="collapse" id="order-details-{{ $order->id }}">
                                                    <div class="card-body border-top bg-light pt-4 px-4">
                                                        <div class="row g-4">
                                                            <div class="col-md-6">
                                                                <div
                                                                    class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                                                                    <div class="card-body p-4">
                                                                        <h6
                                                                            class="card-title d-flex align-items-center mb-3 text-dark fw-bold">
                                                                            <i
                                                                                class="fa fa-info-circle me-2 text-primary"></i>
                                                                            Thông tin đơn hàng
                                                                        </h6>
                                                                        <div class="row g-3">
                                                                            <div class="col-6">
                                                                                <div class="text-muted small fw-medium">Mã
                                                                                    đơn hàng:</div>
                                                                                <div class="fw-bold text-dark">
                                                                                    {{ $order->order_code }}</div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <div class="text-muted small fw-medium">
                                                                                    Ngày đặt:</div>
                                                                                <div class="fw-bold text-dark">
                                                                                    {{ $order->created_at->format('d/m/Y H:i') }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <div class="text-muted small fw-medium">
                                                                                    Phương thức thanh toán:</div>
                                                                                <div class="fw-bold text-dark">
                                                                                    {{ $order->payment_method }}</div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <div class="text-muted small fw-medium">Mã
                                                                                    giảm giá:</div>
                                                                                <div class="fw-bold text-dark">
                                                                                    {{ $order->coupon ?? 'Không có' }}
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="text-muted small fw-medium">Ghi
                                                                                    chú:</div>
                                                                                <div class="fw-bold text-dark">
                                                                                    {{ $order->note ?? 'Không có' }}</div>
                                                                            </div>
                                                                            @if ($order->order_status === 'cancelled' && $order->cancellation)
                                                                                <div class="col-12 mt-2">
                                                                                    <div
                                                                                        class="text-muted small fw-medium">
                                                                                        Lý do hủy:</div>
                                                                                    <div class="fw-bold text-danger">
                                                                                        {{ $order->cancellation->reason_id ? $order->cancellation->reason->reason : $order->cancellation->custom_reason }}
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div
                                                                    class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                                                                    <div class="card-body p-4">
                                                                        <h6
                                                                            class="card-title d-flex align-items-center mb-3 text-dark fw-bold">
                                                                            <i class="fa fa-user me-2 text-primary"></i>
                                                                            Thông tin người nhận
                                                                        </h6>
                                                                        <div class="row g-3">
                                                                            <div class="col-12">
                                                                                <div class="text-muted small fw-medium">Tên
                                                                                    người nhận:</div>
                                                                                <div class="fw-bold text-dark">
                                                                                    {{ $order->receiver_name }}</div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="text-muted small fw-medium">Số
                                                                                    điện thoại:</div>
                                                                                <div class="fw-bold text-dark">
                                                                                    {{ $order->receiver_phone }}</div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <div class="text-muted small fw-medium">Địa
                                                                                    chỉ:</div>
                                                                                <div class="fw-bold text-dark">
                                                                                    {{ $order->receiver_address }}</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <div
                                                                    class="card border-0 shadow-sm rounded-4 overflow-hidden">
                                                                    <div class="card-body p-4">
                                                                        <h6
                                                                            class="card-title d-flex align-items-center mb-3 text-dark fw-bold">
                                                                            <i
                                                                                class="fa fa-shopping-cart me-2 text-primary"></i>
                                                                            Sản phẩm đã đặt
                                                                        </h6>
                                                                        <div class="table-responsive">
                                                                            <table class="table table-hover align-middle">
                                                                                <thead class="table-light">
                                                                                    <tr>
                                                                                        <th class="fw-bold text-dark">Sản
                                                                                            phẩm</th>
                                                                                        <th class="fw-bold text-dark">Giá
                                                                                        </th>
                                                                                        <th class="fw-bold text-dark">Số
                                                                                            lượng</th>
                                                                                        <th
                                                                                            class="text-end fw-bold text-dark">
                                                                                            Thành tiền</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach ($order->orderItems as $item)
                                                                                        <tr>
                                                                                            <td>
                                                                                                <div
                                                                                                    class="d-flex align-items-center">
                                                                                                    <div class="rounded-3 overflow-hidden border shadow-sm me-3"
                                                                                                        style="width: 45px; height: 45px;">
                                                                                                        <img src="{{ Storage::url($item->product_image) }}"
                                                                                                            alt="{{ $item->product_name }}"
                                                                                                            class="w-100 h-100 object-fit-cover">
                                                                                                    </div>
                                                                                                    <div>
                                                                                                        <div
                                                                                                            class="fw-bold text-dark">
                                                                                                            {{ $item->product_name }}
                                                                                                        </div>
                                                                                                        <div
                                                                                                            class="d-flex flex-wrap small text-muted mt-1">
                                                                                                            <span
                                                                                                                class="me-3">
                                                                                                                <span
                                                                                                                    class="badge bg-light text-dark fw-medium rounded-pill px-2">{{ $item->product_sku }}</span>
                                                                                                            </span>
                                                                                                            @if ($item->variant_size_name)
                                                                                                                <span
                                                                                                                    class="me-3 fw-medium">Size:
                                                                                                                    {{ $item->variant_size_name }}</span>
                                                                                                            @endif
                                                                                                            @if ($item->variant_color_name)
                                                                                                                <span
                                                                                                                    class="fw-medium">Màu:
                                                                                                                    {{ $item->variant_color_name }}</span>
                                                                                                            @endif
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td class="fw-bold text-dark">
                                                                                                {{ number_format($item->product_price_sale ?? $item->product_price, 0, ',', '.') }}
                                                                                                VND
                                                                                            </td>
                                                                                            <td class="fw-bold text-dark">
                                                                                                {{ $item->quantity }}</td>
                                                                                            <td
                                                                                                class="text-end fw-bold text-primary">
                                                                                                {{ number_format(($item->product_price_sale ?? $item->product_price) * $item->quantity, 0, ',', '.') }}
                                                                                                VND
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                                <tfoot class="table-light">
                                                                                    <tr>
                                                                                        <td colspan="3"
                                                                                            class="text-end fw-bold text-dark">
                                                                                            Tổng cộng:</td>
                                                                                        <td
                                                                                            class="text-end fw-bold text-primary fs-5">
                                                                                            {{ number_format($order->total_price, 0, ',', '.') }}
                                                                                            VND
                                                                                        </td>
                                                                                    </tr>
                                                                                </tfoot>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-12 text-end">
                                                                <button type="button"
                                                                    class="btn btn-light btn-sm px-3 py-2 shadow-sm rounded-pill"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#order-details-{{ $order->id }}">
                                                                    <i class="fa fa-chevron-up me-1"></i> Đóng
                                                                </button>
                                                                @if ($order->order_status === 'pending')
                                                                    <button type="button"
                                                                        class="btn btn-outline-danger btn-sm px-3 py-2 ms-2 shadow-sm rounded-pill cancel-order-btn"
                                                                        data-order-id="{{ $order->id }}"
                                                                        data-order-code="{{ $order->order_code }}"
                                                                        data-order-date="{{ $order->created_at->format('d/m/Y H:i') }}"
                                                                        data-order-total="{{ number_format($order->total_price, 0, ',', '.') }} VND"
                                                                        data-order-items="{{ json_encode(
                                                                            $order->orderItems->map(function ($item) {
                                                                                    return [
                                                                                        'name' => $item->product_name,
                                                                                        'quantity' => $item->quantity,
                                                                                        'price' => number_format($item->product_price_sale ?? $item->product_price, 0, ',', '.') . ' VND',
                                                                                        'total' =>
                                                                                            number_format(($item->product_price_sale ?? $item->product_price) * $item->quantity, 0, ',', '.') .
                                                                                            ' VND',
                                                                                        'color' => $item->variant_color_name ?? 'N/A',
                                                                                        'size' => $item->variant_size_name ?? 'N/A',
                                                                                    ];
                                                                                })->toArray(),
                                                                        ) }}"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#cancelOrderModal">
                                                                        <i class="fa fa-times me-1"></i> Hủy đơn hàng
                                                                    </button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="d-flex justify-content-center mt-4">
                                    {{ $orders->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal xác nhận hủy đơn -->
    <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content rounded-4 shadow-lg">
                <div class="modal-header border-0 bg-danger bg-opacity-10">
                    <h5 class="modal-title fw-bold text-danger" id="cancelOrderModalLabel">
                        <i class="fa fa-exclamation-triangle me-2"></i> Xác nhận hủy đơn hàng
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="text-muted mb-4">Vui lòng chọn lý do hủy đơn hàng. Hành động này không thể hoàn tác.</p>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm rounded-3 p-3 bg-light">
                                <h6 class="fw-bold text-dark mb-3"><i class="fa fa-info-circle me-2 text-primary"></i> Tóm
                                    tắt đơn hàng</h6>
                                <div class="mb-2">
                                    <strong class="text-muted">Mã đơn hàng:</strong>
                                    <span id="modal-order-code" class="fw-bold text-dark"></span>
                                </div>
                                <div class="mb-2">
                                    <strong class="text-muted">Ngày đặt:</strong>
                                    <span id="modal-order-date" class="fw-bold text-dark"></span>
                                </div>
                                <div>
                                    <strong class="text-muted">Tổng tiền:</strong>
                                    <span id="modal-order-total" class="fw-bold text-primary"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm rounded-3 p-3 bg-light">
                                <h6 class="fw-bold text-dark mb-3"><i class="fa fa-comment me-2 text-primary"></i> Lý do
                                    hủy đơn</h6>
                                <select class="form-select mb-3" id="cancel-reason" name="reason" required>
                                    <option value="" disabled selected>Chọn lý do hủy</option>
                                    @foreach ($cancellationReasons as $reason)
                                        <option value="{{ $reason->reason }}">{{ $reason->reason }}</option>
                                    @endforeach
                                    <option value="other">Khác (Vui lòng nhập lý do)</option>
                                </select>
                                <textarea class="form-control border-0 shadow-sm d-none" id="custom-reason" name="custom_reason" rows="4"
                                    placeholder="Vui lòng nhập lý do hủy đơn hàng..."></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card border-0 shadow-sm rounded-3 p-3">
                                <h6 class="fw-bold text-dark mb-3"><i class="fa fa-shopping-cart me-2 text-primary"></i>
                                    Sản phẩm trong đơn</h6>
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="fw-bold">Sản phẩm</th>
                                                <th class="fw-bold">Màu</th>
                                                <th class="fw-bold">Size</th>
                                                <th class="fw-bold">Số lượng</th>
                                                <th class="fw-bold">Giá</th>
                                                <th class="fw-bold text-end">Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody id="modal-order-items"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary px-4 py-2 rounded-pill"
                        data-bs-dismiss="modal">
                        <i class="fa fa-times me-1"></i> Hủy bỏ
                    </button>
                    <form id="cancelOrderForm" method="POST" action="">
                        @csrf
                        <button type="submit" class="btn btn-danger px-4 py-2 rounded-pill" id="confirmCancelBtn">
                            <i class="fa fa-check me-1"></i> Xác nhận hủy
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .list-group-item-action.active {
            background-color: rgba(var(--bs-primary-rgb), 0.1);
            border-left: 3px solid var(--bs-primary);
            color: var(--bs-primary);
            font-weight: 500;
        }

        .list-group-item-action:hover {
            background-color: rgba(var(--bs-primary-rgb), 0.05);
        }

        .order-item .card {
            transition: all 0.3s ease;
            border-radius: 12px;
        }

        .order-item .card:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1) !important;
            transform: translateY(-2px);
        }

        .order-icon {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .badge,
        .btn {
            font-weight: 500;
            letter-spacing: 0.3px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            box-shadow: 0 4px 10px rgba(var(--bs-primary-rgb), 0.3);
        }

        .btn-primary:hover {
            box-shadow: 0 6px 15px rgba(var(--bs-primary-rgb), 0.4);
            transform: translateY(-1px);
        }

        .table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .table thead th {
            border-top: none;
            border-bottom: 2px solid rgba(var(--bs-primary-rgb), 0.1);
            padding: 12px 16px;
            font-weight: 600;
            background-color: #f8f9fa;
        }

        .table tbody td {
            padding: 12px 16px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .modal-xl {
            max-width: 1000px;
        }

        .modal-content {
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .modal-header {
            padding: 1.5rem;
            border-radius: 0.5rem 0.5rem 0 0;
        }

        .modal-body .card {
            transition: all 0.3s ease;
        }

        .modal-body .card:hover {
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .form-control,
        .form-select {
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--bs-primary);
            box-shadow: 0 0 0 0.2rem rgba(var(--bs-primary-rgb), 0.25);
        }

        .btn-danger {
            box-shadow: 0 4px 10px rgba(var(--bs-danger-rgb), 0.3);
        }

        .btn-danger:hover {
            box-shadow: 0 6px 15px rgba(var(--bs-danger-rgb), 0.4);
            transform: translateY(-1px);
        }

        @media (max-width: 767.98px) {
            .modal-xl {
                max-width: 95%;
            }

            .modal-body .card {
                padding: 1rem;
            }

            .table thead th,
            .table tbody td {
                padding: 8px;
                font-size: 0.9rem;
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('orderSearch');
            const orderItems = document.querySelectorAll('.order-item');
            const noOrdersFound = document.getElementById('no-orders-found');
            const toggleButtons = document.querySelectorAll('.toggle-details');
            const cancelButtons = document.querySelectorAll('.cancel-order-btn');
            const cancelForm = document.getElementById('cancelOrderForm');
            const modalOrderCode = document.getElementById('modal-order-code');
            const modalOrderDate = document.getElementById('modal-order-date');
            const modalOrderTotal = document.getElementById('modal-order-total');
            const modalOrderItemsBody = document.getElementById('modal-order-items');
            const reasonSelect = document.getElementById('cancel-reason');
            const customReason = document.getElementById('custom-reason');

            // Tìm kiếm đơn hàng
            function searchOrders() {
                const searchTerm = searchInput.value.toLowerCase();
                let visibleCount = 0;
                orderItems.forEach(item => {
                    const orderCode = item.querySelector('.badge.bg-dark').textContent.toLowerCase();
                    const searchMatch = searchTerm === '' || orderCode.includes(searchTerm);
                    item.style.display = searchMatch ? '' : 'none';
                    if (searchMatch) visibleCount++;
                });
                noOrdersFound.classList.toggle('d-none', visibleCount > 0);
            }

            searchInput.addEventListener('input', searchOrders);

            // Thay đổi icon khi mở/đóng chi tiết
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    icon.classList.toggle('fa-chevron-down');
                    icon.classList.toggle('fa-chevron-up');
                });
            });

            // Xử lý hiển thị trường nhập lý do tùy chỉnh
            reasonSelect.addEventListener('change', function() {
                customReason.classList.toggle('d-none', this.value !== 'other');
                customReason.required = this.value === 'other';
            });

            // Xử lý nút hủy đơn hàng
            cancelButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = this.getAttribute('data-order-id');
                    const orderCode = this.getAttribute('data-order-code');
                    const orderDate = this.getAttribute('data-order-date');
                    const orderTotal = this.getAttribute('data-order-total');
                    const orderItems = JSON.parse(this.getAttribute('data-order-items'));

                    modalOrderCode.textContent = orderCode;
                    modalOrderDate.textContent = orderDate;
                    modalOrderTotal.textContent = orderTotal;

                    modalOrderItemsBody.innerHTML = '';
                    orderItems.forEach(item => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                        <td>${item.name}</td>
                        <td>${item.color}</td>
                        <td>${item.size}</td>
                        <td>${item.quantity}</td>
                        <td>${item.price}</td>
                        <td class="text-end">${item.total}</td>
                    `;
                        modalOrderItemsBody.appendChild(row);
                    });

                    reasonSelect.value = '';
                    customReason.value = '';
                    customReason.classList.add('d-none');
                    cancelForm.action = `/profile/orders/${orderId}/cancel`;
                });
            });

            // Xử lý submit form hủy đơn
            cancelForm.addEventListener('submit', function(e) {
                e.preventDefault();

                if (!reasonSelect.value || (reasonSelect.value === 'other' && !customReason.value.trim())) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Thiếu thông tin',
                        text: reasonSelect.value === 'other' ? 'Vui lòng nhập lý do tùy chỉnh!' :
                            'Vui lòng chọn lý do hủy đơn hàng!',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#3085d6'
                    });
                    return;
                }

                const formData = new FormData(this);
                formData.append('reason', reasonSelect.value);
                if (reasonSelect.value === 'other') {
                    formData.append('custom_reason', customReason.value);
                }

                fetch(this.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Thành công',
                                text: data.success,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#28a745'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi',
                                text: data.error,
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#d33'
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi hệ thống',
                            text: 'Có lỗi xảy ra khi hủy đơn hàng: ' + error.message,
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#d33'
                        });
                    });
            });

            // Hiệu ứng hover cho card
            orderItems.forEach(item => {
                const card = item.querySelector('.card');
                card.addEventListener('mouseenter', () => card.style.transform = 'translateY(-5px)');
                card.addEventListener('mouseleave', () => card.style.transform = 'translateY(0)');
            });
        });
    </script>
@endsection

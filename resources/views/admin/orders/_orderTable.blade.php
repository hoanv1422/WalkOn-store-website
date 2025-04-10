<div id="orderTableContainer">
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
                                <input class="form-check-input" type="checkbox" name="checkAll"
                                    value="{{ $order->id }}">
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
                        <td class="date">
                            {{ $order->created_at->locale('vi')->translatedFormat('d M, Y') }}
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
                            @elseif ($order->order_status == 'confirmed')
                                <span class="badge bg-primary-subtle text-primary">Đã xác nhận</span>
                            @elseif ($order->order_status == 'processing')
                                <span class="badge bg-info-subtle text-info">Đang xử lý</span>
                            @elseif ($order->order_status == 'ready')
                                <span class="badge bg-secondary-subtle text-secondary">Đã chuẩn bị xong</span>
                            @elseif ($order->order_status == 'shipped')
                                <span class="badge bg-secondary-subtle text-secondary">Đang giao</span>
                            @elseif ($order->order_status == 'delivered')
                                <span class="badge bg-success-subtle text-success">Đã giao</span>
                            @elseif ($order->order_status == 'cancelled')
                                <span class="badge bg-danger-subtle text-danger">Đã hủy</span>
                            @elseif ($order->order_status == 'returned')
                                <span class="badge bg-dark-subtle text-dark">Đã hoàn</span>
                            @elseif ($order->order_status == 'completed')
                                <span class="badge bg-success-subtle text-success">Hoàn tất</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary">{{ $order->order_status }}</span>
                            @endif
                        </td>

                        <td class="action">
                            <ul class="list-inline hstack gap-2 mb-0">
                                <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Xem">
                                    <a href="{{ route('orders.show', $order) }}" class="text-primary d-inline-block">
                                        <i class="ri-eye-fill fs-16"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item edit" data-bs-toggle="modal"
                                    data-bs-target="#updateOrderModal" data-id="{{ $order->id }}"
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
    </div>

    <div class="d-flex justify-content-end">
        <div class="pagination-wrap hstack gap-2">
            {{-- {!! $orders->links() !!} --}}
        </div>
    </div>
</div>

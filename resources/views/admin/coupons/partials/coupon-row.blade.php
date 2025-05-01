<tr>
    <th scope="row">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="checkAll" value="option1">
        </div>
    </th>
    <!-- Coupon Code -->
    <td class="code">
        <span class="badge bg-primary-subtle text-primary fs-5 fw-bold px-3 py-2 text-uppercase">
            <i class="fas fa-ticket-alt me-1"></i> {{ $item->code }}
        </span>
    </td>
    <!-- Start Time -->
    <td class="startTime">
        <span class="d-block">{{ \Carbon\Carbon::parse($item->start_time)->format('d/m/Y') }}</span>
        <small class="text-muted">{{ \Carbon\Carbon::parse($item->start_time)->format('H:i A') }}</small>
    </td>
    <!-- End Time -->
    <td class="endTime">
        <span class="d-block">{{ \Carbon\Carbon::parse($item->end_time)->format('d/m/Y') }}</span>
        <small class="text-muted">{{ \Carbon\Carbon::parse($item->end_time)->format('H:i A') }}</small>
    </td>
    <!-- Discount Type -->
    <td class="discount-type">
        @php
            $discountTypes = [
                'percentage' => ['text' => 'Giảm %', 'class' => 'bg-primary-subtle text-primary'],
                'fixed' => ['text' => 'Giảm Tiền', 'class' => 'bg-success-subtle text-success'],
                'freeship' => ['text' => 'FreeShip', 'class' => 'bg-warning-subtle text-warning'],
            ];
            $type = $discountTypes[$item->discount_type] ?? ['text' => 'N/A', 'class' => 'bg-secondary-subtle text-secondary'];
        @endphp
        <span class="badge {{ $type['class'] }} fs-5 px-3 py-2">{{ $type['text'] }}</span>
    </td>
    <!-- Discount Value -->
    <td class="discount-value text-center">
        @if ($item->discount_type === 'percentage')
            <span class="badge bg-success-subtle text-success fs-5 px-3 py-2">
                <i class="fas fa-percent me-1"></i> {{ number_format($item->discount_value, 0) }}%
            </span>
        @elseif ($item->discount_type === 'fixed')
            <span class="badge bg-danger-subtle text-danger fs-5 px-3 py-2">
                <i class="fas fa-money-bill-wave me-1"></i> {{ number_format($item->discount_value, 0, ',', '.') }} VNĐ
            </span>
        @else
            <span class="badge bg-warning-subtle text-warning fs-5 px-3 py-2">
                <i class="fas fa-truck me-1"></i> Free
            </span>
        @endif
    </td>
    <!-- Status -->
    <td class="status text-center">
        @php
            $status = 'Đang Áp Dụng';
            $badgeClass = 'bg-success-subtle text-success';
            if ($item->end_time && \Carbon\Carbon::parse($item->end_time)->isPast()) {
                $status = 'Hết Hạn';
                $badgeClass = 'bg-secondary-subtle text-secondary';
            } elseif (!$item->is_active) {
                $status = 'Không Áp Dụng';
                $badgeClass = 'bg-danger-subtle text-danger';
            }
        @endphp
        <span class="badge {{ $badgeClass }} fs-5 px-3 py-2 text-uppercase">{{ $status }}</span>
    </td>
    <!-- Actions -->
    <td class="text-center">
        <ul class="list-inline hstack gap-2 mb-0">
            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Xem Chi Tiết">
                <a href="{{ route('coupons.show', $item) }}" class="text-primary d-inline-block">
                    <i class="ri-eye-fill fs-18"></i>
                </a>
            </li>
            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Chỉnh Sửa">
                <a href="{{ route('coupons.edit', $item) }}" class="text-success d-inline-block">
                    <i class="ri-pencil-fill fs-18"></i>
                </a>
            </li>
            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa">
                <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteOrder"
                    data-id="{{ $item->id }}" data-action="{{ route('coupons.destroy', $item) }}">
                    <i class="ri-delete-bin-5-fill fs-18"></i>
                </a>
            </li>
        </ul>
    </td>
</tr>
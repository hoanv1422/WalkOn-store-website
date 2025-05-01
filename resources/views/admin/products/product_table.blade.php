<div class="table-card gridjs-border-none table-responsive">
    <table class="dataTable">
        <thead class="gridjs-thead">
            <tr class="gridjs-tr">
                <th data-column-id="#" class="gridjs-th gridjs-th-sort text-muted" tabindex="0" style="width: 15px;">
                    <div class="gridjs-th-content">#</div>
                </th>
                <th data-column-id="product" class="gridjs-th gridjs-th-sort text-muted" tabindex="0" style="width: 360px;">
                    <div class="gridjs-th-content">Sản phẩm</div>
                </th>
                <th data-column-id="stock" class="gridjs-th gridjs-th-sort text-muted" tabindex="0" style="width: 94px;">
                    <div class="gridjs-th-content">Số lượng</div>
                </th>
                <th data-column-id="price" class="gridjs-th gridjs-th-sort text-muted" tabindex="0" style="width: 101px;">
                    <div class="gridjs-th-content">Giá</div>
                </th>
                <th data-column-id="orders" class="gridjs-th gridjs-th-sort text-muted" tabindex="0" style="width: 84px;">
                    <div class="gridjs-th-content">Đã bán</div>
                </th>
                <th data-column-id="rating" class="gridjs-th gridjs-th-sort text-muted" tabindex="0" style="width: 105px;">
                    <div class="gridjs-th-content">Đánh giá</div>
                </th>
                <th data-column-id="brand" class="gridjs-th gridjs-th-sort text-muted" tabindex="0">
                    <div class="gridjs-th-content">Thương hiệu</div>
                </th>
                {{-- <th data-column-id="discount" class="gridjs-th gridjs-th-sort text-muted" tabindex="0">
                    <div class="gridjs-th-content">Giảm giá</div>
                </th> --}}
                <th data-column-id="published" class="gridjs-th gridjs-th-sort text-muted" tabindex="0" style="width: 220px;">
                    <div class="gridjs-th-content">Ngày bán</div>
                </th>
                <th data-column-id="action" class="gridjs-th gridjs-th-sort text-muted" tabindex="0" style="width: 80px;">
                    <div class="gridjs-th-content">Hành động</div>
                </th>
            </tr>
        </thead>
        <tbody class="gridjs-tbody">
            @forelse ($products as $item)
                <tr class="gridjs-tr">
                    <td class="gridjs-td">
                        <div class="form-check checkbox-product-list">
                            <input class="form-check-input" type="checkbox" value="{{ $item->id }}" id="checkbox-{{ $item->id }}">
                            <label class="form-check-label" for="checkbox-{{ $item->id }}"></label>
                        </div>
                    </td>
                    <td class="gridjs-td">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-sm bg-light rounded p-1 overflow-hidden">
                                    <img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}"
                                        class="img-fluid d-block object-fit-cover" style="height: 80px; width: 80px;">
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="fs-14 mb-1">
                                    <a href="{{ route('products.show', $item) }}" class="text-body">{{ $item->name }}</a>
                                </h5>
                                <p class="text-muted mb-0">
                                    Danh Mục: <span class="fw-medium">{{ $item->category->name }}</span>
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="gridjs-td">{{ number_format($item->quantity) }}</td>
                    <td class="gridjs-td">
                        <span>{{ number_format($item->price, 0, ',', '.') }} VNĐ</span>
                    </td>
                    <td class="gridjs-td">{{ number_format($item->sold_quantity) }}</td>
                    <td class="gridjs-td">
                        <span class="badge bg-light text-body fs-12 fw-medium">
                            <i class="mdi mdi-star text-warning me-1"></i>
                            {{ number_format($item->average_rating, 1) }}
                        </span>
                    </td>
                    <td class="gridjs-td">
                        @if ($item->brand)
                            {{ $item->brand->name }}
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                    {{-- <td class="gridjs-td">
                        @php
                            if ($item->price && $item->price_sale && $item->price > $item->price_sale) {
                                $discountPercent = round((($item->price - $item->price_sale) / $item->price) * 100);
                            } else {
                                $discountPercent = 0;
                            }
                        @endphp
                        <span>{{ $discountPercent }}%</span>
                    </td> --}}
                    <td class="gridjs-td">
                        <span>{{ $item->created_at->format('d/m/Y') }}
                            <small class="text-muted ms-1">{{ $item->created_at->format('h:i A') }}</small>
                        </span>
                    </td>
                    <td class="gridjs-td">
                        <div class="dropdown">
                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-fill"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('products.show', $item) }}">
                                        <i class="ri-eye-fill align-bottom me-2 text-muted"></i> Xem
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('products.edit', $item) }}">
                                        <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Sửa
                                    </a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item remove-list" href="#" data-id="{{ $item->id }}"
                                        data-bs-toggle="modal" data-bs-target="#removeItemModal"
                                        data-action="{{ route('products.destroy', $item) }}">
                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Xóa
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @empty
                {{-- <tr class="gridjs-tr">
                    <td class="gridjs-td" colspan="10">
                        <div class="text-center py-4">
                            <i class="ri-error-warning-line fs-1 text-muted"></i>
                            <h5 class="mt-2">Không tìm thấy sản phẩm nào</h5>
                        </div>
                    </td>
                </tr> --}}
            @endforelse
        </tbody>
    </table>
</div>

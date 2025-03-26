@extends('admin.layouts.app')
@section('title', 'Quản lý kho hàng')
@section('style')
    <!-- nouisliderribute css -->
    <link rel="stylesheet" href="{{ asset('templates/admin/assets/libs/nouislider/nouislider.min.css') }}">
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Kho hàng</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Thương Mại Điện Tử</a></li>
                                <li class="breadcrumb-item active">Kho hàng</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex mb-3">
                                <div class="flex-grow-1">
                                    <h5 class="fs-16">Bộ lọc kho hàng </h5>
                                </div>
                                <div class="flex-shrink-0">
                                    @if (request()->hasAny(['search', 'min_price', 'max_price', 'category']))
                                        <a href="{{ route('inventory.index') }}" class="btn btn-danger" id="clearall">
                                            <i class="bi bi-x-circle"></i> Xóa tất cả
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="accordion accordion-flush filter-accordion">
                            <div class="card-body border-bottom">
                                <div>
                                    <p class="text-muted text-uppercase fs-12 fw-medium mb-2">Sản Phẩm</p>
                                    <form action="{{ route('inventory.index') }}" method="GET">
                                        <input type="hidden" name="min_price" value="{{ request()->min_price }}">
                                        <input type="hidden" name="max_price" value="{{ request()->max_price }}">
                                        <input type="hidden" name="category" value="{{ request()->category }}">
                                        <input type="text" name="search" class="form-control"
                                            placeholder="Tìm kiếm sản phẩm..." value="{{ request()->search }}">
                                        <button type="submit" class="btn btn-primary mt-2">Tìm kiếm</button>
                                        @if (request()->has('search') && request()->search != '')
                                            <a href="{{ route('inventory.index', request()->except('search')) }}"
                                                class="btn btn-danger mt-2">
                                                <i class="bi bi-x-circle"></i> Xóa
                                            </a>
                                        @endif
                                    </form>
                                </div>
                            </div>

                            <div class="card-body border-bottom">
                                <p class="text-muted text-uppercase fs-12 fw-medium mb-4">Giá</p>
                                <form action="{{ route('inventory.index') }}" method="GET">
                                    <input type="hidden" name="search" value="{{ request()->search }}">
                                    <input type="hidden" name="category" value="{{ request()->category }}">
                                    <div class="d-flex align-items-center">
                                        <div class="position-relative w-50">
                                            <input class="form-control form-control-sm text-end pe-4 border rounded"
                                                type="number" name="min_price" id="minCost"
                                                value="{{ request()->min_price ?? '' }}" placeholder="Giá thấp nhất"
                                                min="0">
                                            <span
                                                class="position-absolute top-50 translate-middle-y end-0 me-2 text-muted">đ</span>
                                        </div>
                                        <span class="mx-2 text-muted fw-bold">~</span>
                                        <div class="position-relative w-50">
                                            <input class="form-control form-control-sm text-end pe-4 border rounded"
                                                type="number" name="max_price" id="maxCost"
                                                value="{{ request()->max_price ?? '' }}" placeholder="Giá cao nhất"
                                                min="0">
                                            <span
                                                class="position-absolute top-50 translate-middle-y end-0 me-2 text-muted">đ</span>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2 mt-3">
                                        <button type="submit" class="btn btn-primary px-3">Lọc</button>
                                        @if (
                                            (request()->has('min_price') && request()->min_price != '') ||
                                                (request()->has('max_price') && request()->max_price != ''))
                                            <a href="{{ route('inventory.index', request()->except(['min_price', 'max_price'])) }}"
                                                class="btn btn-danger px-3">
                                                <i class="bi bi-x-circle"></i> Xóa
                                            </a>
                                        @endif
                                    </div>
                                </form>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingCategories">
                                    <button class="accordion-button bg-transparent shadow-none" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseCategories"
                                        aria-expanded="true" aria-controls="flush-collapseCategories">
                                        <span class="text-muted text-uppercase fs-12 fw-medium">Danh mục</span>
                                    </button>
                                </h2>
                                <div id="flush-collapseCategories" class="accordion-collapse collapse show"
                                    aria-labelledby="flush-headingCategories">
                                    <div class="accordion-body text pt-0">
                                        <div class="d-flex flex-column gap-2 mt-3 filter-check">
                                            <form action="{{ route('inventory.index') }}" method="GET">
                                                <input type="hidden" name="search" value="{{ request()->search }}">
                                                <input type="hidden" name="min_price"
                                                    value="{{ request()->min_price }}">
                                                <input type="hidden" name="max_price"
                                                    value="{{ request()->max_price }}">
                                                @foreach ($categories as $category)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="category"
                                                            value="{{ $category->id }}" id="category{{ $category->id }}"
                                                            {{ request()->category == $category->id ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="category{{ $category->id }}">{{ $category->name }}</label>
                                                    </div>
                                                @endforeach
                                                <button type="submit" class="btn btn-primary mt-2">Lọc</button>
                                                @if (!empty(request()->category))
                                                    <a href="{{ route('inventory.index', request()->except('category')) }}"
                                                        class="btn btn-danger mt-2">
                                                        <i class="bi bi-x-circle"></i> Xóa
                                                    </a>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-9 col-lg-8">
                    <div>
                        <div class="card">
                            <div class="card-header border-0">
                            </div>
                            <div class="card-body">
                                <div class="tab-content text-muted">
                                    <div class="tab-pane active" id="productnav-all" role="tabpanel">
                                        <div id="table-product-list-all"
                                            class="table-card gridjs-border-none table-responsive" width="100%">
                                            <table id="products-all" class="dataTable">
                                                <thead class="gridjs-thead">
                                                    <tr class="gridjs-tr">
                                                        <th data-column-id="#" class="gridjs-th gridjs-th-sort text-muted"
                                                            tabindex="0" style="width: 15px;">
                                                            <div class="gridjs-th-content">#</div>
                                                        </th>
                                                        <th data-column-id="product"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 360px;">
                                                            <div class="gridjs-th-content">Sản phẩm</div>
                                                        </th>
                                                        <th data-column-id="color"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 100px;">
                                                            <div class="gridjs-th-content">Màu sắc</div>
                                                        </th>
                                                        <th data-column-id="size"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 100px;">
                                                            <div class="gridjs-th-content">Kích cỡ</div>
                                                        </th>
                                                        <th data-column-id="stock"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 94px;">
                                                            <div class="gridjs-th-content">Số lượng</div>
                                                        </th>
                                                        <th data-column-id="price"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 101px;">
                                                            <div class="gridjs-th-content">Giá</div>
                                                        </th>
                                                        <th data-column-id="date_added"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 150px;">
                                                            <div class="gridjs-th-content">Ngày thêm</div>
                                                        </th>
                                                        <th data-column-id="action"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 80px;">
                                                            <div class="gridjs-th-content">Hành động</div>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="gridjs-tbody">
                                                    @foreach ($products as $product)
                                                        @foreach ($product->variants as $variant)
                                                            <tr class="gridjs-tr">
                                                                <td class="gridjs-td"><span>
                                                                        <div class="form-check checkbox-product-list">
                                                                            <input class="form-check-input"
                                                                                type="checkbox" value="1"
                                                                                id="checkbox-{{ $variant->id }}">
                                                                            <label class="form-check-label"
                                                                                for="checkbox-{{ $variant->id }}"></label>
                                                                        </div>
                                                                    </span></td>
                                                                <td class="gridjs-td"><span>
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="flex-shrink-0 me-3">
                                                                                <div
                                                                                    class="avatar-sm bg-light rounded p-1 overflow-hidden">
                                                                                    <img src="{{ Storage::url($product->image) }}"
                                                                                        alt=""
                                                                                        class="img-fluid d-block object-fit-cover">
                                                                                </div>
                                                                            </div>
                                                                            <div class="flex-grow-1">
                                                                                <h5 class="fs-14 mb-1"><a
                                                                                        href="apps-ecommerce-product-details.html"
                                                                                        class="text-body">{{ $product->name }}</a>
                                                                                </h5>
                                                                                <p class="text-muted mb-0">Danh Mục : <span
                                                                                        class="fw-medium">{{ $product->category->name }}</span>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </span></td>
                                                                <td class="gridjs-td">{{ $variant->color->color }}</td>
                                                                <td class="gridjs-td">{{ $variant->size->size }}</td>
                                                                <td class="gridjs-td">{{ $variant->quantity }}</td>
                                                                <td class="gridjs-td">
                                                                    <span>{{ number_format($variant->price, 0, ',', '.') }}
                                                                        VNĐ</span>
                                                                </td>
                                                                <td class="gridjs-td">
                                                                    <span>{{ $product->created_at->format('d/m/Y') }}</span>
                                                                </td>
                                                                <td class="gridjs-td"><span>
                                                                        <div class="dropdown">
                                                                            <button
                                                                                class="btn btn-soft-secondary btn-sm dropdown"
                                                                                type="button" data-bs-toggle="dropdown"
                                                                                aria-expanded="false">
                                                                                <i class="ri-more-fill"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li><a class="dropdown-item"
                                                                                        href="{{ route('inventory.show', $variant->id) }}"><i
                                                                                            class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                                                        Xem</a></li>
                                                                                <!-- Nút cập nhật số lượng -->
                                                                                <li><a class="dropdown-item update-list"
                                                                                        href="#"
                                                                                        data-id="{{ $variant->id }}"
                                                                                        data-quantity="{{ $variant->quantity }}"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#updateQuantityModal"><i
                                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                                        Cập nhật số lượng</a></li>
                                                                                <li class="dropdown-divider"></li>
                                                                                <li><a class="dropdown-item remove-list"
                                                                                        href="#"
                                                                                        data-id="{{ $variant->id }}"
                                                                                        data-bs-toggle="modal"
                                                                                        data-action="{{ route('inventory.destroy', $variant->id) }}"
                                                                                        data-bs-target="#removeItemModal"><i
                                                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                                        Xóa</a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </span></td>
                                                            </tr>
                                                        @endforeach
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- removeItemModal -->
    <div id="removeItemModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Bạn có chắc không ?</h4>
                            <p class="text-muted mx-4 mb-0">Bạn có chắc muốn xóa biến thể sản phẩm này không?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Đóng</button>
                        <form id="deleteForm" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn w-sm btn-danger" id="delete-product">Xóa!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- updateQuantityModal -->
    <!-- Lưu ý: Modal này dùng để cập nhật số lượng biến thể -->
    <div id="updateQuantityModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cập nhật số lượng biến thể</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Số lượng mới</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" min="0"
                                required>
                        </div>
                        <div class="d-flex gap-2 justify-content-center">
                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn w-sm btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- nouisliderribute js -->
    <script src="{{ asset('templates/admin/assets/libs/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('templates/admin/assets/libs/wnumb/wNumb.min.js') }}"></script>

    <script>
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

        // Xử lý sự kiện xóa biến thể
        $(document).on('click', '.dropdown-item.remove-list', function() {
            var actionUrl = $(this).data('action');
            $('#deleteForm').attr('action', actionUrl);
        });

        // Xử lý sự kiện cập nhật số lượng
        // Lưu ý: Đảm bảo ID và quantity được truyền chính xác từ data attributes
        $(document).on('click', '.dropdown-item.update-list', function() {
            var actionUrl = '{{ route('inventory.update', ':id') }}'.replace(':id', $(this).data('id'));
            var currentQuantity = $(this).data('quantity');

            // Cập nhật action của form
            $('#updateForm').attr('action', actionUrl);

            // Điền số lượng hiện tại vào input
            $('#quantity').val(currentQuantity);
        });
    </script>
@endsection

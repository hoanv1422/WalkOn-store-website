@extends('admin.layouts.app')
@section('title', 'Sản Phẩm')
@section('style')
    <!-- nouisliderribute css -->
    <link rel="stylesheet" href="{{ asset('templates/admin/assets/libs/nouislider/nouislider.min.css') }}">
    <!-- gridjs css (nếu cần) -->
@endsection

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Sản Phẩm</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Thương Mại Điện Tử</a></li>
                                <li class="breadcrumb-item active">Sản Phẩm</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <!-- Filter Sidebar -->
                <div class="col-xl-3 col-lg-4">
                    @include('admin.products.filter_sidebar')
                </div>

                <!-- Main Content: Bảng sản phẩm và tìm kiếm sản phẩm -->
                <div class="col-xl-9 col-lg-8">
                    <div>
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="row g-4">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a href="{{ route('products.create') }}" class="btn btn-success"
                                                id="addproduct-btn">
                                                <i class="ri-add-line align-bottom me-1"></i> Thêm Sản Phẩm
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        {{-- <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text" class="form-control"  id="searchProductList"
                                                    placeholder="Search Products...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active fw-semibold" data-bs-toggle="tab"
                                                    href="#productnav-all" role="tab" id="productnav-all-tab">
                                                    Tất Cả <span
                                                        class="badge bg-danger-subtle text-danger align-middle rounded-pill ms-1">{{ $allProducts->count() }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold" data-bs-toggle="tab"
                                                    href="#productnav-published" role="tab"
                                                    id="productnav-published-tab">
                                                    Đang Bán <span
                                                        class="badge bg-danger-subtle text-danger align-middle rounded-pill ms-1">{{ $products_active->count() }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold" data-bs-toggle="tab"
                                                    href="#productnav-draft" role="tab" id="productnav-draft-tab">
                                                    Ẩn <span
                                                        class="badge bg-danger-subtle text-danger align-middle rounded-pill ms-1">{{ $products_non_active->count() }}</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-auto">
                                        <div id="selection-element">
                                            <div class="my-n1 d-flex align-items-center text-muted">
                                                Select <div id="select-content" class="text-body fw-semibold px-1"></div>
                                                Result <button type="button"
                                                    class="btn btn-link link-danger p-0 ms-3 material-shadow-none"
                                                    data-bs-toggle="modal" data-bs-target="#removeItemModal">Xóa</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card header -->
                            <div class="card-body">
                                <div class="tab-content text-muted">
                                    <!-- Tab All Products -->
                                    <div class="tab-pane active" id="productnav-all" role="tabpanel">
                                        @include('admin.products.product_table', [
                                            'products' => $allProducts,
                                        ])
                                    </div>
                                    <!-- Tab Published -->
                                    <div class="tab-pane" id="productnav-published" role="tabpanel">
                                        @include('admin.products.product_table', [
                                            'products' => $products_active,
                                        ])
                                    </div>
                                    <!-- Tab Draft -->
                                    <div class="tab-pane" id="productnav-draft" role="tabpanel">
                                        @include('admin.products.product_table', [
                                            'products' => $products_non_active,
                                        ])
                                    </div>
                                </div>
                            </div>
                            <!-- end tab content -->
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
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
                            <p class="text-muted mx-4 mb-0">Bạn có chắc muốn xóa sản phẩm này không?</p>
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
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

@endsection
<meta name="csrf-token" content="{{ csrf_token() }}">
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
            initDataTables();
        });

        document.addEventListener('DOMContentLoaded', function() {
            // ============== INIT PRICE SLIDER ==============
            const priceSlider = document.getElementById('product-price-range');
            const minCostInput = document.getElementById('minCost');
            const maxCostInput = document.getElementById('maxCost');

            noUiSlider.create(priceSlider, {
                start: [0, 100000000],
                connect: true,
                range: {
                    'min': 0,
                    'max': 100000000
                },
                tooltips: [
                    wNumb({
                        decimals: 0,
                        thousand: ',',
                        suffix: ' VNĐ'
                    }),
                    wNumb({
                        decimals: 0,
                        thousand: ',',
                        suffix: ' VNĐ'
                    })
                ],
                format: wNumb({
                    decimals: 0,
                    thousand: ',',
                    suffix: ' VNĐ'
                })
            });

            // Khi slider thay đổi, cập nhật input min/max
            priceSlider.noUiSlider.on('update', function(values, handle) {
                const [min, max] = values.map(val =>
                    Math.round(parseFloat(val.replace(/[^0-9.-]+/g, "")))
                );
                minCostInput.value = min.toLocaleString('vi-VN');
                maxCostInput.value = max.toLocaleString('vi-VN');
            });
            [minCostInput, maxCostInput].forEach(input => {
                input.addEventListener('change', function() {
                    let value = parseFloat(this.value.replace(/[^0-9]/g, '')) || 0;
                    value = Math.max(0, Math.min(value, 100000000));
                    let cleanValue = parseFloat(this.value.replace(/[^0-9]/g, '')) || 0;
                    cleanValue = Math.max(0, Math.min(cleanValue, 100000000));
                    this.value = cleanValue.toLocaleString('vi-VN');
                    priceSlider.noUiSlider.set([
                        this === minCostInput ? cleanValue : null,
                        this === maxCostInput ? cleanValue : null
                    ]);
                });
            });

            [minCostInput, maxCostInput].forEach(input => {
                input.addEventListener('input', function(e) {
                    // Chỉ cho phép nhập số và tự động thêm dấu phân cách
                    let value = e.target.value.replace(/[^0-9]/g, '');
                    value = value ? parseInt(value).toLocaleString('vi-VN') : '';
                    e.target.value = value;
                });
            });
            // ============== FILTER EVENT HANDLERS ==============
            //  nghe sự kiện thay đổi cho các phần tử filter (checkbox, search, ...)
            document.querySelectorAll(
                '.category-filter, [name="brands[]"], [name^="productdiscountRadio"], [name="ratings[]"]'
            ).forEach(element => {
                element.addEventListener('change', applyFilters);
            });
            document.getElementById('searchProductList').addEventListener('input', applyFilters);
            document.getElementById('searchBrandsList').addEventListener('input', applyFilters);

            // Xử lý nút xóa filter
            document.getElementById('clearall').addEventListener('click', function(e) {
                e.preventDefault();
                resetFilters();
            });

            // Debounce để tránh gọi API liên tục
            let filterTimeout;
            const DEBOUNCE_DELAY = 500;

            async function applyFilters() {
                clearTimeout(filterTimeout);

                // Hiển thị loading cho các tab
                const loadingHtml = `
                    <div class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                `;
                document.querySelectorAll('.tab-pane').forEach(pane => {
                    pane.innerHTML = loadingHtml;
                });

                filterTimeout = setTimeout(async () => {
                    try {
                        const filters = {
                            categories: Array.from(document.querySelectorAll(
                                '.category-filter:checked')).map(cb => cb.value),
                            minPrice: parseFloat(minCostInput.value.replace(/\./g, '')) || 0,
                            maxPrice: parseFloat(maxCostInput.value.replace(/\./g, '')) ||
                                100000000,
                            brands: Array.from(document.querySelectorAll(
                                '[name="brands[]"]:checked')).map(cb => cb.value),
                            discounts: Array.from(document.querySelectorAll(
                                '[name^="productdiscountRadio"]:checked')).map(cb => cb
                                .value),
                            ratings: Array.from(document.querySelectorAll(
                                '[name="ratings[]"]:checked')).map(cb => cb.value),
                            search: document.getElementById('searchProductList').value,
                            searchBrands: document.getElementById('searchBrandsList').value
                        };

                        const response = await fetch('{{ route('products.filter') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify(filters)
                        });

                        if (!response.ok) throw new Error('HTTP error: ' + response.status);

                        const {
                            html,
                            counts
                        } = await response.json();

                        // Cập nhật nội dung cho các tab
                        const tempDiv = document.createElement('div');
                        tempDiv.innerHTML = html;

                        ['productnav-all', 'productnav-published', 'productnav-draft'].forEach(
                            id => {
                                const source = tempDiv.querySelector(`#${id}`);
                                const target = document.getElementById(id);
                                if (source && target) {
                                    // Hủy DataTables của bảng cũ (nếu có)
                                    const table = target.querySelector('table.dataTable');
                                    if (table && $.fn.DataTable.isDataTable(table)) {
                                        $(table).DataTable().destroy(true);
                                    }
                                    target.innerHTML = source.innerHTML;
                                }
                            });

                        // Cập nhật số lượng sản phẩm trên tab
                        document.querySelector('#productnav-all-tab .badge').textContent = counts
                            .all;
                        document.querySelector('#productnav-published-tab .badge').textContent =
                            counts.active;
                        document.querySelector('#productnav-draft-tab .badge').textContent = counts
                            .nonActive;

                        // Khởi tạo lại DataTables sau khi cập nhật nội dung
                        initDataTables();

                    } catch (error) {
                        console.error('Filter error:', error);
                        alert('Lỗi khi tải dữ liệu: ' + error.message);
                    }
                }, DEBOUNCE_DELAY);
            }

            function resetFilters() {
                // Reset tất cả checkbox
                document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
                // Reset các ô tìm kiếm
                document.getElementById('searchProductList').value = '';
                document.getElementById('searchBrandsList').value = '';
                priceSlider.noUiSlider.set([0, 100000000]);
                minCostInput.value = (0).toLocaleString('vi-VN');
                maxCostInput.value = (100000000).toLocaleString('vi-VN');

                // Áp dụng filter ngay lập tức
                applyFilters();
            }
        });

        // Hàm khởi tạo DataTables
        function initDataTables() {
            $('table.dataTable').each(function() {
                // Nếu bảng đã được khởi tạo, hủy hoàn toàn DataTables trước
                if ($.fn.DataTable.isDataTable(this)) {
                    $(this).DataTable().destroy(true);
                }
                // Sau đó khởi tạo lại DataTables
                $(this).DataTable({
                    "paging": true,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "pageLength": 10,
                    "lengthChange": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Vietnamese.json"
                    }
                });
            });
        }

        // Xử lý xóa sản phẩm
        $(document).on('click', '.dropdown-item.remove-list', function() {
            var actionUrl = $(this).data('action');
            $('#deleteForm').attr('action', actionUrl);
        });
    </script>
@endsection

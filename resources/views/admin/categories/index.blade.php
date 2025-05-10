@extends('admin.layouts.app')
@section('title', 'Danh Mục')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="customerList">
                        <div class="card-header border-bottom-dashed">
                            <div class="row g-4 align-items-center">
                                <div class="col-sm">
                                    <div>
                                        <h5 class="card-title mb-0">Danh Sách Danh Mục</h5>
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex flex-wrap align-items-start gap-2">
                                        <button class="btn btn-soft-danger" id="remove-actions"
                                            onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                            id="create-btn" data-bs-target="#showModalCreate"><i
                                                class="ri-add-line align-bottom me-1"></i> Thêm Danh Mục</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-bottom-dashed border-bottom">
                            <form id="filterForm" method="GET" action="{{ route('categories.index') }}">
                                <div class="row g-3">
                                    <div class="col-xl-6">
                                        <div class="search-box">
                                            <input type="text" class="form-control" id="searchInput" name="search"
                                                placeholder="Tìm kiếm theo tên danh mục..." value="{{ request('search') }}">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xl-6">
                                        <div class="row g-3">
                                            <div class="col-sm-4">
                                                <div>
                                                    <select class="form-control" data-plugin="choices" data-choices
                                                        data-choices-search-false name="status" id="idStatus">
                                                        <option value="all" {{ request('status', 'all') === 'all' ? 'selected' : '' }}>Tất cả</option>
                                                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Hoạt Động</option>
                                                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Ẩn</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-sm-4">
                                                <div>
                                                    <button type="submit" class="btn btn-primary w-100">
                                                        <i class="ri-equalizer-fill me-2 align-bottom"></i>Tìm kiếm
                                                    </button>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                    </div>
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="table-responsive table-card mb-1">
                                    <table id="categoryTable" class="table align-middle dataTable">
                                        <thead class="table-light text-muted">
                                            <tr>
                                                <th scope="col" style="width: 15px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                                    </div>
                                                </th>
                                                <th class="sort" data-sort="name">Tên Danh Mục</th>
                                                <th class="sort" data-sort="status">Trạng Thái</th>
                                                <th class="sort" data-sort="action">Hành Động</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all" id="categoryTableBody">
                                            @forelse ($categories as $item)
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="chk_child">
                                                        </div>
                                                    </th>
                                                    <td class="name">{{ $item->name }}</td>
                                                    <td class="status">
                                                        <span
                                                            class="badge {{ $item->is_active ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                                                            {{ $item->is_active ? 'Hoạt Động' : 'Ẩn' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <ul class="list-inline hstack gap-2 mb-0">
                                                            <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                                data-bs-trigger="hover" data-bs-placement="top"
                                                                title="Edit">
                                                                <a href="#showModalEdit" data-bs-toggle="modal"
                                                                    class="text-primary d-inline-block edit-item-btn"
                                                                    data-id="{{ $item->id }}"
                                                                    data-name="{{ $item->name }}"
                                                                    data-status="{{ $item->is_active }}">
                                                                    <i class="ri-pencil-fill fs-16"></i>
                                                                </a>
                                                            </li>
                                                            <li class="list-inline-item" data-bs-toggle="tooltip"
                                                                data-bs-trigger="hover" data-bs-placement="top"
                                                                title="Remove">
                                                                <a class="text-danger d-inline-block remove-item-btn"
                                                                    data-bs-toggle="modal" data-id="{{ $item->id }}"
                                                                    href="#deleteRecordModal">
                                                                    <i class="ri-delete-bin-5-fill fs-16"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">Không có danh mục nào.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div id="pagination">
                                    {{ $categories->links() }}
                                </div>
                            </div>

                            <div class="modal fade" id="showModalCreate" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h4>Thêm Mới</h4>
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form action="{{ route('categories.store') }}" method="POST"
                                            class="tablelist-form" autocomplete="off">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <input type="hidden" name="id" id="id-field" />
                                                    <label for="name-field" class="form-label">Tên Danh Mục</label>
                                                    <input type="text" id="name-field" class="form-control"
                                                        placeholder="Nhập tên" name="name" />
                                                    <div class="invalid-feedback">Vui lòng nhập tên danh mục.</div>
                                                </div>
                                                <div>
                                                    <label for="status-field" class="form-label">Trạng Thái</label>
                                                    <select class="form-control" data-choices data-choices-search-false
                                                        name="is_active" id="status-field" required>
                                                        <option value="1">Hoạt Động</option>
                                                        <option value="0">Ẩn</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-success"
                                                        id="add-btn">Thêm</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="showModalEdit" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h4>Sửa</h4>
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form action="" method="POST" class="tablelist-form edit"
                                            autocomplete="off">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-body">
                                                <input type="hidden" name="id" id="id-field-edit" />
                                                <div class="mb-3" id="modal-id" style="display: none;">
                                                    <label for="id-field1" class="form-label">ID</label>
                                                    <input type="text" id="id-field1" class="form-control"
                                                        placeholder="ID" readonly />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="name-field-edit" class="form-label">Tên Danh Mục</label>
                                                    <input type="text" id="name-field-edit" class="form-control"
                                                        placeholder="Nhập tên" name="name" />
                                                    <div class="invalid-feedback">Vui lòng nhập tên danh mục.</div>
                                                </div>
                                                <div>
                                                    <label for="status-field-edit" class="form-label">Trạng Thái</label>
                                                    <select class="form-control" data-choices data-choices-search-false
                                                        name="is_active" id="status-field-edit" required>
                                                        <option value="1">Hoạt Động</option>
                                                        <option value="0">Ẩn</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-success" id="add-btn">Cập
                                                        Nhật Danh Mục</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" id="deleteRecord-close"
                                                data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mt-2 text-center">
                                                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                                    colors="primary:#f7b84b,secondary:#f06548"
                                                    style="width:100px;height:100px"></lord-icon>
                                                <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                    <h4>Bạn có chắc không?</h4>
                                                    <p class="text-muted mx-4 mb-0">Bạn có muốn xóa danh mục này không?</p>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                <button type="button" class="btn w-sm btn-light"
                                                    data-bs-dismiss="modal">Đóng</button>
                                                <form id="deleteForm" method="POST" action="">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn w-sm btn-danger"
                                                        id="delete-record">Xóa!</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end modal -->
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection

@section('script')
    <script>
        var categories = @json($categorySlug);
    </script>
    <script src="{{ asset('templates/admin/assets/libs/validates/CreateSlug.js') }}"></script>
    <script src="{{ asset('templates/admin/assets/libs/validates/category.js') }}"></script>
    <script>
        $(document).ready(function () {
            // Khởi tạo DataTables
            $('#categoryTable').DataTable({
                paging: true,
                searching: false,
                ordering: true,
                info: true,
                pageLength: 10,
                lengthChange: false
            });

            // Xử lý sự kiện xóa
            $(document).on('click', '.remove-item-btn', function () {
                let userId = $(this).data('id');
                let actionUrl = "/admin/categories/" + userId;
                $('#deleteForm').attr('action', actionUrl);
            });

            // Xử lý sự kiện chỉnh sửa
            $(document).on('click', '.edit-item-btn', function () {
                let id = $(this).data('id');
                let name = $(this).data('name');
                let status = $(this).data('status');
                let actionUrl = "/admin/categories/" + id;

                $('#id-field-edit').val(id);
                $('#name-field-edit').val(name);
                $('#status-field-edit').val(status);
                $('.edit').attr('action', actionUrl);
            });
        });
    </script>
@endsection
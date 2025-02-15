@extends('admin.layouts.app')
@section('title', 'trang danh mục category')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Danh Mục</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Thương Mại Điện Tử</a></li>
                                <li class="breadcrumb-item active">Danh Mục</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->@extends('admin.layouts.app')
@section('title', 'trang danh mục category')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Danh Mục</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Thương Mại Điện Tử</a></li>
                                <li class="breadcrumb-item active">Danh Mục</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

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
                            <form>
                                <div class="row g-3">
                                    <div class="col-xl-6">
                                        <div class="search-box">
                                            <input type="text" class="form-control search"
                                                placeholder="Search for customer, email, phone, status or something...">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xl-6">
                                        <div class="row g-3">
                                            <div class="col-sm-4">
                                                <div class="">
                                                    <input type="text" class="form-control" id="datepicker-range"
                                                        data-provider="flatpickr" data-date-format="d M, Y"
                                                        data-range-date="true" placeholder="Select date">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-sm-4">
                                                <div>
                                                    <select class="form-control" data-plugin="choices" data-choices
                                                        data-choices-search-false name="choices-single-default"
                                                        id="idStatus">
                                                        <option value="">Status</option>
                                                        <option value="all" selected>All</option>
                                                        <option value="Active">Active</option>
                                                        <option value="Block">Block</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!--end col-->

                                            <div class="col-sm-4">
                                                <div>
                                                    <button type="button" class="btn btn-primary w-100"
                                                        onclick="SearchData();"> <i
                                                            class="ri-equalizer-fill me-2 align-bottom"></i>Lọc</button>
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
                                        <tbody class="list form-check-all">
                                            @foreach ($categories as $item)
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
                                            @endforeach
                                        </tbody>
                                    </table>
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
                                                <input type="hidden" id="id-field" />

                                                <div class="mb-3" id="modal-id" style="display: none;">
                                                    <label for="id-field1" class="form-label">ID</label>
                                                    <input type="text" id="id-field1" class="form-control"
                                                        placeholder="ID" readonly />
                                                </div>

                                                <div class="mb-3">
                                                    <label for="name-field" class="form-label">
                                                        Tên Danh Mục</label>
                                                    <input type="text" id="name-field" class="form-control"
                                                        placeholder="Enter name" name="name" />
                                                    <div class="invalid-feedback">Please enter a customer name.</div>
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
                                                    <button type="submit" class="btn btn-success" id="add-btn">Thêm
                                                        Danh Mục</button>
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
                                            <h4>Sửa </h4>
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
                                                    <label for="name-field-edit" class="form-label">
                                                        Tên Danh Mục</label>
                                                    <input type="text" id="name-field-edit" class="form-control"
                                                        placeholder="Enter name" name="name" />
                                                    <div class="invalid-feedback">Please enter a customer name.</div>
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

                            <!-- Modal -->
                            <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog  modal-dialog-centered">
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
                                                    <h4>Bạn có chắc không ?</h4>
                                                    <p class="text-muted mx-4 mb-0">Bạn có muốn xóa người dùng này không?
                                                    </p>
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
<<<<<<< HEAD
                            <!--end modal -->
=======
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
    </script>
@endsection

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
                            <form>
                                <div class="row g-3">
                                    <div class="col-xl-6">
                                        <div class="search-box">
                                            <input type="text" class="form-control search"
                                                placeholder="Search for customer, email, phone, status or something...">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-xl-6">
                                        <div class="row g-3">
                                            <div class="col-sm-4">
                                                <div class="">
                                                    <input type="text" class="form-control" id="datepicker-range"
                                                        data-provider="flatpickr" data-date-format="d M, Y"
                                                        data-range-date="true" placeholder="Select date">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-sm-4">
                                                <div>
                                                    <select class="form-control" data-plugin="choices" data-choices
                                                        data-choices-search-false name="choices-single-default"
                                                        id="idStatus">
                                                        <option value="">Status</option>
                                                        <option value="all" selected>All</option>
                                                        <option value="Active">Active</option>
                                                        <option value="Block">Block</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!--end col-->

                                            <div class="col-sm-4">
                                                <div>
                                                    <button type="button" class="btn btn-primary w-100"
                                                        onclick="SearchData();"> <i
                                                            class="ri-equalizer-fill me-2 align-bottom"></i>Filters</button>
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
                                        <tbody class="list form-check-all">
                                            @foreach ($categories as $item)
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="chk_child">
                                                        </div>
                                                    </th>

                                                    <td class="customer_name">{{ $item->name }}</td>
                                                    <td class="status">
                                                        <span
                                                            class="badge {{ $item->is_active ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                                                            {{ $item->is_active ? 'ACTIVE' : 'BLOCK' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <ul class="list-inline hstack gap-2 mb-0">
                                                            <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                                data-bs-trigger="hover" data-bs-placement="top"
                                                                title="Edit">
                                                                <a href="#showModalEdit" data-bs-toggle="modal"
                                                                    class="text-primary d-inline-block edit-item-btn">
                                                                    <i class="ri-pencil-fill fs-16"></i>
                                                                </a>
                                                            </li>
                                                            <li class="list-inline-item" data-bs-toggle="tooltip"
                                                                data-bs-trigger="hover" data-bs-placement="top"
                                                                title="Remove">
                                                                <a class="text-danger d-inline-block remove-item-btn"
                                                                    data-bs-toggle="modal" href="#deleteRecordModal">
                                                                    <i class="ri-delete-bin-5-fill fs-16"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>



                            <form class="" action="" method="POST">
                                @csrf
                                <div class="modal fade" id="showModalCreate" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-light p-3">
                                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close" id="close-modal"></button>
                                            </div>
                                            <form class="tablelist-form" autocomplete="off">
                                                <div class="modal-body">
                                                    <input type="hidden" id="id-field" />

                                                    <div class="mb-3" id="modal-id" style="display: none;">
                                                        <label for="id-field1" class="form-label">ID</label>
                                                        <input type="text" id="id-field1" class="form-control"
                                                            placeholder="ID" readonly />
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="customername-field" class="form-label">Customer
                                                            Name</label>
                                                        <input type="text" id="customername-field"
                                                            class="form-control" placeholder="Enter name" required />
                                                        <div class="invalid-feedback">Please enter a customer name.</div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="form-label">Email</label>
                                                        <input type="email" id="email-field" class="form-control"
                                                            placeholder="Enter email" required />
                                                        <div class="invalid-feedback">Please enter an email.</div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="phone-field" class="form-label">Phone</label>
                                                        <input type="text" id="phone-field" class="form-control"
                                                            placeholder="Enter phone no." required />
                                                        <div class="invalid-feedback">Please enter a phone.</div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="date-field" class="form-label">Joining Date</label>
                                                        <input type="date" id="date-field" class="form-control"
                                                            data-provider="flatpickr" data-date-format="d M, Y" required
                                                            placeholder="Select date" />
                                                        <div class="invalid-feedback">Please select a date.</div>
                                                    </div>

                                                    <div>
                                                        <label for="status-field" class="form-label">Status</label>
                                                        <select class="form-control" data-choices data-choices-search-false
                                                            name="status-field" id="status-field" required>
                                                            <option value="">Status</option>
                                                            <option value="Active">Active</option>
                                                            <option value="Block">Block</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <button type="button" class="btn btn-light"
                                                            data-bs-dismiss="modal">Đóng</button>
                                                        <button type="submit" class="btn btn-success"
                                                            id="add-btn">Thêm Danh Mục</button>
                                                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </form>

                            <form class="" action="" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="modal fade" id="showModalEdit" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-light p-3">
                                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close" id="close-modal"></button>
                                            </div>
                                            <form class="tablelist-form" autocomplete="off">
                                                <div class="modal-body">
                                                    <input type="hidden" id="id-field" />

                                                    <div class="mb-3" id="modal-id" style="display: none;">
                                                        <label for="id-field1" class="form-label">ID</label>
                                                        <input type="text" id="id-field1" class="form-control"
                                                            placeholder="ID" readonly />
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="customername-field" class="form-label">Customer
                                                            Name</label>
                                                        <input type="text" id="customername-field"
                                                            class="form-control" placeholder="Enter name" required />
                                                        <div class="invalid-feedback">Please enter a customer name.</div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="email-field" class="form-label">Email</label>
                                                        <input type="email" id="email-field" class="form-control"
                                                            placeholder="Enter email" required />
                                                        <div class="invalid-feedback">Please enter an email.</div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="phone-field" class="form-label">Phone</label>
                                                        <input type="text" id="phone-field" class="form-control"
                                                            placeholder="Enter phone no." required />
                                                        <div class="invalid-feedback">Please enter a phone.</div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="date-field" class="form-label">Joining Date</label>
                                                        <input type="date" id="date-field" class="form-control"
                                                            data-provider="flatpickr" data-date-format="d M, Y" required
                                                            placeholder="Select date" />
                                                        <div class="invalid-feedback">Please select a date.</div>
                                                    </div>

                                                    <div>
                                                        <label for="status-field" class="form-label">Status</label>
                                                        <select class="form-control" data-choices data-choices-search-false
                                                            name="status-field" id="status-field" required>
                                                            <option value="">Status</option>
                                                            <option value="Active">Active</option>
                                                            <option value="Block">Block</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <button type="button" class="btn btn-light"
                                                            data-bs-dismiss="modal">Đóng</button>
                                                        <button type="submit" class="btn btn-success"
                                                            id="add-btn">Cập Nhật Danh Mục</button>
                                                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </form>

                            <!-- Modal -->
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
                                                    <h4>Are you sure ?</h4>
                                                    <p class="text-muted mx-4 mb-0">Are you sure you want to remove this
                                                        record ?</p>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                <button type="button" class="btn w-sm btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn w-sm btn-danger"
                                                    id="delete-record">Yes, Delete It!</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
<<<<<<< HEAD

                            <div class="QA_table mb_30">
                                <div class="add_button ">
                                    <a href="{{url('/admin/categories/create')}}" data-bs-toggle="modal" data-bs-target="#addcategory" class="btn btn-primary btn-sm mx-1">
                                        <i class="fas fa-plus me-1"></i> Add new
                                    </a>
                                </div>
                                <!-- table-responsive -->
                                <table class="table lms_table_active text-center">
                                    <thead class="">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Tên danh mục</th>
                                            <th scope="col">isActive</th>
                                            <th scope="col">Created_at</th>
                                            <th scope="col">Update_at</th>
                                            <th scope="col">Tính năng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Category name </td>
                                            <td>
                                                <p class="status_btn">Activated</p>
                                            </td>
                                            <td>2025-02-01 00:15</td>
                                            <td>2025-02-01 00:20</td>
                                            <td>
                                                <a href="{{url('/admin/categories/edit')}}"><button class="btn btn-success btn-sm mx-1"><i class="fas fa-edit"></i> Edit</button></a>
                                                <button class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> <a href="#" onclick="alert('cannot delete !')" class="btn btn-danger btn-sm"></a>Delete</button>
                                                <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i><a href="#" onclick="alert('no view detail !')" class="btn btn-danger btn-sm"></a> View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Category name</td>
                                            <td>
                                                <p class="status_btn">Activated</p>
                                            </td>
                                            <td>2025-02-01 00:15</td>
                                            <td>2025-02-01 00:20</td>
                                            <td>
                                                <a href="{{url('/admin/categories/edit')}}"><button class="btn btn-success btn-sm mx-1"><i class="fas fa-edit"></i> Edit</button></a>
                                                <button class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> <a href="#" onclick="alert('cannot delete !')" class="btn btn-danger btn-sm"></a>Delete</button>
                                                <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i><a href="#" onclick="alert('no view detail !')" class="btn btn-danger btn-sm"></a> View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Category name</td>
                                            <td>
                                                <p class="status_btn">Activated</p>
                                            </td>
                                            <td>2025-02-01 00:15</td>
                                            <td>2025-02-01 00:20</td>
                                            <td>
                                                <a href="{{url('/admin/categories/edit')}}"><button class="btn btn-success btn-sm mx-1"><i class="fas fa-edit"></i> Edit</button></a>
                                                <button class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> <a href="#" onclick="alert('cannot delete !')" class="btn btn-danger btn-sm"></a>Delete</button>
                                                <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i><a href="#" onclick="alert('no view detail !')" class="btn btn-danger btn-sm"></a> View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Category name</td>
                                            <td>
                                                <p class="status_btn">Activated</p>
                                            </td>
                                            <td>2025-02-01 00:15</td>
                                            <td>2025-02-01 00:20</td>
                                            <td>
                                                <a href="{{url('/admin/categories/edit')}}"><button class="btn btn-success btn-sm mx-1"><i class="fas fa-edit"></i> Edit</button></a>
                                                <button class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> <a href="#" onclick="alert('cannot delete !')" class="btn btn-danger btn-sm"></a>Delete</button>
                                                <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i><a href="#" onclick="alert('no view detail !')" class="btn btn-danger btn-sm"></a> View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Category name</td>
                                            <td>
                                                <p class="status_btn">Activated</p>
                                            </td>
                                            <td>2025-02-01 00:15</td>
                                            <td>2025-02-01 00:20</td>
                                            <td>
                                                <a href="{{url('/admin/categories/edit')}}"><button class="btn btn-success btn-sm mx-1"><i class="fas fa-edit"></i> Edit</button></a>
                                                <button class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> <a href="#" onclick="alert('cannot delete !')" class="btn btn-danger btn-sm"></a>Delete</button>
                                                <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i><a href="#" onclick="alert('no view detail !')" class="btn btn-danger btn-sm"></a> View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Category name</td>
                                            <td>
                                                <p class="status_btn">Activated</p>
                                            </td>
                                            <td>2025-02-01 00:15</td>
                                            <td>2025-02-01 00:20</td>
                                            <td>
                                                <a href="{{url('/admin/categories/edit')}}"><button class="btn btn-success btn-sm mx-1"><i class="fas fa-edit"></i> Edit</button></a>
                                                <button class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> <a href="#" onclick="alert('cannot delete !')" class="btn btn-danger btn-sm"></a>Delete</button>
                                                <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i><a href="#" onclick="alert('no view detail !')" class="btn btn-danger btn-sm"></a> View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>Category name</td>
                                            <td>
                                                <p class="status_btn">Activated</p>
                                            </td>
                                            <td>2025-02-01 00:15</td>
                                            <td>2025-02-01 00:20</td>
                                            <td>
                                                <a href="{{url('/admin/categories/edit')}}"><button class="btn btn-success btn-sm mx-1"><i class="fas fa-edit"></i> Edit</button></a>
                                                <button class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> <a href="#" onclick="alert('cannot delete !')" class="btn btn-danger btn-sm"></a>Delete</button>
                                                <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i><a href="#" onclick="alert('no view detail !')" class="btn btn-danger btn-sm"></a> View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>8</td>
                                            <td>Category name</td>
                                            <td>
                                                <p class="status_btn">Activated</p>
                                            </td>
                                            <td>2025-02-01 00:15</td>
                                            <td>2025-02-01 00:20</td>
                                            <td>
                                                <a href="{{url('/admin/categories/edit')}}"><button class="btn btn-success btn-sm mx-1"><i class="fas fa-edit"></i> Edit</button></a>
                                                <button class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> <a href="#" onclick="alert('cannot delete !')" class="btn btn-danger btn-sm"></a>Delete</button>
                                                <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i><a href="#" onclick="alert('no view detail !')" class="btn btn-danger btn-sm"></a> View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td>Category name</td>
                                            <td>
                                                <p class="status_btn">Activated</p>
                                            </td>
                                            <td>2025-02-01 00:15</td>
                                            <td>2025-02-01 00:20</td>
                                            <td>
                                                <a href="{{url('/admin/categories/edit')}}"><button class="btn btn-success btn-sm mx-1"><i class="fas fa-edit"></i> Edit</button></a>
                                                <button class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> <a href="#" onclick="alert('cannot delete !')" class="btn btn-danger btn-sm"></a>Delete</button>
                                                <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i><a href="#" onclick="alert('no view detail !')" class="btn btn-danger btn-sm"></a> View</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>10</td>
                                            <td>Category name</td>
                                            <td>
                                                <p class="status_btn">Activated</p>
                                            </td>
                                            <td>2025-02-01 00:15</td>
                                            <td>2025-02-01 00:20</td>
                                            <td>
                                                <a href="{{url('/admin/categories/edit')}}"><button class="btn btn-success btn-sm mx-1"><i class="fas fa-edit"></i> Edit</button></a>
                                                <button class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> <a href="#" onclick="alert('cannot delete !')" class="btn btn-danger btn-sm"></a>Delete</button>
                                                <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i><a href="#" onclick="alert('no view detail !')" class="btn btn-danger btn-sm"></a> View</button>
                                            </td>
                                        </tr>
                                        <!-- page 2 -->
                                        <tr>
                                            <td>11</td>
                                            <td>Category name</td>
                                            <td>
                                                <p class="status_btn">Activated</p>
                                            </td>
                                            <td>2025-02-01 00:15</td>
                                            <td>2025-02-01 00:20</td>
                                            <td>
                                                <a href="{{url('/admin/categories/edit')}}"><button class="btn btn-success btn-sm mx-1"><i class="fas fa-edit"></i> Edit</button></a>
                                                <button class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i> <a href="#" onclick="alert('cannot delete !')" class="btn btn-danger btn-sm"></a>Delete</button>
                                                <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i><a href="#" onclick="alert('no view detail !')" class="btn btn-danger btn-sm"></a> View</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
=======
                            <!--end modal -->
>>>>>>> bde16fc80a13c5c34308cb58424bb210b08227db
>>>>>>> hoa_dev
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

    <script src="{{ asset('templates/admin/assets/libs/validates/category.js') }}"></script>

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

        $(document).on('click', '.remove-item-btn', function() {
            let userId = $(this).data('id'); // Lấy ID người dùng
            let actionUrl = "/admin/categories/" + userId; // Tạo URL xóa

            $('#deleteForm').attr('action', actionUrl); // Cập nhật action của form
        });
    </script>
@endsection

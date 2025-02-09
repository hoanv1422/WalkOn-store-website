@extends('admin.layouts.app')
@section('title', 'Danh sách người dùng')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Customers</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                <li class="breadcrumb-item active">Customers</li>
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
                                        <h5 class="card-title mb-0">Customer List</h5>
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex flex-wrap align-items-start gap-2">
                                        <button class="btn btn-soft-danger" id="remove-actions"
                                            onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                            id="create-btn" data-bs-target="#showModalCreate"><i
                                                class="ri-add-line align-bottom me-1"></i> Thêm Người Dùng</button>
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
                                    <table id="userTable" class="table align-middle dataTable">
                                        <thead class="table-light text-muted">
                                            <tr>
                                                <th scope="col" style="width: 15px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="checkAll">
                                                    </div>
                                                </th>
                                                <th class="sort" data-sort="avatar" style="width: 50px;">Ảnh</th>
                                                <th class="sort" data-sort="username">Tên Người Dùng</th>
                                                <th class="sort" data-sort="name">Tên Tài Khoản</th>
                                                <th class="sort" data-sort="email">Email</th>
                                                <th class="sort" data-sort="phone">Số Điện Thoại</th>
                                                <th class="sort" data-sort="date">Ngày Tạo</th>
                                                <th class="sort" data-sort="authentic">Xác thực</th>
                                                <th class="sort" data-sort="status">Trạng Thái</th>
                                                <th class="sort" data-sort="action">Hành Động</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                            @foreach ($users as $user)
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="chk_child">
                                                        </div>
                                                    </th>
                                                    <td class="avatar">
                                                        <div class="flex-shrink-">
                                                            <div class="avatar-sm bg-light rounded p-1 overflow-hidden">
                                                                <img src="{{ Storage::url($user->avatar) }}"
                                                                    alt="" class="img-fluid d-block ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="username">{{ $user->username }}</td>
                                                    <td class="name">{{ $user->name }}</td>
                                                    <td class="email">{{ $user->mail }}</td>
                                                    <td class="phone">{{ $user->phone }}</td>
                                                    <td class="date">{{ $user->created_at->format('d M, Y') }}</td>
                                                    <td class="authentic"></td>
                                                    <td class="status">
                                                        <span
                                                            class="badge {{ $user->is_active ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                                                            {{ $user->is_active ? 'ACTIVE' : 'BLOCK' }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <ul class="list-inline hstack gap-2 mb-0">
                                                            <li class="list-inline-item edit">
                                                                <a href="#showModalEdit" data-bs-toggle="modal"
                                                                    class="text-primary d-inline-block edit-item-btn"
                                                                    data-id="{{ $user->id }}"
                                                                    data-avatar="{{ Storage::url($user->avatar) }}"
                                                                    data-username="{{ $user->username }}"
                                                                    data-name="{{ $user->name }}"
                                                                    data-email="{{ $user->mail }}"
                                                                    data-phone="{{ $user->phone }}" 
                                                                    data-password="{{$user->password}}"
                                                                    data-address="{{ $user->address }}"
                                                                    data-status="{{ $user->is_active }}">
                                                                    <i class="ri-pencil-fill fs-16"></i>
                                                                </a>
                                                            </li>
                                                            <li class="list-inline-item" data-bs-toggle="tooltip"
                                                                data-bs-trigger="hover" data-bs-placement="top"
                                                                title="Remove">
                                                                <a class="text-danger d-inline-block remove-item-btn"
                                                                    data-bs-toggle="modal" data-id="{{$user->id}}" href="#deleteRecordModal">
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
                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form action="{{ route('users.store') }}" method="POST" class="tablelist-form"
                                            autocomplete="off" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" id="id-field" />

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="text-center">
                                                            <div class="position-relative d-inline-block">
                                                                <div
                                                                    class="position-absolute top-100 start-100 translate-middle">
                                                                    <label for="product-image-input" class="mb-0"
                                                                        data-bs-toggle="tooltip" data-bs-placement="right"
                                                                        title="Chọn ảnh">
                                                                        <div class="avatar-xs">
                                                                            <div
                                                                                class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                                                <i class="ri-image-fill"></i>
                                                                            </div>
                                                                        </div>
                                                                    </label>
                                                                    <input class="form-control d-none"
                                                                        id="product-image-input" name="avatar"
                                                                        type="file"
                                                                        accept="image/png, image/gif, image/jpeg"
                                                                        onchange="previewImage(event)">
                                                                </div>
                                                                <div class="avatar-lg">
                                                                    <div class="avatar-title bg-light rounded overflow-hidden">
                                                                        <img src="" id="product-img"
                                                                            class="avatar-md h-auto " />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="customername-field" class="form-label">Tên Tài
                                                                Khoản</label>
                                                            <input type="text" id="customername-field"
                                                                class="form-control" placeholder="Nhập tên tài khoản"
                                                                name="username" required />
                                                            <div class="invalid-feedback">Vui lòng nhập tên tài khoản.
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="email-field" class="form-label">Email</label>
                                                            <input type="text" id="email-field" class="form-control"
                                                                placeholder="Nhập email" name="mail" required />
                                                            <div class="invalid-feedback">Vui lòng nhập email.</div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="passwword-field" class="form-label">Mật
                                                                Khẩu</label>
                                                            <input type="text" id="password-field"
                                                                class="form-control" placeholder="Nhập mật khẩu"
                                                                name="password" required />
                                                            <div class="invalid-feedback">Vui lòng nhập mật khẩu.</div>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="customername-field" class="form-label">Tên Người
                                                                Dùng</label>
                                                            <input type="text" id="customername-field"
                                                                class="form-control" placeholder="Nhập tên người dùng"
                                                                name="name" />
                                                            <div class="invalid-feedback">Vui lòng nhập tên người dùng.
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="phone-field" class="form-label">Số Điện
                                                                Thoại</label>
                                                            <input type="text" id="phone-field" class="form-control"
                                                                placeholder="Nhập Số Điện Thoại" name="phone"
                                                                required />
                                                            <div class="invalid-feedback">Vui lòng nhập số điện thoại.
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="address-field" class="form-label">Địa chỉ</label>
                                                            <textarea type="text" id="address-field" class="form-control" placeholder="Nhập địa chỉ" name="address"
                                                                required> </textarea>
                                                            <div class="invalid-feedback">Vui lòng nhập địa chỉ.
                                                            </div>
                                                        </div>


                                                        <div class="mb-3">
                                                            <label for="status-field" class="form-label">Trạng
                                                                Thái</label>
                                                            <select class="form-control" name="is_active"
                                                                id="status-field" required>
                                                                <option>Hoạt động</option>
                                                                <option >Khoá</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-success" id="add-btn">Thêm
                                                        Người Dùng</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                            <div class="modal fade" id="showModalEdit" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form action="" method="POST"
                                            class="tablelist-form edit" autocomplete="off" enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-body">
                                                <input type="hidden" name="id" id="id-field-edit" />
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="text-center">
                                                            <div class="position-relative d-inline-block">
                                                                <div
                                                                    class="position-absolute top-100 start-100 translate-middle">
                                                                    <label for="product-image-input-edit" class="mb-0"
                                                                        data-bs-toggle="tooltip" data-bs-placement="right"
                                                                        title="Chọn ảnh">
                                                                        <div class="avatar-xs">
                                                                            <div
                                                                                class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                                                <i class="ri-image-fill"></i>
                                                                            </div>
                                                                        </div>
                                                                    </label>
                                                                    <input class="form-control d-none"
                                                                        id="product-image-input-edit" name="avatar"
                                                                        type="file"
                                                                        accept="image/png, image/gif, image/jpeg"
                                                                        onchange="previewImageEdit(event)">
                                                                </div>
                                                                <div class="avatar-lg">
                                                                    <div class="avatar-title bg-light rounded overflow-hidden">
                                                                        <img src="" id="product-img-edit"
                                                                            class="avatar-md h-auto" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="username-field-edit" class="form-label">Tên Tài
                                                                Khoản</label>
                                                            <input type="text" id="username-field-edit"
                                                                class="form-control" placeholder="Nhập tên tài khoản"
                                                                name="username" required />
                                                            <div class="invalid-feedback">Vui lòng nhập tên tài khoản.
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="mail-field-edit" class="form-label">Email</label>
                                                            <input type="text" id="mail-field-edit" class="form-control"
                                                                placeholder="Nhập email" name="mail" required />
                                                            <div class="invalid-feedback">Vui lòng nhập email.</div>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="name-field-edit" class="form-label">Tên Người
                                                                Dùng</label>
                                                            <input type="text" id="name-field-edit"
                                                                class="form-control" placeholder="Nhập tên người dùng"
                                                                name="name" />
                                                            <div class="invalid-feedback">Vui lòng nhập tên người dùng.
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="phone-field-edit" class="form-label">Số Điện
                                                                Thoại</label>
                                                            <input type="text" id="phone-field-edit" class="form-control"
                                                                placeholder="Nhập Số Điện Thoại" name="phone"
                                                                required />
                                                            <div class="invalid-feedback">Vui lòng nhập số điện thoại.
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="address-field-edit" class="form-label">Địa chỉ</label>
                                                            <textarea type="text" id="address-field-edit" class="form-control" placeholder="Nhập địa chỉ" name="address"
                                                                required> </textarea>
                                                            <div class="invalid-feedback">Vui lòng nhập địa chỉ.
                                                            </div>
                                                        </div>


                                                        <div class="mb-3">
                                                            <label for="status-field-edit" class="form-label">Trạng
                                                                Thái</label>
                                                            <select class="form-control" name="is_active"
                                                                id="status-field-edit" required>
                                                                <option value="1">Hoạt động</option>
                                                                <option value="0">Khoá</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-success" id="add-btn">Cập
                                                        Nhật
                                                        Người Dùng</button>
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
                                                    <p class="text-muted mx-4 mb-0">Bạn có muốn xóa người dùng này không ?</p>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                <button type="button" class="btn w-sm btn-light"
                                                    data-bs-dismiss="modal">Đóng</button>
                                                    <form id="deleteForm" method="POST"  action="">
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
    <script src="{{ asset('templates/admin/assets/libs/gallery/gallery.js') }}"></script>
    <script src="{{ asset('templates/admin/assets/libs/validates/user.js') }}"></script>
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
                let actionUrl = "/admin/users/" + userId; // Tạo URL xóa

                $('#deleteForm').attr('action', actionUrl); // Cập nhật action của form
            });


    </script>

@endsection

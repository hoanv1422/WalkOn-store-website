@extends('admin.layouts.app')
@section('title', 'Danh Mục Bài Viết')
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
                                          
                                            @foreach ($postCategories as $item)
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
                                        <form action="{{ route('post-categories.store') }}" method="POST"
                                            class="tablelist-form" autocomplete="off">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <input type="hidden" name="id" id="id-field" />
                                                    <label for="name-field" class="form-label">
                                                        Tên Danh Mục</label>
                                                    <input type="text" id="name-field" class="form-control"
                                                        placeholder="Nhập tên" name="name" />
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
    var postCategories = @json($postCategorySlug);
</script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
    // Sử dụng biến postCategories được truyền từ Blade
    const postCategories = window.postCategories || [];
    console.log("postCategories:", postCategories);

    const forms = document.querySelectorAll(".tablelist-form");

    // Xử lý validate cho các form (cả tạo mới và cập nhật)
    forms.forEach((form) => {
        form.addEventListener("submit", function (event) {
            let isValid = true;
            // Lấy giá trị input 'name' và 'id' (nếu có) từ form hiện tại
            const nameInput = form.querySelector("[name='name']");
            const idField = form.querySelector("[name='id']");
            const idCategory = idField ? idField.value : "";

            // Tạo slug từ tên danh mục (bạn cần đảm bảo hàm createSlug đã được định nghĩa)
            const slug = createSlug(nameInput.value);

            // Reset trạng thái lỗi cho form hiện tại
            form.querySelectorAll(".invalid-feedback").forEach(el => el.style.display = "none");
            form.querySelectorAll(".form-control").forEach(el => el.classList.remove("is-invalid"));

            // Kiểm tra nếu slug đã tồn tại (ngoại trừ trường hợp cập nhật danh mục hiện tại)
            if (
                postCategories.some(
                    (category) => category.slug === slug && category.id != idCategory
                )
            ) {
                showError(nameInput, "Tên danh mục đã tồn tại.");
                isValid = false;
            }

            // Kiểm tra trường name không được rỗng
            if (nameInput.value.trim() === "") {
                showError(nameInput, "Vui lòng nhập tên danh mục.");
                isValid = false;
            }

            // Kiểm tra độ dài tên không vượt quá 40 ký tự
            if (nameInput.value.trim().length > 40) {
                showError(nameInput, "Tên danh mục quá dài.");
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault();
            }
        });
    });

    function showError(input, message) {
        const feedback = input.nextElementSibling;
        input.classList.add("is-invalid");
        if (feedback) {
            feedback.innerText = message;
            feedback.style.display = "block";
        }
    }

    // Xử lý nút chỉnh sửa (Edit)
    document.querySelectorAll(".edit-item-btn").forEach((button) => {
        button.addEventListener("click", function () {
            const id = this.getAttribute("data-id");
            const name = this.getAttribute("data-name");
            const status = this.getAttribute("data-status");

            // Gán giá trị vào modal edit
            document.getElementById("id-field-edit").value = id;
            document.getElementById("name-field-edit").value = name;
            document.getElementById("status-field-edit").value = status || "0";

            // Cập nhật action của form chỉnh sửa với URL chính xác
            let editForm = document.querySelector(".tablelist-form.edit");
            if (editForm) {
                editForm.setAttribute("action", `/admin/post-categories/${id}`);
            }
        });
    });

    // Xử lý nút xóa (Delete) sử dụng jQuery
    $(document).on('click', '.remove-item-btn', function() {
        let postcategoryId = $(this).data('id');
        if (!postcategoryId) {
            console.error("Không tìm thấy ID danh mục cần xóa!");
            return;
        }
        console.log("Deleting post category with ID:", postcategoryId);
        let actionUrl = `/admin/post-categories/${postcategoryId}`;
        $('#deleteForm').attr('action', actionUrl);
    });
});

    </script>

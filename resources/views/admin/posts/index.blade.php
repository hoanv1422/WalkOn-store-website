@extends('admin.layouts.app')
@section('title', 'Quản Lý Bài Viết')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Header -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="postList">
                        <div class="card-header border-bottom-dashed">
                            <div class="row g-4 align-items-center">
                                <div class="col-sm">
                                    <div>
                                        <h5 class="card-title mb-0">Danh Sách Bài Viết</h5>
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex flex-wrap align-items-start gap-2">
                                        <button class="btn btn-soft-danger" id="remove-actions"
                                            onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                            id="create-btn" data-bs-target="#showModalCreate"><i
                                                class="ri-add-line align-bottom me-1"></i> Thêm Bài Viết</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Search & Filter -->
                        <div class="card-body border-bottom-dashed border-bottom">
                            <form>
                                <div class="row g-3">
                                    <div class="col-xl-6">
                                        <div class="search-box">
                                            <input type="text" class="form-control search"
                                                placeholder="Tìm kiếm theo tiêu đề, danh mục, người viết...">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="row g-3">
                                            <div class="col-sm-4">
                                                <div class="">
                                                    <input type="text" class="form-control" id="datepicker-range"
                                                        data-provider="flatpickr" data-date-format="d M, Y"
                                                        data-range-date="true" placeholder="Chọn ngày">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div>
                                                    <select class="form-control" data-plugin="choices" data-choices
                                                        data-choices-search-false name="choices-single-default"
                                                        id="idStatus">
                                                        <option value="">Trạng thái</option>
                                                        <option value="all" selected>All</option>
                                                        <option value="published">Published</option>
                                                        <option value="draft">Draft</option>
                                                        <option value="pending">Pending</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div>
                                                    <button type="button" class="btn btn-primary w-100"
                                                        onclick="SearchData();">
                                                        <i class="ri-equalizer-fill me-2 align-bottom"></i> Lọc
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Table danh sách bài viết -->
                        <div class="card-body">
                            <div class="table-responsive table-card mb-1">
                                <table id="postTable" class="table align-middle dataTable">
                                    <thead class="table-light text-muted">
                                        <tr>
                                            <th scope="col" style="width: 15px;">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="checkAll">
                                                </div>
                                            </th>
                                            <th class="sort" data-sort="title">Tiêu Đề</th>
                                            <!-- Thêm cột hiển thị hình ảnh -->
                                            <th class="sort" data-sort="thumbnail">Ảnh Đại Diện</th>
                                            <th class="sort" data-sort="category">Danh Mục</th>
                                            <th class="sort" data-sort="user">Người Viết</th>
                                            <th class="sort" data-sort="status">Trạng Thái</th>
                                            <th class="sort" data-sort="action">Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($posts as $post)
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="chk_child">
                                                    </div>
                                                </th>
                                                <td class="title">{{ $post->title }}</td>
                                                <!-- Hiển thị ảnh đại diện nếu có, với kích thước vừa -->
                                                <td class="thumbnail">
                                                    @if ($post->thumbnail)
                                                        <img src="{{ asset('uploads/posts/' . $post->thumbnail) }}"
                                                            alt="{{ $post->title }}"
                                                            style="width:80px; height:80px; object-fit: cover;">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td class="category">{{ $post->category->name }}</td>
                                                <td class="user">{{ $post->user->name }}</td>
                                                <td class="status">
                                                    <span
                                                        class="badge 
                                                        @if ($post->status == 'published') bg-success-subtle text-success 
                                                        @elseif($post->status == 'draft') bg-warning-subtle text-warning 
                                                        @else bg-danger-subtle text-danger @endif">
                                                        {{ ucfirst($post->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <ul class="list-inline hstack gap-2 mb-0">
                                                        <li class="list-inline-item detail" data-bs-toggle="tooltip"
                                                            title="Xem Chi Tiết">
                                                            <a href="#showModalDetail" data-bs-toggle="modal"
                                                                class="text-info detail-item-btn"
                                                                data-id="{{ $post->id }}"
                                                                data-title="{{ $post->title }}"
                                                                data-categoryname="{{ $post->category->name }}"
                                                                data-user="{{ $post->user->name }}"
                                                                data-status="{{ $post->status }}"
                                                                data-content="{{ $post->content }}"
                                                                data-thumbnail="{{ $post->thumbnail }}">
                                                                <i class="ri-eye-fill fs-16"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                            title="Edit">
                                                            <a href="#showModalEdit" data-bs-toggle="modal"
                                                                class="text-primary edit-item-btn"
                                                                data-id="{{ $post->id }}"
                                                                data-title="{{ $post->title }}"
                                                                data-category="{{ $post->category_id }}"
                                                                data-status="{{ $post->status }}"
                                                                data-content="{{ $post->content }}">
                                                                <i class="ri-pencil-fill fs-16"></i>
                                                            </a>
                                                        </li>
                                                        <li class="list-inline-item" data-bs-toggle="tooltip"
                                                            title="Remove">
                                                            <a class="text-danger remove-item-btn" data-bs-toggle="modal"
                                                                data-id="{{ $post->id }}" href="#deleteRecordModal">
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

                        <!-- Modal: xem bài viết -->
                        <div class="modal fade" id="showModalDetail" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-light p-3">
                                        <h4>Chi Tiết Bài Viết</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <!-- Cột hiển thị ảnh đại diện -->
                                            <div class="col-md-4">
                                                <div id="detail-thumbnail" style="margin-bottom: 15px;"></div>
                                            </div>
                                            <!-- Cột hiển thị thông tin chi tiết -->
                                            <div class="col-md-8">
                                                <h5 id="detail-title"></h5>
                                                <p><strong>Danh Mục:</strong> <span id="detail-category"></span></p>
                                                <p><strong>Người Viết:</strong> <span id="detail-user"></span></p>
                                                <p><strong>Trạng Thái:</strong> <span id="detail-status"></span></p>
                                                <hr>
                                                <div id="detail-content"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal: Create Post -->
                        <div class="modal fade" id="showModalCreate" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-light p-3">
                                        <h4>Thêm Bài Viết</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('posts.store') }}" method="POST"
                                        enctype="multipart/form-data" class="tablelist-form" autocomplete="off">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="title-field" class="form-label">Tiêu Đề</label>
                                                <input type="text" id="title-field" name="title"
                                                    class="form-control" required>
                                                <div class="invalid-feedback" style="display: none;">Vui lòng nhập tiêu đề
                                                    bài viết.</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="content-field" class="form-label">Nội Dung</label>
                                                <textarea id="content-field" name="content" rows="5" class="form-control" required></textarea>
                                                <div class="invalid-feedback" style="display: none;">Vui lòng nhập nội
                                                    dung bài viết.</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="category-field" class="form-label">Danh Mục</label>
                                                <select id="category-field" name="category_id" class="form-control"
                                                    required>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="thumbnail-field" class="form-label">Ảnh Đại Diện</label>
                                                <input type="file" id="thumbnail-field" name="thumbnail"
                                                    class="form-control" onchange="previewImage(event)">
                                                <!-- Container hiển thị preview -->
                                                <div id="image-preview" style="margin-top: 10px;"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status-field" class="form-label">Trạng Thái</label>
                                                <select id="status-field" name="is_active" class="form-control" required>
                                                    <option value="1">Hoạt Động</option>
                                                    <option value="0">Ẩn</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Đóng</button>
                                            <button type="submit" class="btn btn-success">Thêm</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal: Edit Post -->
                        <div class="modal fade" id="showModalEdit" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-light p-3">
                                        <h4>Sửa Bài Viết</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="" method="POST" enctype="multipart/form-data"
                                        class="tablelist-form edit" autocomplete="off">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-body">
                                            <input type="hidden" name="id" id="id-field-edit">
                                            <div class="mb-3">
                                                <label for="title-field-edit" class="form-label">Tiêu Đề</label>
                                                <input type="text" id="title-field-edit" name="title"
                                                    class="form-control" required>
                                                <div class="invalid-feedback" style="display: none;">Vui lòng nhập tiêu đề
                                                    bài viết.</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="content-field-edit" class="form-label">Nội Dung</label>
                                                <textarea id="content-field-edit" name="content" rows="5" class="form-control" required></textarea>
                                                <div class="invalid-feedback" style="display: none;">Vui lòng nhập nội
                                                    dung bài viết.</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="category-field-edit" class="form-label">Danh Mục</label>
                                                <select id="category-field-edit" name="category_id" class="form-control"
                                                    required>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="thumbnail-field-edit" class="form-label">Ảnh Đại Diện</label>
                                                <input type="file" id="thumbnail-field-edit" name="thumbnail"
                                                    class="form-control" onchange="previewImageEdit(event)">
                                                <!-- Container hiển thị preview -->
                                                <div id="image-preview-edit" style="margin-top: 10px;"></div>
                                                <!-- Nút hủy thay đổi ảnh -->
                                                <button type="button" class="btn btn-secondary btn-sm mt-2"
                                                    id="cancel-image-change" style="display: none;"
                                                    onclick="cancelImageChange()">Hủy thay đổi</button>
                                            </div>>
                                            <div class="mb-3">
                                                <label for="status-field-edit" class="form-label">Trạng Thái</label>
                                                <select id="status-field-edit" name="status" class="form-control"
                                                    required>
                                                    <option value="published">Published</option>
                                                    <option value="draft">Draft</option>
                                                    <option value="pending">Pending</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Đóng</button>
                                                <button type="submit" class="btn btn-success" id="add-btn">Cập Nhật
                                                    Bài Viết</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal: Delete Post -->
                        <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mt-2 text-center">
                                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                                colors="primary:#f7b84b,secondary:#f06548"
                                                style="width:100px;height:100px"></lord-icon>
                                            <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                <h4>Bạn có chắc không?</h4>
                                                <p class="text-muted mx-4 mb-0">Bạn có muốn xóa bài viết này không?</p>
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
                        <!-- End Delete Modal -->

                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection


@section('script')
    <script>
        //  controller truyền biến $postSlugs chứa danh sách bài viết với id và slug
        var postSlugs = @json($postSlugs);
    </script>
    <script>
        // Hàm tạo slug 
        function createSlug(text) {
            return text.toString().toLowerCase().trim()
                .replace(/\s+/g, '-') // Thay khoảng trắng bằng dấu gạch ngang
                .replace(/[^\w\-]+/g, '') // Loại bỏ ký tự đặc biệt
                .replace(/\-\-+/g, '-'); // Giảm số dấu gạch ngang liên tiếp
        }

        // Hàm preview ảnh cho form tạo 
        function previewImage(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('image-preview').innerHTML =
                        `<img src="${e.target.result}" alt="Preview" style="max-width:150px; max-height:150px; object-fit: cover;">`;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        //  xử lý preview ảnh và hủy thay đổi trong modal edit 
        let originalThumbnail = "";

        function previewImageEdit(event) {
            const input = event.target;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('image-preview-edit').innerHTML =
                        `<img src="${e.target.result}" alt="Preview" style="max-width:150px; max-height:150px; object-fit: cover;">`;
                    document.getElementById('cancel-image-change').style.display = "inline-block";
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function cancelImageChange() {
            document.getElementById('thumbnail-field-edit').value = "";
            if (originalThumbnail) {
                document.getElementById('image-preview-edit').innerHTML =
                    `<img src="${originalThumbnail}" alt="Current Thumbnail" style="max-width:150px; max-height:150px; object-fit: cover;">`;
            } else {
                document.getElementById('image-preview-edit').innerHTML = "";
            }
            document.getElementById('cancel-image-change').style.display = "none";
        }

        document.addEventListener("DOMContentLoaded", function() {
            //  xem chi tiết 
            document.querySelectorAll(".detail-item-btn").forEach((button) => {
                button.addEventListener("click", function() {
                    const title = this.getAttribute("data-title");
                    const categoryName = this.getAttribute("data-categoryname");
                    const user = this.getAttribute("data-user");
                    const status = this.getAttribute("data-status");
                    const content = this.getAttribute("data-content");
                    const thumbnail = this.getAttribute("data-thumbnail");

                    document.getElementById("detail-title").innerText = title;
                    document.getElementById("detail-category").innerText = categoryName;
                    document.getElementById("detail-user").innerText = user;
                    document.getElementById("detail-status").innerText = status;
                    document.getElementById("detail-content").innerText = content;

                    if (thumbnail) {
                        document.getElementById("detail-thumbnail").innerHTML =
                            `<img src="/uploads/posts/${thumbnail}" alt="${title}" style="max-width:100%; height:auto;">`;
                    } else {
                        document.getElementById("detail-thumbnail").innerHTML = "N/A";
                    }
                });
            });

            // Validate form cho create & edit post 
            const forms = document.querySelectorAll(".tablelist-form");
            forms.forEach((form) => {
                form.addEventListener("submit", function(event) {
                    let isValid = true;
                    const titleInput = form.querySelector("[name='title']");
                    const idField = form.querySelector("[name='id']");
                    const idPost = idField ? idField.value : "";
                    const slug = createSlug(titleInput.value);
                    form.querySelectorAll(".invalid-feedback").forEach(el => el.style.display =
                        "none");
                    form.querySelectorAll(".form-control").forEach(el => el.classList.remove(
                        "is-invalid"));

                    if (postSlugs.some((post) => post.slug === slug && post.id != idPost)) {
                        showError(titleInput, "Tiêu đề bài viết đã tồn tại.");
                        isValid = false;
                    }
                    if (titleInput.value.trim() === "") {
                        showError(titleInput, "Vui lòng nhập tiêu đề bài viết.");
                        isValid = false;
                    }
                    if (titleInput.value.trim().length > 100) {
                        showError(titleInput, "Tiêu đề bài viết quá dài.");
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

            //  chỉnh sửa 
            document.querySelectorAll(".edit-item-btn").forEach((button) => {
                button.addEventListener("click", function() {
                    const id = this.getAttribute("data-id");
                    const title = this.getAttribute("data-title");
                    const status = this.getAttribute("data-status");
                    const category = this.getAttribute("data-category");
                    const content = this.getAttribute("data-content");
                    const thumbnail = this.getAttribute("data-thumbnail");

                    document.getElementById("id-field-edit").value = id;
                    document.getElementById("title-field-edit").value = title;
                    document.getElementById("category-field-edit").value = category;
                    document.getElementById("status-field-edit").value = status || "0";
                    document.getElementById("content-field-edit").value = content || "";

                    if (thumbnail) {
                        originalThumbnail = `/uploads/posts/${thumbnail}`;
                        document.getElementById("image-preview-edit").innerHTML =
                            `<img src="${originalThumbnail}" alt="Current Thumbnail" style="max-width:150px; max-height:150px; object-fit: cover;">`;
                    } else {
                        originalThumbnail = "";
                        document.getElementById("image-preview-edit").innerHTML = "";
                    }
                    document.getElementById("cancel-image-change").style.display = "none";

                    let editForm = document.querySelector(".tablelist-form.edit");
                    if (editForm) {
                        editForm.setAttribute("action", `/admin/posts/${id}`);
                    }
                });
            });

            //  nút xóa 
            $(document).on('click', '.remove-item-btn', function() {
                let postId = $(this).data('id');
                if (!postId) {
                    console.error("Không tìm thấy ID bài viết cần xóa!");
                    return;
                }
                let actionUrl = `/admin/posts/${postId}`;
                $('#deleteForm').attr('action', actionUrl);
            });
        });
    </script>
@endsection

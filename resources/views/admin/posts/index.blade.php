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
                                    <h5 class="card-title mb-0">Danh Sách Bài Viết</h5>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex flex-wrap align-items-start gap-2">
                                        <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()">
                                            <i class="ri-delete-bin-2-line"></i>
                                        </button>
                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModalCreate">
                                            <i class="ri-add-line align-bottom me-1"></i> Thêm Bài Viết
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Search & Filter -->
                        <div class="card-body border-bottom-dashed border-bottom">
                            <form>
                                <div class="row g-3">
                                    <!-- Ô tìm kiếm chung -->
                                    <div class="col-xl-6">
                                        <div class="search-box">
                                            <input type="text" class="form-control search" placeholder="Tìm kiếm theo tiêu đề, danh mục, người viết...">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="row g-3">
                                            <!-- Trường chọn ngày -->
                                            <div class="col-sm-4">
                                                <input type="date" class="form-control" id="datepicker-range" data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true" placeholder="Chọn ngày">
                                            </div>
                                            <!-- Trường chọn trạng thái -->
                                            <div class="col-sm-4">
                                                <select class="form-control" data-plugin="choices" data-choices data-choices-search-false name="choices-single-default" id="idStatus">
                                                    <option value="">Trạng thái</option>
                                                    <option value="all" selected>All</option>
                                                    <option value="published">Published</option>
                                                    <option value="draft">Draft</option>
                                                    <option value="pending">Pending</option>
                                                </select>
                                            </div>
                                            <!-- Nút lọc -->
                                            <div class="col-sm-4">
                                                <button type="button" class="btn btn-primary w-100" onclick="SearchData();">
                                                    <i class="ri-equalizer-fill me-2 align-bottom"></i> Lọc
                                                </button>
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
                                            <th class="sort" data-sort="thumbnail">Ảnh Đại Diện</th>
                                            <th class="sort" data-sort="category">Danh Mục</th>
                                            <th class="sort" data-sort="user">Người Viết</th>
                                            <th class="sort" data-sort="status">Trạng Thái</th>
                                            <th class="sort" data-sort="action">Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @include('admin.posts.table', ['posts' => $posts])
                                    </tbody>
                                </table>
                            </div>
                            <!-- Phân trang -->
                            {{-- <div class="pagination">
                                {{ $posts->links() }}
                            </div> --}}
                        </div>

                        <!-- Các modal: Detail, Create, Edit, Delete -->
                        <!-- Modal: Xem Bài Viết -->
                        <div class="modal fade" id="showModalDetail" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-light p-3">
                                        <h4>Chi Tiết Bài Viết</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div id="detail-thumbnail" style="margin-bottom: 15px;"></div>
                                                <div id="detail-images" class="d-flex flex-wrap"></div>
                                            </div>
                                            <div class="col-md-8">
                                                <h5 id="detail-title"></h5>
                                                <p><strong>Danh Mục:</strong> <span id="detail-category"></span></p>
                                                <p><strong>Người Viết:</strong> <span id="detail-user"></span></p>
                                                <p><strong>Trạng Thái:</strong> <span id="detail-status" class="badge"></span></p>
                                                <hr>
                                                <div id="detail-content"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal: Create Post -->
                        @include('admin.posts.create_posts')

                        <!-- Modal: Edit Post -->
                        <div class="modal fade" id="showModalEdit" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-light p-3">
                                        <h4>Sửa Bài Viết</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="" method="POST" enctype="multipart/form-data" class="tablelist-form edit" autocomplete="off">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-body">
                                            <input type="hidden" name="id" id="id-field-edit">
                                            <div class="mb-3">
                                                <label for="title-field-edit" class="form-label">Tiêu Đề</label>
                                                <input type="text" id="title-field-edit" name="title" class="form-control" required>
                                                <div class="invalid-feedback" style="display: none;">Vui lòng nhập tiêu đề bài viết.</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="content-field-edit" class="form-label">Nội Dung</label>
                                                <textarea id="content-field-edit" name="content" rows="5" class="form-control" required></textarea>
                                                <div class="invalid-feedback" style="display: none;">Vui lòng nhập nội dung bài viết.</div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="category-field-edit" class="form-label">Danh Mục</label>
                                                <select id="category-field-edit" name="category_id" class="form-control" required>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="thumbnail-field-edit" class="form-label">Ảnh Đại Diện</label>
                                                <input type="file" id="thumbnail-field-edit" name="thumbnail" class="form-control" onchange="previewImageEdit(event)">
                                                <div id="image-preview-edit" style="margin-top: 10px;"></div>
                                                <button type="button" class="btn btn-secondary btn-sm mt-2" id="cancel-image-change" style="display: none;" onclick="cancelImageChange()">Hủy thay đổi</button>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status-field-edit" class="form-label">Trạng Thái</label>
                                                <select id="status-field-edit" name="status" class="form-control" required>
                                                    <option value="published">Published</option>
                                                    <option value="draft">Draft</option>
                                                    <option value="pending">Pending</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Các Ảnh Bài Viết Hiện Có</label>
                                                <div id="current-images-container-edit"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Thêm Hình Ảnh Mới</label>
                                                <div id="multiple-images-container-edit"></div>
                                                <button type="button" class="btn btn-secondary mt-2" onclick="addImageFieldEdit()">Thêm Hình Ảnh</button>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                                                <button type="submit" class="btn btn-success" id="add-btn">Cập Nhật Bài Viết</button>
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
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mt-2 text-center">
                                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                                            <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                <h4>Bạn có chắc không?</h4>
                                                <p class="text-muted mx-4 mb-0">Bạn có muốn xóa bài viết này không?</p>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Đóng</button>
                                            <form id="deleteForm" method="POST" action="">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn w-sm btn-danger" id="delete-record">Xóa!</button>
                                            </form>
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
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@section('script')
    <script>
        var postSlugs = @json($postSlugs);

        function SearchData() {
            var search = document.querySelector('.search').value;
            var status = document.getElementById('idStatus').value;
            var dateRange = document.getElementById('datepicker-range').value;

            var dates = dateRange.split(" to ");
            var startDate = dates[0] ? dates[0] : '';
            var endDate = dates[1] ? dates[1] : startDate;

            var data = {
                search: search,
                status: status
            };

            if (startDate) data.start_date = startDate;
            if (endDate) data.end_date = endDate;

            $.ajax({
                url: '{{ route('posts.index') }}',
                type: 'GET',
                data: data,
                success: function(response) {
                    $('#postTable tbody').html(response);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        function createSlug(text) {
            return text.toString().toLowerCase().trim()
                .replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '')
                .replace(/\-\-+/g, '-');
        }

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

        function addImageField() {
            var container = document.getElementById('multiple-images-container');
            var index = container.children.length;
            var html = `
                <div class="card mb-2" id="image-field-${index}">
                    <div class="card-body">
                        <div class="mb-2">
                            <label class="form-label">Chọn ảnh</label>
                            <input type="file" name="images_post[]" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Chú Thích Ảnh</label>
                            <input type="text" name="captions[]" class="form-control" placeholder="Nhập chú thích ảnh">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Thứ Tự Hiển Thị</label>
                            <input type="number" name="display_orders[]" class="form-control" value="0">
                        </div>
                        <button type="button" class="btn btn-danger" onclick="removeImageField(${index})">Xóa</button>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        }

        function removeImageField(index) {
            var field = document.getElementById('image-field-' + index);
            if (field) {
                field.remove();
            }
        }

        function addImageFieldEdit() {
            var container = document.getElementById('multiple-images-container-edit');
            var index = container.children.length;
            var html = `
                <div class="card mb-2" id="image-field-edit-${index}">
                    <div class="card-body">
                        <div class="mb-2">
                            <label class="form-label">Chọn ảnh</label>
                            <input type="file" name="images_post[]" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Chú Thích Ảnh</label>
                            <input type="text" name="captions[]" class="form-control" placeholder="Nhập chú thích ảnh">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Thứ Tự Hiển Thị</label>
                            <input type="number" name="display_orders[]" class="form-control" value="0">
                        </div>
                        <button type="button" class="btn btn-danger" onclick="removeImageFieldEdit(${index})">Xóa</button>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        }

        function removeExistingImage(imageId) {
            document.getElementById("delete-image-" + imageId).value = 1;
            var container = document.getElementById("current-image-" + imageId);
            if (container) {
                container.style.display = "none";
            }
        }

        function removeImageFieldEdit(index) {
            var field = document.getElementById('image-field-edit-' + index);
            if (field) {
                field.remove();
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".detail-item-btn").forEach((button) => {
                button.addEventListener("click", function() {
                    const title = this.getAttribute("data-title");
                    const categoryName = this.getAttribute("data-categoryname");
                    const user = this.getAttribute("data-user");
                    const status = this.getAttribute("data-status");
                    const content = this.getAttribute("data-content");
                    const thumbnail = this.getAttribute("data-thumbnail");
                    const imagesData = this.getAttribute("data-images");

                    document.getElementById("detail-title").innerText = title;
                    document.getElementById("detail-category").innerText = categoryName;
                    document.getElementById("detail-user").innerText = user;
                    document.getElementById("detail-status").innerText = status;
                    document.getElementById("detail-content").innerHTML = content;

                    if (thumbnail) {
                        document.getElementById("detail-thumbnail").innerHTML =
                            `<img src="/uploads/posts/${thumbnail}" alt="${title}" style="max-width:100%; height:auto;">`;
                    } else {
                        document.getElementById("detail-thumbnail").innerHTML = "Không có ảnh đại diện.";
                    }

                    let imagesHtml = "";
                    if (imagesData) {
                        let imagesArray = JSON.parse(imagesData);
                        if (imagesArray.length > 0) {
                            imagesArray.forEach(function(imagePath) {
                                imagesHtml += `<div class="p-1">
                                    <img src="/uploads/posts/${imagePath}" alt="${title}" style="width:100px; height:100px; object-fit:cover;">
                                </div>`;
                            });
                        } else {
                            imagesHtml = "<p>Không có ảnh bổ sung.</p>";
                        }
                    } else {
                        imagesHtml = "<p>Không có ảnh bổ sung.</p>";
                    }
                    document.getElementById("detail-images").innerHTML = imagesHtml;
                });
            });

            const forms = document.querySelectorAll(".tablelist-form");
            forms.forEach((form) => {
                form.addEventListener("submit", function(event) {
                    let isValid = true;
                    const titleInput = form.querySelector("[name='title']");
                    const idField = form.querySelector("[name='id']");
                    const idPost = idField ? idField.value : "";
                    const slug = createSlug(titleInput.value);
                    form.querySelectorAll(".invalid-feedback").forEach(el => el.style.display = "none");
                    form.querySelectorAll(".form-control").forEach(el => el.classList.remove("is-invalid"));

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

            document.querySelectorAll(".edit-item-btn").forEach((button) => {
                button.addEventListener("click", function() {
                    const id = this.getAttribute("data-id");
                    const title = this.getAttribute("data-title");
                    const category = this.getAttribute("data-category");
                    const status = this.getAttribute("data-status");
                    const content = this.getAttribute("data-content");
                    const images = JSON.parse(this.getAttribute("data-images") || '[]');

                    document.getElementById("id-field-edit").value = id;
                    document.getElementById("title-field-edit").value = title;
                    document.getElementById("category-field-edit").value = category;
                    document.getElementById("status-field-edit").value = status;
                    document.getElementById("content-field-edit").value = content;

                    let imagesHtml = "";
                    if (images && images.length > 0) {
                        images.forEach(function(image) {
                            imagesHtml += `
                                <div class="card mb-2" id="image-${image.id}">
                                    <div class="card-body">
                                        <img src="/uploads/posts/${image.image_path}" class="img-thumbnail mb-2" style="max-width: 200px;">
                                        <div class="form-group">
                                            <label>Chú thích</label>
                                            <input type="text" name="existing_images[${image.id}][caption]" class="form-control" value="${image.caption || ''}">
                                        </div>
                                        <div class="form-group">
                                            <label>Thứ tự</label>
                                            <input type="number" name="existing_images[${image.id}][display_order]" class="form-control" value="${image.display_order || 0}">
                                        </div>
                                        <div class="form-group">
                                            <label>Thay ảnh mới</label>
                                            <input type="file" name="existing_images[${image.id}][image]" class="form-control">
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" name="delete_images[]" value="${image.id}" class="form-check-input" id="delete-${image.id}">
                                            <label class="form-check-label" for="delete-${image.id}">Xóa ảnh</label>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                    } else {
                        imagesHtml = "<p>Không có ảnh nào.</p>";
                    }
                    document.getElementById("current-images-container-edit").innerHTML = imagesHtml;

                    let editForm = document.querySelector(".tablelist-form.edit");
                    if (editForm) {
                        editForm.setAttribute("action", `/admin/posts/${id}`);
                    }
                });
            });

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
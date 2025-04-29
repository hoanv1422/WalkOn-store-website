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
                    <!-- Các trường thông tin cơ bản -->
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
                    <!-- Ảnh đại diện -->
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

                    <!-- Phần thêm nhiều hình ảnh bài viết -->
                    <div class="mb-3">
                        <label class="form-label">Hình ảnh bài viết (nhiều ảnh)</label>
                        <!-- Container chứa danh sách các trường upload ảnh -->
                        <div id="multiple-images-container"></div>
                        <!-- Nút thêm trường upload ảnh -->
                        <button type="button" class="btn btn-secondary mt-2"
                            onclick="addImageField()">Thêm hình ảnh</button>
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

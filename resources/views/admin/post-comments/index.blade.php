@extends('admin.layouts.app')
@section('title', 'Quản Lý Bình Luận Bài Viết')
@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- Header -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card" id="commentList">
                    <div class="card-header border-bottom-dashed">
                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">Danh Sách Bình Luận</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                {{-- Các nút hành động nếu cần --}}
                            </div>
                        </div>
                    </div>
                    <!-- Search & Filter -->
                    <div class="card-body border-bottom-dashed border-bottom">
                        <form>
                            <div class="row g-3">
                                <div class="col-xl-6">
                                    <div class="search-box">
                                        <input type="text" class="form-control search" placeholder="Tìm kiếm theo nội dung, bài viết, người viết...">
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
                                                <select class="form-control" data-plugin="choices" data-choices data-choices-search-false
                                                        name="choices-single-default" id="idStatus">
                                                    <option value="">Trạng thái</option>
                                                    <option value="all" selected>All</option>
                                                    <option value="published">Published</option>
                                                    <option value="pending">Pending</option>
                                                    <option value="spam">Spam</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div>
                                                <button type="button" class="btn btn-primary w-100" onclick="SearchData();">
                                                    <i class="ri-equalizer-fill me-2 align-bottom"></i> Lọc
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Table danh sách bình luận -->
                    <div class="card-body">
                        <div class="table-responsive table-card mb-1">
                            <table id="commentTable" class="table align-middle dataTable">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col" style="width: 15px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll">
                                            </div>
                                        </th>
                                        <th class="sort" data-sort="content">Nội dung</th>
                                        <th class="sort" data-sort="parent">Bình luận cha</th>
                                        <th class="sort" data-sort="post">Bài viết</th>
                                        <th class="sort" data-sort="user">Người viết</th>
                                        <th class="sort" data-sort="status">Trạng thái</th>
                                        <th class="sort" data-sort="action">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all" id="commentTableBody">
                                    @include('admin.post-comments.table-rows', ['postComments' => $postComments])
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- End Table -->
                    
                    <!-- Modal: Edit Comment -->
                    <div class="modal fade" id="showModalEdit" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-light p-3">
                                    <h4>Sửa Bình Luận</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                </div>
                                <form action="" method="POST" class="tablelist-form edit" autocomplete="off">
                                    @csrf
                                    @method('PATCH')
                                    <div class="modal-body">
                                        <input type="hidden" name="id" id="id-field-edit" />
                                        <div class="mb-3">
                                            <label for="content-field-edit" class="form-label">Nội dung</label>
                                            <textarea id="content-field-edit" class="form-control" name="content" placeholder="Nhập nội dung bình luận"></textarea>
                                            <div class="invalid-feedback">Vui lòng nhập nội dung bình luận.</div>
                                        </div>
                                        <div>
                                            <label for="status-field-edit" class="form-label">Trạng thái</label>
                                            <select class="form-control" data-choices data-choices-search-false name="status" id="status-field-edit" required>
                                                <option value="published">Published</option>
                                                <option value="pending">Pending</option>
                                                <option value="spam">Spam</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                                            <button type="submit" class="btn btn-success" id="add-btn">Cập Nhật Bình Luận</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal: Delete Comment -->
                    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mt-2 text-center">
                                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                            <h4>Bạn có chắc không?</h4>
                                            <p class="text-muted mx-4 mb-0">Bạn có muốn xóa bình luận này không?</p>
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
                    <!-- End Modal -->
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // Khởi tạo DataTable (nếu sử dụng)
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

    // Xóa bình luận dùng jQuery
    $(document).on('click', '.remove-item-btn', function() {
        var commentId = $(this).data('id');
        if (!commentId) {
            console.error("Không tìm thấy ID bình luận cần xóa!");
            return;
        }
        var actionUrl = `/admin/post-comments/${commentId}`;
        $('#deleteForm').attr('action', actionUrl);
    });

    // Chỉnh sửa bình luận
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".edit-item-btn").forEach(function(button) {
            button.addEventListener("click", function() {
                var id = this.getAttribute("data-id");
                var content = this.getAttribute("data-content");
                var status = this.getAttribute("data-status");

                document.getElementById("id-field-edit").value = id;
                document.getElementById("content-field-edit").value = content;
                document.getElementById("status-field-edit").value = status;

                // Cập nhật action cho form chỉnh sửa
                var editForm = document.querySelector(".tablelist-form.edit");
                if (editForm) {
                    editForm.setAttribute("action", `/admin/post-comments/${id}`);
                }
            });
        });
    });

    // Hàm lọc bình luận qua AJAX
    function SearchData() {
        var searchQuery = $('.search').val();
        var status = $('#idStatus').val();
        var dateRange = $('#datepicker-range').val();

        $.ajax({
            url: "{{ route('post-comments.filter') }}",
            type: 'GET',
            data: {
                search: searchQuery,
                status: status,
                date: dateRange
            },
            success: function(response) {
                if (response.success) {
                    $('#commentTableBody').html(response.html);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr) {
                toastr.error('Có lỗi xảy ra khi lọc dữ liệu');
            }
            var actionUrl = `/admin/post-comments/${commentId}`;
            $('#deleteForm').attr('action', actionUrl);
        });
    }
</script>
@endsection

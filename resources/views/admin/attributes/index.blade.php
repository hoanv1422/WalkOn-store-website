@extends('admin.layouts.app')
@section('title', 'Thuộc Tính')
@section('content')
    <div class="page-content d-flex">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Kích Cỡ</h4>
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
                                        <h5 class="card-title mb-0">Danh Sách Kích Cỡ</h5>
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex flex-wrap align-items-start gap-2">
                                        <button class="btn btn-soft-danger" id="remove-actions"
                                            onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                            id="create-btn" data-bs-target="#showModalCreateSize"><i
                                                class="ri-add-line align-bottom me-1"></i> Thêm Thuộc Tính</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-bottom-dashed border-bottom">

                            
                            <div id="size-list">
                                @include('admin.attributes._listSize', ['sizes' => $sizes])
                            </div>
                           
                            
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="table-responsive table-card mb-1">
                                    {{-- Bảng Size --}}
                                </div>
                            </div>



                            <!--Modal Sizes -->
                            <div class="modal fade" id="showModalCreateSize" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h4>Thêm Mới Kích Cỡ</h4>
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form action="{{ route('sizes.store') }}" method="POST" class="tablelist-form"
                                            autocomplete="off">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" id="id-field" name="id" />

                                                <div class="mb-3">
                                                    <label for="size-field" class="form-label">Nhập size</label>
                                                    <input type="text" id="size-field" class="form-control"
                                                        placeholder="Nhập tên" name="size" />
                                                    <div class="invalid-feedback">Please enter a customer name.</div>
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

                            <div class="modal fade" id="showModalEditSize" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h4>Sửa Kích Cỡ</h4>
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form action="" method="POST" class="tablelist-form edit-size"
                                            autocomplete="off">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <input type="hidden" name="id" id="id-field-edit-size" />

                                                <div class="mb-3">
                                                    <label for="size-field" class="form-label">Tên</label>
                                                    <input type="text" id="size-field-edit" class="form-control"
                                                        placeholder="Nhập tên" name="size" />
                                                    <div class="invalid-feedback">Please enter a customer name.</div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-success" id="add-btn">Cập
                                                        Nhật</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade zoomIn" id="deleteRecordModalSize" tabindex="-1" aria-hidden="true">
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
                                                    <p class="text-muted mx-4 mb-0">Bạn có muốn xóa kích cỡ này không ?
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                <button type="button" class="btn w-sm btn-light"
                                                    data-bs-dismiss="modal">Đóng</button>
                                                <form id="deleteFormSize" action="" method="POST">
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


        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Màu Sắc</h4>
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
                                        <h5 class="card-title mb-0">Danh Sách Màu Sắc</h5>
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex flex-wrap align-items-start gap-2">
                                        <button class="btn btn-soft-danger" id="remove-actions"
                                            onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                            id="create-btn" data-bs-target="#showModalCreateColor"><i
                                                class="ri-add-line align-bottom me-1"></i> Thêm Thuộc Tính</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-bottom-dashed border-bottom">                           
                            <div id="color-list">
                                @include('admin.attributes._listColor', ['colors' => $colors])
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="table-responsive table-card mb-1">
                                    {{-- Bảng color --}}
                                </div>
                            </div>


                            <!--Modal Colors -->
                            <div class="modal fade" id="showModalCreateColor" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h4>Thêm Mới Màu Sắc</h4>
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form action="{{ route('colors.store') }}" method="POST" class="tablelist-form"
                                            autocomplete="off">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" name="id" id="id-field" />


                                                <div class="mb-3">
                                                    <label for="color-field" class="form-label">Tên</label>
                                                    <input type="text" id="color-field" class="form-control"
                                                        placeholder="Nhập tên" name="color" />
                                                    <div class="invalid-feedback">Please enter a customer name.</div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="color-field" class="form-label">Mã màu</label>
                                                    <div class="d-flex align-items-center">
                                                        <input type="color" id="code-field-create" class="form-control form-control-color me-2" name="code" />
                                                        <span id="color-preview-create" class="border p-2 rounded"
                                                            style="width: 50px; height: 30px; display: inline-block;"></span>
                                                    </div>
                                                    <div class="invalid-feedback">Please enter a customer code.</div>
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

                            <div class="modal fade" id="showModalEditColor" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-light p-3">
                                            <h4>Sửa Màu Sắc</h4>
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form action="" method="POST" class="tablelist-form edit-color"
                                            autocomplete="off">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <input type="hidden" name="id" id="id-field-edit-color" />

                                                <div class="mb-3">
                                                    <label for="color-field" class="form-label">Tên</label>
                                                    <input type="text" id="color-field-edit" class="form-control"
                                                        placeholder="Nhập tên" name="color" />
                                                    <div class="invalid-feedback">Please enter a customer name.</div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="color-field" class="form-label">Mã màu</label>
                                                    <input type="color" id="code-field-edit" class="form-control "
                                                        placeholder="Nhập tên" name="code" />
                                                    <div class="invalid-feedback">Please enter a customer code.</div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-success" id="add-btn">Cập
                                                        Nhật</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade zoomIn" id="deleteRecordModalColor" tabindex="-1"
                                aria-hidden="true">
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
                                                    <p class="text-muted mx-4 mb-0">Bạn có muốn xóa màu sắc này không?
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                <button type="button" class="btn w-sm btn-light"
                                                    data-bs-dismiss="modal">Đóng</button>
                                                <form id="deleteFormColor" method="POST" action="">
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
        var sizes = @json($sizeSlug);
        var colors = @json($colorSlug);
    </script>

    <script src="{{ asset('templates/admin/assets/libs/validates/CreateSlug.js') }}"></script>
    {{-- <script src="{{ asset('templates/admin/assets/libs/validates/attributes.js') }}"></script> --}}
    <script src="{{ asset('templates/admin/assets/libs/validates/size.js') }}"></script>
    <script src="{{ asset('templates/admin/assets/libs/validates/color.js') }}"></script>

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
            let type = $(this).data('type'); // Lấy loại thuộc tính (size hoặc color)

            let actionUrl = "/admin/attributes/" + type + "/" + userId; // Tạo URL xóa

            if (type === 'size') {
                $('#deleteFormSize').attr('action', actionUrl); // Cập nhật action form size
            } else if (type === 'color') {
                $('#deleteFormColor').attr('action', actionUrl); // Cập nhật action form color
            }
        });
    </script> 
@endsection

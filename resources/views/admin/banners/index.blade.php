@extends('admin.layouts.app')
@section('title', 'Banner')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                    <h4 class="mb-sm-0">Quản lý Banner</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Thương Mại Điện Tử</a></li>
                            <li class="breadcrumb-item active">Quản lý Banner</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card" id="customerList">
                    <div class="card-header border-bottom-dashed">

                        <div class="row g-4 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">Danh Sách Banner</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div class="d-flex flex-wrap align-items-start gap-2">
                                    {{-- <button class="btn btn-soft-danger" id="remove-actions"
                                        onClick="deleteMultiple()"><i class="ri-delete-bin-2-line"></i></button>
                                    <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal"
                                        id="create-btn" data-bs-target="#showModalCreate"><i
                                            class="ri-add-line align-bottom me-1"></i> </button> --}}
                                            <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBannerModal">
                                                Thêm Banner
                                            </a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                            <div class="table-responsive table-card mb-1">
                                
                        
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Vị trí</th>
                                        <th>Hình ảnh</th>
                                        <th>Tiêu đề</th>
                                        <th>Link</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($banners as $banner)
                                    <tr>
                                        <td>{{ $banner->position }}</td>
                                        <td><img src="{{ asset('storage/' . $banner->image_url) }}" width="100"></td>
                                        <td>{{ $banner->title }}</td>
                                        <td><a href="{{ $banner->link }}" target="_blank">{{ $banner->link }}</a></td>
                                        <td>
                                            <button class="btn btn-warning edit-banner-btn" 
                                            data-id="{{ $banner->id }}" 
                                            data-title="{{ $banner->title }}" 
                                            data-link="{{ $banner->link }}" 
                                            data-position="{{ $banner->position }}" 
                                            data-image="{{ asset('storage/' . $banner->image_url) }}">
                                            Sửa
                                        </button>
                                        
                                            
                                            <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Xóa banner này?')">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>




                       
                    </div>

                </div>

            </div>
            <!--end col-->
        </div>
        
    
        
    </div>
    <!-- container-fluid -->
</div>
<div class="modal fade" id="showModalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h4>Sửa Banner</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editBannerForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" id="banner_id">

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title-field" class="form-label">Tiêu đề</label>
                        <input type="text" class="form-control" id="title-field" name="title">
                    </div>

                    <div class="mb-3">
                        <label for="link-field" class="form-label">Link</label>
                        <input type="url" class="form-control" id="link-field" name="link">
                    </div>

                    <div class="mb-3">
                        <label for="position-field" class="form-label">Vị trí</label>
                        <input type="number" class="form-control" id="position-field" name="position" >
                    </div>

                    <div class="mb-3">
                        <label for="image-field" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" id="image-field" name="image">
                        <img id="previewImage" src="" width="100" class="mt-2">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-success">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Popup Create -->
<div class="modal fade" id="addBannerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h4>Thêm Banner</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addBannerForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Tiêu đề</label>
                        <input type="text" class="form-control" name="title">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Link</label>
                        <input type="url" class="form-control" name="link">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Vị trí</label>
                        <input type="number" class="form-control" name="position" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" name="image" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-success">Thêm mới</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $(document).ready(function () {
        // Khi bấm vào nút "Sửa"
        $('.edit-banner-btn').click(function () {
            let bannerId = $(this).data('id');
            let title = $(this).data('title');
            let link = $(this).data('link');
            let position = $(this).data('position');
            let image = $(this).data('image');

            // Gán giá trị vào modal
            $('#banner_id').val(bannerId);
            $('#title-field').val(title);
            $('#link-field').val(link);
            $('#position-field').val(position);
            $('#previewImage').attr('src', image);

            // Hiển thị modal
            $('#showModalEdit').modal('show');
        });

        // AJAX submit form
        $('#editBannerForm').submit(function (e) {
            e.preventDefault(); 

            let formData = new FormData(this);
            let bannerId = $('#banner_id').val();
            let updateUrl = "{{ url('admin/banners') }}/" + bannerId;

            $.ajax({
                url: updateUrl,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        alert(response.message);
                        location.reload(); 
                    }
                },
                error: function (xhr) {
                    alert('Cập nhật thất bại! Kiểm tra dữ liệu');
                }
            });
        });
        //Create Banner
        $('#addBannerForm').submit(function (e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('admin.banners.store') }}", 
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        alert(response.message);
                        $('#addBannerModal').modal('hide'); 
                        location.reload(); 
                    }
                },
                error: function (xhr) {
                    alert('Thêm banner thất bại! Vui lòng kiểm tra dữ liệu.');
                }
            });
        });
    });
   
</script>
@endsection


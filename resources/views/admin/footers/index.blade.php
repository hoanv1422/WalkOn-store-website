@extends('admin.layouts.app')
@section('title', 'Thương Hiệu')
@section('content')
<style>
    .website-info-container {
        max-width: 700px;
        margin: 40px auto;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
    }
    
    .website-info-container h2 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
    }
    
    .info-group {
        margin-bottom: 15px;
    }
    
    .info-group label {
        font-weight: bold;
        color: #555;
        display: block;
        margin-bottom: 5px;
    }
    
    .info-group p {
        margin: 0;
        color: #222;
        line-height: 1.5;
    }
    
    .logo-img {
        max-width: 150px;
        border: 1px solid #ccc;
        padding: 5px;
        border-radius: 6px;
    }
    
    .btn-container {
        margin-top: 25px;
        text-align: right;
    }
    
    .edit-btn {
        display: inline-block;
        padding: 10px 18px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 6px;
        transition: background-color 0.3s ease;
    }
    
    .edit-btn:hover {
        background-color: #0056b3;
    }
</style>
<div class="page-content">
    <div class="website-info-container">
        <h2>Thông Tin Website</h2>
    
        <div class="info-group">
            <label>Tên Website:</label>
            <p>{{ $info->site_name }}</p>
        </div>
    
        <div class="info-group">
            <label>Logo:</label>
            @if ($info->logo)
                <img src="{{ Storage::url($info->logo) }}" alt="Logo" class="logo-img">
            @else
                <p><em>Chưa có logo</em></p>
            @endif
        </div>
    
        <div class="info-group">
            <label>Email:</label>
            <p>{{ $info->email }}</p>
        </div>
    
        <div class="info-group">
            <label>Số điện thoại:</label>
            <p>{{ $info->phone_number ?? 'Không có' }}</p>
        </div>
    
        <div class="info-group">
            <label>Địa chỉ:</label>
            <p>{{ $info->address ?? 'Không có' }}</p>
        </div>
    
        <div class="info-group">
            <label>Mô tả:</label>
            <p>{{ $info->description ?? 'Không có' }}</p>
        </div>
    
        <div class="btn-container">
            <a href="#showModalEdit" data-bs-toggle="modal"
            class="text-primary d-inline-block edit-info-btn"
            data-id="{{ $info->id }}"
            data-logo="{{ Storage::url($info->logo) }}"
            data-site_name="{{ $info->site_name }}"
            data-email="{{$info->email}}"
            data-phone_number="{{$info->phone_number}}"
            data-description="{{ $info->description }}">
            <i class="ri-pencil-fill fs-16"></i>
            </a>
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
                        <form action="{{ route('footers.update', $info->id) }}" method="POST" class="tablelist-form edit" autocomplete="off" enctype="multipart/form-data">
                            
                            @csrf
                            @method('PUT')
                            <div class="modal-body">

                                <input type="hidden" name="id" id="id-field-edit" value=""/>

                                <div class="text-center">
                                    <div class="position-relative d-inline-block">
                                        <div class="position-absolute top-100 start-100 translate-middle">
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
                                                id="product-image-input-edit" name="logo"
                                                type="file" accept="image/png, image/gif, image/jpeg"
                                                onchange="previewImageEdit(event)" >
                                        </div>
                                        <div class="avatar-lg">
                                            <div class="avatar-title bg-light rounded overflow-hidden">
                                                <img src="{{ $info->logo ? asset('storage/' . $info->logo) : asset('images/default-logo.png') }}"
                                                 id="product-img-edit" class="avatar-md h-auto" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="name-field" class="form-label">Tên cửa hàng</label>
                                    <input type="text" id="name-field" class="form-control"
                                        placeholder="Nhập tên cửa hàng" name="site_name" value="{{$info->site_name}}" />
                                    <div class="invalid-feedback">Please enter a customer name.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="description-field" class="form-label">Email</label>
                                    <input type="text" id="description-field" class="form-control"
                                        placeholder="Nhập email" name="email" value="{{$info->email}}" />
                                    <div class="invalid-feedback">Please enter a customer name.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="description-field" class="form-label">Số điện thoại</label>
                                    <input type="text" id="description-field" class="form-control"
                                        placeholder="Nhập số điện thoại" name="phone_number" value="{{$info->phone_number}}" />
                                    <div class="invalid-feedback">Please enter a customer name.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="description-field" class="form-label">Địa chỉ</label>
                                    <input type="text" id="description-field" class="form-control"
                                        placeholder="Nhập địa chỉ" name="address" value="{{$info->address}}"/>
                                    <div class="invalid-feedback">Please enter a customer name.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="description-field" class="form-label">Ghi chú</label>
                                    <input type="text" id="description-field" class="form-control"
                                        placeholder="Nhập ghi chú" name="description" value="{{$info->description}}"/>
                                    <div class="invalid-feedback">Please enter a customer name.</div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light"
                                        data-bs-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-success" id="add-btn">Sửa
                                    </button>
                                </div>
                            </div>
                        </form>
                </div>

            </div>
        </div>
    </div>
    
</div>
<script src="{{ asset('templates/admin/assets/libs/gallery/gallery.js') }}"></script>
<script>
    // Hàm preview hình ảnh khi chọn
    function previewImageEdit(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('product-img-edit');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
    </script>
@endsection
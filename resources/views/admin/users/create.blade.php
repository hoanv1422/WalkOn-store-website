@extends('admin.layouts.app')
@section('title', 'Thêm user')
@section('content')
<div class=" ">
    <div class="container-fluid p-0 sm_padding_15px">
        <div class="row justify-content-center">

            <div class="">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">Thêm Mới Người dùng</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">

                        <form action="{{route('admin.user.add')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 row">
                                <label for="inputEmail3" class="form-label col-sm-4 col-form-label">Username</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Username...." name="username" value="{{old('username')}}">
                                </div>
                            </div>
                            @error('username') <span style="color:red">{{$message}}</span> @enderror
                            <div class="mb-3 row">
                                <label for="inputPassword3" class="form-label col-sm-4 col-form-label">Mật khẩu</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="password" value="{{old('password')}}"
                                        placeholder="Password.......">
                                </div>
                            </div>
                            @error('password') <span style="color:red">{{$message}}</span> @enderror

                            <div class="mb-3 row">
                                <label for="inputEmail3" class="form-label col-sm-4 col-form-label">Tên người dùng</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Name...." name="name" value="{{old('name')}}">
                                </div>
                            </div>
                            @error('username') <span style="color:red">{{$message}}</span> @enderror

                            <div class="mb-3 row">
                                <label for="inputEmail3" class="form-label col-sm-4 col-form-label">Mail</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Mail...." name="mail" value="{{old('mail')}}">
                                </div>
                            </div>
                            @error('mail') <span style="color:red">{{ $message }}</span> @enderror

                            <div class="mb-3 row">
                                <label for="inputAvatar" class="form-label col-sm-4 col-form-label">Ảnh đại diện</label>
                                <div class="col-sm-8">
                                    <input type="file" name="avatar" id="inputAvatar" class="form-control" onchange="previewImage(event)">
                                    <img id="avatarPreview" src="#" alt="Ảnh đại diện" class="d-none mt-2" style="max-width: 150px;">
                                </div>
                            </div>
                            @error('avatar') <span style="color:red">{{ $message }}</span> @enderror

                            @if(isset($user->avatar))
                            <img src="{{ asset($user->avatar) }}" alt="Avatar" style="max-width: 150px;">
                            @endif


                            <div class="mb-3 row">
                                <label for="inputEmail3" class="form-label col-sm-4 col-form-label">Số điện thoại</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="inputEmail3" placeholder="Phone...." name="phone" value="{{old('phone')}}">
                                </div>
                            </div>
                            @error('phone') <span style="color:red">{{$message}}</span> @enderror

                            <div class="mb-3 row">
                                <label for="inputEmail3" class="form-label col-sm-4 col-form-label">Địa chỉ</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Address...." name="address" value="{{old('address')}}">
                                </div>
                            </div>
                            @error('address') <span style="color:red">{{$message}}</span> @enderror

                            <div class="mb-3 row">
                                <label for="inputEmail3" class="form-label col-sm-4 col-form-label">Email_verified</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Điền ngày tháng năm đầy đủ...." name="email_verified_at" value="{{old('email_verified_at')}}">
                                </div>
                            </div>
                            @error('email_verified_at') <span style="color:red">{{$message}}</span> @enderror

                            <div class="mb-3 row">
                                <label for="inputEmail3" class="form-label col-sm-4 col-form-label">Vai trò</label>
                                <div class="col-sm-8">
                                    <select name="role" class="form-control">
                                        <option value="" disabled selected>===Chọn vai trò===</option>
                                        <option value="user" {{ old('role', $user->role ?? '') == 'user' ? 'selected' : '' }}>User</option>
                                        <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </div>
                            </div>
                            @error('role') <span style="color:red">{{$message}}</span> @enderror

                            <div class=" row">
                                <div class="col-sm-10">
                                    <div class="add_button ">
                                        <button class="btn btn-primary btn-sm mx-1" type="submit"> <i class="fas fa-plus me-1"></i>Add new</button></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById("avatarPreview");

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove("d-none");
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush

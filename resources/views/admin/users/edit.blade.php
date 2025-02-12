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
                                <h3 class="m-0">Sửa Người dùng</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <form action="{{route('admin.user.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{$user->id}}" />
                            <div class="mb-3 row">
                                <label for="inputEmail3" class="form-label col-sm-4 col-form-label">Username</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Username...." name="username" value="{{$user->username}}">
                                </div>
                            </div>
                            @error('username') <span style="color:red">{{$message}}</span> @enderror
                            <div class="mb-3 row">
                                <label for="inputPassword3" class="form-label col-sm-4 col-form-label">Mật khẩu</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="password" value="{{$user->password}}"
                                        placeholder="Password......">
                                </div>
                            </div>
                            @error('password') <span style="color:red">{{$message}}</span> @enderror

                            <div class="mb-3 row">
                                <label for="inputEmail3" class="form-label col-sm-4 col-form-label">Tên người dùng</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Name...." name="name" value="{{$user->name}}">
                                </div>
                            </div>
                            @error('name') <span style="color:red">{{$message}}</span> @enderror

                            <div class="mb-3 row">
                                <label for="inputEmail3" class="form-label col-sm-4 col-form-label">Mail</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Mail...." name="mail" value="{{$user->mail}}">
                                </div>
                            </div>
                            @error('mail') <span style="color:red">{{$message}}</span> @enderror

                            <div class="mb-3 row">
                                <label for="inputAvatar" class="form-label col-sm-4 col-form-label">Ảnh đại diện</label>
                                <div class="col-sm-8">
                                    @if($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="img-thumbnail mb-2" width="100">
                                    @endif
                                    <input type="file" name="avatar" class="form-control" id="inputAvatar">
                                </div>
                            </div>
                            @error('avatar')
                            <span class="alert alert-danger text-center">{{ $message }}</span>
                            @enderror


                            <div class="mb-3 row">
                                <label for="inputEmail3" class="form-label col-sm-4 col-form-label">Số điện thoại</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="inputEmail3" placeholder="Phone...." name="phone" value="{{$user->phone}}">
                                </div>
                            </div>
                            @error('phone') <span style="color:red">{{$message}}</span> @enderror

                            <div class="mb-3 row">
                                <label for="inputEmail3" class="form-label col-sm-4 col-form-label">Address</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Address...." name="address" value="{{$user->address}}">
                                </div>
                            </div>
                            @error('address') <span style="color:red">{{$message}}</span> @enderror

                            <div class="mb-3 row">
                                <label for="inputEmail3" class="form-label col-sm-4 col-form-label">Email_verified</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Điền ngày tháng năm đầy đủ....." name="email_verified_at" value="{{$user->email_verified_at}}">
                                </div>
                            </div>
                            @error('email_verified_at') <span style="color:red">{{$message}}</span> @enderror

                            <div class="mb-3 row">
                                <label for="inputEmail3" class="form-label col-sm-4 col-form-label">Vai trò</label>
                                <div class="col-sm-8">
                                    <div class="col-sm-8">
                                        <select name="role" class="form-control">
                                            <option value="user" {{ old('role', $user) == 'user' ? 'selected' : '' }}>User</option>
                                            <option value="admin" {{ old('role', $user) == 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @error('role') <span style="color:red">{{$message}}</span> @enderror
                            <div class=" row">
                                <div class="col-sm-10">
                                    <div class="add_button ">
                                        <button class="btn btn-success btn-sm mx-1" type="submit"><i class="fas fa-edit"></i> Edit </button></button>
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

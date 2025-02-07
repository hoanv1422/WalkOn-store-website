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
                            @error('username') <span class="alert-alert-danger text-center">{{$message}}</span> @enderror
                            <div class="mb-3 row">
                                <label for="inputPassword3" class="form-label col-sm-4 col-form-label">password</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="password" value="{{old('password')}}"
                                        placeholder="Password.......">
                                </div>
                            </div>
                            @error('password') <span class="alert-alert-danger text-center">{{$message}}</span> @enderror

                            <div class="mb-3 row">
                                <label for="inputEmail3" class="form-label col-sm-4 col-form-label">Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Name...." name="name" value="{{old('name')}}">
                                </div>
                            </div>
                            @error('name') <span class="alert-alert-danger text-center">{{$message}}</span> @enderror

                            <div class="mb-3 row">
                                <label for="inputEmail3" class="form-label col-sm-4 col-form-label">Mail</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Mail...." name="mail" value="{{old('mail')}}">
                                </div>
                            </div>
                            @error('mail') <span class="alert-alert-danger text-center">{{$message}}</span> @enderror

                            <div class="mb-3 row">
                                <label for="inputEmail3" class="form-label col-sm-4 col-form-label">Avatar</label>
                                <div class="col-sm-8">
                                <input type="file" name="avatar" value="{{old('avatar')}} class="form-control">
                                </div>
                            </div>
                            @error('avatar') <span class="alert-alert-danger text-center">{{$message}}</span> @enderror

                            <div class="mb-3 row">
                                <label for="inputEmail3" class="form-label col-sm-4 col-form-label">Phone</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="inputEmail3" placeholder="Phone...." name="phone" value="{{old('phone')}}">
                                </div>
                            </div>
                            @error('phone') <span class="alert-alert-danger text-center">{{$message}}</span> @enderror

                            <div class="mb-3 row">
                                <label for="inputEmail3" class="form-label col-sm-4 col-form-label">Address</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Address...." name="address" value="{{old('address')}}">
                                </div>
                            </div>
                            @error('address') <span class="alert-alert-danger text-center">{{$message}}</span> @enderror

                            <div class="mb-3 row">
                                <label for="inputEmail3" class="form-label col-sm-4 col-form-label">Email_verified</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="Email_verified...." name="email_verified_at" value="{{old('email_verified_at')}}">
                                </div>
                            </div>
                            @error('email_verified_at') <span class="alert-alert-danger text-center">{{$message}}</span> @enderror

                            <div class="mb-3 row">
                                <label for="inputEmail3" class="form-label col-sm-4 col-form-label">Role</label>
                                <div class="col-sm-8">
                                    <select name="role" class="form-control">
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>
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

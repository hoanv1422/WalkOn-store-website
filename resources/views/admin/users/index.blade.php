@extends('admin.layouts.app')
@section('title', 'Danh sách người dùng')
@section('content')
<div class="main_content_iner ">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="white_card card_height_100 mb_30">
                    <div class="white_card_header">
                        <div class="box_header m-0">
                            <div class="main-title">
                                <h3 class="m-0">Danh sách</h3>
                            </div>
                        </div>
                    </div>
                    <div class="white_card_body">
                        <div class="QA_section">
                            <div class="white_box_tittle list_header">
                                <h4>Danh sách người dùng</h4>
                                <div class="box_right d-flex lms_block">
                                    <div class="search_field_2">
                                        <div class="search_inner">
                                            <form action="#" class="d-flex">
                                                <input type="text" class="form-control" placeholder="Search here..." aria-label="Search">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="QA_table mb_30">
                                <div class="add_button ">
                                    <a href="{{url('admin/users/create')}}" data-bs-toggle="modal" data-bs-target="#addcategory" class="btn btn-primary btn-sm mx-1">
                                        <i class="fas fa-plus me-1"></i> Add new
                                    </a>
                                </div>
                                @if(session('status'))
                                <div class="alert alert-success mt-2">
                                    {{ session('status') }}
                                </div>
                                @endif
                                @if(session('error'))
                                <div class="alert alert-danger mt-2">
                                    <span style="color:red">{{ session('error') }}</span>
                                </div>
                                @endif
                                <!-- table-responsive -->
                                <table class="table-responsive lms_table_active text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Mật khẩu</th>
                                            <th scope="col">Tên người dùng</th>
                                            <th scope="col">Mail</th>
                                            <th scope="col">Ảnh đại diện</th>
                                            <th scope="col">Số điện thoại</th>
                                            <th scope="col">Địa chỉ</th>
                                            <th scope="col">Email_Verified_At</th>
                                            <th scope="col">Vai trò</th>
                                            <th scope="col">Tính năng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user )
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->username}}</td>
                                            <td>{{$user->password}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->mail}}</td>
                                            <td><img src="{{asset('users/')}}/{{$user->avatar}}" alt="{{$user->name}}" width="50"></td>
                                            <td>{{$user->phone}}</td>
                                            <td>{{$user->address}}</td>
                                            <td>{{$user->email_verified_at}}</td>
                                            <td>{{ $user->role }}</td>
                                            <td class="d-flex gap-2">
                                                <a href="{{ route('admin.user.edit', ['id' => $user->id]) }}">
                                                    <button class="btn btn-success btn-sm">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                </a>

                                                <form class="delete-form" action="{{ route('admin.user.delete', ['id' => $user->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm mx-1">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </button>
                                                </form>
                                                <a href="{{ route('admin.user.detail', ['id' => $user->id]) }}">
                                                    <button class="btn btn-light btn-sm mx-1"><i class="fas fa-eye"></i> View</button>
                                                </a>
                                                <td />
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">

            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts');
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".delete-form").forEach(form => {
            form.addEventListener("submit", function(e) {
                if (!confirm("Bạn có chắc chắn muốn xóa người dùng này không?")) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endscript

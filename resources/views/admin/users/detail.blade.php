@extends('admin.layouts.app')
@section('title', 'Chi tiết người dùng shop')
@section('content')
<section class="section about-section gray-bg" id="about">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-lg-6">
                <div class="about-text go-to ">
                    <h3 class="dark-color pl-2">Người dùng : {{$user->username}}</h3>
                    <h6 class="theme-color lead">Dev Code time with Walkon Dev Team kakaa</h6>
                    <p>Tôi <mark>dev zai và bạn cx vậy</mark> !Lorem ipsum dolor sit, amet consectetur adipisicing elit. Excepturi consectetur similique, fugit facilis harum corporis totam, dignissimos adipisci ducimus dolore alias provident hic nostrum. Molestias pariatur repudiandae animi atque quas.</p>
                    <div class="row about-list">
                        <div class="col-md-6">
                            <div class="media">
                                <label>Tên thật</label>
                                <p>{{$user->name}}</p>
                            </div>
                            <div class="media">
                                <label>Địa chỉ</label>
                                <p>{{$user->address}}</p>
                            </div>
                            <div class="media">
                                <label>Mật khẩu</label>
                                <p style="word-break: break-all;">{{ $user->password }}</p>
                            </div>
                            <a href="{{ route('admin.users') }}">
                                <button class="btn btn-primary btn-sm mt-4">
                                    <i class="fas fa-arrow-left"></i> Back
                                </button>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <div class="media">
                                <label>Số điện thoại</label>
                                <p>{{$user->phone}}</p>
                            </div>
                            <div class="media">
                                <label>Ngày xác nhập email</label>
                                <p>{{$user->email_verified_at}}</p>
                            </div>
                            <div class="media">
                                <label>Vai trò</label>
                                <p style="color:green">{{$user->role}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-avatar">
                    <img src="{{asset('storage/')}}/{{$user->avatar}}" alt="{{$user->name}}" style="margin-left:40px;border:0.5px solid #ddd;border-radius:5px;width:400px;height:400px">
                </div>
            </div>
        </div>
    </div>
    @endsection

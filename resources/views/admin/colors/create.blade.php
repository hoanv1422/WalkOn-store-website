@extends('admin.layouts.app')
@section('title', 'THem MAU SAC')
@section('content')
<form action="{{ route('colors.store') }}" method="post">
    @csrf
    <div>
        <label for="">mã màu</label>
        <input type="text" name="color">
        <button type="submit">tạo mới</button>
    </div>
</form>
@endsection
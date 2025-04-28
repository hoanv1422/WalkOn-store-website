@extends('admin.layouts.app')
@section('title', 'SUA MAU SAC')
@section('content')
<form action="{{ route('colors.update',$color) }}" method="post">
    @csrf
    @method('PUT')
    <div>
        <label for="">mã màu</label>
        <input type="text" name="color" value="{{ $color->color }}">
        <button type="submit">Cập Nhật</button>
    </div>
</form>
@endsection
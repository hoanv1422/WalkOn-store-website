@extends('admin.layouts.app')
@section('title', 'SUA MAU SAC')
@section('content')
<form action="{{ route('sizes.update',$size) }}" method="post">
    @csrf
    @method('PUT')
    <div>
        <label for="">kích cỡ</label>
        <input type="text" name="size" value="{{ $size->size }}">
        <button type="submit">Cập Nhật</button>
    </div>
</form>
@endsection
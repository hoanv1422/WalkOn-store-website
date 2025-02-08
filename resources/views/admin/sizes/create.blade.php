@extends('admin.layouts.app')
@section('title', 'THem MAU SAC')
@section('content')
<form action="{{ route('sizes.store') }}" method="post">
    @csrf
    <div>
        <label for="">kích cỡ</label>
        <input type="text" name="size">
        <button type="submit">tạo mới </button>
    </div>
</form>
@endsection
@extends('client.layouts.app')

@section('title', 'Cửa Hàng')

@section('css')
<style>
/* Định dạng ô nhập giá trên cùng một hàng */
.price-inputs {
    display: flex;
    align-items: center;
    gap: 10px;
}

.price-inputs input {
    width: 45%;
    padding: 5px;
    border: 1px solid #ddd;
    border-radius: 4px;
    text-align: center;
}

.price-inputs span {
    font-weight: bold;
}
</style>
@endsection

@section('content')
    @include('client.pages.shop.banner')
    @include('client.components.breadcrumb')
    @include('client.pages.shop.product')
@endsection

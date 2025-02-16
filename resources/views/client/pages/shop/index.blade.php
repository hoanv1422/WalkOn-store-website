@extends('client.layouts.app')

@section('title', 'Cửa Hàng')

@section('content')
    @include('client.pages.shop.banner')
    @include('client.components.breadcrumb')
    @include('client.pages.shop.product')
@endsection

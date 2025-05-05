@extends('client.layouts.app')

@section('title', 'Đơn Hàng Đã Đặt')
@section('breadcrumb', 'Đơn Hàng Đã Đặt')
@section('style')
@endsection

@section('content')
    @include('client.components.breadcrumb')
    @include('client.pages.order.orders')
@endsection
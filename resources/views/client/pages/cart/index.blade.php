@extends('client.layouts.app')

@section('title', 'Giỏ Hàng')

@section('content')
    @include('client.components.breadcrumb')
    @include('client.pages.cart.shopping-cart')
@endsection

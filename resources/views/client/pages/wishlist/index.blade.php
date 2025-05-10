@extends('client.layouts.app')

@section('title', 'Sản Phẩm Yêu Thích')
@section('breadcrumb', 'Sản Phẩm Yêu Thích')


@section('content')
    @include('client.components.breadcrumb')
    @include('client.pages.wishlist.wishlist')
@endsection

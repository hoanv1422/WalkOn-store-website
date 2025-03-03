@extends('client.layouts.app')

@section('title', 'Chi Tiết Sản Phẩm')

@section('content')
    @include('client.components.breadcrumb')
    @include('client.pages.detail.product')
    @include('client.pages.detail.product-tab')
    @include('client.pages.detail.upsell-product')
    @include('client.pages.detail.related-product')
    @include('client.pages.detail.comments')
@endsection

@section('script')
    <script>
        
    </script>
@endsection

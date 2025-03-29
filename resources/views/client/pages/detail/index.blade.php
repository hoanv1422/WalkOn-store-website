@extends('client.layouts.app')

@section('title', 'Chi Tiết Sản Phẩm')
@section('breadcrumb', 'Chi Tiết Sản Phẩm')


@section('style')
    
@endsection

@section('content')
    @include('client.components.breadcrumb')
    @include('client.pages.detail.product')
    @include('client.pages.detail.product-tab')
    @include('client.pages.detail.upsell-product')
    @include('client.pages.detail.related-product')
    
@endsection


@section('script')
<script>





</script>    
@endsection


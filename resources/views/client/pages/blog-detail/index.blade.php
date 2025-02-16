@extends('client.layouts.app')

@section('title', 'Chi Tiết Bài Viết')

@section('content')
    @include('client.components.breadcrumb')
    @include('client.pages.blog-detail.blog-detail')
@endsection

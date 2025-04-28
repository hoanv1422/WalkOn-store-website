@extends('client.layouts.app')

@section('title', 'Bài Viết')
@section('breadcrumb', 'Bài Viết')

@section('content')
    @include('client.pages.blog.banner')
    @include('client.components.breadcrumb')
    @include('client.pages.blog.blog')
@endsection

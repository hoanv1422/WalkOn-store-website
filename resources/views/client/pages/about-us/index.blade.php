@extends('client.layouts.app')

@section('title', 'Về Chúng Tôi')
@section('breadcrumb', 'Về Chúng Tôi')

@section('content')
    @include('client.components.breadcrumb')
    @include('client.pages.about-us.about-us')
@endsection

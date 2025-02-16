@extends('client.layouts.app')

@section('title', 'Checkout')

@section('content')
    @include('client.components.breadcrumb')
    @include('client.pages.checkout.checkout')
@endsection

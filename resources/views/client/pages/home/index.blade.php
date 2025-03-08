@extends('client.layouts.app')

@section('title', 'Trang chủ')

@section('content')
    @foreach (['slider', 'banner', 'product', 'features-product', 'another-banner', 'new-product', 'testimonial', 'blog', 'newsletter'] as $section)
        @include("client.pages.home.$section")
    @endforeach
    
@endsection

@extends('client.layouts.app')

@section('title', 'Trang chủ')

@section('style')
    <style>
        .modal-content {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .modal-header-1{
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-title {
            color: #333;
            font-weight: 600;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .product-img-modal {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #eee;
        }

        .form-select,
        .form-control {
            border-radius: 6px;
            border: 1px solid #ddd;
            padding: 0.5rem;
        }

        .form-select:focus,
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 0.5rem 1.5rem;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-outline-secondary {
            border-color: #ccc;
            color: #666;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s;
        }

        .btn-outline-secondary:hover {
            background-color: #f8f9fa;
            border-color: #999;
            color: #333;
        }

        .text-danger {
            font-size: 1.1rem;
        }

        .form-label {
            margin-bottom: 0.3rem;
            color: #555;
        }
    </style>
    <style>
    .btn-outline-secondary {
        transition: all 0.2s;
    }

    .btn-outline-secondary.active {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    .btn-outline-secondary:hover:not(.active) {
        background-color: #f8f9fa;
        color: #333;
    }

    .btn-outline-secondary:focus {
        box-shadow: 0 0 5px rgba(0,123,255,0.3);
    }
</style>
@endsection

@section('content')
    @foreach (['slider', 'banner', 'product', 'features-product', 'another-banner', 'new-product', 'testimonial', 'blog', 'newsletter'] as $section)
        @include("client.pages.home.$section")
    @endforeach

@endsection

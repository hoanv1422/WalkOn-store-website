@extends('client.layouts.app')

@section('title', 'Cửa Hàng')
@section('breadcrumb', 'Của Hàng')

@section('style')
<style>
/* Định dạng ô nhập giá trên cùng một hàng */
.price-inputs {
    display: flex;
    align-items: center;
    gap: 10px;
}

.price-inputs input {
    width: 45%;
    padding: 5px;
    border: 1px solid #ddd;
    border-radius: 4px;
    text-align: center;
}

.price-inputs span {
    font-weight: bold;
}

</style>
<style>
    .modal-content {
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .modal-header-1 {
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

    .color-btn {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 2px solid #ddd;
            margin: 4px;
            cursor: pointer;
            outline: none;
            transition: transform 0.2s ease;
        }

        .color-btn:hover {
            transform: scale(1.1);
            border-color: #999;
        }

        .color-btn.active {
            border: 2px solid #000;
        }
</style>


@endsection

@section('content')
    @include('client.pages.shop.banner')
    @include('client.components.breadcrumb')
    @include('client.pages.shop.product')
@endsection

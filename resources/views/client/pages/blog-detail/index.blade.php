@extends('client.layouts.app')
@section('title', 'Chi Tiết Bài Viết')
@section('breadcrumb', 'Chi Tiết Bài Viết')
@section('style')

    <style>
        #toast-container {
            top: auto !important;
            bottom: 12%;
            right: 1%;
        }

        .toast {
            background: #000;
            color: #fff;
        }

        .toast-success {
            background: #28a745;
        }

        .toast-error {
            background: #dc3545;
        }

        .toast-warning {
            background: #ffc107;
        }

        .toast-info {
            background: #17a2b8;
        }

        .toast-default {
            background: #6c757d;
        }

        .comment-item .btn-group {
            margin-left: auto;
        }

        .comment-item .btn {
            padding: 5px 10px;
            font-size: 0.875rem;
        }

        .comment-item .btn i {
            margin-right: 3px;
        }

        /* Gallery styles */
        .post-gallery {
            position: relative;
            margin: 2rem 0;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            transition: transform 0.3s ease;
            background: #f8f9fa;
        }

        .gallery-item:hover {
            transform: translateY(-5px);
        }

        .gallery-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            cursor: zoom-in;
            border-radius: 8px;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover img {
            opacity: 0.9;
        }

        .gallery-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 0.8rem;
            font-size: 0.9rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-item:hover .gallery-caption {
            opacity: 1;
        }

        /* Main image */
        .blog-img {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin: 2rem 0;
        }

        .blog-img img {
            width: 100%;
            height: 500px;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .blog-img img {
                height: 300px;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection
@section('content')
    @include('client.pages.blog-detail.blog-detail')
@endsection

@extends('admin.layouts.app')
@section('title', 'Chi Tiết Biến Thể Sản Phẩm')
@section('style')
    <link href="{{ asset('templates/admin/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- Start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Chi Tiết Biến Thể - {{ $variant->product->sku }} ({{ $variant->color->color }} -
                            {{ $variant->size->size }})</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('inventory.index') }}">Quản Lý Kho</a></li>
                                <li class="breadcrumb-item active">Chi Tiết Biến Thể</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row gx-lg-5">
                                <div class="col-xl-4 col-md-8 mx-auto">
                                    <div class="product-img-slider sticky-side-div">
                                        <div class="swiper product-thumbnail-slider p-2 rounded bg-light">
                                            <div class="swiper-wrapper" style="height: 490px">
                                                <div class="swiper-slide overflow-hidden">
                                                    <img src="{{ Storage::url($variant->product->image) }}" alt=""
                                                        class="img-fluid d-block object-fit-cover" />
                                                </div>
                                                @foreach ($variant->product->galleries as $item)
                                                    <div class="swiper-slide overflow-hidden">
                                                        <img src="{{ Storage::url($item->image) }}" alt=""
                                                            class="img-fluid d-block object-fit-cover" />
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="swiper-button-next material-shadow"></div>
                                            <div class="swiper-button-prev material-shadow"></div>
                                        </div>
                                        <div class="swiper product-nav-slider mt-2">
                                            <div class="swiper-wrapper" style="height: 101px">
                                                <div class="swiper-slide">
                                                    <div class="nav-slide-item overflow-hidden">
                                                        <img src="{{ Storage::url($variant->product->image) }}"
                                                            alt="" class="img-fluid d-block object-fit-cover" />
                                                    </div>
                                                </div>
                                                @foreach ($variant->product->galleries as $item)
                                                    <div class="swiper-slide">
                                                        <div class="nav-slide-item overflow-hidden">
                                                            <img src="{{ Storage::url($item->image) }}" alt=""
                                                                class="img-fluid d-block object-fit-cover" />
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-8">
                                    <div class="mt-xl-0 mt-5">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h4>{{ $variant->product->name }}</h4>
                                                <div class="hstack gap-3 flex-wrap">
                                                    <div><a href="#"
                                                            class="text-primary d-block">{{ $variant->product->brand->name }}</a>
                                                    </div>
                                                    <div class="vr"></div>
                                                    <div class="text-muted">Danh Mục: <span
                                                            class="text-body fw-medium">{{ $variant->product->category->name }}</span>
                                                    </div>
                                                    <div class="vr"></div>
                                                    <div class="text-muted">Ngày thêm: <span
                                                            class="text-body fw-medium">{{ $variant->product->created_at->format('d/m/Y') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <a href="{{ route('products.edit', $variant->product) }}"
                                                    class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Sửa sản phẩm"><i class="ri-pencil-fill align-bottom"></i></a>
                                            </div>
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="p-2 border border-dashed rounded">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm me-2">
                                                            <div
                                                                class="avatar-title rounded bg-transparent text-success fs-24">
                                                                <i class="ri-money-dollar-circle-fill"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <p class="text-muted mb-1">Giá:</p>
                                                            <h5 class="mb-0">
                                                                {{ number_format($variant->price, 0, ',', '.') }} VNĐ</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="p-2 border border-dashed rounded">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm me-2">
                                                            <div
                                                                class="avatar-title rounded bg-transparent text-success fs-24">
                                                                <i class="ri-stack-fill"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <p class="text-muted mb-1">Số lượng tồn:</p>
                                                            <h5 class="mb-0">{{ $variant->quantity }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="p-2 border border-dashed rounded">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm me-2">
                                                            <div
                                                                class="avatar-title rounded bg-transparent text-success fs-24">
                                                                <i class="ri-brush-fill"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <p class="text-muted mb-1">Màu sắc:</p>
                                                            <h5 class="mb-0">{{ $variant->color->color }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6 mt-3">
                                                <div class="p-2 border border-dashed rounded">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm me-2">
                                                            <div
                                                                class="avatar-title rounded bg-transparent text-success fs-24">
                                                                <i class="ri-ruler-fill"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <p class="text-muted mb-1">Kích cỡ:</p>
                                                            <h5 class="mb-0">{{ $variant->size->size }}</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Mô tả sản phẩm -->
                                        <div class="mt-4 text-muted">
                                            <h5 class="fs-14">Mô tả sản phẩm:</h5>
                                            {!! $variant->product->description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('templates/admin/assets/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('templates/admin/assets/js/pages/ecommerce-product-details.init.js') }}"></script>
@endsection

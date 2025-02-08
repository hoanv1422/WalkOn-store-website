@extends('admin.layouts.app')
@section('title', 'trang sản phẩm')
@section('style')
    <!-- nouisliderribute css -->
    <link rel="stylesheet" href="{{ asset('templates/admin/assets/libs/nouislider/nouislider.min.css') }}">

    <!-- gridjs css -->
    {{-- <link rel="stylesheet" href="{{ asset('templates/admin/assets/libs/gridjs/theme/mermaid.min.css') }}"> --}}




@endsection
@section('content')

 {{-- @if(session('success'))
   @php
       dd(session('success'));
   @endphp
@endif --}}


    <div class="page-content">
        
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Sản Phẩm</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Thương Mại Điện Tử</a></li>
                                <li class="breadcrumb-item active">Sản Phẩm</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex mb-3">
                                <div class="flex-grow-1">
                                    <h5 class="fs-16">Lọc</h5>
                                </div>
                                <div class="flex-shrink-0">
                                    <a href="#" class="text-decoration-underline" id="clearall">Xóa</a>
                                </div>
                            </div>

                            <div class="filter-choices-input">
                                <input class="form-control" data-choices data-choices-removeItem type="text"
                                    id="filter-choices-input" value="T-Shirts" />
                            </div>
                        </div>

                        <div class="accordion accordion-flush filter-accordion">

                            <div class="card-body border-bottom">
                                <div>
                                    <p class="text-muted text-uppercase fs-12 fw-medium mb-2">Sản Phẩm</p>
                                    <ul class="list-unstyled mb-0 filter-list">
                                        <li>
                                            <a href="#" class="d-flex py-1 align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-13 mb-0 listname">Grocery</h5>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-flex py-1 align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-13 mb-0 listname">Fashion</h5>
                                                </div>
                                                <div class="flex-shrink-0 ms-2">
                                                    <span class="badge bg-light text-muted">5</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-flex py-1 align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-13 mb-0 listname">Watches</h5>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-flex py-1 align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-13 mb-0 listname">Electronics</h5>
                                                </div>
                                                <div class="flex-shrink-0 ms-2">
                                                    <span class="badge bg-light text-muted">5</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-flex py-1 align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-13 mb-0 listname">Furniture</h5>
                                                </div>
                                                <div class="flex-shrink-0 ms-2">
                                                    <span class="badge bg-light text-muted">6</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-flex py-1 align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-13 mb-0 listname">Automotive Accessories</h5>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-flex py-1 align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-13 mb-0 listname">Appliances</h5>
                                                </div>
                                                <div class="flex-shrink-0 ms-2">
                                                    <span class="badge bg-light text-muted">7</span>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="d-flex py-1 align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="fs-13 mb-0 listname">Kids</h5>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card-body border-bottom">
                                <p class="text-muted text-uppercase fs-12 fw-medium mb-4">Price</p>

                                <div id="product-price-range"></div>
                                <div class="formCost d-flex gap-2 align-items-center mt-3">
                                    <input class="form-control form-control-sm" type="text" id="minCost"
                                        value="0" /> <span class="fw-semibold text-muted">to</span> <input
                                        class="form-control form-control-sm" type="text" id="maxCost" value="1000" />
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingBrands">
                                    <button class="accordion-button bg-transparent shadow-none" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseBrands"
                                        aria-expanded="true" aria-controls="flush-collapseBrands">
                                        <span class="text-muted text-uppercase fs-12 fw-medium">Brands</span> <span
                                            class="badge bg-success rounded-pill align-middle ms-1 filter-badge"></span>
                                    </button>
                                </h2>

                                <div id="flush-collapseBrands" class="accordion-collapse collapse show"
                                    aria-labelledby="flush-headingBrands">
                                    <div class="accordion-body text-body pt-0">
                                        <div class="search-box search-box-sm">
                                            <input type="text" class="form-control bg-light border-0"
                                                id="searchBrandsList" placeholder="Search Brands...">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                        <div class="d-flex flex-column gap-2 mt-3 filter-check">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Boat"
                                                    id="productBrandRadio5" checked>
                                                <label class="form-check-label" for="productBrandRadio5">Boat</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="OnePlus"
                                                    id="productBrandRadio4">
                                                <label class="form-check-label" for="productBrandRadio4">OnePlus</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Realme"
                                                    id="productBrandRadio3">
                                                <label class="form-check-label" for="productBrandRadio3">Realme</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Sony"
                                                    id="productBrandRadio2">
                                                <label class="form-check-label" for="productBrandRadio2">Sony</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="JBL"
                                                    id="productBrandRadio1" checked>
                                                <label class="form-check-label" for="productBrandRadio1">JBL</label>
                                            </div>

                                            <div>
                                                <button type="button"
                                                    class="btn btn-link text-decoration-none text-uppercase fw-medium p-0">1,235
                                                    More</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end accordion-item -->

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingDiscount">
                                    <button class="accordion-button bg-transparent shadow-none collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseDiscount"
                                        aria-expanded="true" aria-controls="flush-collapseDiscount">
                                        <span class="text-muted text-uppercase fs-12 fw-medium">Discount</span> <span
                                            class="badge bg-success rounded-pill align-middle ms-1 filter-badge"></span>
                                    </button>
                                </h2>
                                <div id="flush-collapseDiscount" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingDiscount">
                                    <div class="accordion-body text-body pt-1">
                                        <div class="d-flex flex-column gap-2 filter-check">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="50% or more"
                                                    id="productdiscountRadio6">
                                                <label class="form-check-label" for="productdiscountRadio6">50% or
                                                    more</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="40% or more"
                                                    id="productdiscountRadio5">
                                                <label class="form-check-label" for="productdiscountRadio5">40% or
                                                    more</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="30% or more"
                                                    id="productdiscountRadio4">
                                                <label class="form-check-label" for="productdiscountRadio4">
                                                    30% or more
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="20% or more"
                                                    id="productdiscountRadio3" checked>
                                                <label class="form-check-label" for="productdiscountRadio3">
                                                    20% or more
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="10% or more"
                                                    id="productdiscountRadio2">
                                                <label class="form-check-label" for="productdiscountRadio2">
                                                    10% or more
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Less than 10%"
                                                    id="productdiscountRadio1">
                                                <label class="form-check-label" for="productdiscountRadio1">
                                                    Less than 10%
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end accordion-item -->

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingRating">
                                    <button class="accordion-button bg-transparent shadow-none collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseRating"
                                        aria-expanded="false" aria-controls="flush-collapseRating">
                                        <span class="text-muted text-uppercase fs-12 fw-medium">Rating</span> <span
                                            class="badge bg-success rounded-pill align-middle ms-1 filter-badge"></span>
                                    </button>
                                </h2>

                                <div id="flush-collapseRating" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingRating">
                                    <div class="accordion-body text-body">
                                        <div class="d-flex flex-column gap-2 filter-check">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="4 & Above Star"
                                                    id="productratingRadio4" checked>
                                                <label class="form-check-label" for="productratingRadio4">
                                                    <span class="text-muted">
                                                        <i class="mdi mdi-star text-warning"></i>
                                                        <i class="mdi mdi-star text-warning"></i>
                                                        <i class="mdi mdi-star text-warning"></i>
                                                        <i class="mdi mdi-star text-warning"></i>
                                                        <i class="mdi mdi-star"></i>
                                                    </span> 4 & Above
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="3 & Above Star"
                                                    id="productratingRadio3">
                                                <label class="form-check-label" for="productratingRadio3">
                                                    <span class="text-muted">
                                                        <i class="mdi mdi-star text-warning"></i>
                                                        <i class="mdi mdi-star text-warning"></i>
                                                        <i class="mdi mdi-star text-warning"></i>
                                                        <i class="mdi mdi-star"></i>
                                                        <i class="mdi mdi-star"></i>
                                                    </span> 3 & Above
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="2 & Above Star"
                                                    id="productratingRadio2">
                                                <label class="form-check-label" for="productratingRadio2">
                                                    <span class="text-muted">
                                                        <i class="mdi mdi-star text-warning"></i>
                                                        <i class="mdi mdi-star text-warning"></i>
                                                        <i class="mdi mdi-star"></i>
                                                        <i class="mdi mdi-star"></i>
                                                        <i class="mdi mdi-star"></i>
                                                    </span> 2 & Above
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1 Star"
                                                    id="productratingRadio1">
                                                <label class="form-check-label" for="productratingRadio1">
                                                    <span class="text-muted">
                                                        <i class="mdi mdi-star text-warning"></i>
                                                        <i class="mdi mdi-star"></i>
                                                        <i class="mdi mdi-star"></i>
                                                        <i class="mdi mdi-star"></i>
                                                        <i class="mdi mdi-star"></i>
                                                    </span> 1
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end accordion-item -->
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->

                <div class="col-xl-9 col-lg-8">
                    <div>
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="row g-4">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a href="{{route('products.create')}}" class="btn btn-success"
                                                id="addproduct-btn"><i class="ri-add-line align-bottom me-1"></i> Thêm Sản Phẩm</a>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text" class="form-control" id="searchProductList"
                                                    placeholder="Search Products...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active fw-semibold" data-bs-toggle="tab"
                                                    href="#productnav-all" role="tab">
                                                    Tất Cả <span
                                                        class="badge bg-danger-subtle text-danger align-middle rounded-pill ms-1">{{ $products->count() }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold" data-bs-toggle="tab"
                                                    href="#productnav-published" role="tab">
                                                    Đang Bán <span
                                                        class="badge bg-danger-subtle text-danger align-middle rounded-pill ms-1">{{ $products_active->count() }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link fw-semibold" data-bs-toggle="tab"
                                                    href="#productnav-draft" role="tab">
                                                    Ẩn<span
                                                        class="badge bg-danger-subtle text-danger align-middle rounded-pill ms-1">{{ $products_non_active->count() }}</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-auto">
                                        <div id="selection-element">
                                            <div class="my-n1 d-flex align-items-center text-muted">
                                                Select <div id="select-content" class="text-body fw-semibold px-1"></div>
                                                Result <button type="button"
                                                    class="btn btn-link link-danger p-0 ms-3 material-shadow-none"
                                                    data-bs-toggle="modal" data-bs-target="#removeItemModal">Xóa</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card header -->
                            <div class="card-body">
                                <div class="tab-content text-muted">
                                    <div class="tab-pane active" id="productnav-all" role="tabpanel">
                                        <div id="table-product-list-all" class="table-card gridjs-border-none"
                                            width="100%">
                                            <table id="products-all" class="dataTable">
                                                <thead class="gridjs-thead">
                                                    <tr class="gridjs-tr">
                                                        <th data-column-id="#" class="gridjs-th gridjs-th-sort text-muted"
                                                            tabindex="0" style="width: 15px;">
                                                            <div class="gridjs-th-content">#</div>
                                                        </th>
                                                        <th data-column-id="product"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 360px;">
                                                            <div class="gridjs-th-content">Sản phẩm</div>
                                                        </th>
                                                        <th data-column-id="stock"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 94px;">
                                                            <div class="gridjs-th-content">Số lượng</div>
                                                        </th>
                                                        <th data-column-id="price"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 101px;">
                                                            <div class="gridjs-th-content">Giá</div>
                                                        </th>
                                                        <th data-column-id="orders"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 84px;">
                                                            <div class="gridjs-th-content">Đã bán</div>
                                                        </th>
                                                        <th data-column-id="rating"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 105px;">
                                                            <div class="gridjs-th-content">Đánh giá</div>
                                                        </th>
                                                        <th data-column-id="published"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 220px;">
                                                            <div class="gridjs-th-content">Ngày bán</div>
                                                        </th>
                                                        <th data-column-id="action"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 80px;">
                                                            <div class="gridjs-th-content">Hành động</div>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="gridjs-tbody">
                                                    @foreach ($products as $item)
                                                        <tr class="gridjs-tr">
                                                            <td class="gridjs-td"><span>
                                                                    <div class="form-check checkbox-product-list"> <input
                                                                            class="form-check-input" type="checkbox"
                                                                            value="1" id="checkbox-1"> <label
                                                                            class="form-check-label"
                                                                            for="checkbox-1"></label>
                                                                    </div>
                                                                </span></td>
                                                            <td class="gridjs-td"><span>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-shrink-0 me-3">
                                                                            <div class="avatar-sm bg-light rounded p-1">
                                                                                <img src="{{Storage::url($item->image)}}"
                                                                                    alt=""
                                                                                    class="img-fluid d-block">
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-grow-1">
                                                                            <h5 class="fs-14 mb-1"><a
                                                                                    href="apps-ecommerce-product-details.html"
                                                                                    class="text-body">{{ $item->name }}</a>
                                                                            </h5>
                                                                            <p class="text-muted mb-0">Danh Mục : <span
                                                                                    class="fw-medium">{{ $item->category->name }}</span>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </span></td>
                                                            <td class="gridjs-td">{{ $item->quantity }}</td>
                                                            <td class="gridjs-td">
                                                                <span>{{ number_format($item->price, 0, ',', '.') }} VNĐ
                                                                </span>
                                                            </td>
                                                            <td class="gridjs-td">{{ $item->sold_quantity }}</td>
                                                            <td class="gridjs-td"><span><span
                                                                        class="badge bg-light text-body fs-12 fw-medium"><i
                                                                            class="mdi mdi-star text-warning me-1"></i>{{ $item->average_rating }}</span></span>
                                                            </td>
                                                            <td class="gridjs-td">
                                                                <span>{{ $item->created_at->format('d/m/Y') }}
                                                                    <small
                                                                        class="text-muted ms-1">{{ $item->created_at->format('h:i A') }}</small></span>
                                                            </td>
                                                            <td class="gridjs-td"><span>
                                                                    <div class="dropdown"><button
                                                                            class="btn btn-soft-secondary btn-sm dropdown"
                                                                            type="button" data-bs-toggle="dropdown"
                                                                            aria-expanded="false"><i
                                                                                class="ri-more-fill"></i></button>
                                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                                            <li><a class="dropdown-item"
                                                                                    href="{{route('products.show', $item)}}"><i
                                                                                        class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                                                    Xem</a></li>
                                                                            <li><a class="dropdown-item edit-list"
                                                                                    data-edit-id="1"
                                                                                    href="{{route('products.edit', $item)}}"><i
                                                                                        class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                                    Sửa</a></li>
                                                                            <li class="dropdown-divider"></li>
                                                                            <li><a class="dropdown-item remove-list"
                                                                                    href="#" data-id="{{ $item->id }}"
                                                                                    data-bs-toggle="modal"
                                                                                    data-action="{{ route('products.destroy', $item) }}"
                                                                                    data-bs-target="#removeItemModal"><i
                                                                                        class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                                    Xóa</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </span></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- end tab pane -->

                                    <div class="tab-pane" id="productnav-published" role="tabpanel">
                                        <div id="table-product-list-published" class="table-card gridjs-border-none">
                                            <table id="products-active" class="dataTable">
                                                <thead class="gridjs-thead">
                                                    <tr class="gridjs-tr">
                                                        <th data-column-id="#" class="gridjs-th gridjs-th-sort text-muted"
                                                            tabindex="0" style="width: 15px;">
                                                            <div class="gridjs-th-content">#</div>
                                                        </th>
                                                        <th data-column-id="product"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 360px;">
                                                            <div class="gridjs-th-content">Sản phẩm</div>
                                                        </th>
                                                        <th data-column-id="stock"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 94px;">
                                                            <div class="gridjs-th-content">Số lượng</div>
                                                        </th>
                                                        <th data-column-id="price"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 101px;">
                                                            <div class="gridjs-th-content">Giá</div>
                                                        </th>
                                                        <th data-column-id="orders"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 84px;">
                                                            <div class="gridjs-th-content">Đã bán</div>
                                                        </th>
                                                        <th data-column-id="rating"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 105px;">
                                                            <div class="gridjs-th-content">Đánh giá</div>
                                                        </th>
                                                        <th data-column-id="published"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 220px;">
                                                            <div class="gridjs-th-content">Ngày bán</div>
                                                        </th>
                                                        <th data-column-id="action"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 80px;">
                                                            <div class="gridjs-th-content">Hành động</div>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="gridjs-tbody">
                                                    @foreach ($products_active as $item)
                                                        <tr class="gridjs-tr">
                                                            <td class="gridjs-td"><span>
                                                                    <div class="form-check checkbox-product-list"> <input
                                                                            class="form-check-input" type="checkbox"
                                                                            value="1" id="checkbox-1"> <label
                                                                            class="form-check-label"
                                                                            for="checkbox-1"></label>
                                                                    </div>
                                                                </span></td>
                                                            <td class="gridjs-td"><span>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-shrink-0 me-3">
                                                                            <div class="avatar-sm bg-light rounded p-1">
                                                                                <img src="{{ asset('templates/admin/assets/images/products/img-1.png') }}"
                                                                                    alt=""
                                                                                    class="img-fluid d-block">
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-grow-1">
                                                                            <h5 class="fs-14 mb-1"><a
                                                                                    href="apps-ecommerce-product-details.html"
                                                                                    class="text-body">{{ $item->name }}</a>
                                                                            </h5>
                                                                            <p class="text-muted mb-0">Danh Mục : <span
                                                                                    class="fw-medium">{{ $item->category->name }}</span>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </span></td>
                                                            <td class="gridjs-td">{{ $item->quantity }}</td>
                                                            <td class="gridjs-td">
                                                                <span>{{ number_format($item->price, 0, ',', '.') }} VNĐ
                                                                </span>
                                                            </td>
                                                            <td class="gridjs-td">{{ $item->sold_quantity }}</td>
                                                            <td class="gridjs-td"><span><span
                                                                        class="badge bg-light text-body fs-12 fw-medium"><i
                                                                            class="mdi mdi-star text-warning me-1"></i>{{ $item->average_rating }}</span></span>
                                                            </td>
                                                            <td class="gridjs-td">
                                                                <span>{{ $item->created_at->format('d/m/Y') }}
                                                                    <small
                                                                        class="text-muted ms-1">{{ $item->created_at->format('h:i A') }}</small></span>
                                                            </td>
                                                            <td class="gridjs-td"><span>
                                                                    <div class="dropdown"><button
                                                                            class="btn btn-soft-secondary btn-sm dropdown"
                                                                            type="button" data-bs-toggle="dropdown"
                                                                            aria-expanded="false"><i
                                                                                class="ri-more-fill"></i></button>
                                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                                            <li><a class="dropdown-item"
                                                                                    href=""><i
                                                                                        class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                                                    Xem</a></li>
                                                                            <li><a class="dropdown-item edit-list"
                                                                                    data-edit-id="1"
                                                                                    href=""><i
                                                                                        class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                                    Sửa</a></li>
                                                                            <li class="dropdown-divider"></li>
                                                                            <li><a class="dropdown-item remove-list"
                                                                                    href="#" data-id="1"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#removeItemModal"><i
                                                                                        class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                                    Xóa</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </span></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- end tab pane -->

                                    <div class="tab-pane" id="productnav-draft" role="tabpanel">
                                        <div id="table-product-list-draft" class="table-card gridjs-border-none">
                                            <table id="product-non-active" class="dataTable">
                                                <thead class="gridjs-thead">
                                                    <tr class="gridjs-tr">
                                                        <th data-column-id="#" class="gridjs-th gridjs-th-sort text-muted"
                                                            tabindex="0" style="width: 15px;">
                                                            <div class="gridjs-th-content">#</div>
                                                        </th>
                                                        <th data-column-id="product"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 360px;">
                                                            <div class="gridjs-th-content">Sản phẩm</div>
                                                        </th>
                                                        <th data-column-id="stock"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 94px;">
                                                            <div class="gridjs-th-content">Số lượng</div>
                                                        </th>
                                                        <th data-column-id="price"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 101px;">
                                                            <div class="gridjs-th-content">Giá</div>
                                                        </th>
                                                        <th data-column-id="orders"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 84px;">
                                                            <div class="gridjs-th-content">Đã bán</div>
                                                        </th>
                                                        <th data-column-id="rating"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 105px;">
                                                            <div class="gridjs-th-content">Đánh giá</div>
                                                        </th>
                                                        <th data-column-id="published"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 220px;">
                                                            <div class="gridjs-th-content">Ngày bán</div>
                                                        </th>
                                                        <th data-column-id="action"
                                                            class="gridjs-th gridjs-th-sort text-muted" tabindex="0"
                                                            style="width: 80px;">
                                                            <div class="gridjs-th-content">Hành động</div>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="gridjs-tbody">
                                                    @foreach ($products_non_active as $item)
                                                        <tr class="gridjs-tr">
                                                            <td class="gridjs-td"><span>
                                                                    <div class="form-check checkbox-product-list"> <input
                                                                            class="form-check-input" type="checkbox"
                                                                            value="1" id="checkbox-1"> <label
                                                                            class="form-check-label"
                                                                            for="checkbox-1"></label>
                                                                    </div>
                                                                </span></td>
                                                            <td class="gridjs-td"><span>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-shrink-0 me-3">
                                                                            <div class="avatar-sm bg-light rounded p-1">
                                                                                <img src="{{ asset('templates/admin/assets/images/products/img-1.png') }}"
                                                                                    alt=""
                                                                                    class="img-fluid d-block">
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-grow-1">
                                                                            <h5 class="fs-14 mb-1"><a
                                                                                    href="apps-ecommerce-product-details.html"
                                                                                    class="text-body">{{ $item->name }}</a>
                                                                            </h5>
                                                                            <p class="text-muted mb-0">Danh Mục : <span
                                                                                    class="fw-medium">{{ $item->category->name }}</span>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </span></td>
                                                            <td class="gridjs-td">{{ $item->quantity }}</td>
                                                            <td class="gridjs-td">
                                                                <span>{{ number_format($item->price, 0, ',', '.') }} VNĐ
                                                                </span>
                                                            </td>
                                                            <td class="gridjs-td">{{ $item->sold_quantity }}</td>
                                                            <td class="gridjs-td"><span><span
                                                                        class="badge bg-light text-body fs-12 fw-medium"><i
                                                                            class="mdi mdi-star text-warning me-1"></i>{{ $item->average_rating }}</span></span>
                                                            </td>
                                                            <td class="gridjs-td">
                                                                <span>{{ $item->created_at->format('d/m/Y') }}
                                                                    <small
                                                                        class="text-muted ms-1">{{ $item->created_at->format('h:i A') }}</small></span>
                                                            </td>
                                                            <td class="gridjs-td"><span>
                                                                    <div class="dropdown"><button
                                                                            class="btn btn-soft-secondary btn-sm dropdown"
                                                                            type="button" data-bs-toggle="dropdown"
                                                                            aria-expanded="false"><i
                                                                                class="ri-more-fill"></i></button>
                                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                                            <li><a class="dropdown-item"
                                                                                    href=""><i
                                                                                        class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                                                    Xem</a></li>
                                                                            <li><a class="dropdown-item edit-list"
                                                                                    data-edit-id="1"
                                                                                    href=""><i
                                                                                        class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                                    Sửa</a></li>
                                                                            <li class="dropdown-divider"></li>
                                                                            <li><a class="dropdown-item remove-list"
                                                                                    href="#" data-id="1"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#removeItemModal"><i
                                                                                        class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                                    Xóa</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </span></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- end tab pane -->
                                </div>
                                <!-- end tab content -->

                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

     <!-- removeItemModal -->
    <div id="removeItemModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Bạn có chắc không ?</h4>
                            <p class="text-muted mx-4 mb-0">Bạn có chắc muốn xóa sản phẩm này không?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Đóng</button>
                        <form id="deleteForm" method="POST" action="">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn w-sm btn-danger " id="delete-product">Xóa!</button>
                            </form>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('script')
    <!-- nouisliderribute js -->
    <script src="{{ asset('templates/admin/assets/libs/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('templates/admin/assets/libs/wnumb/wNumb.min.js') }}"></script>


    <!-- gridjs js -->
    {{-- <script src="{{ asset('templates/admin/assets/libs/gridjs/gridjs.umd.js') }}"></script> --}}
    <script src="../../../../unpkg.com/gridjs%406.2.0/plugins/selection/dist/selection.umd.js"></script>
    <!-- ecommerce product list -->

    <script>
        $(document).ready(function() {
            $('table.dataTable').each(function() {
                $(this).DataTable({
                    "paging": true, // Hiển thị phân trang
                    "searching": false, // Tắt tìm kiếm
                    "ordering": true, // Bật sắp xếp
                    "info": true, // Hiển thị thông tin tổng
                    "pageLength": 10, // Giới hạn số lượng bản ghi mỗi trang
                    "lengthChange": false
                });
            });
        });

        $(document).on('click', '.dropdown-item.remove-list', function() {
            var actionUrl = $(this).data('action');
            // var itemId = $(this).data('id'); 

            $('#deleteForm').attr('action', actionUrl);
            // $('#deleteItemId').val(itemId); 
        });



    </script>
    {{-- <script src="{{ asset('templates/admin/assets/js/pages/ecommerce-product-list.init.js') }}"></script> --}}
@endsection

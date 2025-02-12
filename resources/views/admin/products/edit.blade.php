@extends('admin.layouts.app')
@section('title', 'Sửa sản phẩm')
@section('style')
    <link href="{{ asset('templates/admin/assets/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Sửa Sản Phẩm - {{ $product->sku }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Thương Mại Điện Tự</a></li>
                                <li class="breadcrumb-item active">Sửa Sản Phẩm</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <form action="{{ route('products.update', $product) }}" method="POST" onsubmit="removeCurrencyFormat()"
                class="needs-validation" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label" for="product-title-input">Tiêu Đề Sản Phẩm</label>
                                    <input type="text"
                                        class="form-control @error('name') is-invalid @elseif(old('name')) is-valid @enderror"
                                        id="product-title-input" value="{{ old('name', $product->name) }}" name="name"
                                        placeholder="Nhập tiêu đề sản phẩm">
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label>Mô Tả Sản Phẩm</label>
                                    <textarea name="description" id="ckeditor-classic">
                                        {{ old('description', $product->description) }}
                                    </textarea>
                                    @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- end card -->

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Thư Viện Ảnh</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <h5 class="fs-14 mb-1">Ảnh Sản Phẩm</h5>
                                    <p class="text-muted">Ảnh chính.</p>
                                    @error('image')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <div class="text-center">
                                        <div class="position-relative d-inline-block">
                                            <div class="position-absolute top-100 start-100 translate-middle">
                                                <label for="product-image-input" class="mb-0" data-bs-toggle="tooltip"
                                                    data-bs-placement="right" title="Select Image">
                                                    <div class="avatar-xs">
                                                        <div
                                                            class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                            <i class="ri-image-fill"></i>
                                                        </div>
                                                    </div>
                                                </label>
                                                <input class="form-control d-none" id="product-image-input" name="image"
                                                    type="file" accept="image/png, image/gif, image/jpeg"
                                                    onchange="previewImage(event)">
                                            </div>
                                            <div class="avatar-lg">
                                                <div class="avatar-title bg-light rounded">
                                                    <img src="{{ Storage::url($product->image) }}" id="product-img"
                                                        class="avatar-md h-auto" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="fs-14 mb-1">Thư Viện</h5>
                                    <p class="text-muted">Nhập thư viện ảnh.</p>
                                    @error('product_galleries')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <div class="border border-2 border-muted p-4 text-center rounded">
                                        <div>
                                            <div class="mb-3">
                                                <input type="file" id="fileInput" multiple class="form-control d-none"
                                                    name="product_galleries[]" />
                                                <a class="btn btn-primary mt-3"
                                                    onclick="document.getElementById('fileInput').click()">Chọn Ảnh(Có thể
                                                    chọn nhiều)</a>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="deletedImages" name="deleted_images" value="[]">
                                    <ul class="list-unstyled mb-0" id="dropzone-preview">
                                        @foreach ($product_galleries as $item)
                                            <li class="mt-2 preview-item" data-id="{{ $item->id }}">
                                                <div class="border rounded">
                                                    <div class="d-flex p-2">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-sm bg-light rounded">
                                                                <img class="img-fluid rounded d-block"
                                                                    src="{{ Storage::url($item->image) }}"
                                                                    alt="Product-Image" />
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div class="pt-1">
                                                                <h5 class="fs-14 mb-1">{{ basename($item->image) }}</h5>
                                                                <p class="fs-13 text-muted mb-0">
                                                                    {{ round(Storage::size($item->image) / 1024, 2) }} KB
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-3">
                                                            <a class="btn btn-sm btn-danger"
                                                                onclick="removeExistingImage(this, {{ $item->id }})">Xóa</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <!-- Khu vực hoàn tác -->
                                    <div id="undo-area" class="mt-3 d-none">
                                        <p class="text-danger">Bạn vừa xóa ảnh cũ. <a href="#"
                                                onclick="undoRemove()">Hoàn tác</a></p>
                                    </div>


                                    <!-- end dropzon-preview -->
                                </div>
                            </div>
                        </div>
                        <!-- end card -->

                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#addproduct-general-info"
                                            role="tab">
                                            Thông Tin Chung
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end card header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="addproduct-general-info" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="manufacturer-brand-input">Thương
                                                        Hiệu</label>
                                                    <a href="#" class="float-end text-decoration-underline">Add
                                                        New</a>
                                                    <select class="form-select" id="choices-brand-input" name="brand_id">
                                                        @foreach ($brands as $item)
                                                            <option value="{{ $item->id }}"
                                                                @selected($product->brand_id == $item->id)>{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="product-price-input">Giá nhập</label>
                                                    <div class="input-group has-validation mb-3">
                                                        <span class="input-group-text" id="product-price-addon">VNĐ</span>
                                                        <input type="text"
                                                            class="form-control @error('price_income') is-invalid @elseif(old('price_income')) is-valid @enderror"
                                                            id="product-price-input" placeholder="" aria-label="Price"
                                                            aria-describedby="product-price-addon" name="price_income"
                                                            value="{{ old('price_income', number_format($product->price_income, 0, ',', '.')) }}"
                                                            oninput="formatCurrency(this)">
                                                        @error('price_income')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->

                                        <div class="row">

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="product-price-input">Giá bán</label>
                                                    <div class="input-group has-validation mb-3">
                                                        <span class="input-group-text" id="product-price-addon">VNĐ</span>
                                                        <input type="text"
                                                            class="form-control  @error('price') is-invalid @elseif(old('price')) is-valid @enderror"
                                                            id="product-price-input" placeholder="" aria-label="Price"
                                                            aria-describedby="product-price-addon" name="price"
                                                            value="{{ old('price', number_format($product->price, 0, ',', '.')) }}"
                                                            oninput="formatCurrency(this)">
                                                        @error('price')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label class="form-label" for="product-price-input">Giá khuyến
                                                        mãi</label>
                                                    <div class="input-group has-validation mb-3">
                                                        <span class="input-group-text" id="product-price-addon">VNĐ</span>
                                                        <input type="text"
                                                            class="form-control @error('price_sale') is-invalid @elseif(old('price_sale')) is-valid @enderror"
                                                            id="product-price-input" placeholder="" aria-label="Price"
                                                            aria-describedby="product-price-addon" name="price_sale"
                                                            value="{{ old('price_sale', number_format($product->price_sale, 0, ',', '.')) }}"
                                                            oninput="formatCurrency(this)">
                                                        @error('price_sale')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </div>
                                    <!-- end tab-pane -->
                                </div>
                                <!-- end tab content -->
                            </div>
                            <!-- end card body -->
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#addproduct-general-info"
                                            role="tab">
                                            Biến Thể
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end card header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="addproduct-general-info" role="tabpanel">
                                        <!--Nhập biến thể ở đây-->
                                        <table class="table" id="variantsContainer"
                                            data-sizes='@json($sizes)'
                                            data-colors='@json($colors)'>
                                            <thead>
                                                <tr>
                                                    <th>Ảnh</th>
                                                    <th>Kích Cỡ</th>
                                                    <th>Màu Sắc</th>
                                                    <th>Số lượng</th>
                                                    <th>Giá</th>
                                                    <th>Hoạt Động</th>
                                                </tr>
                                            </thead>
                                            <tbody id="variantsContainer">

                                                @php
                                                    $lastIndex = $product_variants->isEmpty()
                                                        ? -1
                                                        : $product_variants->count() - 1;
                                                @endphp
                                                <input type="hidden" id="lastIndex" value="{{ $lastIndex }}">
                                                {{-- @if (old('product_variant'))
                                                    @foreach (old('product_variant', []) as $index => $product_variant)
                                                        @php $lastIndex = $index; @endphp
                                                        <tr class="variant">
                                                            <td class="align-middle">
                                                                <div class="position-relative d-inline-block">
                                                                    <div
                                                                        class="position-absolute top-100 start-100 translate-middle">
                                                                        <label
                                                                            for="imagePreviewVariantInput_{{ $index }}"
                                                                            class="mb-0" data-bs-toggle="tooltip"
                                                                            data-bs-placement="right"
                                                                            aria-label="Select Image"
                                                                            data-bs-original-title="Select Image">
                                                                            <div class="avatar-xs">
                                                                                <div
                                                                                    class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                                                    <i
                                                                                        class="mdi mdi-image text-muted fs-16 p-1"></i>
                                                                                </div>
                                                                            </div>
                                                                        </label>
                                                                        <input class="form-control d-none"
                                                                            id="imagePreviewVariantInput_{{ $index }}"
                                                                            type="file"
                                                                            accept="image/png, image/gif, image/jpeg"
                                                                            onchange="previewImageVariant(event, {{ $index }})"
                                                                            name="product_variant[{{ $index }}][image]">
                                                                    </div>
                                                                    <div class="avatar-sm">
                                                                        <div class="avatar-title bg-light rounded">
                                                                            <img src=""
                                                                                id="imagePreviewVariant_{{ $index }}"
                                                                                class="avatar-sm h-auto" alt="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <select class="form-control"
                                                                    name="product_variant[{{ $index }}][size]">
                                                                    <option value="">Chọn kích cỡ</option>
                                                                    @foreach ($sizes as $size_id => $size)
                                                                        <option value="{{ $size_id }}">
                                                                            {{ $size }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="form-control"
                                                                    name="product_variant[{{ $index }}][color]">
                                                                    <option value="">Chọn màu</option>
                                                                    @foreach ($colors as $color_id => $color)
                                                                        <option value="{{ $color_id }}">
                                                                            {{ $color }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>

                                                            <td>
                                                                <input class="form-control" type="text"
                                                                    name="product_variant[{{ $index }}][quantity]"
                                                                    value="" placeholder="Số lượng">
                                                                @error('')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <div class="input-group has-validation mb-3">
                                                                    <span class="input-group-text"
                                                                        id="product-price-addon">VNĐ</span>
                                                                    <input type="text" class="form-control"
                                                                        id="product-price-input" placeholder="Giá"
                                                                        aria-label="Price"
                                                                        aria-describedby="product-price-addon"
                                                                        name="product_variant[{{ $index }}][price]">
                                                                    <div class="invalid-feedback">Please Enter a product
                                                                        price.
                                                                    </div>
                                                                </div>
                                                                @error('')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <div class="btn btn-danger removeVariant">X</div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else  --}}
                                                <input type="hidden" id="deletedVariants" name="deleted_variants"
                                                    value="[]"> <!-- Lưu ID đã xóa -->

                                                @foreach ($product_variants as $index => $item)
                                                    <tr class="variant" data-id="{{ $item->id }}">
                                                        <input type="hidden" value="{{ $item->id }}"
                                                            name="product_variant[{{ $index }}][id]">
                                                        <td class="align-middle">
                                                            <div class="position-relative d-inline-block">
                                                                <div
                                                                    class="position-absolute top-100 start-100 translate-middle">
                                                                    <label
                                                                        for="imagePreviewVariantInput_{{ $index }}"
                                                                        class="mb-0 cursor-pointer">
                                                                        <div class="avatar-xs">
                                                                            <div
                                                                                class="avatar-title bg-light border rounded-circle text-muted">
                                                                                <i
                                                                                    class="mdi mdi-image text-muted fs-16 p-1"></i>
                                                                            </div>
                                                                        </div>
                                                                    </label>
                                                                    <input class="form-control d-none"
                                                                        id="imagePreviewVariantInput_{{ $index }}"
                                                                        type="file"
                                                                        accept="image/png, image/gif, image/jpeg"
                                                                        onchange="previewImageVariant(event, {{ $index }})"
                                                                        name="product_variant[{{ $index }}][image]">
                                                                </div>
                                                                <div class="avatar-sm">
                                                                    <div class="avatar-title bg-light rounded">
                                                                        <img src="{{ Storage::url($item->image) }}"
                                                                            id="imagePreviewVariant_{{ $index }}"
                                                                            class="avatar-sm h-auto" alt="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <select class="form-control"
                                                                name="product_variant[{{ $index }}][size]">
                                                                <option value="">Chọn kích cỡ</option>
                                                                @foreach ($sizes as $size_id => $size)
                                                                    <option value="{{ $size_id }}"
                                                                        @selected($item->size_id == $size_id)>
                                                                        {{ $size }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select class="form-control"
                                                                name="product_variant[{{ $index }}][color]">
                                                                <option value="">Chọn màu</option>
                                                                @foreach ($colors as $color_id => $color)
                                                                    <option value="{{ $color_id }}"
                                                                        @selected($item->color_id == $color_id)>
                                                                        {{ $color }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="text"
                                                                name="product_variant[{{ $index }}][quantity]"
                                                                value="{{ $item->quantity }}" placeholder="Số lượng">
                                                        </td>
                                                        <td>
                                                            <div class="input-group has-validation mb-3">
                                                                <span class="input-group-text">VNĐ</span>
                                                                <input type="text" class="form-control"
                                                                    name="product_variant[{{ $index }}][price]"
                                                                    value="{{ number_format($item->price, 0, ',', '.') }}"
                                                                    oninput="formatCurrency(this)">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="btn btn-danger removeVariant"
                                                                data-id="{{ $item->id }}">X</div>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                <!-- Danh sách hoàn tác -->
                                                <ul id="undoList"></ul>

                                                {{-- @endif --}}

                                            </tbody>
                                        </table>
                                        <div class="btn btn-info" id="addMoreVariant">Add more variant</div>
                                    </div>
                                    <!-- end tab-pane -->
                                </div>
                                <!-- end tab content -->
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                        <div class="text-end mb-3">
                            <button type="submit" class="btn btn-success w-sm">Cập Nhật</button>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Xuất Bản</h5>
                            </div>
                            <div class="card-body">
                                <div>
                                    <label for="choices-publish-visibility-input" class="form-label">Trạng Thái</label>
                                    <select class="form-select" id="choices-publish-visibility-input" data-choices
                                        data-choices-search-false name="is_active">
                                        <option value="1" @selected($product->is_active == 1)>Công Khai</option>
                                        <option value="0" @selected($product->is_active == 0)>Ẩn</option>
                                    </select>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Danh Mục Sản Phẩm</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-2"> <a href="#"
                                        class="float-end text-decoration-underline">Thêm Mới </a>Chọn danh mục</p>
                                <select class="form-select" id="choices-category-input" name="category_id">
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" @selected($product->category_id == $item->id)>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </form>

        </div>
        <!-- container-fluid -->
    </div>

@endsection

@section('script')


    <script src="{{ asset('templates/admin/assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}">
    </script>
    {{-- <script src="{{ asset('templates/admin/assets/libs/dropzone/dropzone-min.js') }}"></script> --}}
    <script src="{{ asset('templates/admin/assets/js/pages/ecommerce-product-create.init.js') }}"></script>
    <script src="{{ asset('templates/admin/assets/libs/gallery/gallery.js') }}"></script>
    <script src="{{ asset('templates/admin/assets/libs/product-variant/product-variant.js') }}"></script>
    <script src="{{ asset('templates/admin/assets/libs/price-format/price-format.js') }}"></script>
@endsection

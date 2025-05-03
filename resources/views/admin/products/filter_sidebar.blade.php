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
        <!-- Ví dụ: lựa chọn hiện tại -->
        <div class="filter-choices-input">
            <input class="form-control" data-choices data-choices-removeItem type="text" id="searchProductList" />
        </div>
    </div>

    <div class="accordion accordion-flush filter-accordion">
        <!-- Danh mục (Sản Phẩm) -->
        <div class="card-body border-bottom">
            <div>
                <p class="text-muted text-uppercase fs-12 fw-medium mb-2">Sản Phẩm</p>
                <ul class="list-unstyled mb-0 filter-list">
                    @foreach ($categories as $category)
                        <li>
                            <div class="form-check">
                                <input class="form-check-input category-filter" type="checkbox"
                                    value="{{ $category->id }}" id="category-{{ $category->id }}">
                                <label class="form-check-label" for="category-{{ $category->id }}">
                                    {{ $category->name }}
                                    <span class="badge bg-light text-muted ms-2">{{ $category->products_count }}</span>
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- Price -->
        <div class="card-body border-bottom">
            <p class="text-muted text-uppercase fs-12 fw-medium mb-4">Price</p>
            <div id="product-price-range"></div>
            <div class="formCost d-flex gap-2 align-items-center mt-3">
                <input class="form-control form-control-sm" type="text" id="minCost" value="0" />
                <span class="fw-semibold text-muted">to</span>
                <input class="form-control form-control-sm" type="text" id="maxCost" value="5000000" /> 
            </div>
        </div>
        <!-- Brands -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingBrands">
                <button class="accordion-button bg-transparent shadow-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseBrands" aria-expanded="true" aria-controls="flush-collapseBrands">
                    <span class="text-muted text-uppercase fs-12 fw-medium">Brands</span>
                    <span class="badge bg-success rounded-pill align-middle ms-1 filter-badge"></span>
                </button>
            </h2>
            <div id="flush-collapseBrands" class="accordion-collapse collapse show"
                aria-labelledby="flush-headingBrands">
                <div class="accordion-body text-body pt-0">
                    <!-- Tìm kiếm Brands -->
                    <div class="search-box search-box-sm">
                        <input type="text" class="form-control bg-light border-0" id="searchBrandsList"
                            placeholder="Search Brands...">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                    <div class="d-flex flex-column gap-2 mt-3 filter-check">
                        @foreach ($brands as $brand)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="brands[]"
                                    value="{{ $brand->id }}" id="brand-{{ $brand->id }}">
                                <label class="form-check-label" for="brand-{{ $brand->id }}">
                                    {{ $brand->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Discount -->
        {{-- <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingDiscount">
                <button class="accordion-button bg-transparent shadow-none collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#flush-collapseDiscount"
                    aria-expanded="true" aria-controls="flush-collapseDiscount">
                    <span class="text-muted text-uppercase fs-12 fw-medium">Discount</span>
                    <span class="badge bg-success rounded-pill align-middle ms-1 filter-badge"></span>
                </button>
            </h2>
            <div id="flush-collapseDiscount" class="accordion-collapse collapse"
                aria-labelledby="flush-headingDiscount">
                <div class="accordion-body text-body pt-1">
                    <div class="d-flex flex-column gap-2 filter-check">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="discounts[]"
                                value="50% or more" id="productdiscountRadio6">
                            <label class="form-check-label" for="productdiscountRadio6">50% or
                                more</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="discounts[]"
                                value="40% or more" id="productdiscountRadio5">
                            <label class="form-check-label" for="productdiscountRadio5">40% or
                                more</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="discounts[]"
                                value="30% or more" id="productdiscountRadio4">
                            <label class="form-check-label" for="productdiscountRadio4">30% or
                                more</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="discounts[]"
                                value="20% or more" id="productdiscountRadio3">
                            <label class="form-check-label" for="productdiscountRadio3">20% or
                                more</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="discounts[]"
                                value="10% or more" id="productdiscountRadio2">
                            <label class="form-check-label" for="productdiscountRadio2">10% or
                                more</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="discounts[]"
                                value="Less than 10%" id="productdiscountRadio1">
                            <label class="form-check-label" for="productdiscountRadio1">Less than
                                10%</label>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Rating -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingRating">
                <button class="accordion-button bg-transparent shadow-none collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#flush-collapseRating" aria-expanded="false"
                    aria-controls="flush-collapseRating">
                    <span class="text-muted text-uppercase fs-12 fw-medium">Rating</span>
                    <span class="badge bg-success rounded-pill align-middle ms-1 filter-badge"></span>
                </button>
            </h2>
            <div id="flush-collapseRating" class="accordion-collapse collapse" aria-labelledby="flush-headingRating">
                <div class="accordion-body text-body">
                    <div class="d-flex flex-column gap-2 filter-check">
                        <!-- 4 & Above Star -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ratings[]" value="4 & Above Star"
                                id="productratingRadio4">
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
                        <!-- 3 & Above Star -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ratings[]" value="3 & Above Star"
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
                        <!-- 2 & Above Star -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ratings[]" value="2 & Above Star"
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
                        <!-- 1 Star -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ratings[]" value="1 Star"
                                id="productratingRadio1">
                            <label class="form-check-label" for="productratingRadio1">
                                <span class="text-muted">
                                    <i class="mdi mdi-star text-warning"></i>
                                    <i class="mdi mdi-star"></i>
                                    <i class="mdi mdi-star"></i>
                                    <i class="mdi mdi-star"></i>
                                    <i class="mdi mdi-star"></i>
                                </span> 1 Star
                            </label>
                        </div>
                        <!-- Below 1 Star -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ratings[]" value="Below 1 Star"
                                id="productratingBelow1">
                            <label class="form-check-label" for="productratingBelow1">
                                <span class="text-muted">
                                    <i class="mdi mdi-star-outline"></i>
                                    <i class="mdi mdi-star-outline"></i>
                                    <i class="mdi mdi-star-outline"></i>
                                    <i class="mdi mdi-star-outline"></i>
                                    <i class="mdi mdi-star-outline"></i>
                                </span> Below 1 Star
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- SIZE --}}
        <div class="card-body border-bottom">
            <div>
                <p class="text-muted text-uppercase fs-12 fw-medium mb-2">Màu Sắc</p>
                <ul class="list-unstyled mb-0 filter-list">
                    @foreach ($colors as $colors)
                        <li>
                            <div class="form-check">
                                <input class="form-check-input category-filter" type="checkbox"
                                    value="{{ $colors->id }}" id="colors-{{ $colors->id }}">
                                <label class="form-check-label" for="colors-{{ $colors->id }}">
                                    {{ $colors->color }}
                                    <span class="badge bg-light text-muted ms-2">{{ $colors->products_count }}</span>
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        {{-- COLOR --}}
        <div class="card-body border-bottom">
            <div>
                <p class="text-muted text-uppercase fs-12 fw-medium mb-2">Size </p>
                <ul class="list-unstyled mb-0 filter-list">
                    @foreach ($sizes as $sizes)
                        <li>
                            <div class="form-check">
                                <input class="form-check-input category-filter" type="checkbox"
                                    value="{{ $sizes->id }}" id="sizes-{{ $sizes->id }}">
                                <label class="form-check-label" for="sizes-{{ $sizes->id }}">
                                    {{ $sizes->size }}
                                    <span class="badge bg-light text-muted ms-2">{{ $sizes->products_count }}</span>
                                </label>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- end accordion-item -->
    </div>
</div>




<!-- product main items area start -->
<div class="product-main-items">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="product-sidebar">
                    <div class="sidebar-title">
                        <h2>Lọc</h2>
                    </div>

                    {{-- Form lọc sản phẩm --}}
                    <form id="product-filter-form" method="GET">
                        {{-- Category --}}
                        <div class="single-sidebar">
                            <div class="single-sidebar-title">
                                <h3>Danh mục</h3>
                            </div>
                            <div class="single-sidebar-content">
                                <ul>
                                    @foreach ($categories as $category)
                                        <li>
                                            <label>
                                                <input type="checkbox" name="category[]" value="{{ $category->id }}"
                                                    {{ request()->has('category') && in_array($category->id, (array) request()->category) ? 'checked' : '' }}>
                                                {{ $category->name }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        {{-- Color --}}
                        <div class="single-sidebar">
                            <div class="single-sidebar-title">
                                <h3>Màu sắc</h3>
                            </div>
                            <div class="single-sidebar-content">
                                <ul>
                                    @foreach ($colors as $color)
                                        <li>
                                            <label>
                                                <input type="checkbox" name="color[]" value="{{ $color->id }}"
                                                    {{ request()->has('color') && in_array($color->id, (array) request()->color) ? 'checked' : '' }}>
                                                {{ $color->color }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        {{-- Brand --}}
                        <div class="single-sidebar">
                            <div class="single-sidebar-title">
                                <h3>Thương hiệu</h3>
                            </div>
                            <div class="single-sidebar-content">
                                <ul>
                                    @foreach ($brands as $brand)
                                        <li>
                                            <label>
                                                <input type="checkbox" name="brand[]" value="{{ $brand->id }}"
                                                    {{ request()->has('brand') && in_array($brand->id, (array) request()->brand) ? 'checked' : '' }}>
                                                {{ $brand->name }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        {{-- Sizes --}}
                        <div class="single-sidebar">
                            <div class="single-sidebar-title">
                                <h3>Kích cỡ</h3>
                            </div>
                            <div class="single-sidebar-content">
                                <ul>
                                    @foreach ($sizes as $size)
                                        <li>
                                            <label>
                                                <input type="checkbox" name="size[]" value="{{ $size->id }}"
                                                    {{ request()->has('size') && in_array($size->id, (array) request()->size) ? 'checked' : '' }}>
                                                {{ $size->size }}
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        {{-- Price --}}
                        <div class="single-sidebar price">
                            <div class="single-sidebar-title">
                                <h3>Giá</h3>
                            </div>
                            <div class="single-sidebar-content">
                                <div class="price-range">
                                    <div class="price-filter">
                                        <div id="slider-range"></div>
                                        <div class="price-slider-amount">
                                            <input type="text" id="amount" name="price" readonly
                                                value="{{ request()->price ?? '0-10000000' }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="banner-left mt-4">
                        <a href="#"><img src="{{ asset('img/product/banner_left.jpg') }}" alt=""
                                class="img-fluid"></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="product-bar d-flex justify-content-between">
                    <ul class="nav product-navigation justify-content-center" role="tablist">
                        <li role="presentation" class="gird">
                            <a class="active" href="#gird" aria-controls="gird" role="tab" data-bs-toggle="tab">
                                <span>
                                    <img class="primary" src="{{ asset('img/product/grid-primary.png') }}"
                                        alt="">
                                    <img class="secondary" src="{{ asset('img/product/grid-secondary.png') }}"
                                        alt="">
                                </span>
                                Lưới
                            </a>
                        </li>
                        <li role="presentation" class="list">
                            <a href="#list" aria-controls="list" role="tab" data-bs-toggle="tab">
                                <span>
                                    <img class="primary" src="{{ asset('img/product/list-primary.png') }}"
                                        alt="">
                                    <img class="secondary" src="{{ asset('img/product/list-secondary.png') }}"
                                        alt="">
                                </span>
                                Danh sách
                            </a>
                        </li>
                    </ul>

                    <div class="limit-product">
                        <label>Hiển thị</label>
                        <select name="show" id="per-page-select">
                            <option value="9" selected>9</option>
                            <option value="12">12</option>
                            <option value="24">24</option>
                            <option value="36">36</option>
                        </select>
                        trên trang
                    </div>
                    <div class="d-flex align-items-center" style="position: relative;">
                        <input type="text" name="keyword" id="shop-search-input" placeholder="Tìm kiếm sản phẩm..."
                            value="{{ request()->input('keyword') }}"
                            style="
            width: 250px;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 25px;
            font-size: 14px;
            color: #333;
            background-color: #fff;
            outline: none;
            transition: all 0.3s ease;
        "
                            onfocus="this.style.borderColor='#007bff'; this.style.boxShadow='0 0 5px rgba(0, 123, 255, 0.3)'; this.style.width='280px';"
                            onblur="this.style.borderColor='#ddd'; this.style.boxShadow='none'; this.style.width='250px';"
                            onmouseover="this.style.borderColor='#aaa';" onmouseout="this.style.borderColor='#ddd';">
                    </div>
                </div>
                <div class="row">
                    <div class="product-content">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active fade show home2" id="gird">
                                <div class="row" id="product-container">
                                    {{-- Hiển thị sản phẩm --}}
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade home2" id="list">
                                <div class="product-catagory" id="product-container-list">
                                    {{-- Hiển thị sản phẩm --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="toolbar-bottom">
                            <div id="pagination" class="pagination-container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true"
        id="add-to-cart-form">
        <form action="{{ route('cartApi.add') }}" method="POST" id="add-to-cart-api">
            @csrf
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header-1">
                        <h5 class="modal-title" id="cartModalLabel">Sản phẩm</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex align-items-start gap-4">
                            <input type="hidden" name="product_id" id="product-id-modal" value="">
                            <img src="img/default-image.jpg" alt="Ảnh sản phẩm" id="product-image-modal"
                                class="img-fluid product-img-modal">

                            <div class="flex-grow-1">
                                <h5 id="product-name-modal" class="fw-bold mb-2">Tên sản phẩm</h5>
                                <div class="d-flex align-items-end">
                                    <p id="product-price-modal" class="text-secondary small fw-semibold "
                                        style="text-decoration: line-through"></p>
                                    <p id="product-price-sale-modal" class="text-danger fw-bold"></p>
                                </div>
                                <div class="">
                                    <p class="small" id="product-quantity-modal">Còn 0 sản phẩm</p>
                                </div>

                                <div class="mb-3">
                                    <!-- Chọn màu sắc -->
                                    <label class="form-label fw-medium">Màu sắc:</label>
                                    <input type="hidden" id="color-for-cart" name="color" value="">
                                    <div class="d-flex flex-wrap gap-3 mb-3" id="color-options">

                                    </div>

                                    <!-- Chọn kích cỡ -->
                                    <label class="form-label fw-medium">Kích cỡ:</label>
                                    <input type="hidden" id="size-for-cart" name="size" value="">
                                    <div class="d-flex flex-wrap gap-3" id="size-options">

                                    </div>
                                </div>

                                <p id="error-modal" class="text-danger" style="font-size: 13px"></p>
                                <!-- Chọn số lượng -->
                                <div>
                                    <label for="quantity" class="form-label fw-medium">Số lượng:</label>
                                    <input type="number" id="quantity" name="quantity" class="form-control w-25"
                                        value="1" min="1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary px-4">Thêm vào giỏ hàng</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- product main items area end -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Global variables
        let currentPage = 1;
        let lastPage = 1;
        let perPage = 9;
        let currentKeyword = '';

        // Product fetching and display functions
        async function fetchProducts(page = 1, filters = {}) {
            try {
                let url = new URL("http://127.0.0.1:8000/api/shop");

                // Add filter parameters to URL
                Object.keys(filters).forEach(key => {
                    if (filters[key] && filters[key].length > 0) {
                        if (Array.isArray(filters[key])) {
                            filters[key].forEach(value => url.searchParams.append(`${key}[]`, value));
                        } else {
                            url.searchParams.append(key, filters[key]);
                        }
                    }
                });

                // Add keyword if exists
                if (currentKeyword) {
                    url.searchParams.set('keyword', currentKeyword);
                }

                url.searchParams.append("page", page);
                url.searchParams.append("per_page", perPage);

                const response = await fetch(url);
                const data = await response.json();

                currentPage = data.current_page;
                lastPage = data.last_page;

                displayProducts(data.data);
                updatePagination();

                // Important: Initialize cart functionality after displaying products
                initializeCartForms();
            } catch (error) {
                console.error("Lỗi khi tải sản phẩm:", error);
            }
        }

        function displayProducts(products) {
            let productContainer = document.getElementById("product-container");
            let productContainerList = document.getElementById("product-container-list");

            // Clear both containers
            productContainer.innerHTML = "";
            productContainerList.innerHTML = "";

            if (products.length === 0) {
                productContainer.innerHTML = "<p>Không có sản phẩm nào phù hợp.</p>";
                productContainerList.innerHTML = "<p>Không có sản phẩm nào phù hợp.</p>";
                return;
            }

            products.forEach(product => {
                // Grid display (product-container)
                productContainer.innerHTML += `
            <div class="col-lg-4 col-md-6">
                <div class="single-product">
                    ${product.is_sale 
                        ? '<div class="level-pro-sale"><span>Sale</span></div>' 
                        : product.is_new 
                            ? '<div class="level-pro-new"><span>New</span></div>' 
                            : product.is_top_selling 
                                ? '<div class="level-pro-hot"><span>Hot</span></div>' 
                                : ''}
                    <div class="product-img">
                        <a href="/detail/${product.slug}">
                            <img src="${product.image}" alt="${product.name}" class="primary-img">
                            <img src="${product.variant_image}" alt="${product.name}" class="secondary-img">
                        </a>
                    </div>
                    <div class="actions d-flex justify-content-between w-100">
                        <form class="add-to-cart-form" action="{{ route('get.product') }}" method="get">
                            <input type="hidden" name="idProduct" value="${product.id}">
                            <button type="submit" class="cart-btn"
                                title="Thêm vào giỏ hàng" data-bs-toggle="modal"
                                data-bs-target="#cartModal">
                                Thêm vào giỏ hàng
                            </button>
                        </form>
                        
                        <ul class="add-to-link">
                            <li><a class="modal-view" href="/detail/${product.slug}"><i class="fa fa-search"></i></a></li>
                            <li class="${product.is_favorite ? 'active' : ''}">
                                <a href="#"><i class="fa fa-heart-o"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="product-price">
                        <div class="product-name">
                            <a href="/detail/${product.slug}" title="${product.name}">${product.name}</a>
                        </div>
                        <div class="price-rating">
                            <span class="old-price">${product.price} VND</span>
                            <span class="text-danger">${product.price_sale} VND</span>
                            <div class="ratings">
                                <span>${product.average_rating}</span> <i class="fa fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;

                // List display (product-container-list)
                productContainerList.innerHTML += `
            <div class="single-list-product row">
                <div class="col-md-4">
                    <div class="product-img">
                        <a href="/detail/${product.slug}">
                            <img src="${product.image}" alt="${product.name}" class="primary-img">
                            <img src="${product.variant_image}" alt="${product.name}" class="secondary-img">
                        </a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="list-product-info">
                        <a href="/detail/${product.slug}" class="list-product-name">${product.name}</a>
                        <div class="price-rating">
                            <span class="old-price">${product.price} VND</span>
                            <span class="text-danger">${product.price_sale} VND</span>
                            <div class="ratings">
                                <span>${product.average_rating}</span> <i class="fa fa-star"></i>
                                <a href="#" class="review">${product.rating_count} Đánh giá</a>
                            </div>
                        </div>
                        <div class="list-product-details">
                            ${product.description || 'Không có mô tả'}
                            <a href="/detail/${product.slug}">Đọc thêm</a>
                        </div>
                    </div>
                </div>
            </div>`;
            });
        }

        function updatePagination() {
            let paginationContainer = document.getElementById("pagination");
            paginationContainer.innerHTML = "";

            if (lastPage <= 1) return;

            if (currentPage > 1) {
                paginationContainer.innerHTML +=
                    `<button onclick="fetchProducts(${currentPage - 1}, getFilters())">« Trang trước</button>`;
            }

            for (let i = 1; i <= lastPage; i++) {
                paginationContainer.innerHTML +=
                    `<button onclick="fetchProducts(${i}, getFilters())" ${i === currentPage ? 'class="active"' : ''}>${i}</button>`;
            }

            if (currentPage < lastPage) {
                paginationContainer.innerHTML +=
                    `<button onclick="fetchProducts(${currentPage + 1}, getFilters())">Trang sau »</button>`;
            }
        }

        function getFilters() {
            const categories = Array.from(document.querySelectorAll('input[name="category[]"]:checked')).map(input => input
                .value);
            const colors = Array.from(document.querySelectorAll('input[name="color[]"]:checked')).map(input => input.value);
            const brands = Array.from(document.querySelectorAll('input[name="brand[]"]:checked')).map(input => input.value);
            const sizes = Array.from(document.querySelectorAll('input[name="size[]"]:checked')).map(input => input.value);
            const price = document.getElementById("amount").value;

            return {
                category: categories,
                color: colors,
                brand: brands,
                size: sizes,
                price: price
            };
        }

        // Cart functionality
        function initializeCartForms() {
            const forms = document.querySelectorAll('.add-to-cart-form');
            const modalElement = document.getElementById('cartModal');
            const modal = new bootstrap.Modal(modalElement);

            forms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    const formData = new FormData(form);
                    const url = form.action + '?' + new URLSearchParams(formData).toString();

                    fetch(url, {
                            method: 'GET',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById('product-id-modal').value = data.data
                                    .id;
                                document.getElementById('product-name-modal').textContent = data
                                    .data.name;
                                document.getElementById('product-quantity-modal').textContent =
                                    'Còn ' + data.data.quantity + ' sản phẩm';
                                const initialQuantity = data.data.quantity;
                                document.getElementById('product-image-modal').setAttribute(
                                    'src', 'http://127.0.0.1:8000/storage/' + data.data
                                    .image);
                                const priceProduct = Number(data.data.price);
                                const priceSaleProduct = Number(data.data.price_sale);
                                if (priceSaleProduct > 0 && priceSaleProduct < priceProduct) {
                                    document.getElementById('product-price-modal').textContent =
                                        `${priceProduct.toLocaleString('vi-VN')} VND`;
                                    document.getElementById('product-price-sale-modal')
                                        .textContent =
                                        `${priceSaleProduct.toLocaleString('vi-VN')} VND`;
                                } else {
                                    document.getElementById('product-price-sale-modal')
                                        .textContent =
                                        `${priceProduct.toLocaleString('vi-VN')} VND`;
                                    document.getElementById('product-price-modal').textContent =
                                        '';
                                }

                                // Colors
                                const colorOptions = document.getElementById('color-options');
                                const colorForCart = document.getElementById('color-for-cart');
                                const sizeForCart = document.getElementById('size-for-cart');
                                colorOptions.innerHTML = '';
                                data.data.colors.forEach((color, index) => {
                                    const active = index === 0 ? 'active' : '';
                                    colorOptions.innerHTML += `
                            <button type="button" name="color" style="background-color: ${color.code};" class=" color-btn" data-value="${color.id}" value="${color.id}"></button>
                        `;
                                });

                                // Sizes
                                const sizeOptions = document.getElementById('size-options');
                                sizeOptions.innerHTML = '';
                                data.data.sizes.forEach((size, index) => {
                                    const active = index === 0 ? 'active' : '';
                                    sizeOptions.innerHTML += `
                            <button type="button" name="size" class="btn btn-outline-secondary size-btn" data-value="${size.id}" value="${size.id}">${size.size}</button>
                        `;
                                });

                                // Check and reset quantity
                                function updateQuantityDisplay() {
                                    const activeColor = document.querySelector(
                                        '.color-btn.active');
                                    const activeSize = document.querySelector(
                                        '.size-btn.active');
                                    if (!activeColor && !activeSize) {
                                        document.getElementById('product-quantity-modal')
                                            .textContent = 'Còn ' + initialQuantity +
                                            ' sản phẩm';
                                        if (priceSaleProduct > 0 && priceSaleProduct < priceProduct) {
                                            document.getElementById('product-price-modal')
                                                .textContent =
                                                `${priceProduct.toLocaleString('vi-VN')} VND`;
                                            document.getElementById('product-price-sale-modal')
                                                .textContent =
                                                `${priceSaleProduct.toLocaleString('vi-VN')} VND`;
                                        } else {
                                            document.getElementById('product-price-sale-modal')
                                                .textContent =
                                                `${priceProduct.toLocaleString('vi-VN')} VND`;
                                            document.getElementById('product-price-modal')
                                                .textContent = '';
                                        }
                                        document.getElementById('product-image-modal')
                                            .setAttribute('src',
                                                'http://127.0.0.1:8000/storage/' + data.data
                                                .image);
                                    }
                                }

                                // Update size availability based on color
                                function updateSizeAvailability(selectedColorId) {
                                    const sizeButtons = document.querySelectorAll('.size-btn');
                                    sizeButtons.forEach(button => {
                                        const sizeId = button.getAttribute(
                                            'data-value');
                                        const variant = data.data.variants.find(v =>
                                            v.color_id == selectedColorId && v
                                            .size_id == sizeId
                                        );

                                        if (variant && variant.quantity > 0) {
                                            const priceVariant = Number(variant.price);
                                            const priceSaleVariant = Number(variant
                                                .price_sale);

                                            button.disabled = false;
                                            button.classList.remove('btn-disabled');
                                            if (button.classList.contains('active')) {
                                                document.getElementById(
                                                        'product-quantity-modal')
                                                    .textContent = 'Còn ' + variant
                                                    .quantity + ' sản phẩm';
                                                if (priceSaleVariant > 0 &&
                                                    priceSaleVariant < priceVariant) {
                                                    document.getElementById(
                                                            'product-price-modal')
                                                        .textContent =
                                                        `${priceVariant.toLocaleString('vi-VN')} VND`;
                                                    document.getElementById(
                                                            'product-price-sale-modal')
                                                        .textContent =
                                                        `${priceSaleVariant.toLocaleString('vi-VN')} VND`;
                                                } else {
                                                    document.getElementById(
                                                            'product-price-sale-modal')
                                                        .textContent =
                                                        `${priceVariant.toLocaleString('vi-VN')} VND`;
                                                    document.getElementById(
                                                            'product-price-modal')
                                                        .textContent = '';
                                                }
                                                document.getElementById(
                                                        'product-image-modal')
                                                    .setAttribute('src',
                                                        'http://127.0.0.1:8000/storage/' +
                                                        variant.image);
                                            }
                                        } else {
                                            button.disabled = true;
                                            button.classList.add('btn-disabled');
                                            button.classList.remove('active');
                                        }
                                    });

                                    const activeSize = document.querySelector(
                                        '.size-btn.active');
                                    if (!activeSize || activeSize.disabled) {
                                        const firstAvailableSize = document.querySelector(
                                            '.size-btn:not(.btn-disabled)');
                                        if (firstAvailableSize) {
                                            sizeButtons.forEach(btn => btn.classList.remove(
                                                'active'));
                                        }
                                    }
                                    updateQuantityDisplay(); // Check after update
                                }

                                // Update color availability based on size
                                function updateColorAvailability(selectedSizeId) {
                                    const colorButtons = document.querySelectorAll(
                                        '.color-btn');
                                    colorButtons.forEach(button => {
                                        const colorId = button.getAttribute(
                                            'data-value');
                                        const variant = data.data.variants.find(v =>
                                            v.color_id == colorId && v.size_id ==
                                            selectedSizeId
                                        );

                                        if (variant && variant.quantity > 0) {
                                            const priceVariant = Number(variant.price);
                                            const priceSaleVariant = Number(variant
                                                .price_sale);
                                            button.disabled = false;
                                            button.classList.remove('btn-disabled');
                                            if (button.classList.contains('active')) {
                                                document.getElementById(
                                                        'product-quantity-modal')
                                                    .textContent = 'Còn ' + variant
                                                    .quantity + ' sản phẩm';
                                                if (priceSaleVariant > 0 &&
                                                    priceSaleVariant < priceVariant) {
                                                    document.getElementById(
                                                            'product-price-modal')
                                                        .textContent =
                                                        `${priceVariant.toLocaleString('vi-VN')} VND`;
                                                    document.getElementById(
                                                            'product-price-sale-modal')
                                                        .textContent =
                                                        `${priceSaleVariant.toLocaleString('vi-VN')} VND`;
                                                } else {
                                                    document.getElementById(
                                                            'product-price-sale-modal')
                                                        .textContent =
                                                        `${priceVariant.toLocaleString('vi-VN')} VND`;
                                                    document.getElementById(
                                                            'product-price-modal')
                                                        .textContent = '';
                                                }
                                                document.getElementById(
                                                        'product-image-modal')
                                                    .setAttribute('src',
                                                        'http://127.0.0.1:8000/storage/' +
                                                        variant.image);
                                            }
                                        } else {
                                            button.disabled = true;
                                            button.classList.add('btn-disabled');
                                            button.classList.remove('active');
                                        }
                                    });

                                    const activeColor = document.querySelector(
                                        '.color-btn.active');
                                    if (!activeColor || activeColor.disabled) {
                                        const firstAvailableColor = document.querySelector(
                                            '.color-btn:not(.btn-disabled)');
                                        if (firstAvailableColor) {
                                            colorButtons.forEach(btn => btn.classList.remove(
                                                'active'));
                                        }
                                    }
                                    updateQuantityDisplay(); // Check after update
                                }

                                // Manage colors with toggle
                                const colorButtons = document.querySelectorAll('.color-btn');
                                colorButtons.forEach(button => {
                                    button.addEventListener('click', function() {
                                        if (!this.disabled) {
                                            const isActive = this.classList
                                                .contains('active');
                                            colorButtons.forEach(btn => btn
                                                .classList.remove('active'));
                                            if (!isActive) {
                                                this.classList.add('active');
                                                const selectedColorId = this
                                                    .getAttribute('data-value');
                                                colorForCart.value =
                                                    selectedColorId;
                                                updateSizeAvailability(
                                                    selectedColorId);
                                            } else {
                                                colorForCart.value = '';
                                                const sizeButtons = document
                                                    .querySelectorAll(
                                                        '.size-btn');
                                                sizeButtons.forEach(button => {
                                                    button.disabled =
                                                        false;
                                                    button.classList
                                                        .remove(
                                                            'btn-disabled'
                                                        );
                                                });
                                                updateQuantityDisplay
                                                    (); // Update quantity when deselected
                                            }
                                        }
                                    });
                                });

                                // Manage sizes with toggle
                                const sizeButtons = document.querySelectorAll('.size-btn');
                                sizeButtons.forEach(button => {
                                    button.addEventListener('click', function() {
                                        if (!this.disabled) {
                                            const isActive = this.classList
                                                .contains('active');
                                            sizeButtons.forEach(btn => btn
                                                .classList.remove('active'));
                                            if (!isActive) {
                                                this.classList.add('active');
                                                const selectedSizeId = this
                                                    .getAttribute('data-value');
                                                sizeForCart.value =
                                                    selectedSizeId;
                                                updateColorAvailability(
                                                    selectedSizeId);
                                            } else {
                                                sizeForCart.value = '';
                                                const colorButtons = document
                                                    .querySelectorAll(
                                                        '.color-btn');
                                                colorButtons.forEach(button => {
                                                    button.disabled =
                                                        false;
                                                    button.classList
                                                        .remove(
                                                            'btn-disabled'
                                                        );
                                                });
                                                updateQuantityDisplay
                                                    (); // Update quantity when deselected
                                            }
                                        }
                                    });
                                });

                                modal.show();
                            } else {
                                console.error('Lỗi:', data.message);
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Lỗi:', error);
                            alert('Đã có lỗi xảy ra!');
                        });
                });
            });

            // Handle modal close
            modalElement.addEventListener('hidden.bs.modal', function() {
                forms.forEach(form => form.reset());
                const backdrops = document.querySelectorAll('.modal-backdrop');
                backdrops.forEach(backdrop => backdrop.remove());
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            });
        }

        // Event handlers and initialization
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            currentKeyword = urlParams.get('keyword') || '';

            // Update initial input value
            const shopInput = document.getElementById('shop-search-input');
            if (shopInput) shopInput.value = currentKeyword;

            // Initialize slider
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 10000000,
                values: [0, 10000000],
                slide: function(event, ui) {
                    $("#amount").val(ui.values[0] + "-" + ui.values[1]);
                },
                stop: function(event, ui) {
                    fetchProducts(1, getFilters());
                }
            });
            $("#amount").val($("#slider-range").slider("values", 0) + "-" + $("#slider-range").slider("values", 1));

            if (shopInput) {
                shopInput.addEventListener('input', function() {
                    clearTimeout(window.searchTimeout);
                    window.searchTimeout = setTimeout(() => {
                        currentKeyword = this.value.trim();
                        fetchProducts(1, getFilters());
                    }, 500); // Debounce 500ms
                });
            }

            // Handle form submit
            document.getElementById('product-filter-form').addEventListener('submit', function(e) {
                e.preventDefault();
                fetchProducts(1, getFilters());
            });

            // Handle checkbox changes
            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                checkbox.addEventListener('change', () => {
                    fetchProducts(1, getFilters());
                });
            });

            // Handle per-page select change
            document.getElementById('per-page-select').addEventListener('change', function() {
                perPage = parseInt(this.value);
                fetchProducts(1, getFilters()); // Reset to page 1 when changing per_page
            });

            // Load initial products
            fetchProducts();
        });
    </script>

    <script>
        document.getElementById('add-to-cart-api').addEventListener('submit', function(e) {
            e.preventDefault(); // Ngăn form submit mặc định

            // Lấy dữ liệu từ form
            const formData = new FormData(this);
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content ||
                document.querySelector('input[name="_token"]').value;

            // Gửi request Ajax
            fetch("{{ route('cartApi.add') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    const errorModal = document.getElementById('error-modal');
                    errorModal.innerHTML = ''; // Xóa lỗi cũ

                    if (data.status === 'success') {
                        // Cập nhật nội dung modal
                        document.getElementById('notificationModalBody').innerText = data.message;

                        // Hiển thị modal
                        const notificationModalEl = document.getElementById('notificationModal');
                        const notificationModal = new bootstrap.Modal(notificationModalEl);
                        notificationModal.show();

                        // Đóng modal sau 2 giây
                        setTimeout(() => {
                            notificationModal.hide();
                        }, 1000);

                        // Đóng modal giỏ hàng (nếu cần)
                        bootstrap.Modal.getInstance(document.getElementById('cartModal')).hide();
                    } else {
                        if (data.errors) {
                            let errorMessages = '';
                            Object.values(data.errors).forEach(error => {
                                errorMessages += error[0] + '<br>';
                            });
                            errorModal.innerHTML = errorMessages;
                        } else {
                            errorModal.innerHTML = data.message;
                        }
                    }
                })

                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('error-modal').innerHTML =
                        'Đã xảy ra lỗi khi thêm sản phẩm vào giỏ hàng!';
                });
        });
    </script>

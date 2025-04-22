@extends('client.layouts.app')

@section('title', 'Chi Tiết Sản Phẩm')
@section('breadcrumb', 'Chi Tiết Sản Phẩm')


@section('style')
    <style>
        .btn-outline-secondary {
            border: 2px solid #6c757d;
            color: #6c757d;
            background-color: transparent;
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        /* Trạng thái active */
        .btn-outline-secondary.active {
            background-color: #e63946;
            color: #fff;
            border-color: #e63946;
            box-shadow: 0 4px 8px rgba(230, 57, 70, 0.2);
        }

        .btn-outline-secondary:hover:not(.active) {
            background-color: #f1f3f5;
            color: #343a40;
            border-color: #5a6268;
            transform: translateY(-1px);
        }

        /* Focus state */
        .btn-outline-secondary:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(108, 117, 125, 0.3);
        }

        .color-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 2px solid #e9ecef;
            margin: 6px;
            cursor: pointer;
            outline: none;
            background-size: cover;
            transition: all 0.3s ease;
            position: relative;
        }

        .color-btn:hover {
            transform: scale(1.15);
            border-color: #495057;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .color-btn.active {
            border: 3px solid #212529;
            transform: scale(1.05);
            box-shadow: 0 0 0 4px rgba(33, 37, 41, 0.2);
        }


        #add-to-cart-btn-detail {
            padding: 12px 20px;
            font-size: 16px;
            font-weight: 500;
            border-radius: 6px;
            border: none;
            background: #e63946;
            color: #fff;
            transition: background 0.3s, transform 0.2s;
            box-shadow: 0 2px 4px rgba(230, 57, 70, 0.3);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        #add-to-cart-btn-detail:hover {
            background: #cc2f3b;
            transform: translateY(-2px);
        }

        #add-to-cart-btn-detail:active {
            background: #b22632;
            transform: translateY(0);
        }


        #single-product-slider-detail {
            width: 555px;
            display: flex;
            overflow: hidden;
            position: relative;
            gap: 13px;
            margin-top: 5px;

        }

        .single-product-slider {
            display: flex;
            flex: 0 0 100px;
            gap: 12px;
            transition: transform 0.5s ease-in-out;
        }

        .slider-image-detail {
            width: 100px;
            height: 100px;
            display: block;
            /* Ensure the <a> tag behaves as a block for proper sizing */
        }

        .slider-image-detail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 5px;
        }

        .slider-image-detail.active {
            border: 2px solid #007bff;
            border-radius: 7px;
            /* Highlight active slide */
        }

        .next-slider-detail,
        .prev-slider-detail {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 10;
            /* Ensure buttons are above slides */
        }

        .prev-slider-detail {
            left: 10px;
        }

        .next-slider-detail {
            right: 10px;
        }

        .products-slider-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
        }

        .products-slider {
            display: flex;
            overflow-x: hidden;
            scroll-behavior: smooth;
            gap: 15px;
            padding: 10px 0;
        }

        .single-product {
            flex: 0 0 calc(25% - 15px);
            min-width: calc(25% - 15px);
        }

        .slider-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.8);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 10;
            transition: .3s ease;
        }

        .slider-button:hover {
            color: #fff;
            background: #cc2f3b;
        }

        .prev-button {
            left: 10px;
        }

        .next-button {
            right: 10px;
        }

        .slider-dots {
            display: flex;
            justify-content: center;
            margin-top: 15px;
            gap: 8px;
        }

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #ddd;
            cursor: pointer;
            transition: .2s ease;
        }

        .dot.active {
            background-color: #cc2f3b;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .single-product {
                flex: 0 0 calc(50% - 10px);
                min-width: calc(50% - 10px);
            }
        }

        @media (max-width: 576px) {
            .single-product {
                flex: 0 0 calc(100% - 10px);
                min-width: calc(100% - 10px);
            }
        }
    </style>
@endsection

@section('content')
    @include('client.components.breadcrumb')
    @include('client.pages.detail.product')
    @include('client.pages.detail.product-tab')
    @include('client.pages.detail.upsell-product')
    @include('client.pages.detail.related-product')
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function getSlug() {
                const pathParts = window.location.pathname.split('/').filter(part => part);
                const slug = pathParts[pathParts.length - 1];
                return slug && slug !== 'product' ? slug : null;
            }

            const slug = getSlug();

            if (!slug) {
                document.getElementById('product-details').innerHTML =
                    '<p class="error">Không tìm thấy slug sản phẩm trong URL</p>';
                return;
            }



            async function fetchProductDetails() {
                try {
                    const response = await fetch(`/api/detail/${slug}`);
                    const data = await response.json();

                    if (data.status === 'success') {
                        const product = data.data.product;
                        const variants = data.data.product_variants;

                        const colors = product.colors;
                        const sizes = product.sizes;

                        document.getElementById('product-id-detail').value = product.id;

                        const imageSliders = document.getElementById('single-product-slider');
                        imageSliders.innerHTML = `<div class="single-product-slider" id="single-product-slider">
                        <a class="active slider-image-detail" href="#pro-large-img-1" data-bs-toggle="tab">
                            <img src="http://127.0.0.1:8000/storage/${product.image}" alt="Ảnh thu nhỏ sản phẩm" id="image-slider-main">
                        </a>
                    </div>`;
                        product.galleries.forEach((image, index) => {
                            imageSliders.innerHTML +=
                                `<a class="slider-image-detail" href="#pro-large-img-${index+2}" data-bs-toggle="tab">
                                    <img src="http://127.0.0.1:8000/storage/${image.image}" alt="Ảnh thu nhỏ sản phẩm">
                                </a>`;
                        });
                        // Initialize slider
                        let currentIndex = 0;
                        const slides = document.querySelectorAll('.slider-image-detail');

                        const totalSlides = slides.length;
                        const visibleSlides = 5;

                        function moveSlide(direction) {
                            currentIndex += direction;

                            if (currentIndex >= totalSlides) {
                                currentIndex = 0;
                            } else if (currentIndex < 0) {
                                currentIndex = totalSlides - 1;
                            }

                            updateSlider();
                        }

                        function updateSlider() {
                            slides.forEach((slide, index) => {
                                slide.classList.toggle('active', index === currentIndex);
                            });

                            // Update main image
                            const currentImage = slides[currentIndex].querySelector('img').src;
                            document.getElementById('main-image-product-detail').setAttribute(
                                'src', currentImage);

                            let translateX = currentIndex * 113;
                            if (currentIndex > totalSlides - visibleSlides) {
                                translateX = (totalSlides - visibleSlides) * 113;
                            }
                            if (currentIndex < 0) {
                                translateX = (totalSlides - visibleSlides) * 113;
                            }
                            imageSliders.style.transform = `translateX(-${translateX}px)`;
                        }

                        // Attach event listeners to buttons
                        const prevButton = document.querySelector('.prev-slider-detail');
                        const nextButton = document.querySelector('.next-slider-detail');
                        prevButton.addEventListener('click', () => moveSlide(-1));
                        nextButton.addEventListener('click', () => moveSlide(1));

                        // Attach click event listeners to thumbnails
                        slides.forEach((slide, index) => {
                            slide.addEventListener('click', (e) => {
                                e.preventDefault();
                                currentIndex = index;
                                updateSlider();
                            });
                        });

                        // Initialize slider
                        if (totalSlides > 0) {
                            updateSlider();
                        }

                        document.getElementById('product-name-detail').textContent = product.name;
                        document.getElementById('product-quantity-detail').textContent =
                            'Còn ' + product.quantity + ' sản phẩm';
                        const initialQuantity = product.quantity;
                        const priceProduct = Number(product.price);
                        const priceSaleProduct = Number(product.price_sale);

                        if (priceSaleProduct > 0 && priceSaleProduct < priceProduct) {
                            document.getElementById('price-detail').textContent =
                                `${priceProduct.toLocaleString('vi-VN')} VND`;
                            document.getElementById('price-sale-detail').textContent =
                                `${priceSaleProduct.toLocaleString('vi-VN')} VND`;
                        } else {
                            document.getElementById('price-sale-detail').textContent =
                                `${priceProduct.toLocaleString('vi-VN')} VND`;
                            document.getElementById('price-detail').style.display = 'none';
                        }


                        const colorForCart = document.getElementById('selected-color-detail');
                        const sizeForCart = document.getElementById('selected-size-detail');
                        const colorOptions = document.getElementById('color-detail-options');
                        colorOptions.innerHTML = '';
                        colors.forEach(color => {
                            colorOptions.innerHTML +=
                                `<button type="button" name="color" style="background-color: ${color.code};"  class=" color-btn" data-value="${color.id}" value="${color.id}"></button>`;
                        });

                        const sizeOptions = document.getElementById('size-detail-options');
                        sizeOptions.innerHTML = '';
                        sizes.forEach(size => {
                            sizeOptions.innerHTML += `
                                <button type="button" name="size" class="btn btn-outline-secondary size-btn" data-value="${size.id}" value="${size.id}">${size.size}</button>
                            `;
                        });

                        function updateQuantityDisplay() {
                            const activeColor = document.querySelector(
                                '.color-btn.active');
                            const activeSize = document.querySelector(
                                '.size-btn.active');
                            if (!activeColor && !activeSize) {
                                document.getElementById('product-quantity-detail')
                                    .textContent = 'Còn ' + initialQuantity + ' sản phẩm';
                                if (priceSaleProduct > 0 && priceSaleProduct <
                                    priceProduct) {
                                    document.getElementById('price-detail')
                                        .textContent =
                                        `${priceProduct.toLocaleString('vi-VN')} VND`;
                                    document.getElementById('price-sale-detail')
                                        .textContent =
                                        `${priceSaleProduct.toLocaleString('vi-VN')} VND`;
                                } else {
                                    document.getElementById('price-sale-detail')
                                        .textContent =
                                        `${priceProduct.toLocaleString('vi-VN')} VND`;
                                    document.getElementById('price-detail')
                                        .textContent = '';
                                }
                                document.getElementById('main-image-product-detail')
                                    .setAttribute('src',
                                        'http://127.0.0.1:8000/storage/' + product.image);
                            }
                        }

                        // Hàm cập nhật trạng thái kích cỡ dựa trên màu
                        function updateSizeAvailability(selectedColorId) {
                            const sizeButtons = document.querySelectorAll('.size-btn');
                            sizeButtons.forEach(button => {
                                const sizeId = button.getAttribute(
                                    'data-value');
                                const variant = variants.find(v =>
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
                                                'product-quantity-detail')
                                            .textContent = 'Còn ' + variant
                                            .quantity + ' sản phẩm';
                                        if (priceSaleVariant > 0 &&
                                            priceSaleVariant < priceVariant) {
                                            document.getElementById(
                                                    'price-detail')
                                                .textContent =
                                                `${priceVariant.toLocaleString('vi-VN')} VND`;
                                            document.getElementById(
                                                    'price-sale-detail')
                                                .textContent =
                                                `${priceSaleVariant.toLocaleString('vi-VN')} VND`;
                                        } else {
                                            document.getElementById(
                                                    'price-sale-detail')
                                                .textContent =
                                                `${priceVariant.toLocaleString('vi-VN')} VND`;
                                            document.getElementById(
                                                    'price-detail')
                                                .textContent = '';
                                        }
                                        document.getElementById(
                                                'main-image-product-detail')
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
                            updateQuantityDisplay();
                        }

                        // Hàm cập nhật trạng thái màu dựa trên kích cỡ
                        function updateColorAvailability(selectedSizeId) {
                            const colorButtons = document.querySelectorAll(
                                '.color-btn');
                            colorButtons.forEach(button => {
                                const colorId = button.getAttribute(
                                    'data-value');
                                const variant = variants.find(v =>
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
                                                'product-quantity-detail')
                                            .textContent = 'Còn ' + variant
                                            .quantity + ' sản phẩm';
                                        if (priceSaleVariant > 0 &&
                                            priceSaleVariant < priceVariant) {
                                            document.getElementById(
                                                    'price-detail')
                                                .textContent =
                                                `${priceVariant.toLocaleString('vi-VN')} VND`;
                                            document.getElementById(
                                                    'price-sale-detail')
                                                .textContent =
                                                `${priceSaleVariant.toLocaleString('vi-VN')} VND`;
                                        } else {
                                            document.getElementById(
                                                    'price-sale-detail')
                                                .textContent =
                                                `${priceVariant.toLocaleString('vi-VN')} VND`;
                                            document.getElementById(
                                                    'price-detail')
                                                .textContent = '';
                                        }
                                        document.getElementById(
                                                'main-image-product-detail')
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
                            updateQuantityDisplay(); // Kiểm tra sau khi cập nhật
                        }

                        // Quản lý màu sắc với toggle
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
                                            (); // Cập nhật số lượng khi bỏ chọn
                                    }
                                }
                            });
                        });

                        // Quản lý kích cỡ với toggle
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
                                            (); // Cập nhật số lượng khi bỏ chọn
                                    }
                                }
                            });
                        });

                    } else {
                        document.getElementById('single-product-details').innerHTML =
                            '<p>Product not found</p>';
                    }
                } catch (error) {
                    console.error('Error fetching product details:', error);
                    document.getElementById('single-product-details').innerHTML =
                        '<p>Error loading product</p>';
                }
            }

            function resetDataForm() {
                document.getElementById('selected-color-detail').value = '';
                document.getElementById('selected-size-detail').value = '';
            }

            document.getElementById('add-cart-item-form').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content ||
                    document.querySelector('input[name="_token"]').value;

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
                        errorModal.innerHTML = '';

                        if (data.status === 'success') {

                            document.getElementById('notificationModalBody').innerText = data.message;

                            const notificationModalEl = document.getElementById('notificationModal');

                            const notificationModal = new bootstrap.Modal(notificationModalEl);
                            notificationModal.show();

                            setTimeout(() => {
                                notificationModal.hide();
                            }, 1000);
                            fetchCart();
                            resetDataForm();
                            fetchProductDetails();

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



            fetchProductDetails();
            if (slug) {
                fetchRelatedProducts(slug);
                fetchRecommendProducts(slug);
            } else {
                loadDummyData();
            }
        });


        function renderProductPrice(product) {
            // Kiểm tra nếu có giá khuyến mãi và nó nhỏ hơn giá gốc
            if (product.price_sale && product.price_sale < product.price) {
                return `<span class="old-price">${formatPrice(product.price)} VND</span>
                        <span style="color: red">${formatPrice(product.price_sale)} VND</span>`;
            } else {
                // Nếu không có giá khuyến mãi hoặc giá khuyến mãi không nhỏ hơn giá gốc
                return `<span>${formatPrice(product.price)} VND</span>`;
            }
        }

        function renderProductItem(product) {
            return `
                <div class="single-product">
                <div class="product-img">
                    <a href="/detail/${product.slug}">
                    <img src="${product.image}" alt="" class="primary-img" />
                    <img src="${product.secondary_image}" alt="" class="secondary-img" />
                    </a>
                </div>
                <div class="product-name">
                    <a href="/detail/${product.slug}" title="">${product.name}</a>
                </div>
                

                <div class="price-rating d-flex justify-content-between mx-1">
                        <div>
                        ${renderProductPrice(product)}
                        </div>
                        <div class="ratings">
                        <span></span>${product.average_rating} <i class="fa fa-star"></i>
                        </div>
                    </div>
                </div>
            `;
        }

        // Hàm định dạng giá tiền
        function formatPrice(price) {
            return Math.floor(price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        async function fetchRelatedProducts(slug) {
            try {
                const response = await fetch(
                    `/api/get-related-products/${slug}`
                );
                if (!response.ok) {
                    throw new Error(
                        `HTTP error! Status: ${response.status}`
                    );
                }
                const data = await response.json();
                const relatedProducts = data.data.related_products;
                const relatedProductsDisplay =
                    document.getElementById("related-products");

                if (data.status === "success") {
                    relatedProductsDisplay.innerHTML = "";

                    // Generate slider items
                    relatedProducts.forEach((product) => {
                        relatedProductsDisplay.innerHTML += renderProductItem(product);
                    });

                    // Initialize slider
                    initSlider('#related-products-slider');
                } else {
                    console.error(
                        "Failed to fetch related products:",
                        data.message
                    );
                    document.getElementById("related-products").innerHTML =
                        "<p>Không tìm thấy sản phẩm liên quan.</p>";
                }
            } catch (error) {
                console.error("Error fetching related products:", error);
                document.getElementById("related-products").innerHTML =
                    "<p>Lỗi khi tải sản phẩm liên quan.</p>";
            }
        }

        async function fetchRecommendProducts(slug) {
            try {
                const response = await fetch(
                    `/api/get-recommend-products/${slug}`
                );
                if (!response.ok) {
                    throw new Error(
                        `HTTP error! Status: ${response.status}`
                    );
                }
                const data = await response.json();
                const recommendedProducts = data.data.recommended_products;


                const recommendedProductsDisplay =
                    document.getElementById("recommended-products");

                if (data.status === "success") {
                    recommendedProductsDisplay.innerHTML = "";

                    recommendedProducts.forEach((product) => {

                        recommendedProductsDisplay.innerHTML += renderProductItem(product);
                    });

                    // Initialize slider
                    initSlider('#commended-products-slider');
                } else {
                    console.error(
                        "Failed to fetch related products:",
                        data.message
                    );
                    document.getElementById("related-products").innerHTML =
                        "<p>Không tìm thấy sản phẩm liên quan.</p>";
                }
            } catch (error) {
                console.error("Error fetching related products:", error);
                document.getElementById("related-products").innerHTML =
                    "<p>Lỗi khi tải sản phẩm liên quan.</p>";
            }
        }

        // For demo purposes - create dummy data if API is not available
        // function loadDummyData() {
        //     const relatedProductsDisplay = document.getElementById('related-products');
        //     relatedProductsDisplay.innerHTML = '';

        //     // Generate 8 dummy products
        //     for (let i = 0; i < 8; i++) {
        //         relatedProductsDisplay.innerHTML += `
    //             <div class="single-product">
    //                 <div class="product-img">
    //                     <a href="single-product.html">
    //                         <img src="/api/placeholder/250/200" alt="" class="primary-img">
    //                         <img src="/api/placeholder/250/200" alt="" class="secondary-img">
    //                     </a>
    //                 </div>
    //                 <div class="product-price">
    //                     <div class="product-name">
    //                         <a href="single-product.html" title="Product ${i+1}">Product ${i+1}</a>
    //                     </div>
    //                     <div class="price-rating">
    //                         <span>$${(150 + i * 10).toFixed(2)}</span>
    //                     </div>
    //                 </div>
    //             </div>
    //         `;
        //     }

        //     // Initialize slider after loading dummy data
        //     initSlider();
        // }

        function initSlider(containerSelector) {
            const container = document.querySelector(containerSelector);
            if (!container) return;

            const slider = container.querySelector('.products-slider');
            const prevButton = container.querySelector('.prev-button');
            const nextButton = container.querySelector('.next-button');
            const dotsContainer = container.querySelector('.slider-dots');

            const itemsPerSlide = 4;
            const totalItems = slider.children.length;
            const totalSlides = Math.ceil(totalItems / itemsPerSlide);

            // Create dots
            dotsContainer.innerHTML = '';
            for (let i = 0; i < totalSlides; i++) {
                const dot = document.createElement('div');
                dot.classList.add('dot');
                if (i === 0) dot.classList.add('active');
                dot.addEventListener('click', () => {
                    goToSlide(i);
                    updateActiveDot(i);
                });
                dotsContainer.appendChild(dot);
            }

            let currentSlide = 0;
            const slideWidth = slider.offsetWidth;

            function goToSlide(slideIndex) {
                const scrollAmount = slideIndex * slideWidth;
                slider.scrollLeft = scrollAmount;
                currentSlide = slideIndex;
            }

            function updateActiveDot(slideIndex) {
                const dots = dotsContainer.querySelectorAll('.dot');
                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === slideIndex);
                });
            }

            // Prev & Next buttons
            prevButton.addEventListener('click', () => {
                if (currentSlide > 0) {
                    goToSlide(currentSlide - 1);
                    updateActiveDot(currentSlide - 1);
                }
            });

            nextButton.addEventListener('click', () => {
                if (currentSlide < totalSlides - 1) {
                    goToSlide(currentSlide + 1);
                    updateActiveDot(currentSlide + 1);
                }
            });

            // Touch/Swipe functionality
            let startX, scrollLeft;

            slider.addEventListener('touchstart', (e) => {
                startX = e.touches[0].pageX - slider.offsetLeft;
                scrollLeft = slider.scrollLeft;
            });

            slider.addEventListener('touchmove', (e) => {
                const x = e.touches[0].pageX - slider.offsetLeft;
                const dist = x - startX;
                slider.scrollLeft = scrollLeft - dist;
            });

            slider.addEventListener('touchend', () => {
                const slideIndex = Math.round(slider.scrollLeft / slideWidth);
                goToSlide(slideIndex);
                updateActiveDot(slideIndex);
            });
        }
    </script>

@endsection

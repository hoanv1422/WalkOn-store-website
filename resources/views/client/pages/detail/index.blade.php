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

                        document.getElementById('description-product-tab').innerHTML = product.description;

                        if (product.average_rating !== undefined) {
                            updateProductRating(product.average_rating);
                        }

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

            fetchComments(slug);

            const ratingSelect = document.getElementById('rating');
            if (ratingSelect) {
                ratingSelect.addEventListener('change', () => {
                    const selectedRating = ratingSelect.value;
                    fetchComments(slug, selectedRating);
                });
            }
            const form = document.getElementById('comment-form');
            form.addEventListener('submit', function(event) {
                storeComment(event, slug);
            });
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
                const response = await fetch(`/api/get-recommend-products/${slug}`);
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const data = await response.json();
                const recommendedProducts = data.data.recommended_products;

                const recommendedProductsDisplay = document.getElementById("recommended-products");
                const upsellSection = document.querySelector(".upsell-product.home2");

                if (data.status === "success" && recommendedProducts.length > 0) {
                    recommendedProductsDisplay.innerHTML = "";

                    recommendedProducts.forEach((product) => {
                        recommendedProductsDisplay.innerHTML += renderProductItem(product);
                    });

                    // Hiển thị khối gợi ý
                    upsellSection.style.display = "block";

                    // Initialize slider
                    initSlider('#commended-products-slider');
                } else {
                    // Ẩn khối gợi ý nếu không có sản phẩm
                    upsellSection.style.display = "none";
                    console.warn("Không có sản phẩm đề xuất.");
                }
            } catch (error) {
                console.error("Error fetching related products:", error);
                document.querySelector(".upsell-product.home2").style.display = "none";
            }
        }


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


        let allComments = [];
        let currentPage = 1;
        const COMMENTS_PER_PAGE = 3;

        function fetchComments(slug, star) {
            // Construct the API URL
            let url = `/api/products/${slug}/comments`;

            // Add rating parameter if star is provided
            if (star !== undefined && star !== null && star !== '') {
                url += `?rating=${star}`;
            }

            // Reset pagination when fetching new comments
            currentPage = 1;

            // Show loading state
            const commentsContainer = document.getElementById('comments-container');
            if (commentsContainer) {
                commentsContainer.innerHTML = `
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Đang tải...</span>
                        </div>
                    </div>
                    <p class="text-center mt-2">Đang tải bình luận...</p>
                `;
            }

            // Fetch comments from API
            return fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Handle the response
                    if (data.success) {
                        // Store all comments
                        allComments = data.data;

                        // Display only the first page
                        displayComments(allComments, true);
                        return data.data;
                    } else {
                        // If no comments but success is false
                        if (commentsContainer) {
                            commentsContainer.innerHTML = `
                        <div class="alert alert-info text-center" role="alert">
                            ${data.message || 'Không có bình luận nào.'}
                        </div>
                    `;
                        }
                    }
                })
                .catch(error => {
                    console.error('Error fetching comments:', error);
                    if (commentsContainer) {
                        commentsContainer.innerHTML = `
                <div class="alert alert-danger text-center" role="alert">
                    <i class="fa fa-exclamation-circle me-2"></i>
                    Có lỗi xảy ra khi tải bình luận.
                </div>
                `;
                    }
                    return [];
                });
        }



        function displayComments(comments, isFirstLoad = false) {
            const commentsContainer = document.getElementById('comments-container');
            if (!commentsContainer) return;

            // Clear container if this is the first load
            if (isFirstLoad) {
                commentsContainer.innerHTML = '';
            }

            // If no comments
            if (!comments || comments.length === 0) {
                commentsContainer.innerHTML = '<p class="text-center">Không có bình luận nào.</p>';
                return;
            }

            // Calculate which comments to display
            const startIndex = 0;
            const endIndex = currentPage * COMMENTS_PER_PAGE;
            const commentsToDisplay = comments.slice(startIndex, endIndex);

            // If first load, replace all content
            if (isFirstLoad) {
                commentsContainer.innerHTML = '';
                commentsToDisplay.forEach(comment => {
                    const commentEl = createCommentElement(comment);
                    commentsContainer.appendChild(commentEl);
                });
            } else {
                // Otherwise, just add the new comments
                const newComments = comments.slice((currentPage - 1) * COMMENTS_PER_PAGE, endIndex);
                newComments.forEach(comment => {
                    const commentEl = createCommentElement(comment);
                    commentsContainer.appendChild(commentEl);
                });

                // Remove the existing load more button if it exists
                const existingButton = document.getElementById('load-more-comments');
                if (existingButton) {
                    existingButton.remove();
                }
            }

            // Add "Load More" button if there are more comments to load
            if (endIndex < comments.length) {
                const loadMoreButton = document.createElement('div');
                loadMoreButton.className = 'text-center mt-4';
                loadMoreButton.innerHTML = `
            <button id="load-more-comments" class="btn btn-outline-primary">
                <i class="fa fa-refresh me-2"></i>Xem thêm bình luận
            </button>
            `;
                commentsContainer.appendChild(loadMoreButton);

                // Add event listener to the load more button
                document.getElementById('load-more-comments').addEventListener('click', function() {
                    currentPage++;
                    displayComments(allComments, false);
                });
            }
        }

        // Function to create comment element
        function createCommentElement(comment) {
            const commentEl = document.createElement('div');
            commentEl.className = 'card mb-3';

            // Generate stars based on rating
            let stars = '';
            for (let i = 1; i <= 5; i++) {
                if (i <= comment.rating) {
                    stars += '<i class="fa fa-star text-warning"></i>';
                } else {
                    stars += '<i class="fa fa-star-o text-warning"></i>';
                }
            }

            // Format date
            const date = new Date(comment.created_at);
            const formattedDate = date.toLocaleDateString('vi-VN', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            // Create comment HTML
            commentEl.innerHTML = `
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="user-info">
                            <h6 class="card-subtitle mb-1">${comment.user?.name || 'Người dùng'}</h6>
                            <p class="card-text"><small class="text-muted">${formattedDate}</small></p>
                        </div>
                        <div class="rating">
                            ${stars}
                        </div>
                    </div>
                    <p class="card-text mt-2">${comment.content}</p>
                    
                    <div class="comment-images d-flex flex-wrap gap-2 mt-2">
                        ${
                            comment.galleries && comment.galleries.length > 0
                                ? comment.galleries
                                    .map(
                                        (gallery) =>
                                            `<img src="http://127.0.0.1:8000/storage/${gallery.image || gallery}"
                                                        alt="Comment image"
                                                        class="img-thumbnail"
                                                        style="width: 120px; height: 120px; object-fit: cover; border-radius: 8px;" />`
                                    )
                                    .join('')
                                : ''
                        }
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        <button class="btn btn-link text-danger" onclick="deleteComment(${comment.id})">
                            <i class="fa fa-trash"></i> Xóa
                        </button>
                </div>
                `;

            return commentEl;
        }

        async function storeComment(event, slug) {
            event.preventDefault();

            // Ẩn thông báo lỗi cũ nếu có
            const formErrors = document.getElementById('form-errors');
            const formErrorsList = formErrors.querySelector('ul');
            formErrors.classList.add('d-none');
            formErrorsList.innerHTML = '';

            const formMessage = document.getElementById('form-message');
            formMessage.innerHTML = '';

            const form = event.target;
            const formData = new FormData(form);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const url = `/products/${slug}/comments`;

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                });

                const data = await response.json();

                // Xử lý phản hồi không thành công với trạng thái mã HTTP
                if (!response.ok) {
                    console.error('Lỗi từ server:', data);

                    // Xử lý các loại phản hồi lỗi khác nhau
                    if (response.status === 422 && data.errors) {
                        // Lỗi validation
                        formErrors.classList.remove('d-none');
                        Object.keys(data.errors).forEach(key => {
                            const errorMessages = data.errors[key];
                            errorMessages.forEach(errorMessage => {
                                const li = document.createElement('li');
                                li.textContent = errorMessage;
                                formErrorsList.appendChild(li);
                            });
                        });
                    } else if (response.status === 401) {
                        // Lỗi chưa đăng nhập
                        formErrors.classList.remove('d-none');
                        const li = document.createElement('li');
                        li.textContent = data.message || 'Bạn cần đăng nhập để bình luận.';
                        formErrorsList.appendChild(li);

                        // Optional: Redirect to login page after 2 seconds
                        setTimeout(() => {
                            window.location.href = '/login';
                        }, 2000);
                    } else if (response.status === 403) {
                        // Lỗi không có quyền hoặc chưa mua sản phẩm
                        formErrors.classList.remove('d-none');
                        const li = document.createElement('li');
                        li.textContent = data.message;
                        formErrorsList.appendChild(li);
                    } else if (response.status === 404) {
                        // Lỗi không tìm thấy sản phẩm
                        formErrors.classList.remove('d-none');
                        const li = document.createElement('li');
                        li.textContent = data.message || 'Sản phẩm không tồn tại.';
                        formErrorsList.appendChild(li);
                    } else {
                        // Các lỗi khác
                        formErrors.classList.remove('d-none');
                        const li = document.createElement('li');
                        li.textContent = data.message || 'Đã xảy ra lỗi khi gửi bình luận';
                        formErrorsList.appendChild(li);
                    }

                    return;
                }

                // Xử lý phản hồi thành công
                if (data.success) {
                    showMessage('Bình luận thành công', '#4CAF50');

                    // Reset image preview
                    document.getElementById('image-preview').innerHTML = '';
                    selectedFiles = [];
                    form.reset();

                    if (data.average_rating !== undefined) {
                        updateProductRating(data.average_rating);
                    }

                    // Refresh comments để hiển thị bình luận mới
                    fetchComments(slug);
                } else {
                    // Trường hợp hiếm: thành công HTTP nhưng JSON có success = false
                    formErrors.classList.remove('d-none');
                    const li = document.createElement('li');
                    li.textContent = data.message || 'Đã xảy ra lỗi không xác định khi gửi bình luận';
                    formErrorsList.appendChild(li);
                }

            } catch (error) {
                console.error('Lỗi kết nối:', error);

                // Hiển thị lỗi kết nối
                formErrors.classList.remove('d-none');
                const li = document.createElement('li');
                li.textContent = 'Không thể gửi bình luận. Vui lòng thử lại sau.';
                formErrorsList.appendChild(li);
            }
        }


        function updateProductRating(averageRating) {
            // Tìm tất cả các phần tử hiển thị đánh giá trung bình
            const ratingElements = document.querySelectorAll('.product-average-rating');
            const ratingValueElements = document.querySelectorAll('.product-rating-value');
            const ratingStarsContainers = document.querySelectorAll('.product-rating-stars');


            // Cập nhật giá trị số
            ratingValueElements.forEach(element => {
                element.textContent = averageRating;
            });

            // Cập nhật hiển thị sao
            ratingStarsContainers.forEach(container => {
                // Xóa tất cả sao hiện tại
                container.innerHTML = '';

                // Thêm sao mới dựa trên giá trị average_rating
                const fullStars = Math.floor(averageRating);
                const hasHalfStar = averageRating % 1 >= 0.5;

                // Thêm sao đầy
                for (let i = 0; i < fullStars; i++) {
                    const star = document.createElement('i');
                    star.className = 'fa fa-star text-warning';
                    container.appendChild(star);
                }

                // Thêm nửa sao nếu cần
                if (hasHalfStar) {
                    const halfStar = document.createElement('i');
                    halfStar.className = 'fa fa-star-half-o text-warning'; // Font Awesome half star
                    container.appendChild(halfStar);
                }

                // Thêm sao rỗng cho phần còn lại
                const emptyStars = 5 - fullStars - (hasHalfStar ? 1 : 0);
                for (let i = 0; i < emptyStars; i++) {
                    const emptyStar = document.createElement('i');
                    emptyStar.className = 'fa fa-star-o text-warning'; // Font Awesome empty star
                    container.appendChild(emptyStar);
                }
            });

            // Cập nhật số lượng đánh giá (nếu hiển thị)
            // Giả sử chúng ta đang lấy số lượng đánh giá từ server response
            const reviewCountElements = document.querySelectorAll('.product-review-count');
            if (reviewCountElements.length > 0) {
                // Nếu chúng ta không có số lượng đánh giá từ server, chúng ta có thể cập nhật bằng cách tăng thêm 1
                const currentCount = parseInt(reviewCountElements[0].textContent, 10) || 0;
                const newCount = currentCount + 1;

                reviewCountElements.forEach(element => {
                    element.textContent = newCount;
                });
            }
        }

        const imageInput = document.querySelector('input[name="image[]"]');
        const previewContainer = document.getElementById('image-preview');
        let selectedFiles = [];

        imageInput.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);

            if (files.length > 3) {
                alert('Chỉ được chọn tối đa 3 ảnh.');
                imageInput.value = ''; // Reset input
                return;
            }
            // Gộp file mới vào danh sách tạm thời
            selectedFiles = files;

            // Xóa phần hiển thị cũ
            previewContainer.innerHTML = '';

            files.forEach((file, index) => {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.classList.add('position-relative');

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.width = '100px';
                    img.style.height = '100px';
                    img.style.objectFit = 'cover';
                    img.style.marginBottom = '10px';
                    img.classList.add('rounded');

                    const removeBtn = document.createElement('button');
                    removeBtn.innerHTML = '&times;';
                    removeBtn.className = 'btn btn-sm btn-danger position-absolute top-0 end-0';
                    removeBtn.type = 'button';

                    removeBtn.addEventListener('click', function() {
                        selectedFiles.splice(index, 1);
                        updateFileInput();
                        div.remove();
                    });

                    div.appendChild(img);
                    div.appendChild(removeBtn);
                    previewContainer.appendChild(div);
                };

                reader.readAsDataURL(file);
            });
        });

        function updateFileInput() {
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => dataTransfer.items.add(file));
            imageInput.files = dataTransfer.files;
        }
    </script>

@endsection

<!-- Chi tiết sản phẩm -->
<div class="single-product-details">
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success mt-3 d-flex align-items-center">
                <i class="fa fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger mt-3 d-flex align-items-center">
                <i class="fa fa-exclamation-circle me-2"></i>
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <!-- Cột hình ảnh sản phẩm -->
            <div class="col-lg-6">
                <div class="single-product-img tab-content">
                    <!-- Hình ảnh chính -->
                    <div class="single-pro-main-image tab-pane active overflow-hidden show" style="height: 555px"
                        id="pro-large-img-1">
                        <a href="#">
                            <img class="optima_zoom object-fit-cover" src="{{ Storage::url($product->image) }}"
                                data-zoom-image="{{ Storage::url($product->image) }}" alt="Hình ảnh sản phẩm">
                        </a>
                    </div>
                    <!-- Hình ảnh bộ sưu tập -->
                    @foreach ($product->galleries as $key => $gallery)
                        <div class="single-pro-main-image tab-pane overflow-hidden" style="height: 555px"
                            id="pro-large-img-{{ $key + 2 }}">
                            <a href="#">
                                <img class="optima_zoom object-fit-cover" src="{{ Storage::url($gallery->image) }}"
                                    data-zoom-image="{{ Storage::url($gallery->image) }}" alt="Hình ảnh sản phẩm">
                            </a>
                        </div>
                    @endforeach
                </div>
                <!-- Thanh hình thu nhỏ -->
                <div class="nav product-page-slider">
                    <div class="single-product-slider overflow-hidden" style="height: 150px; width:150px">
                        <a class="active" href="#pro-large-img-1" data-bs-toggle="tab">
                            <img src="{{ Storage::url($product->image) }}" alt="Ảnh thu nhỏ sản phẩm"
                                class="object-fit-cover">
                        </a>
                    </div>
                    @foreach ($product->galleries as $key => $gallery)
                        <div class="single-product-slider overflow-hidden" style="height: 150px; width:150px">
                            <a href="#pro-large-img-{{ $key + 2 }}" data-bs-toggle="tab">
                                <img src="{{ Storage::url($gallery->image) }}" alt="Ảnh thu nhỏ sản phẩm"
                                    class="object-fit-cover">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Cột thông tin sản phẩm -->
            <div class="col-lg-6">
                <div class="single-product-details">
                    <!-- Tên sản phẩm -->
                    <a href="#" class="product-name">{{ $product->name }}</a>
                    <!-- Giá và đánh giá -->
                    <div class="list-product-info">
                        <div class="price-rating">
                            <!-- Giá gốc -->
                            <span class="old-price" id="variantOriginalPrice"
                                style="display: none; color:rgb(0, 0, 0); text-decoration: line-through;">
                                {{ number_format($product->price, 0, ',', '.') }} VND
                            </span>
                            <!-- Giá hiện tại -->
                            <span class="new-price" id="variantCurrentPrice"
                                style="margin-left: 10px; font-weight: bold;">
                                @if ($product_variants && count($product_variants) > 0)
                                    @php
                                        $firstVariant = $product_variants->first();
                                        $firstOriginal = $firstVariant['price'];
                                        $firstSale = $firstVariant['price_sale'];
                                    @endphp
                                    @if ($firstSale < $firstOriginal)
                                        {{ number_format($firstSale, 0, ',', '.') }} VND
                                    @else
                                        {{ number_format($firstOriginal, 0, ',', '.') }} VND
                                    @endif
                                @else
                                    {{ isset($product->price_sale) && $product->price_sale < $product->price ? number_format($product->price_sale, 0, ',', '.') : number_format($product->price, 0, ',', '.') }}
                                    VND
                                @endif
                            </span>
                            <div class="ratings">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= floor($product->average_rating))
                                        <i class="fa fa-star"></i>
                                    @elseif($i - 0.5 == $product->average_rating)
                                        <i class="fa fa-star-half-o"></i>
                                    @else
                                        <i class="fa fa-star-o"></i>
                                    @endif
                                @endfor
                                <a href="#" class="review">{{ $product->sold_quantity }} đánh giá</a>
                            </div>
                        </div>
                    </div>
                    <!-- Tình trạng -->
                    <div class="avalable">
                        <p>Tình trạng:
                            @if ($product->quantity > 0)
                                <span style="color: #06ce06">Còn hàng</span>
                            @else
                                <span style="color: red">Hết hàng</span>
                            @endif
                        </p>
                    </div>
                    <!-- Tổng giá -->
                    <div class="item-price">
                        <span id="totalPriceDisplay"></span>
                    </div>
                    <!-- Form thêm vào giỏ hàng -->
                    <form action="{{ route('cart.add', $product->id) }}" method="post">
                        @csrf
                        <!-- Chỉ để 1 bộ hidden inputs -->
                        <input type="hidden" name="color" id="selectedColor">
                        <input type="hidden" name="size" id="selectedSize">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="variant_id" id="selectedVariantId">
                        <div class="container">
                            <div class="row g-3 align-items-center my-2">
                                <!-- Chọn màu -->
                                <div class="col-md-6">
                                    <label class="form-label required">Màu sắc</label>
                                    <div class="d-flex flex-wrap gap-2">
                                        <!-- Nút chọn "Gốc" -->
                                        <button type="button"
                                            class="btn btn-outline-secondary color-btn reset-variant rounded-circle p-0 d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px;" onclick="resetVariant()">
                                            <i class="fa fa-refresh"></i>
                                        </button>
                                        @foreach ($product->colors as $color)
                                            <button type="button"
                                                class="btn btn-outline-secondary color-btn rounded-circle p-0 border-2"
                                                style="width: 40px; height: 40px; background-color: {{ $color->code }};"
                                                data-color="{{ $color->id }}" onclick="selectColor(this)"></button>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- Chọn kích cỡ -->
                                <div class="col-md-6">
                                    <label class="form-label required">Kích cỡ</label>
                                    <div class="d-flex flex-wrap">
                                        @foreach ($product->sizes as $size)
                                            <button type="button" class="btn btn-outline-secondary me-2 size-btn"
                                                data-size="{{ $size->id }}" onclick="selectSize(this)">
                                                {{ strtoupper($size->size) }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Thông tin tồn kho -->
                        <p class="mt-2">
                            <strong>SL:</strong> <span id="variantStock">Vui lòng chọn màu sắc và kích cỡ </span>
                        </p>
                        <!-- Số lượng và nút thêm vào giỏ -->
                        <div class="row g-3 align-items-center mt-3">
                            <div class="col-md-3">
                                <label class="form-label"><strong>Số lượng</strong></label>
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="decreaseQty()">-</button>
                                    <input type="text" class="form-control text-center" id="qtyInput"
                                        value="1" name="quantity">
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="increaseQty()">+</button>
                                </div>
                            </div>
                            <div class="d-flex align-items-end">
                                <button class="btn btn-primary w-50" type="submit" id="addToCartBtn">Thêm vào giỏ
                                    hàng</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Chi tiết sản phẩm kết thúc -->

<!-- Script xử lý -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
    /* === DOM Elements === */
    const elements = {
        qtyInput: document.getElementById('qtyInput'),
        addButton: document.getElementById('addToCartBtn'),
        stockDisplay: document.getElementById('variantStock'),
        totalPriceDisplay: document.getElementById('totalPriceDisplay'),
        variantOriginalPrice: document.getElementById('variantOriginalPrice'),
        variantCurrentPrice: document.getElementById('variantCurrentPrice'),
        mainImage: document.querySelector('#pro-large-img-1 img'),
        selectedColor: document.getElementById('selectedColor'),
        selectedSize: document.getElementById('selectedSize'),
        selectedVariantId: document.getElementById('selectedVariantId')
    };

    // Check for required elements
    const requiredElements = ['qtyInput', 'stockDisplay', 'totalPriceDisplay'];
    for (const element of requiredElements) {
        if (!elements[element]) {
            console.error(`Required element ${element} not found`);
            return;
        }
    }

    /* === Product Data === */
    const productData = {
        basePrice: {{ $product->price ?? 0 }},
        baseSalePrice: {{ $product->price_sale ?? $product->price ?? 0 }},
        variants: @json($product_variants ?? []),
        totalStock: {{ $product->quantity ?? 0 }},
        defaultImage: "{{ Storage::url($product->image) }}"
    };

    /* === State === */
    let state = {
        selectedColor: null,
        selectedSize: null,
        currentVariant: null,
        quantity: 1
    };

    /* === Helper Functions === */
    const formatPrice = (price) => {
        return new Intl.NumberFormat('vi-VN').format(price || 0) + ' VND';
    };

    const updateHiddenFields = () => {
        try {
            elements.selectedColor.value = state.selectedColor || "";
            elements.selectedSize.value = state.selectedSize || "";
            elements.selectedVariantId.value = state.currentVariant?.id || "";
        } catch (error) {
            console.error('Error updating hidden fields:', error);
        }
    };

    /* === Core Functions === */
    const findVariant = () => {
        return productData.variants.find(v =>
            v.color_id === state.selectedColor &&
            v.size_id === state.selectedSize
        ) || null;
    };

    const updateVariantInfo = () => {
        try {
            state.currentVariant = findVariant();
            updateHiddenFields();
            updateStockDisplay();
            updatePriceDisplay();
            updateMaxQuantity();
            updateTotalPrice();
            updateButtonState();
            updateVariantImage();
            updateSizeOptions();
        } catch (error) {
            console.error('Error updating variant info:', error);
        }
    };

    const updateStockDisplay = () => {
        const stock = state.currentVariant?.quantity ?? null;
        if (stock !== null) {
            elements.stockDisplay.textContent = stock > 0 ? 
                `${stock} sản phẩm có sẵn` : 'Hết hàng';
            elements.stockDisplay.style.color = stock > 0 ? 'inherit' : '#dc3545';
        } else {
            elements.stockDisplay.textContent = (state.selectedColor && state.selectedSize) ?
                'Sản phẩm không tồn tại' : 'Vui lòng chọn màu và kích cỡ';
            elements.stockDisplay.style.color = '#dc3545';
        }
    };

    const updatePriceDisplay = () => {
        let originalPrice = productData.basePrice;
        let currentPrice = productData.baseSalePrice;
        let hasSale = productData.baseSalePrice < productData.basePrice;

        if (state.currentVariant) {
            originalPrice = parseFloat(state.currentVariant.price) || 0;
            currentPrice = state.currentVariant.price_sale ? 
                parseFloat(state.currentVariant.price_sale) : originalPrice;
            hasSale = state.currentVariant.price_sale && 
                (parseFloat(state.currentVariant.price_sale) < originalPrice);
        }

        elements.variantOriginalPrice.style.display = hasSale ? 'inline' : 'none';
        elements.variantOriginalPrice.textContent = formatPrice(originalPrice);
        elements.variantCurrentPrice.textContent = formatPrice(currentPrice);
        
        if (hasSale) {
            elements.variantCurrentPrice.classList.add('text-danger', 'fw-bold');
        } else {
            elements.variantCurrentPrice.classList.remove('text-danger', 'fw-bold');
        }
    };

    const updateTotalPrice = () => {
        if (!state.currentVariant) {
            elements.totalPriceDisplay.textContent = 'Vui lòng chọn đủ thông tin';
            elements.totalPriceDisplay.style.color = '#dc3545';
            return;
        }
        
        const price = parseFloat(state.currentVariant.price_sale || state.currentVariant.price) || 0;
        elements.totalPriceDisplay.textContent = `Tổng tiền: ${formatPrice(price * state.quantity)}`;
        elements.totalPriceDisplay.style.color = '#28a745';
    };

    const updateMaxQuantity = () => {
        const max = state.currentVariant?.quantity > 0 ?
            parseInt(state.currentVariant.quantity) : productData.totalStock;
        elements.qtyInput.setAttribute('max', max);
        state.quantity = Math.min(state.quantity, max);
        elements.qtyInput.value = state.quantity;
    };

    const updateButtonState = () => {
        if (!elements.addButton) return;
        const inStock = state.currentVariant?.quantity > 0;
        elements.addButton.disabled = !inStock;
        elements.addButton.innerHTML = inStock ? 'Thêm vào giỏ hàng' : 'Hết hàng';
        elements.addButton.classList.toggle('btn-success', inStock);
        elements.addButton.classList.toggle('btn-secondary', !inStock);
    };

    const updateVariantImage = () => {
        if (!elements.mainImage) return;
        const imageSrc = state.currentVariant?.image || productData.defaultImage;
        elements.mainImage.src = imageSrc;
        elements.mainImage.dataset.zoomImage = imageSrc;
    };

    const updateSizeOptions = () => {
        const sizeButtons = document.querySelectorAll('.size-btn');
        if (!state.selectedColor) {
            sizeButtons.forEach(button => {
                button.disabled = false;
                button.classList.remove('disabled-option');
            });
            return;
        }

        const availableSizes = productData.variants
            .filter(v => v.color_id === state.selectedColor)
            .map(v => parseInt(v.size_id));

        sizeButtons.forEach(button => {
            const sizeId = parseInt(button.dataset.size);
            const isAvailable = availableSizes.includes(sizeId);
            button.disabled = !isAvailable;
            button.classList.toggle('disabled-option', !isAvailable);
            if (!isAvailable && button.classList.contains('active')) {
                button.classList.remove('active', 'bg-primary', 'text-white');
                state.selectedSize = null;
                elements.selectedSize.value = "";
            }
        });
    };

    /* === Event Handlers === */
    window.selectColor = (button) => {
        state.selectedColor = parseInt(button.dataset.color);
        document.querySelectorAll('.color-btn').forEach(btn => {
            btn.classList.remove('active', 'border-primary');
        });
        button.classList.add('active', 'border-primary');
        state.selectedSize = null;
        elements.selectedSize.value = '';
        document.querySelectorAll('.size-btn').forEach(btn => 
            btn.classList.remove('active', 'bg-primary', 'text-white'));
        updateVariantInfo();
    };

    window.selectSize = (button) => {
        if (button.disabled) return;
        state.selectedSize = parseInt(button.dataset.size);
        document.querySelectorAll('.size-btn').forEach(btn => {
            btn.classList.remove('active', 'bg-primary', 'text-white');
        });
        button.classList.add('active', 'bg-primary', 'text-white');
        updateVariantInfo();
    };

    window.resetVariant = () => {
        state = {
            selectedColor: null,
            selectedSize: null,
            currentVariant: null,
            quantity: 1
        };
        document.querySelectorAll('.color-btn, .size-btn').forEach(btn => {
            btn.classList.remove('active', 'bg-primary', 'text-white', 'border-primary', 'disabled-option');
            btn.disabled = false;
        });
        elements.qtyInput.value = 1;
        if (elements.mainImage) {
            elements.mainImage.src = productData.defaultImage;
            elements.mainImage.dataset.zoomImage = productData.defaultImage;
        }
        updateVariantInfo();
    };

    window.increaseQty = () => {
        const max = parseInt(elements.qtyInput.getAttribute('max')) || productData.totalStock;
        state.quantity = Math.min((parseInt(elements.qtyInput.value) || 0) + 1, max);
        elements.qtyInput.value = state.quantity;
        updateTotalPrice();
    };

    window.decreaseQty = () => {
        state.quantity = Math.max((parseInt(elements.qtyInput.value) || 1) - 1, 1);
        elements.qtyInput.value = state.quantity;
        updateTotalPrice();
    };

    elements.qtyInput.addEventListener('input', (e) => {
        const max = parseInt(elements.qtyInput.getAttribute('max')) || productData.totalStock;
        let value = parseInt(e.target.value.replace(/\D/g, '')) || 1;
        state.quantity = Math.min(Math.max(value, 1), max);
        elements.qtyInput.value = state.quantity;
        updateTotalPrice();
    });

    elements.qtyInput.addEventListener('blur', (e) => {
        if (!e.target.value || parseInt(e.target.value) < 1) {
            state.quantity = 1;
            elements.qtyInput.value = 1;
            updateTotalPrice();
        }
    });

    // Alerts handling
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 3000);

    // Initialize
    updateVariantInfo();
});
</script>


<style>
    /* Nút màu */
    .color-btn {
        border-radius: 50%;
    }

    /* Nút size */
    .size-btn {
        border-radius: 0 !important;
    }

    .color-btn,
    .size-btn {
        transition: all 0.3s ease-in-out;
        transform-origin: center;
        position: relative;
        border: 1px solid #000;
        overflow: hidden;
    }

    .color-btn::after,
    .size-btn::after {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        width: 80%;
        height: 80%;
        transform: translate(-50%, -50%) scale(0);
        background: rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        transition: transform 0.3s ease-in-out;
    }

    .color-btn:hover::after,
    .size-btn:hover::after {
        transform: translate(-50%, -50%) scale(1);
    }

    .color-btn.active {
        transform: scale(1.15);
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.3);
    }

    .size-btn.active {
        transform: scale(1.15);
        background-color: #007bff !important;
        color: #fff !important;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.3);
    }

    .color-btn:hover,
    .size-btn:hover {
        transform: scale(1.1);
    }

    .disabled-option {
        opacity: 0.6;
        cursor: not-allowed;
        position: relative;
    }

    .disabled-option::after {
        content: "";
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 2px;
        background: red;
        transform: rotate(-45deg);
    }

    .reset-variant {
        background-color: #f8f9fa;
        color: #333;
        border: 1px solid #000000;
        font-weight: bold;
        padding: 0;
        width: 40px;
        height: 40px;
        transition: all 0.3s ease;
    }

    .reset-variant i {
        font-size: 18px;
        transition: transform 0.3s ease;
    }

    .reset-variant:hover {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }

    .reset-variant:hover i {
        transform: rotate(360deg);
    }
</style>

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
                            <div class="action">
                                <ul class="add-to-links">
                                    <li>
                                        <a href="javascript:void(0);" class="wishlist-btn"
                                            data-product-id="{{ $product->id }}"
                                            title="{{ in_array($product->id, $wishlistProductIds) ? 'Đã thêm vào danh sách yêu thích' : 'Thêm vào danh sách yêu thích' }}">
                                            <i
                                                class="fa fa-heart {{ in_array($product->id, $wishlistProductIds) ? 'text-danger' : '' }}"></i>
                                        </a>
                                    </li>
                                    {{-- <li>
                                        <a href="#">
                                            <i class="fa fa-refresh"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-envelope"></i>
                                        </a>
                                    </li> --}}
                                </ul>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        /* === DOM Elements === */
        const qtyInput = document.getElementById('qtyInput');
        const addButton = document.getElementById('addToCartBtn');
        const stockDisplay = document.getElementById('variantStock');
        const totalPriceDisplay = document.getElementById('totalPriceDisplay');
        const variantOriginalPrice = document.getElementById('variantOriginalPrice');
        const variantCurrentPrice = document.getElementById('variantCurrentPrice');
        const mainImage = document.querySelector('#pro-large-img-1 img');

        /* === Dữ liệu sản phẩm lấy từ backend === */
        const productData = {
            basePrice: {{ $product->price }},
            baseSalePrice: {{ $product->price_sale ?? $product->price }},
            variants: @json($product_variants ?? []),
            totalStock: {{ $product->quantity }},
            defaultImage: "{{ Storage::url($product->image) }}"
        };

        /* === State: Lưu các lựa chọn hiện tại === */
        let state = {
            selectedColor: null,
            selectedSize: null,
            currentVariant: null,
            quantity: 1
        };

        /* === Helper Functions === */
        // Hàm định dạng giá theo VNĐ
        const formatPrice = (price) => {
            return new Intl.NumberFormat('vi-VN').format(price) + ' VND';
        };

        // Cập nhật các trường ẩn để gửi lên backend
        const updateHiddenFields = () => {
            document.getElementById('selectedColor').value = state.selectedColor || "";
            document.getElementById('selectedSize').value = state.selectedSize || "";
            document.getElementById('selectedVariantId').value = state.currentVariant?.id || "";
        };

        /* === Core Functions === */
        // Tìm biến thể dựa theo màu và kích cỡ được chọn
        const findVariant = () => {
            return productData.variants.find(v =>
                v.color_id == state.selectedColor &&
                v.size_id == state.selectedSize
            );
        };

        // Cập nhật thông tin biến thể, bao gồm tồn kho, giá, ảnh, các nút option và hidden fields
        const updateVariantInfo = () => {
            state.currentVariant = findVariant();
            updateHiddenFields();
            updateStockDisplay();
            updatePriceDisplay();
            updateMaxQuantity();
            updateTotalPrice();
            updateButtonState();
            updateVariantImage();
            updateSizeOptions();
        };

        // Cập nhật hiển thị số tồn kho
        const updateStockDisplay = () => {
            if (state.currentVariant) {
                const stock = parseInt(state.currentVariant['quantity']);
                stockDisplay.textContent = stock > 0 ? `${stock} sản phẩm có sẵn` : 'Hết hàng';
                stockDisplay.style.color = stock > 0 ? 'inherit' : '#dc3545';
            } else {
                stockDisplay.textContent = (state.selectedColor && state.selectedSize) ?
                    'Sản phẩm không tồn tại' : 'Vui lòng chọn màu và kích cỡ';
                stockDisplay.style.color = '#dc3545';
            }
        };

        // Cập nhật hiển thị giá gốc và giá sale (nếu có)
        const updatePriceDisplay = () => {
            let originalPrice = productData.basePrice;
            let currentPrice = productData.baseSalePrice;
            let hasSale = false;

            if (state.currentVariant) {
                originalPrice = parseFloat(state.currentVariant['price']);
                currentPrice = state.currentVariant['price_sale'] ? parseFloat(state.currentVariant[
                    'price_sale']) : originalPrice;
                hasSale = state.currentVariant['price_sale'] && (parseFloat(state.currentVariant[
                    'price_sale']) < originalPrice);
            } else {
                hasSale = productData.baseSalePrice < productData.basePrice;
                currentPrice = hasSale ? productData.baseSalePrice : productData.basePrice;
            }

            if (hasSale) {
                variantOriginalPrice.style.display = 'inline';
                variantOriginalPrice.textContent = formatPrice(originalPrice);
                variantCurrentPrice.textContent = formatPrice(currentPrice);
                variantCurrentPrice.classList.add('text-danger', 'fw-bold');
            } else {
                variantOriginalPrice.style.display = 'none';
                variantCurrentPrice.textContent = formatPrice(currentPrice);
                variantCurrentPrice.classList.remove('text-danger', 'fw-bold');
            }
        };

        // Cập nhật hiển thị tổng giá theo số lượng đã chọn
        const updateTotalPrice = () => {
            let price;
            if (state.currentVariant) {
                price = state.currentVariant['price_sale'] ?
                    parseFloat(state.currentVariant['price_sale']) :
                    parseFloat(state.currentVariant['price']);
            } else {
                price = productData.baseSalePrice < productData.basePrice ?
                    productData.baseSalePrice : productData.basePrice;
            }
            totalPriceDisplay.textContent = `Tổng tiền: ${formatPrice(price * state.quantity)}`;
            totalPriceDisplay.style.color = '#28a745';
        };
        // Cập nhật thuộc tính max của ô số lượng dựa trên tồn kho của biến thể (hoặc tổng số sản phẩm nếu chưa chọn biến thể)
        const updateMaxQuantity = () => {
            const max = state.currentVariant && parseInt(state.currentVariant['quantity']) > 0 ?
                parseInt(state.currentVariant['quantity']) :
                productData.totalStock;
            qtyInput.setAttribute('max', max);
            qtyInput.value = Math.min(state.quantity, max);
            state.quantity = parseInt(qtyInput.value);
        };

        // Cập nhật trạng thái nút "Thêm vào giỏ hàng" dựa trên tồn kho của biến thể
        const updateButtonState = () => {
            if (!addButton) return;
            const inStock = state.currentVariant && parseInt(state.currentVariant['quantity']) > 0;
            addButton.disabled = !inStock;
            addButton.innerHTML = inStock ? 'Thêm vào giỏ hàng' : 'Hết hàng';
            addButton.classList.toggle('btn-success', inStock);
            addButton.classList.toggle('btn-secondary', !inStock);
        };

        // Cập nhật hình ảnh sản phẩm theo biến thể được chọn
        const updateVariantImage = () => {
            if (state.currentVariant && state.currentVariant['image']) {
                mainImage.src = state.currentVariant['image'];
                mainImage.dataset.zoomImage = state.currentVariant['image'];
            } else {
                mainImage.src = productData.defaultImage;
                mainImage.dataset.zoomImage = productData.defaultImage;
            }
        };

        // Cập nhật trạng thái các nút kích cỡ dựa theo màu đã chọn
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
                .filter(v => v.color_id == state.selectedColor)
                .map(v => parseInt(v.size_id));
            sizeButtons.forEach(button => {
                const sizeId = parseInt(button.dataset.size);
                if (availableSizes.includes(sizeId)) {
                    button.disabled = false;
                    button.classList.remove('disabled-option');
                } else {
                    button.disabled = true;
                    button.classList.add('disabled-option');
                    if (button.classList.contains('active')) {
                        button.classList.remove('active');
                        document.getElementById('selectedSize').value = "";
                        state.selectedSize = null;
                    }
                }
            });
        };

        /* === Event Handlers === */
        // Xử lý chọn màu
        window.selectColor = (button) => {
            state.selectedColor = parseInt(button.dataset.color);
            document.getElementById('selectedColor').value = state.selectedColor;
            document.querySelectorAll('.color-btn').forEach(btn => {
                btn.classList.remove('active', 'border-primary');
            });
            button.classList.add('active', 'border-primary');
            // Reset lựa chọn kích cỡ khi chọn màu mới
            state.selectedSize = null;
            document.getElementById('selectedSize').value = '';
            document.querySelectorAll('.size-btn').forEach(btn => btn.classList.remove('active',
                'bg-primary', 'text-white'));
            updateVariantInfo();
        };

        // Xử lý chọn kích cỡ
        window.selectSize = (button) => {
            if (button.disabled) return;
            state.selectedSize = parseInt(button.dataset.size);
            document.getElementById('selectedSize').value = state.selectedSize;
            document.querySelectorAll('.size-btn').forEach(btn => {
                btn.classList.remove('active', 'bg-primary', 'text-white');
            });
            button.classList.add('active', 'bg-primary', 'text-white');
            updateVariantInfo();
        };

        // Xử lý reset lựa chọn (nút "Gốc")
        window.resetVariant = () => {
            state.selectedColor = null;
            state.selectedSize = null;
            state.currentVariant = null;
            state.quantity = 1;
            document.querySelectorAll('.color-btn, .size-btn').forEach(btn => {
                btn.classList.remove('active', 'bg-primary', 'text-white', 'border-primary');
                btn.disabled = false;
                btn.classList.remove('disabled-option');
            });
            qtyInput.value = 1;
            mainImage.src = productData.defaultImage;
            mainImage.dataset.zoomImage = productData.defaultImage;
            updateVariantInfo();
        };

        // Xử lý tăng số lượng
        window.increaseQty = () => {
            // console.log('increaseQty'); // Kiểm tra xem hàm có được gọi
            let current = parseInt(qtyInput.value) || 1;
            const max = parseInt(qtyInput.getAttribute('max')) || productData.totalStock;
            // console.log(max);
            // Tăng lên 1, nhưng không vượt quá max
            current = Math.min(current + 1, max);
            // console.log(current);
            qtyInput.value = current - 1;
            state.quantity = current;
            // console.log(qtyInput.value);
            updateTotalPrice();
        };

        // Xử lý giảm số lượng
        window.decreaseQty = () => {
            console.log('decreaseQty'); // Kiểm tra xem hàm có được gọi
            let current = parseInt(qtyInput.value) || 1;
            // Giảm 1, nhưng không nhỏ hơn 1
            current = Math.max(current - 1, 1);
            qtyInput.value = current + 1;
            state.quantity = current;
            updateTotalPrice();
        };


        // Xử lý khi nhập trực tiếp vào ô số lượng
        qtyInput.addEventListener('input', (e) => {
            let value = e.target.value;
            if (value === '') {
                state.quantity = 1;
                qtyInput.value = '';
                updateTotalPrice();
                return;
            }
            value = parseInt(value.replace(/\D/g, '')) || 1;
            const max = parseInt(qtyInput.getAttribute('max')) || productData.totalStock;
            state.quantity = Math.min(Math.max(value, 1), max);
            qtyInput.value = state.quantity;
            updateTotalPrice();
        });

        qtyInput.addEventListener('blur', (e) => {
            if (e.target.value === '' || parseInt(e.target.value) < 1) {
                qtyInput.value = 1;
                state.quantity = 1;
                updateTotalPrice();
            }
        });

        // ===== Initialization =====
        updateVariantInfo();
    });

    //thông báo 
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            let alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.remove();
                }, 500);
            });
        }, 3000);
    });
    // xử lí wishlist
    $(document).ready(function() {
        $('.wishlist-btn').on('click', function(e) {
            e.preventDefault();
            let $btn = $(this);
            let productId = $btn.data('product-id');
            let $icon = $btn.find('i.fa-heart');

            // Nếu sản phẩm đã có trong wishlist => Xoá
            if ($icon.hasClass('text-danger')) {
                $.ajax({
                    url: "{{ route('wishlist.store') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: productId,
                        action: 'remove'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Bỏ màu đỏ
                            $icon.removeClass('text-danger');
                            // Trả về màu nền mặc định
                            $btn.css("background-color", "");
                            // Icon trái tim trở về màu mặc định
                            $icon.css("color", "");
                            $btn.attr('title', 'Thêm vào danh sách yêu thích');
                            showToast(response.message ||
                                'Đã xoá sản phẩm khỏi danh sách yêu thích thành công!');
                        } else {
                            showToast(response.message ||
                                'Không thể xoá sản phẩm khỏi danh sách yêu thích!');
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            } else {
                // Nếu chưa có => Thêm
                $.ajax({
                    url: "{{ route('wishlist.store') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: productId,
                        action: 'add'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Thêm màu đỏ nền nút
                            $btn.css("background-color", "");
                            $icon.addClass('text-danger');
                            $btn.attr('title', 'Đã thêm vào danh sách yêu thích');
                            showToast(response.message ||
                                'Đã thêm sản phẩm vào danh sách yêu thích thành công!');
                        } else {
                            showToast(response.message ||
                                'Không thể thêm sản phẩm vào danh sách yêu thích!');
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });

        function showToast(message) {
            // Chèn toast 
            $('<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                message +
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                '</div>').appendTo('body').delay(3000).fadeOut(500, function() {
                $(this).remove();
            });
        }
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

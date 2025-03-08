<!-- single product details start -->
<div class="single-product-details">
    <div class="container">
        <div class="row">
            <!-- Cột hình ảnh sản phẩm -->
            <div class="col-lg-6">
                <div class="single-product-img tab-content" >
                    <div class="single-pro-main-image tab-pane active overflow-hidden" style="height: 555px"  id="pro-large-img-1">
                        <a href="#">
                            <img class="optima_zoom object-fit-cover" src="{{ Storage::url($product->image) }}"
                                 data-zoom-image="{{ Storage::url($product->image) }}" alt="optima" />
                        </a>
                    </div>
                    @foreach ($product->galleries as $key => $gallery)
                        <div class="single-pro-main-image tab-pane overflow-hidden" style="height: 555px" id="pro-large-img-{{ $key + 2 }}">
                            <a href="#">
                                <img class="optima_zoom object-fit-cover" src="{{ Storage::url($gallery->image) }}"
                                     data-zoom-image="{{ Storage::url($gallery->image) }}" alt="Product Image">
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="nav product-page-slider">
                    <div class="single-product-slider overflow-hidden" style="height: 150px; width:150px">
                        <a class="active " href="#pro-large-img-1" data-bs-toggle="tab">
                            <img src="{{ Storage::url($product->image) }}" alt="" class="object-fit-cover">
                        </a>
                    </div>
                    @foreach ($product->galleries as $key => $gallery)
                        <div class="single-product-slider  overflow-hidden" style="height: 150px; width:150px" >
                            <a href="#pro-large-img-{{ $key + 2 }}" data-bs-toggle="tab">
                                <img src="{{ Storage::url($gallery->image) }}" alt="Product Image" class=" object-fit-cover">
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
                    <div class="list-product-info">
                        <div class="price-rating">
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
                                <a href="#" class="review">{{ $product->sold_quantity }} Review(s)</a>
                                <a href="#" class="add-review">Add Your Review</a>
                            </div>
                        </div>
                    </div>
                    <div class="avalable">
                        <p>Availability:
                            @if ($product->quantity > 0)
                                <span> In stock</span>
                            @else
                                <span style="color: red;"> Out of stock</span>
                            @endif
                        </p>
                    </div>
                    <div class="item-price">
                        <div class="item-price">
                            <!-- Giá tổng (đã nhân số lượng) -->
                            <span id="totalPriceDisplay" style="margin-left: 10px;"></span>
                        </div>
                    </div>
                    <div class="action">
                        <ul class="add-to-links">
                            <li>
                                <a href="#" class="wishlist-action" data-id="{{ $product->id }}">
                                    <i class="fa fa-heart-o"></i> 
                                </a>
                            </li>
                            
                        </ul>
                    </div>
            
                    <!-- Form thêm sản phẩm vào giỏ -->
                    <form action="{{ route('cart.add', $product->id) }}" method="post">
                        @csrf
                        <div class="container">
                            <div class="row g-3 align-items-center my-2">
                                <!-- Chọn Màu -->
                                <div class="col-md-6">
                                    <label class="form-label required"> Màu</label>
                                    <div class="d-flex flex-wrap">
                                        <!-- Nút chọn sản phẩm gốc -->
                                        <button type="button"
                                            class="btn btn-outline-secondary me-2 color-btn reset-variant"
                                            onclick="resetVariant()">--</button>
                                        <!-- Các nút màu thông thường -->
                                        @foreach ($product->colors as $color)
                                            <button type="button"
                                                class="btn btn-outline-primary me-2 color-btn rounded-0"
                                                data-color="{{ $color->id }}"
                                                style="background: {{ $color->code }}; width: 40px; height: 40px;"
                                                onclick="selectColor(this)">
                                            </button>
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="color" id="selectedColor">
                                </div>
            
                                <!-- Chọn Kích Cỡ  -->
                                <div class="col-md-6">
                                    <label class="form-label required"> Kích cỡ</label>
                                    <div class="d-flex flex-wrap">
                                        @foreach ($product->sizes as $size)
                                            <button type="button" class="btn btn-outline-secondary me-2 size-btn"
                                                data-size="{{ $size->id }}" onclick="selectSize(this)">
                                                {{ strtoupper($size->size) }}
                                            </button>
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="size" id="selectedSize">
                                </div>
                            </div>
                        </div>
                        <p class="mt-2">
                            <strong>Số lượng tồn kho:</strong> <span id="variantStock">Chọn biến thể</span>
                        </p>
            
                        <!-- Chọn số lượng và nút thêm vào giỏ hàng -->
                        <div class="row g-3 align-items-center mt-3">
                            <div class="col-md-3">
                                <label class="form-label"><strong>Số Lượng</strong></label>
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="decreaseQty()">-</button>
                                    <input type="text" class="form-control text-center" id="qtyInput"
                                        value="1" name="quantity" >
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="increaseQty()">+</button>
                                </div>
                            </div>
                            <div class="d-flex align-items-end">
                                <button class="btn btn-primary w-50" type="submit">Thêm Vào Giỏ Hàng</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
            
        </div>
    </div>
</div>
<!-- single product details end -->

<!-- Script xử lý lựa chọn, cập nhật giá và cập nhật trạng thái disabled của các option -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Các phần tử DOM
        const colorButtons = document.querySelectorAll(".color-btn");
        const sizeButtons = document.querySelectorAll(".size-btn");
        const qtyInput = document.getElementById("qtyInput");
        const priceBox = document.querySelector(".item-price span");
        const productImage = document.querySelector(".single-product-img .active img");

        // Lấy giá cơ bản và dữ liệu biến thể từ backend
        const basePrice = {{ $product->price_sale ?? $product->price }};
        const productVariants = @json($product->variants ?? []);
        const totalProductQty = {{ $product->quantity }};

        // Biến lưu lựa chọn hiện tại
        let selectedColor = null;
        let selectedSize = null;

        // Gán sự kiện cho nút "Gốc" một lần (nút có lớp reset-variant)
        const resetButton = document.querySelector('.color-btn.reset-variant');
        if (resetButton) {
            resetButton.addEventListener("click", function() {
                resetVariant();
            });
        }

        // Hàm cập nhật thông tin biến thể (hiển thị ảnh, thiết lập max, hiển thị tồn kho)
        function updateVariant() {
            const stockDisplay = document.getElementById("variantStock");
            if (selectedColor && selectedSize) {
                // Khi đã chọn cả màu và kích cỡ, tìm biến thể cụ thể
                const variant = productVariants.find(v => v.color_id == selectedColor && v.size_id ==
                    selectedSize);
                if (variant) {
                    qtyInput.setAttribute("max", variant.quantity);
                    if (stockDisplay) {
                        stockDisplay.textContent = variant.quantity > 0 ?
                            variant.quantity + " sản phẩm có sẵn" : "Hết hàng";
                    }
                    if (variant.image) {
                        productImage.src = variant.image;
                        productImage.setAttribute("data-zoom-image", variant.image);
                    }
                } else {
                    qtyInput.removeAttribute("max");
                    if (stockDisplay) {
                        stockDisplay.textContent = "Không có sẵn";
                    }
                }
            } else if (selectedColor && !selectedSize) {
                // Khi chỉ chọn màu, tổng hợp số lượng của tất cả các biến thể có cùng màu
                const variantsForColor = productVariants.filter(v => v.color_id == selectedColor);
                const aggregatedQuantity = variantsForColor.reduce((sum, v) => sum + Number(v.quantity), 0);
                qtyInput.setAttribute("max", aggregatedQuantity);
                if (stockDisplay) {
                    stockDisplay.textContent = aggregatedQuantity + " sản phẩm có sẵn";
                }
                // Cập nhật ảnh theo biến thể đầu tiên có ảnh (nếu có), nếu không giữ ảnh gốc
                const firstVariantWithImage = variantsForColor.find(v => v.image);
                if (firstVariantWithImage) {
                    productImage.src = firstVariantWithImage.image;
                    productImage.setAttribute("data-zoom-image", firstVariantWithImage.image);
                } else {
                    productImage.src = "{{ Storage::url($product->image) }}";
                    productImage.setAttribute("data-zoom-image", "{{ Storage::url($product->image) }}");
                }
            } else {
                // Khi chưa chọn gì ("Gốc")
                qtyInput.setAttribute("max", totalProductQty);
                if (stockDisplay) {
                    stockDisplay.textContent = totalProductQty + " sản phẩm có sẵn";
                }
                productImage.src = "{{ Storage::url($product->image) }}";
                productImage.setAttribute("data-zoom-image", "{{ Storage::url($product->image) }}");
            }
        }

        // Hàm cập nhật giá theo lựa chọn và số lượng
        window.updatePrice = function() {
            const selectedColorVal = document.getElementById('selectedColor').value;
            const selectedSizeVal = document.getElementById('selectedSize').value;
            const quantity = parseInt(qtyInput.value) || 1;
            let priceToUse = basePrice;
            if (selectedColorVal && selectedSizeVal) {
                const variant = productVariants.find(v =>
                    v.color_id == selectedColorVal && v.size_id == selectedSizeVal && v.quantity > 0
                );
                if (variant && variant.price) {
                    priceToUse = variant.price;
                }
            }
            const totalPrice = priceToUse * quantity;
            const unitPriceDisplay = document.getElementById("unitPriceDisplay");
            const totalPriceDisplay = document.getElementById("totalPriceDisplay");
            if (unitPriceDisplay) {
                unitPriceDisplay.textContent = new Intl.NumberFormat("vi-VN").format(priceToUse) + " VNĐ";
            }
            if (totalPriceDisplay) {
                totalPriceDisplay.textContent = new Intl.NumberFormat("vi-VN").format(totalPrice) + " VNĐ";
            }
        };

        // Hàm cập nhật trạng thái các nút lựa chọn (disabled, active, ...)
        window.updateAvailableOptions = function() {
            const selectedColorVal = document.getElementById('selectedColor').value;
            const selectedSizeVal = document.getElementById('selectedSize').value;
            // Cập nhật trạng thái cho các nút kích cỡ dựa trên màu đã chọn
            document.querySelectorAll('.size-btn').forEach(function(btn) {
                const sizeId = btn.getAttribute('data-size');
                if (selectedColorVal) {
                    const variantAvailable = productVariants.find(v =>
                        v.color_id == selectedColorVal && v.size_id == sizeId && v.quantity > 0
                    );
                    if (variantAvailable) {
                        btn.disabled = false;
                        btn.classList.remove('disabled-option');
                    } else {
                        btn.disabled = true;
                        btn.classList.add('disabled-option');
                        if (btn.classList.contains('active')) {
                            btn.classList.remove('active');
                            document.getElementById('selectedSize').value = "";
                        }
                    }
                } else {
                    btn.disabled = false;
                    btn.classList.remove('disabled-option');
                }
            });
            // Cập nhật trạng thái cho các nút màu dựa trên kích cỡ đã chọn (loại trừ nút "Gốc")
            document.querySelectorAll('.color-btn:not(.reset-variant)').forEach(function(btn) {
                const colorId = btn.getAttribute('data-color');
                if (selectedSizeVal) {
                    const variantAvailable = productVariants.find(v =>
                        v.size_id == selectedSizeVal && v.color_id == colorId && v.quantity > 0
                    );
                    if (variantAvailable) {
                        btn.disabled = false;
                        btn.classList.remove('disabled-option');
                    } else {
                        btn.disabled = true;
                        btn.classList.add('disabled-option');
                        if (btn.classList.contains('active')) {
                            btn.classList.remove('active');
                            document.getElementById('selectedColor').value = "";
                        }
                    }
                } else {
                    btn.disabled = false;
                    btn.classList.remove('disabled-option');
                }
            });
            if (selectedColorVal && selectedSizeVal) {
                const variant = productVariants.find(v =>
                    v.color_id == selectedColorVal && v.size_id == selectedSizeVal && v.quantity > 0
                );
                if (variant) {
                    qtyInput.setAttribute("max", variant.quantity);
                } else {
                    qtyInput.removeAttribute("max");
                }
            } else {
                qtyInput.setAttribute("max", totalProductQty);
            }
            updateVariant();
            updatePrice();
        };

        // Sự kiện cho các nút màu thông thường (không có lớp reset-variant)
        document.querySelectorAll('.color-btn:not(.reset-variant)').forEach(btn => {
            btn.addEventListener("click", function() {
                selectedColor = this.getAttribute("data-color");
                document.getElementById("selectedColor").value = selectedColor;
                document.querySelectorAll('.color-btn:not(.reset-variant)').forEach(b =>
                    b.classList.remove("active"));
                this.classList.add("active");
                // Khi chọn màu mới, reset lựa chọn kích cỡ
                document.querySelectorAll('.size-btn').forEach(b => b.classList.remove(
                    "active"));
                document.getElementById("selectedSize").value = "";
                selectedSize = null;
                updateAvailableOptions();
            });
        });

        // Sự kiện chọn kích cỡ
        sizeButtons.forEach(btn => {
            btn.addEventListener("click", function() {
                selectedSize = this.getAttribute("data-size");
                document.getElementById("selectedSize").value = selectedSize;
                sizeButtons.forEach(b => b.classList.remove("active"));
                this.classList.add("active");
                updateAvailableOptions();
            });
        });

        // Lắng nghe thay đổi của ô số lượng để cập nhật giá
        if (qtyInput) {
            qtyInput.addEventListener("input", updatePrice);
        }

        // Khởi tạo khi load trang
        window.updateAvailableOptions();
        window.updatePrice();
    });

    // Hàm tăng số lượng (cộng thêm 1 đơn vị)
    function increaseQty() {
        const qtyInput = document.getElementById("qtyInput");
        let currentQty = Number(qtyInput.value) || 1;
        let maxQty = qtyInput.getAttribute("max");
        if (!maxQty) {
            maxQty = {{ $product->quantity }};
        } else {
            maxQty = Number(maxQty);
        }
        if (currentQty < maxQty) {
            qtyInput.value = currentQty ;
            qtyInput.dispatchEvent(new Event("input"));
        }
    }

    // Hàm giảm số lượng (trừ 1 đơn vị, không nhỏ hơn 1)
    function decreaseQty() {
        const qtyInput = document.getElementById("qtyInput");
        let currentQty = Number(qtyInput.value) || 1;
        if (currentQty > 1) {
            qtyInput.value = currentQty ;
            qtyInput.dispatchEvent(new Event("input"));
        }
    }

    // Hàm reset biến thể (nút "Gốc")
    function resetVariant() {
        selectedColor = null;
        selectedSize = null;
        document.getElementById('selectedColor').value = "";
        document.getElementById('selectedSize').value = "";
        document.querySelectorAll('.color-btn').forEach(function(btn) {
            btn.classList.remove('active');
        });
        document.querySelectorAll('.size-btn').forEach(function(btn) {
            btn.classList.remove('active');
        });
        // Đặt lại ô số lượng với tổng số sản phẩm
        const qtyInput = document.getElementById("qtyInput");
        qtyInput.setAttribute("max", {{ $product->quantity }});
        const stockDisplay = document.getElementById("variantStock");
        if (stockDisplay) {
            stockDisplay.textContent = "{{ $product->quantity }} sản phẩm có sẵn";
        }
        const productImage = document.querySelector(".single-product-img .active img");
        productImage.src = "{{ Storage::url($product->image) }}";
        productImage.setAttribute("data-zoom-image", "{{ Storage::url($product->image) }}");
        updatePrice();
        updateAvailableOptions();
    }
</script>

<!-- single product details start -->
<div class="single-product-details">
    <div class="container">
        <div class="row">
            <!-- Cột hình ảnh sản phẩm -->
            <div class="col-lg-6">
                <div class="single-product-img tab-content">
                    <div class="single-pro-main-image tab-pane active" id="pro-large-img-1">
                        <a href="#">
                            <img class="optima_zoom" src="{{ Storage::url($product->image) }}"
                                data-zoom-image="{{ Storage::url($product->image) }}" alt="optima" />
                        </a>
                    </div>
                    @foreach ($product->galleries as $key => $gallery)
                        <div class="single-pro-main-image tab-pane" id="pro-large-img-{{ $key + 2 }}">
                            <a href="#">
                                <img class="optima_zoom" src="{{ Storage::url($gallery->image) }}"
                                    data-zoom-image="{{ Storage::url($gallery->image) }}" alt="Product Image">
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="nav product-page-slider">
                    <div class="single-product-slider">
                        <a class="active" href="#pro-large-img-1" data-bs-toggle="tab">
                            <img src="{{ Storage::url($product->image) }}" alt="">
                        </a>
                    </div>
                    @foreach ($product->galleries as $key => $gallery)
                        <div class="single-product-slider">
                            <a href="#pro-large-img-{{ $key + 2 }}" data-bs-toggle="tab">
                                <img src="{{ Storage::url($gallery->image) }}" alt="Product Image">
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
                        <span>{{ number_format($product->price_sale ?? $product->price, 0, ',', '.') }} VNĐ</span>
                    </div>
                    <div class="action">
                        <ul class="add-to-links">
                            <li>
                                <a href="#">
                                    <i class="fa fa-heart"></i>
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
                                        @foreach ($product->colors as $color)
                                            <button type="button" class="btn btn-outline-primary me-2 color-btn rounded-0"
                                                data-color="{{ $color->id }}"
                                                style="background: {{ $color->color }}; width: 40px; height: 40px;"
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

                        <!-- Chọn số lượng và nút thêm vào giỏ hàng -->
                        <div class="row g-3 align-items-center mt-3">
                            <div class="col-md-3">
                                <label class="form-label"><strong>Số Lượng</strong></label>
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary" type="button" onclick="decreaseQty()">-</button>
                                    <input type="text" class="form-control text-center" id="qtyInput" value="1">
                                    <button class="btn btn-outline-secondary" type="button" onclick="increaseQty()">+</button>
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
        const qtyInput = document.getElementById("qtyInput");
        const priceBox = document.querySelector(".item-price span");

        // Giá cơ bản của sản phẩm
        const basePrice = {{ $product->price_sale ?? $product->price }};
        // Dữ liệu variant
        const productVariants = @json($product->variants ?? []);

        // Hàm cập nhật giá tổng dựa trên lựa chọn và số lượng
        window.updatePrice = function() {
            const selectedColor = document.getElementById('selectedColor').value;
            const selectedSize = document.getElementById('selectedSize').value;
            const quantity = parseInt(qtyInput.value) || 1;
            let priceToUse = basePrice;

            if (selectedColor && selectedSize) {
                const variant = productVariants.find(
                    v => v.color_id == selectedColor && v.size_id == selectedSize && v.quantity > 0
                );
                if (variant) {
                    priceToUse = variant.price;
                }
            }

            const totalPrice = priceToUse * quantity;
            priceBox.textContent = new Intl.NumberFormat("vi-VN").format(totalPrice) + " VNĐ";
        }

        // Hàm cập nhật trạng thái disabled của các nút dựa trên lựa chọn hiện tại
        window.updateAvailableOptions = function() {
            const selectedColor = document.getElementById('selectedColor').value;
            const selectedSize = document.getElementById('selectedSize').value;

            // Cập nhật trạng thái cho các nút size dựa trên màu đã chọn
            document.querySelectorAll('.size-btn').forEach(function(btn) {
                const sizeId = btn.getAttribute('data-size');
                if (selectedColor) {
                    // Kiểm tra xem có variant với màu đã chọn và size tương ứng không
                    const variantAvailable = productVariants.find(v => 
                        v.color_id == selectedColor && v.size_id == sizeId && v.quantity > 0
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
                    // Nếu chưa chọn màu, cho phép chọn tất cả size
                    btn.disabled = false;
                    btn.classList.remove('disabled-option');
                }
            });

            // Cập nhật trạng thái cho các nút màu dựa trên size 
            document.querySelectorAll('.color-btn').forEach(function(btn) {
                const colorId = btn.getAttribute('data-color');
                if (selectedSize) {
                    const variantAvailable = productVariants.find(v => 
                        v.size_id == selectedSize && v.color_id == colorId && v.quantity > 0
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

            // Nếu cả màu và kích cỡ được chọn, cập nhật thuộc tính "max" cho ô số lượng theo tồn kho của variant đó
            if (selectedColor && selectedSize) {
                const variant = productVariants.find(
                    v => v.color_id == selectedColor && v.size_id == selectedSize && v.quantity > 0
                );
                if (variant) {
                    qtyInput.setAttribute("max", variant.quantity);
                } else {
                    qtyInput.removeAttribute("max");
                }
            } else {
                qtyInput.removeAttribute("max");
            }
        }

        // Hàm chọn màu: reset lại lựa chọn size khi chọn màu mới
        window.selectColor = function(element) {
            // Reset lựa chọn size
            document.querySelectorAll('.size-btn').forEach(btn => btn.classList.remove('active'));
            document.getElementById('selectedSize').value = "";

            // Cập nhật active cho nút màu được chọn
            document.querySelectorAll('.color-btn').forEach(btn => btn.classList.remove('active'));
            element.classList.add('active');
            document.getElementById('selectedColor').value = element.getAttribute('data-color');

            window.updateAvailableOptions();
            window.updatePrice();
        }

        // Hàm chọn kích cỡ
        window.selectSize = function(element) {
            document.querySelectorAll('.size-btn').forEach(btn => btn.classList.remove('active'));
            element.classList.add('active');
            document.getElementById('selectedSize').value = element.getAttribute('data-size');
            window.updateAvailableOptions();
            window.updatePrice();
        }

        // Lắng nghe sự thay đổi của số lượng
        if (qtyInput) {
            qtyInput.addEventListener("input", window.updatePrice);
        }

        // Khởi tạo khi load trang
        window.updateAvailableOptions();
        window.updatePrice();
    });

    // Hàm tăng số lượng
    function increaseQty() {
        const qtyInput = document.getElementById("qtyInput");
        qtyInput.value = parseInt(qtyInput.value) ;
        qtyInput.dispatchEvent(new Event("input"));
    }

    // Hàm giảm số lượng (ít nhất là 1)
    function decreaseQty() {
        const qtyInput = document.getElementById("qtyInput");
        if (parseInt(qtyInput.value) > 1) {
            qtyInput.value = parseInt(qtyInput.value) ;
            qtyInput.dispatchEvent(new Event("input"));
        }
    }
</script>

<!-- single product details start -->
<div class="single-product-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="single-product-img tab-content">
                    <div class="single-pro-main-image tab-pane active" id="pro-large-img-1">
                        <a href="#"><img class="optima_zoom" src="{{Storage::url($product->image)}}"
                                data-zoom-image="{{Storage::url($product->image)}}" alt="optima" /></a>
                    </div>
                    @foreach ($product->galleries as $key => $gallery)
                        <div class="single-pro-main-image tab-pane"
                            id="pro-large-img-{{ $key + 2 }}">
                            <a href="#">
                                <img class="optima_zoom" src="{{Storage::url($gallery->image)}}"
                                    data-zoom-image="{{Storage::url($gallery->image)}}" alt="Product Image">
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="nav product-page-slider">
                    <div class="single-product-slider">
                        <a class="active" href="#pro-large-img-1" data-bs-toggle="tab">
                            <img src="{{Storage::url($product->image)}}" alt="">
                        </a>
                    </div>
                    @foreach ($product->galleries as $key => $gallery)
                        <div class="single-product-slider">
                            <a class="" href="#pro-large-img-{{ $key + 2 }}"
                                data-bs-toggle="tab">
                                <img src="{{Storage::url($gallery->image)}}" alt="Product Image">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single-product-details">
                    <!-- Tên sản phẩm -->
                    <a href="#" class="product-name">{{ $product->name }}</a>
                    <div class="list-product-info">
                        <div class="price-rating">
                            <div class="ratings">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= floor($product->average_rating))
                                        <i class="fa fa-star"></i> <!-- Sao đầy -->
                                    @elseif($i - 0.5 == $product->average_rating)
                                        <i class="fa fa-star-half-o"></i> <!-- Sao nửa -->
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
                        <span>{{ number_format($product->price_sale ?? $product->price, 0, ',', '.') }}
                            VNĐ</span>
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
                    <form action="{{route('cart.add',$product->id)}}" method="post" >
                        @csrf
                    <div class="container">
                        <div class="row g-3 align-items-center my-2">
                            <div class="col-md-6">
                                <label class="form-label required"> Màu</label>
                                <select class="form-select" name="color">
                                    <option>-- Chọn Màu --</option>
                                    @foreach ($product->colors as $color)
                                        <option value="{{ $color->id }}" data-color="{{ $color->color }}">
                                            {{ ucfirst($color->color) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required"> Kích cỡ</label>
                                <select class="form-select" name="size">
                                    <option>-- Chọn Kích Cỡ --</option>
                                    @foreach ($product->sizes as $size)
                                        <option value="{{ $size->id }}" data-size="{{ $size->size }}">
                                            {{ strtoupper($size->size) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 align-items-center mt-3">
                        <div class="col-md-3">
                            <label class="form-label"> <strong>Số Lượng</strong> </label>
                            <div class="input-group">
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="decreaseQty()">-</button>
                                <input type="text" class="form-control text-center " id="qtyInput" value="1" name="quantity">
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="increaseQty()">+</button>
                            </div>
                        </div>
                        <div class=" d-flex align-items-end">
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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const selectColor = document.querySelector(".form-select[name='color']");
        const selectSize = document.querySelector(".form-select[name='size']");
        const qtyInput = document.getElementById("qtyInput");
        const priceBox = document.querySelector(".item-price span");

        let basePrice = {{ $product->price_sale ?? $product->price }};
        let productVariants = @json($product->variants ?? []);

        function updatePrice() {
            const selectedColor = selectColor ? selectColor.value : null;
            const selectedSize = selectSize ? selectSize.value : null;
            const quantity = parseInt(qtyInput.value) || 1;
            let extraPrice = basePrice;

            if (productVariants.length > 0) {
                const variant = productVariants.find(
                    (v) => v.color_id == selectedColor && v.size_id == selectedSize
                );

                if (variant) {
                    extraPrice = variant.price;
                }
            }

            const totalPrice = extraPrice * quantity;
            priceBox.textContent = new Intl.NumberFormat("vi-VN").format(totalPrice) + " VNĐ";
        }

        if (selectColor) selectColor.addEventListener("change", updatePrice);
        if (selectSize) selectSize.addEventListener("change", updatePrice);
        if (qtyInput) qtyInput.addEventListener("input", updatePrice);
    });

    function increaseQty() {
        let qtyInput = document.getElementById("qtyInput");
        qtyInput.value = parseInt(qtyInput.value) ;
        qtyInput.dispatchEvent(new Event("input"));
    }

    function decreaseQty() {
        let qtyInput = document.getElementById("qtyInput");
        if (parseInt(qtyInput.value) > 1) {
            qtyInput.value = parseInt(qtyInput.value);
            qtyInput.dispatchEvent(new Event("input"));
        }
    }
</script>

<!-- Chi tiết sản phẩm -->
<div class="single-product-details">
    <div class="container">
        <div class="row">
            <!-- Cột hình ảnh sản phẩm -->
            <div class="col-lg-6">
                <div class="single-product-img tab-content">
                    <!-- Hình ảnh chính -->
                    <div class="single-pro-main-image tab-pane active overflow-hidden show"
                        style="height: 555px; width: 555px;" id="pro-large-img-1">
                        <a href="#">
                            <img class="optima_zoom " id="main-image-product-detail" src=""
                                alt="Hình ảnh sản phẩm"
                                style="width: 100%; height: 100%; object-fit: cover; border-radius: 5px">
                        </a>
                    </div>
                </div>
                <!-- Thanh hình thu nhỏ -->
                <div id="single-product-slider-detail">
                    <button class="prev-slider-detail">&#10094;</button>
                    <button class="next-slider-detail">&#10095;</button>
                    <div class="single-product-slider" id="single-product-slider">
                        <a class="active slider-image-detail" href="#pro-large-img-1" data-bs-toggle="tab">
                            <img src="" alt="Ảnh thu nhỏ sản phẩm" id="image-slider-main">
                        </a>
                    </div>
                </div>

            </div>
            <div class="col-lg-6">
                <div class="single-product-details">
                    <a href="#" class="product-name" id="product-name-detail"></a>
                    <div class="product-average-rating d-flex gap-2">
                        <div class="product-rating-stars">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <span class="product-rating-value">0</span>
                        <span class="product-review-count">0</span> đánh giá
                    </div>
                    <div class="list-product-info">
                        <div class="price-rating">

                            <span class="old-price" id="price-detail"
                                style="color:rgb(0, 0, 0); text-decoration: line-through;">
                            </span>

                            <span class="new-price" id="price-sale-detail"
                                style="margin-left: 10px; font-weight: bold; color: #f25862;">
                            </span>

                            <div class="ratings">
                                <a href="#" class="review" id="number-review-detail"></a>
                            </div>

                        </div>
                    </div>
                    <div class="avalable">
                        <p id="product-quantity-detail"></p>
                    </div>
                    <form id="add-cart-item-form">
                        @csrf
                        <div class="container">
                            <div class="row g-3 align-items-center my-2">
                                <input type="hidden" name="product_id" value="" id="product-id-detail">
                                <!-- Chọn màu -->
                                <div class="col-md-6">
                                    <label class="form-label required">Màu sắc</label>
                                    <input type="hidden" name="color" id="selected-color-detail">
                                    <div class="d-flex flex-wrap gap-2" id="color-detail-options">

                                    </div>
                                </div>
                                <!-- Chọn kích cỡ -->
                                <div class="col-md-6">
                                    <label class="form-label required">Kích cỡ</label>
                                    <input type="hidden" name="size" id="selected-size-detail">
                                    <div class="d-flex flex-wrap gap-2" id="size-detail-options">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Số lượng và nút thêm vào giỏ -->
                        <div class="row g-3 align-items-center mt-3">
                            <div class="col-md-3">
                                <label class="form-label"><strong>Số lượng</strong></label>
                                <div class="input-group">
                                    <input type="number" id="quantity" name="quantity" class="form-control"
                                        value="1" min="1">
                                </div>
                            </div>
                            <p id="error-modal" class="text-danger" style="font-size: 18px"></p>
                            <div class="d-flex align-items-end">
                                <button class="btn w-50" type="submit" id="add-to-cart-btn-detail">
                                    Thêm vào giỏ hàng
                                </button>
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

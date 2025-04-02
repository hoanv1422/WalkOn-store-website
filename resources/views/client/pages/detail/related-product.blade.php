<!-- related product area start-->
@if ($relatedProducts->isNotEmpty())
    <div class="features-product-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Sản phẩm liên quan</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="feature-product-slider carousel-margin">
                    @foreach ($relatedProducts as $related)
                        <div class="col">
                            <div class="single-product">
                                <!-- Nhãn sản phẩm  -->
                                <div class="level-pro-new">
                                    <span>new</span>
                                </div>
                                <div class="product-img">
                                    <a href="{{ route('detail.index', $related->slug) }}">

                                        <img src="{{ Storage::url($related->image) }}" alt="{{ $related->name }}"
                                            class="primary-img">

                                        <img src="{{ Storage::url($related->secondary_image ?? $related->image) }}"
                                            alt="{{ $related->name }}" class="secondary-img">
                                    </a>
                                </div>
                                <div class="product-name">
                                    <a href="{{ route('detail.index', $related->slug) }}" title="{{ $related->name }}">
                                        {{ $related->name }}
                                    </a>
                                </div>
                                <div class="price-rating">
                                    <span class="old-price" style="color:red">
                                        {{ number_format($related->price, 0, ',', '.') }} VND
                                    </span>
                                    <span>
                                        {{ number_format($related->price_sale, 0, ',', '.') }} VND
                                    </span>
                                    <div class="ratings">
                                        <span>{{ $related->average_rating }}</span> <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <div class="actions">
                                    <button type="submit" class="cart-btn" title="Add to cart">thêm vào giỏ
                                        hàng</button>
                                    <ul class="add-to-link">
                                        <li>
                                            <a class="modal-view" data-target="#productModal" data-bs-toggle="modal"
                                                href="#">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        </li>

                                        <a href="#" class="wishlist-link" data-product-id="{{ $product->id }}"
                                            title="{{ in_array($product->id, $wishlistProductIds) ? 'Đã thêm vào danh sách yêu thích' : 'Thêm vào danh sách yêu thích' }}">
                                            <i
                                                class="fa {{ in_array($product->id, $wishlistProductIds) ? 'fa-heart text-danger' : 'fa-heart-o' }}"></i>
                                        </a>

                                        <li>
                                            <a href="#">
                                                <i class="fa fa-refresh"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endif
<!-- related product area end-->
<script>
    $(document).ready(function() {
        $('.wishlist-link').on('click', function(e) {
            e.preventDefault();
            let $link = $(this);
            let productId = $link.data('product-id');
            let $icon = $link.find('i');

            // Xác định hành động: nếu icon đang là fa-heart-o thì thực hiện thêm, ngược lại xoá
            let action = $icon.hasClass('fa-heart-o') ? 'add' : 'remove';

            $.ajax({
                url: "{{ route('wishlist.store') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId,
                    action: action
                },
                success: function(response) {
                    if (response.success) {
                        if (action === 'add') {
                            // Đã thêm sản phẩm vào wishlist: chuyển icon sang fa-heart và thêm màu đỏ
                            $icon.removeClass('fa-heart-o').addClass(
                            'fa-heart text-danger');
                            $link.attr('title', 'Đã thêm vào danh sách yêu thích');
                        } else {
                            // Xoá sản phẩm khỏi wishlist: chuyển icon về fa-heart-o
                            $icon.removeClass('fa-heart text-danger').addClass(
                            'fa-heart-o');
                            $link.attr('title', 'Thêm vào danh sách yêu thích');
                        }
                        // Tùy chọn: hiển thị thông báo thành công
                        showToast(response.message || 'Thao tác thành công!');
                    } else {
                        showToast(response.message || 'Có lỗi xảy ra!');
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });

        // Hàm hiển thị toast (thông báo)
        function showToast(message) {
            $('<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                message +
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                '</div>').appendTo('body').delay(3000).fadeOut(500, function() {
                $(this).remove();
            });
        }
    });
</script>

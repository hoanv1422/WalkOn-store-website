<div class="related-product home2">
    <div class="container">
        <div class="row" >
            <div class="col-md-12" >
                <div class="product-title" style=" margin: 20px 0;">
                    <h2>Sản Phẩm Liên Quan</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="products-slider-container" id="related-products-slider">
                <button class="slider-button prev-button">←</button>
                <button class="slider-button next-button">→</button>
                <div class="products-slider" id="related-products"></div>
                <div class="slider-dots" id="slider-dots"></div>
            </div>
        </div>
    </div>
</div>

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
                url: "{{ route('wishlist.toggle') }}",
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

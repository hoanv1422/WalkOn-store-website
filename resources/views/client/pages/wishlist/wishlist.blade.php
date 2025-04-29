<!-- wishlist area start -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="wishlist-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="product-sidebar">
                    <div class="sidebar-title">
                        <h2>Shopping Options</h2>
                    </div>
                    <div class="single-sidebar">
                        <div class="single-sidebar-title">
                            <h3>Category</h3>
                        </div>
                        <div class="single-sidebar-content">
                            <ul>
                                <li><a href="#">Dresses (4)</a></li>
                                <li><a href="#">shoes (6)</a></li>
                                <li><a href="#">Handbags (1)</a></li>
                                <li><a href="#">Clothing (3)</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="single-sidebar">
                        <div class="single-sidebar-title">
                            <h3>Color</h3>
                        </div>
                        <div class="single-sidebar-content">
                            <ul>
                                <li><a href="#">Black (2)</a></li>
                                <li><a href="#">Blue (2)</a></li>
                                <li><a href="#">Green (4)</a></li>
                                <li><a href="#">Grey (2)</a></li>
                                <li><a href="#">Red (2)</a></li>
                                <li><a href="#">White (2)</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="single-sidebar">
                        <div class="single-sidebar-title">
                            <h3>Manufacturer</h3>
                        </div>
                        <div class="single-sidebar-content">
                            <ul>
                                <li><a href="#">Calvin Klein (2)</a></li>
                                <li><a href="#">Diesel (2)</a></li>
                                <li><a href="#">option value (1)</a></li>
                                <li><a href="#">Polo (2)</a></li>
                                <li><a href="#">store view (4)</a></li>
                                <li><a href="#">Tommy Hilfiger (2)</a></li>
                                <li><a href="#">will be used (1)</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="wishlist-banner">
                    <a href="#"><img src="{{ asset('img/checkout/checkout_banner.jpg') }}" alt=""></a>
                </div>
                <h2 class="wishlist-heading">Wishlist</h2>

                <div class="wishlist-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Sản Phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody id="wishlist-body">
                                @forelse ($wishlistItems as $item)
                                    <tr data-id="{{ $item->id }}">
                                        <td>
                                            <a href="{{ route('detail.index', $item->product->slug ?? '#') }}">
                                                <img src="{{ asset('img/products/' . ($item->product->image ?? 'default.jpg')) }}"
                                                    alt="" width="70">
                                            </a>
                                        </td>
                                        <td>
                                            @if ($item->product)
                                                <a href="{{ route('detail.index', $item->product->slug) }}">
                                                    {{ $item->product->name }}
                                                </a>
                                            @else
                                                <span class="text-danger">Sản phẩm không tồn tại</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->product->quantity ?? 0 }}</td>
                                        <td>${{ number_format($item->product->price ?? 0, 2) }}</td>
                                        <td>
                                            <button class="btn-wishlist-delete" data-id="{{ $item->id }}"
                                                title="Remove" style="background:none;border:none;cursor:pointer">
                                                <i class="fa fa-times text-danger"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">
                                            Chưa có sản phẩm nào trong danh sách yêu thích.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('home.index') }}" class="check-button">Tiếp Tục</a>
                </div>
            </div>
        </div>
    </div>
    <!-- wishlist area end -->
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const baseUrl  = "{{ url('/wishlist') }}";
        const csrfToken = "{{ csrf_token() }}";
    
        document.querySelectorAll('.btn-wishlist-delete').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                if (!confirm('Bạn có chắc muốn xóa sản phẩm này khỏi Wishlist?')) {
                    return;
                }
                const id = this.dataset.id;
                fetch(`${baseUrl}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // Remove the row from the table
                        const row = document.querySelector(`tr[data-id="${id}"]`);
                        if (row) row.remove();
    
                        // Optionally: show a toast/alert
                        // alert('Xóa thành công!');
                    } else {
                        alert(data.error || 'Xóa không thành công.');
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert('Có lỗi xảy ra. Vui lòng thử lại.');
                });
            });
        });
    });
    </script>
    
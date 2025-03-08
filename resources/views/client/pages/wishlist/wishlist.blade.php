<!-- wishlist area start -->
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
                    <a href="#">
                        <img src="img/checkout/checkout_banner.jpg" alt="">
                    </a>
                </div>
                <div class="wishlist-heading">
                    <h2>Wishlist</h2>
                </div>
                <div class="wishlist-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Sku</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($wishlistItems as $item)
                                    <tr>
                                        <!-- Hình ảnh sản phẩm -->
                                        <td>
                                            <a href="{{ route('detail.index', $item->product->slug ?? '#') }}" class="text-center">
                                                <img src="{{ asset('img/products/' . ($item->product->image ?? 'default.jpg')) }}" alt="" width="70">
                                            </a>
                                        </td>
                            
                                        <!-- Tên sản phẩm -->
                                        <td>
                                            @if($item->product)
                                                <a href="{{ route('detail.index', $item->product->slug) }}">{{ $item->product->name }}</a>
                                            @else
                                                <span class="text-danger">Sản phẩm không tồn tại</span>
                                            @endif
                                        </td>
                            
                                        <!-- SKU -->
                                        <td>{{ $item->product->sku ?? 'N/A' }}</td>
                            
                                        <!-- Số lượng còn trong kho -->
                                        <td>{{ $item->product->quantity ?? 0 }}</td>
                            
                                        <!-- Giá -->
                                        <td class="unit-price">${{ number_format($item->product->price ?? 0, 2) }}</td>
                            
                                        <!-- Hành động -->
                                        <td>
                                            <div class="wishlist-actions">
                                                <!-- Form xóa wishlist -->
                                                <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST"
                                                      onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này khỏi Wishlist?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" data-bs-toggle="tooltip" title="Remove">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Chưa có sản phẩm nào trong danh sách yêu thích.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            
                        </table>
                    </div>
                    <button type="submit" value="Continue" class="check-button">Continue</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- wishlist area end -->

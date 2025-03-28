<div class="max-w-2xl mx-auto bg-white p-6 shadow-md rounded-lg">
    <script src="{{ asset('public/resources/js/rating.js') }}"></script>
    <h2 class="text-xl font-bold mb-4">Bình luận sản phẩm</h2>

    @if(session('success'))
        <div class="p-3 mb-4 bg-green-200 text-green-700 rounded">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="p-3 mb-4 bg-red-200 text-red-700 rounded">{{ session('error') }}</div>
    @endif

    <div>
        <p class="avg_rating">Đánh giá trung bình: {{ $averageRating }}  <i class="fa fa-star"></i> </p>
    </div>

    <form method="GET" action="{{ route('product.detail', $product->slug) }}">
        <label for="rating" class="filler_avg">Lọc theo đánh giá:</label>
        <select name="rating" id="rating" class="select_avg">
            <option value="">Tất cả</option>
            <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>1 sao</option>
            <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>2 sao</option>
            <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3 sao</option>
            <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4 sao</option>
            <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 sao</option>
        </select>
        <button type="submit" class="muathemewpgiare muathemewpgiare-4">Lọc</button> 
    </form>
    

    <!-- Danh sách bình luận -->
    <div class="space-y-4">
        @isset($comments)
        @foreach ($comments as $comment)
            <div class="p-3 border rounded-lg ">
                <p class="user_name">{{ $comment->user ? $comment->user->name : 'Tên người dùng không xác định' }}</p>
                <div class="product-rating-info">
                    @for ($i = 1; $i <= 5; $i++)
                        <img src="{{ $i <= $comment->rating ? asset('img/comment/star-filled.png') : asset('img/comment/star-empty.png') }}" alt="star" class="star" width="25px" height="25px">
                    @endfor
                </div>
                <p></p>

                <p class="comment_ct">{{ $comment->content }}</p>
                
                
                <!-- Hiển thị ảnh bình luận (nếu có) -->
                <div class="mt-2">
                    @foreach ($comment->galleries as $gallery)
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="Image" class="w-full h-auto rounded-lg mb-2" width="150px" height="150px">
                    @endforeach
                </div>


                {{-- <span class="text-green-600 flex items-center text-sm mt-1">
                    ✅ Đã mua hàng
                </span> --}}
            </div>
        @endforeach
        @else
            <p>Không có bình luận nào cho sản phẩm này.</p>
        @endisset
    </div>

    <!-- Ô nhập bình luận - Chỉ hiển thị nếu người dùng đã mua hàng -->
    @isset($user)
        @if ($user)
            @if ($hasPurchased)
                {{-- @if ($existingComment == null) --}}
                    <div class="mt-4">
                        <form method="POST" action="{{ route('comments.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <textarea name="content" class="content_cm" placeholder="Viết bình luận của bạn..." required></textarea>
                            <div class="stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    <img src="{{ asset('img/comment/star-empty.png') }}" alt="star" class="star" data-value="{{ $i }}"width="25px" height="25px">
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="rating-input">

                            <!-- Thêm phần upload ảnh -->
                            <div class="mt-4">
                                <input type="file" name="images[]" multiple class="border p-2 rounded-lg">
                            </div>
                              
                            <p></p>
                            <button type="submit" class="btn btn-primary">Gửi bình luận</button>
                        </form>
                    </div>
                {{-- @else
                    <p class="text-red-500 mt-4">Bạn đã bình luận sản phẩm này rồi.</p>
                @endif --}}
            @else
                <p class="text-red-500 mt-4">Bạn cần mua sản phẩm để có thể bình luận.</p>
            @endif
        @else
            <p class="text-gray-600 mt-4">Vui lòng <a href="{{ route('login') }}" class="text-blue-600">đăng nhập</a> để bình luận.</p>
        @endif
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const stars = document.querySelectorAll('.star');
                const ratingInput = document.getElementById('rating-input');
        
                stars.forEach(star => {
                    star.addEventListener('click', function() {
                        const rating = this.getAttribute('data-value');
                        ratingInput.value = rating;
        
                        // Thay đổi hình ảnh của các sao
                        stars.forEach(star => {
                            if (star.getAttribute('data-value') <= rating) {
                                star.src = '{{ asset("img/comment/star-filled.png") }}'; // Sao vàng
                            } else {
                                star.src = '{{ asset("img/comment/star-empty.png") }}'; // Sao trống
                            }
                        });
                    });
        
                    // Thêm hiệu ứng hover để người dùng có thể thấy sao vàng khi di chuột
                    star.addEventListener('mouseenter', function() {
                        const rating = this.getAttribute('data-value');
                        stars.forEach(star => {
                            if (star.getAttribute('data-value') <= rating) {
                                star.src = '{{ asset("img/comment/star-filled.png") }}'; // Sao vàng khi hover
                            } else {
                                star.src = '{{ asset("img/comment/star-empty.png") }}'; // Sao trống
                            }
                        });
                    });
        
                    // Reset khi rời chuột
                    star.addEventListener('mouseleave', function() {
                        const rating = ratingInput.value;
                        stars.forEach(star => {
                            if (star.getAttribute('data-value') <= rating) {
                                star.src = '{{ asset("img/comment/star-filled.png") }}'; // Sao vàng khi đã chọn
                            } else {
                                star.src = '{{ asset("img/comment/star-empty.png") }}'; // Sao trống
                            }
                        });
                    });
                });
            });
        </script>
        
    @endisset
    
</div>

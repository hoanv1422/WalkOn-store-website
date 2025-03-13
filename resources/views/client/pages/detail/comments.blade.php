


<div class="max-w-2xl mx-auto bg-white p-6 shadow-md rounded-lg">
    <script src="{{ asset('public/resources/js/rating.js') }}"></script>
    <h2 class="text-xl font-bold mb-4">Bình luận sản phẩm</h2>

    @if(session('success'))
        <div class="p-3 mb-4 bg-green-200 text-green-700 rounded">{{ session('success') }}</div>
    @endif

    @if(session('error'))<div class="max-w-2xl mx-auto bg-white p-6 shadow-md rounded-lg">
        <script src="{{ asset('public/resources/js/rating.js') }}"></script>
        <h2 class="text-xl font-bold mb-4">Bình luận sản phẩm</h2>
    
        @if(session('success'))
            <div class="p-3 mb-4 bg-green-200 text-green-700 rounded">{{ session('success') }}</div>
        @endif
    
        @if(session('error'))
            <div class="p-3 mb-4 bg-red-200 text-red-700 rounded">{{ session('error') }}</div>
        @endif
    
        <!-- Danh sách bình luận -->
        <div class="space-y-4">
            @isset($comments)
            @foreach ($comments as $comment)
                <div class="p-3 border rounded-lg bg-gray-100">
                    <p class="font-semibold text-blue-600">{{ $comment->user ? $comment->user->name : 'Tên người dùng không xác định' }}</p>
                    <p>{{ $comment->content}}</p>
                    <div class="stars">
                        @for ($i = 1; $i <= 5; $i++)
                            <img src="{{ $i <= $comment->rating ? asset('img/comment/star-filled.png') : asset('img/comment/star-empty.png') }}" alt="star" class="star" width="20px" height="20px">
                        @endfor
                    </div>
                    <span class="text-green-600 flex items-center text-sm mt-1">
                        ✅ Đã mua hàng
                    </span>
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
                    <div class="mt-4">
                        <form method="POST" action="{{ route('comments.store') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <textarea name="content" class="w-full border p-2 rounded-lg" placeholder="Viết bình luận của bạn..." required></textarea>
                            <div class="stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    <img src="{{ asset('img/comment/star-empty.png') }}" alt="star" class="star" data-value="{{ $i }}" width="20px" height="20px">
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="rating-input">
                            
                            <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg">Gửi bình luận</button>
                        </form>
                    </div>
                @else 
                    <p class="text-red-500 mt-4">Bạn cần mua sản phẩm để có thể bình luận.</p>
                @endif
            @else 
                <p class="text-gray-600 mt-4">Vui lòng <a href="{{ route('login') }}" class="text-blue-600">đăng nhập</a> để bình luận.</p>
            @endif  
        @endisset 
    
        <script src="{{ asset('js/rating.js') }}"></script>
    </div>
    
        <div class="p-3 mb-4 bg-red-200 text-red-700 rounded">{{ session('error') }}</div>
    @endif

    <!-- Danh sách bình luận -->
    <div class="space-y-4">
        @isset($comments)
        @foreach ($comments as $comment)
            <div class="p-3 border rounded-lg bg-gray-100">
                <p class="font-semibold text-blue-600">{{ $comment->user ? $comment->user->name : 'Tên người dùng không xác định' }}</p>
                <p>{{ $comment->content}}</p>
                <div class="stars">
                    @for ($i = 1; $i <= 5; $i++)
                        <img src="{{ $i <= $comment->rating ? asset('img/comment/star-filled.png') : asset('img/comment/star-empty.png') }}" alt="star" class="star" width="20px" height="20px">
                    @endfor
                </div>
                <span class="text-green-600 flex items-center text-sm mt-1">
                    ✅ Đã mua hàng
                </span>
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
                <div class="mt-4">
                    <form method="POST" action="{{ route('comments.store') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <textarea name="content" class="w-full border p-2 rounded-lg" placeholder="Viết bình luận của bạn..." required></textarea>
                        <div class="stars">
                            @for ($i = 1; $i <= 5; $i++)
                                <img src="{{ asset('img/comment/star-empty.png') }}" alt="star" class="star" data-value="{{ $i }}" width="20px" height="20px">
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="rating-input">
                        
                        <button type="submit" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg">Gửi bình luận</button>
                    </form>
                </div>
            @else 
                <p class="text-red-500 mt-4">Bạn cần mua sản phẩm để có thể bình luận.</p>
            @endif
        @else 
            <p class="text-gray-600 mt-4">Vui lòng <a href="{{ route('login') }}" class="text-blue-600">đăng nhập</a> để bình luận.</p>
        @endif  
    @endisset 

    <script src="{{ asset('js/rating.js') }}"></script>


</div>


<!-- resources/views/products/show.blade.php -->
<div>
<h2>Bình luận về sản phẩm</h2>

<!-- Form gửi bình luận -->
<form action="{{ route('comments.store', $product->id) }}" method="POST">
    @csrf
    <textarea name="content" rows="4" placeholder="Viết bình luận của bạn..."></textarea>
    <input type="number" name="rating" min="1" max="5" placeholder="Đánh giá (1-5)" required>
    <button type="submit">Gửi bình luận</button>
</form>

<!-- Hiển thị bình luận -->
<div class="comments">
    @foreach($product->comments as $comment)
        <div class="comment">
            <p><strong>{{ $comment->user->name }}</strong> (Đánh giá: {{ $comment->rating }}):</p>
            <p>{{ $comment->content }}</p>
            
            <!-- Form trả lời bình luận -->
            <form action="{{ route('comments.reply', $comment->id) }}" method="POST">
                @csrf
                <textarea name="content" rows="4" placeholder="Trả lời bình luận này..."></textarea>
                <button type="submit">Gửi trả lời</button>
            </form>

            <!-- Hiển thị các trả lời bình luận -->
            @foreach($comment->replies as $reply)
                <div class="reply">
                    <p><strong>{{ $reply->user->name }}</strong>: {{ $reply->content }}</p>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
</div>

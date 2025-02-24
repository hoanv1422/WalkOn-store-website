<li class="comment-item">
    <div class="author-img">
        <img src="{{ asset('img/blog/user.jpg') }}" alt="">
    </div>
    <div class="author-comment">
        <h5>
            <a href="#">{{ $comment->user->name ?? 'Anonymous' }}</a>
            {{ $comment->created_at->format('d M, Y \a\t H:i') }}
         
            <button type="button" class="reply-btn" data-comment-id="{{ $comment->id }}">Reply</button>
        </h5>
        <p>{{ $comment->content }}</p>
        <!-- Form trả lời được ẩn mặc định -->
        <div class="reply-form-container" id="reply-form-{{ $comment->id }}" style="display: none; margin-top:10px;">
            <form action="{{ route('blog.comment', $post->slug) }}" method="POST" class="reply-comment-form">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                <textarea name="content" class="form-control" rows="3" placeholder="Your reply..." required></textarea>
                <div style="margin-top: 5px;">
                    <button type="submit" class="btn btn-sm btn-primary">Submit Reply</button>
                    <button type="button" class="btn btn-sm btn-secondary cancel-reply" data-comment-id="{{ $comment->id }}">Cancel</button>
                </div>
            </form>
        </div>
        <!-- Nếu có bình luận trả lời -->
        @if($comment->replies->count() > 0)
            <ul class="reply-list" style="margin-left:40px; margin-top:10px;">
                @foreach($comment->replies as $reply)
                    @include('client.pages.blog-detail.comment', ['comment' => $reply, 'post' => $post])
                @endforeach
            </ul>
        @endif
    </div>
</li>
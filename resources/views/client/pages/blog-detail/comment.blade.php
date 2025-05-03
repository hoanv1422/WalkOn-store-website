<li class="comment-item" id="comment-{{ $comment->id }}">
    <div class="author-img">
        <img src="{{ asset('img/blog/user.jpg') }}" alt="">
    </div>
    <div class="author-comment">
        <h5 class="d-flex align-items-center justify-content-between">
            <div>
                <a href="#">{{ $comment->user->name ?? 'Anonymous' }}</a>
                <span class="text-muted small">
                    {{ $comment->created_at }}
                </span>
            </div>
        
            <div class="btn-group">
                @auth
                    @if(auth()->id() == $comment->user_id || auth()->user()->role== 'admin')
                        <button type="button" 
                            class="delete-btn btn btn-danger btn-sm ms-2"
                            data-comment-id="{{ $comment->id }}" 
                            title="Xóa bình luận">
                            <i class="fas fa-trash"></i>
                        </button>
                    @endif
                @endauth
        
                <button type="button" 
                    class="reply-btn btn btn-primary btn-sm ms-2"
                    data-comment-id="{{ $comment->id }}">
                    <i class="fas fa-reply"></i>
                </button>
            </div>
        </h5>

        <div class="comment-content mb-3">
            {!! nl2br(e($comment->content)) !!}
        </div>
        @auth
        <!-- Form trả lời được ẩn mặc định -->
        <div class="reply-form-container" id="reply-form-{{ $comment->id }}" style="display: none; margin-top:10px;">
            <form action="{{ route('blog.comment', $post->slug) }}" method="POST" class="reply-comment-form">
                @csrf
                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                <textarea name="content" class="form-control" rows="3" placeholder="Bình Luận Của Bạn..." required></textarea>
                <div style="margin-top: 5px;">
                    <button type="submit" class="btn btn-sm btn-primary">Đăng</button>
                    <button type="button" class="btn btn-sm btn-secondary cancel-reply"
                        data-comment-id="{{ $comment->id }}">Hủy</button>
                </div>
            </form>
        </div>
        @else
    <div class="alert alert-info mt-3">
        Vui lòng <a href="{{ route('login.form') }}">đăng nhập</a> để bình luận
    </div>
@endauth
        <!-- Nếu có bình luận trả lời -->
        @if ($comment->replies->count() > 0)
            <ul class="reply-list" style="margin-left:40px; margin-top:10px;">
                @foreach ($comment->replies as $reply)
                    @include('client.pages.blog-detail.comment', ['comment' => $reply, 'post' => $post])
                @endforeach
            </ul>
        @endif
    </div>
</li>

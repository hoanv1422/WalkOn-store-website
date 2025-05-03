@props(['comment', 'post', 'depth'])

<li class="comment-item mb-3 mt-2" id="comment-{{ $comment->id }}">
    <div class="d-flex">
        <div class="author-img me-3">
            <img src="{{ asset('img/blog/user.jpg') }}" alt="" width="48" height="48">
        </div>
        <div class="flex-fill author-comment">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $comment->user->name }}</strong>
                    <span class="text-muted small">{{ $comment->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="btn-group align-items-center">
                    @auth
                        @if (auth()->id() == $comment->user_id || auth()->user()->role == 'admin')
                            <button class="delete-btn-comment-post btn btn-danger py-1 px-2 lh-1 h-auto"
                                data-comment-id="{{ $comment->id }}" title="Xóa">
                                <i class="fas fa-trash fa-sm"></i>
                            </button>
                        @endif

                        @if ($depth < 3)
                            <button class="reply-btn btn btn-primary py-1 px-2 lh-1 h-auto ms-2"
                                data-comment-id="{{ $comment->id }}" title="Trả lời">
                                <i class="fas fa-reply fa-sm"></i>
                            </button>
                        @endif
                    @endauth
                </div>
            </div>



            <div class="comment-content mt-2">
                {!! nl2br(e($comment->content)) !!}
            </div>

            @auth
                @if ($depth < 3)
                    <div id="reply-form-{{ $comment->id }}" class="reply-form-container mt-2" style="display:none">
                        <form class="reply-comment-form" action="{{ route('blog.comment', $post->slug) }}" method="POST">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                            <textarea name="content" class="form-control mb-2" rows="2" placeholder="Viết trả lời..." required></textarea>
                            <button type="submit" class="btn btn-sm btn-success">Gửi</button>
                            <button type="button" class="btn btn-sm btn-secondary cancel-reply"
                                data-comment-id="{{ $comment->id }}">Hủy</button>
                        </form>
                    </div>
                @endif
            @endauth

            @if ($comment->replies->count() > 0)
                <ul class="reply-list list-unstyled ps-4 mt-3">
                    @foreach ($comment->replies as $reply)
                        @include('client.pages.blog-detail.comment', [
                            'comment' => $reply,
                            'post' => $post,
                            'depth' => $depth + 1,
                        ])
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</li>

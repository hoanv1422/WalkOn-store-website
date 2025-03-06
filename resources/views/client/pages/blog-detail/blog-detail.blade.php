@include('client.components.breadcrumb')
<!-- blog details area start -->
<div class="blog-details-main">
    <div class="container">
        <div class="row">
            <!-- Sidebar (nếu có) -->
            <div class="col-lg-3">
                <div class="product-sidebar">
                    <div class="sidebar-title">
                        <h2>Post Categories</h2>
                    </div>
                    <div class="single-sidebar">
                        <div class="single-sidebar-title">
                            <h3>Category</h3>
                        </div>
                        <div class="single-sidebar-content">
                            <ul>
                                @if (isset($categories))
                                    @foreach ($categories as $category)
                                        <li>
                                            <a href="{{ route('blog.category', $category->slug) }}">
                                                {{ $category->name }} ({{ $category->posts_count }})
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="banner-left">
                        <a href="#">
                            <img src="{{ asset('img/product/banner_left.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
            <!-- Main Content: Chi tiết bài viết -->
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-12">
                        <div class="sidebar-title">
                            <h2>{{ $post->title }}</h2>
                        </div>
                        <div class="blog-area">
                            <div class="blog-post-details">
                                <div class="blog-img">
                                    <a href="#">
                                        <img src="{{ asset('uploads/posts/' . $post->thumbnail) }}"
                                            alt="{{ $post->title }}">
                                    </a>
                                </div>
                                <div class="blog-content">
                                    <span>
                                        <a href="#">{{ $post->user->name ?? 'Admin' }} - </a>
                                        {{ $post->created_at->format('d M, Y') }} ({{ $post->comments()->count() }}
                                        comments)
                                    </span>
                                    <div>
                                        {!! $post->content !!}
                                    </div>
                                    <div class="share-post">
                                        <div class="share-title">
                                            <h3>Share this post</h3>
                                        </div>
                                        <div class="share-social">
                                            <ul>
                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="about-author">
                                        <div class="author-img">
                                            <img src="{{ asset('img/blog/admin.jpg') }}" alt="">
                                        </div>
                                        <div class="author-content">
                                            <h3>About the Author: <a
                                                    href="#">{{ $post->user->name ?? 'Admin' }}</a></h3>
                                        </div>
                                    </div>
                                    <!-- Form gửi bình luận chính -->
                                    <div class="leave-reply">
                                        <div class="reply-title">
                                            <h3>Leave a Reply</h3>
                                        </div>
                                        <div class="reply-form">
                                            <p>Your email address will not be published. Required fields are marked *
                                            </p>
                                            <form id="comment-form" action="{{ route('blog.comment', $post->slug) }}"
                                                method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12 text-area">
                                                        <label>Comment *</label>
                                                        <textarea name="content" cols="30" rows="10" class="form-control" required>{{ old('content') }}</textarea>
                                                        @error('content')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <div class="post-comment">
                                                            <button type="submit" class="btn btn-primary">Post a
                                                                Comment</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    {{-- <!-- Danh sách bình luận --!> --}}
                                    <div class="comment-box">
                                        <div class="comment-title">
                                            <h3 id="comment-count">
                                                {{ $post->comments()->whereNull('parent_id')->count() }} comments</h3>
                                        </div>
                                        <div class="comment-list">
                                            <ul id="comment-list">
                                                {{-- @dd($post->comments) --}}
                                                @foreach ($post->comments->where('parent_id', null) as $comment)
                                                    @include('client.pages.blog-detail.comment', [
                                                        'comment' => $comment,
                                                        'post' => $post,
                                                    ])
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- End phần bình luận -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Phân trang bình luận nếu cần -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- blog details area end -->
@endsection
@section('script')
<script>
    $(document).ready(function() {
        // Gửi bình luận chính
        $('#comment-form').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = $(this).attr('action');

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        // Thêm bình luận mới vào danh sách (append HTML từ response)
                        $('#comment-list').append(response.html);
                        // Cập nhật số lượng bình luận
                        var count = parseInt($('#comment-count').text());
                        $('#comment-count').text(count + 1 + ' comments');
                        // Reset form
                        $('#comment-form')[0].reset();
                        alert('Bình luận của bạn đã được gửi thành công.');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        alert('Bạn cần đăng nhập để bình luận.');
                    } else {
                        alert('Có lỗi xảy ra. Vui lòng thử lại.');
                    }
                }
            });
        });

        // Hiệu ứng slideToggle cho form trả lời khi nhấn nút "Reply"
        $(document).on('click', '.reply-btn', function() {
            var commentId = $(this).data('comment-id');
            $('#reply-form-' + commentId).slideToggle();
        });

        // Hiệu ứng slideUp cho nút "Cancel" trên form trả lời
        $(document).on('click', '.cancel-reply', function() {
            var commentId = $(this).data('comment-id');
            $('#reply-form-' + commentId).slideUp();
        });

        // Gửi form trả lời bình luận
        $(document).on('submit', '.reply-comment-form', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = $(this).attr('action');

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        // Thêm HTML của reply mới vào dưới bình luận cha
                        $(e.target).closest('.reply-form-container').after(response.html);
                        alert('Trả lời của bạn đã được gửi thành công.');
                        $(e.target)[0].reset();
                        $(e.target).closest('.reply-form-container').slideUp();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        alert('Bạn cần đăng nhập để bình luận.');
                    } else {
                        alert('Có lỗi xảy ra. Vui lòng thử lại.');
                    }
                }
            });
        });
    });
</script>

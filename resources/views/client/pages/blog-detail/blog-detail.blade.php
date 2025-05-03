@include('client.components.breadcrumb')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<!-- blog details area start -->
<div class="blog-details-main">
    <div class="container">
        <div class="row">
            <!-- Sidebar (nếu có) -->
            <div class="col-lg-3">
                <div class="product-sidebar">
                    <div class="sidebar-title">
                        <h2>Danh Mục Bài Viết</h2>
                    </div>
                    <div class="single-sidebar">
                        <div class="single-sidebar-title">
                            <h3>Danh Mục</h3>
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
                                    <a href="{{ asset('uploads/posts/' . $post->thumbnail) }}" data-lightbox="gallery"
                                        data-title="{{ $post->title }}">
                                        <img src="{{ asset('uploads/posts/' . $post->thumbnail) }}"
                                            alt="{{ $post->title }}" loading="lazy">
                                    </a>
                                </div>
                                <!-- Cập nhật phần hiển thị ảnh phụ -->
                                @if ($post->images->count() > 0)
                                    <div class="post-gallery">
                                        <h4 class="gallery-title"> Hình ảnh khác {{ $post->images->count() }} </h4>

                                        <div class="gallery-grid">
                                            @foreach ($post->images->sortBy('display_order') as $image)
                                                <div class="gallery-item">
                                                    <a href="{{ asset('uploads/posts/' . $image->image_path) }}"
                                                        data-lightbox="gallery"
                                                        data-title="{{ $image->caption ?? '' }}">
                                                        <img src="{{ asset('uploads/posts/' . $image->image_path) }}"
                                                            alt="{{ $image->caption ?? 'Gallery image' }}"
                                                            loading="lazy">
                                                    </a>

                                                    @if ($image->caption)
                                                        <div class="gallery-caption">
                                                            {{ $image->caption }}
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div class="blog-content">
                                    <span>
                                        <a href="#">{{ $post->user->name ?? 'Admin' }} - </a>
                                        {{ $post->created_at->format('d/m/Y') }} ({{ $post->comments()->count() }}
                                        Bình Luận)
                                    </span>

                                    <div>
                                        {!! $post->content !!}
                                    </div>


                                    <div class="about-author">
                                        <div class="author-img">
                                            <img src="{{ asset('img/blog/admin.jpg') }}" alt="">
                                        </div>
                                        <div class="author-content">
                                            <h3>Tác Giả: <a
                                                    href="#">{{ $post->user->name ?? 'Quản Trị Viên' }}</a></h3>
                                        </div>
                                    </div>
                                    <!-- Form gửi bình luận chính -->
                                    <div class="leave-reply">
                                        <div class="reply-title">
                                            <h3>Bình Luận</h3>
                                        </div>
                                        <div class="reply-form">
                                            @auth
                                                <form id="comment-form" action="{{ route('blog.comment', $post->slug) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-12 text-area">
                                                            <label>Nội Dung</label>
                                                            <textarea name="content" cols="30" rows="10" class="form-control" required>{{ old('content') }}</textarea>
                                                            @error('content')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-md-12">
                                                            <div class="post-comment">
                                                                <button type="submit" class="btn">Đăng Bình
                                                                    Luận</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            @else
                                                <div class="alert alert-info mt-3">
                                                    Vui lòng <a href="{{ route('login.form') }}">Đăng Nhập</a> để bình luận
                                                </div>
                                            @endauth
                                        </div>
                                    </div>

                                    {{-- <!-- Danh sách bình luận --!> --}}
                                    <div class="comment-box">
                                        <div class="comment-title">
                                            <h3 id="comment-count">{{ $post->comments()->count() }} Bình Luận</h3>
                                        </div>
                                        <div class="comment-list">
                                            <ul id="comment-list">
                                                {{-- @dd($post->comments) --}}
                                                @foreach ($post->comments->where('parent_id', null) as $comment)
                                                    @include('client.pages.blog-detail.comment', [
                                                        'comment' => $comment,
                                                        'post' => $post,
                                                        'depth' => 1,
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
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>



@section('script')
<script>
    $(function() {
        // Gửi bình luận gốc
        $('#comment-form').submit(function(e) {
            e.preventDefault();
            let form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: 'POST',
                data: $(form).serialize(),
                success(resp) {
                    if (resp.success) {
                        $('#comment-list').prepend(resp.html);
                        form.reset();
                        $('#comment-count').text(resp.count + ' Bình Luận');
                        toastr.success(resp.message);
                    }
                },
                error(err) {
                    let msg = err.responseJSON?.message || 'Lỗi, thử lại';
                    toastr.error(msg);
                }
            });
        });

        // Toggle reply form
        $(document).on('click', '.reply-btn', function() {
            let id = $(this).data('comment-id');
            $('#reply-form-' + id).slideToggle();
        });

        // Hủy trả lời
        $(document).on('click', '.cancel-reply', function() {
            let id = $(this).data('comment-id');
            $('#reply-form-' + id).slideUp();
        });

        // Gửi bình luận con
        $(document).on('submit', '.reply-comment-form', function(e) {
            e.preventDefault();
            let form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: 'POST',
                data: $(form).serialize(),
                success(resp) {
                    if (resp.success) {
                        $(form).closest('.reply-form-container').after(resp.html);
                        form.reset();
                        $('#reply-form-' + resp.comment.parent_id).slideUp();
                        $('#comment-count').text(resp.count + ' Bình Luận');
                        toastr.success(resp.message);
                    }
                },
                error(err) {
                    let msg = err.responseJSON?.message || 'Lỗi, thử lại';
                    toastr.error(msg);
                }
            });
        });

        $(document).on('click', '.delete-btn-comment-post', function() {
            if (!confirm('Bạn chắc chắn muốn xóa?')) return;
            let id = $(this).data('comment-id');
            let url = `{{ route('blog.comment.delete', ':id') }}`.replace(':id', id);
            $.ajax({
                url,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _method: 'DELETE'
                },
                success(resp) {
                    if (resp.success) {
                        $('#comment-' + id).remove();
                        $('#comment-count').text(resp.count + ' Bình Luận');
                        toastr.success(resp.message);
                    }
                },
                error() {
                    toastr.error('Xóa thất bại');
                }
            });
        });
    });
</script>

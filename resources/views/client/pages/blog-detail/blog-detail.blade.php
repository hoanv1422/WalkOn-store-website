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
                                            <ul class="share-social">
                                                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                                <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                                                <li><a href="#"><i class="fab fa-google"></i></a></li>
                                                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
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
                                            @auth
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
                                            @else
                                                <div class="alert alert-info mt-3">
                                                    Vui lòng <a href="{{ route('login') }}">Đăng Nhập</a> để bình luận
                                                </div>
                                            @endauth
                                        </div>
                                    </div>

                                    {{-- <!-- Danh sách bình luận --!> --}}
                                    <div class="comment-box">
                                        <div class="comment-title">
                                            <h3 id="comment-count">
                                                {{ $post->comments()->count() }} comments</h3>
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
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<style>
#toast-container {
    top: auto !important;
    bottom: 12%;
    right: 1%;
}

.toast {
    background: #000;
    color: #fff;
}

.toast-success {
    background: #28a745;
}

.toast-error {
    background: #dc3545;
}

.toast-warning {
    background: #ffc107;
}

.toast-info {
    background: #17a2b8;
}

.toast-default {
    background: #6c757d;
}

.comment-item .btn-group {
    margin-left: auto;
}

.comment-item .btn {
    padding: 5px 10px;
    font-size: 0.875rem;
}

.comment-item .btn i {
    margin-right: 3px;
}

/* Gallery styles */
.post-gallery {
    position: relative;
    margin: 2rem 0;
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    margin-top: 1.5rem;
}

.gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    transition: transform 0.3s ease;
    background: #f8f9fa;
}

.gallery-item:hover {
    transform: translateY(-5px);
}

.gallery-item img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    cursor: zoom-in;
    border-radius: 8px;
    transition: opacity 0.3s ease;
}

.gallery-item:hover img {
    opacity: 0.9;
}

.gallery-caption {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 0.8rem;
    font-size: 0.9rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.gallery-item:hover .gallery-caption {
    opacity: 1;
}

/* Main image */
.blog-img {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin: 2rem 0;
}

.blog-img img {
    width: 100%;
    height: 500px;
    object-fit: cover;
}

@media (max-width: 768px) {
    .blog-img img {
        height: 300px;
    }

    .gallery-grid {
        grid-template-columns: 1fr;
    }
}
</style>


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
                        $('#comment-list').prepend(response.html);
                        $('#comment-form')[0].reset();
                        var count = parseInt($('#comment-count').text());
                        $('#comment-count').text((count + 1) + ' bình luận');
                        toastr.success(response.message);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        for (var error in errors) {
                            toastr.error(errors[error][0]);
                        }
                    } else if (xhr.status === 401) {
                        toastr.error('Vui lòng đăng nhập để thực hiện chức năng này');
                        setTimeout(function() {
                            window.location.href = "{{ route('login') }}";
                        }, 2000);
                    } else {
                        toastr.error('Có lỗi xảy ra, vui lòng thử lại');
                    }
                }
            });
        });
    
        // Hiển thị/ẩn form trả lời
        $(document).on('click', '.reply-btn', function() {
            var commentId = $(this).data('comment-id');
            $('#reply-form-' + commentId).slideToggle();
        });
    
        // Hủy trả lời bình luận
        $(document).on('click', '.cancel-reply', function() {
            var commentId = $(this).data('comment-id');
            $('#reply-form-' + commentId).slideUp();
        });
    
        // Gửi trả lời bình luận
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
                        $(e.target).closest('.reply-form-container').after(response.html);
                        $(e.target)[0].reset();
                        $(e.target).closest('.reply-form-container').slideUp();
                        toastr.success(response.message);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        alert('Bạn cần đăng nhập để bình luận.');
                        setTimeout(function() {
                            window.location.href = "{{ route('login') }}";
                        }, 2000);
                    } else {
                        alert('Có lỗi xảy ra. Vui lòng thử lại.');
                    }
                }
            });
        });
    });
    
    // Xử lý xóa bình luận
    $(document).on('click', '.delete-btn', function() {
        if (!confirm('Bạn chắc chắn muốn xóa bình luận này?')) return;
    
        var commentId = $(this).data('comment-id');
        var url = "{{ route('blog.comment.delete', ':id') }}".replace(':id', commentId);
    
        $.ajax({
            url: url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                _method: 'DELETE'
            },
            success: function(response) {
                if (response.success) {
                    $('#comment-' + commentId).closest('.comment-item').remove();
                    // Cập nhật count nếu là comment gốc
                    if (response.is_parent) {
                        const countElement = $('#comment-count');
                        const currentCount = parseInt(countElement.text().match(/\d+/)[0]);
                        countElement.text((currentCount - 1) + ' comments');
                    }
                    toastr.success(response.message);
                }
            },
            error: function(xhr) {
                const errorMsg = xhr.responseJSON?.message || 'Lỗi không xác định';
                toastr.error(errorMsg);
                console.error(xhr);
            }
        });
    });
    
    // Cấu hình Lightbox
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'showImageNumberLabel': true,
        'disableScrolling': true,
        'albumLabel': "Ảnh %1 của %2"
    });
    
    // Lazy loading cho hình ảnh
    document.addEventListener("DOMContentLoaded", function() {
        const lazyImages = [].slice.call(document.querySelectorAll("img[loading='lazy']"));
    
        if ("IntersectionObserver" in window) {
            let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        let lazyImage = entry.target;
                        lazyImage.src = lazyImage.dataset.src;
                        lazyImage.classList.remove("lazy");
                        lazyImageObserver.unobserve(lazyImage);
                    }
                });
            });
    
            lazyImages.forEach(function(lazyImage) {
                lazyImageObserver.observe(lazyImage);
            });
        }
    });
    </script>
    

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
                                            <h3 id="comment-count">
                                                {{ $post->comments()->count() }} Bình Luận</h3>
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
                        // toastr.success(response.message);
                        showMessage(response.message, '#4CAF50');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        for (var error in errors) {
                            // toastr.error();
                            showMessage(errors[error][0], '#dc3545');
                        }
                    } else if (xhr.status === 401) {
                        // toastr.error();
                        showMessage('Vui lòng đăng nhập để thực hiện chức năng này',
                            '#dc3545');
                        setTimeout(function() {
                            window.location.href = "{{ route('login.form') }}";
                        }, 2000);
                    } else {
                        // toastr.error();
                        showMessage('Có lỗi xảy ra, vui lòng thử lại', '#dc3545');
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
                        // toastr.success(response.message);
                        showMessage(response.message, '#4CAF50');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        alert('Bạn cần đăng nhập để bình luận.');
                        setTimeout(function() {
                            window.location.href = "{{ route('login.form') }}";
                        }, 2000);
                    } else {
                        alert('Có lỗi xảy ra. Vui lòng thử lại.');
                    }
                }
            });
        });
    });

    // Xử lý xóa bình luận
    $(document).on('click', '.delete-btn-comment-post', function() {
        if (!confirm('Bạn chắc chắn muốn xóa bình luận này?')) return;

        var commentId = $(this).data('comment-id');
        console.log(commentId);

        // Tạo URL xóa bình luận
        var url = "{{ route('blog.comment.delete', ':id') }}".replace(':id', commentId);
        console.log(url);

        $.ajax({
            url: url,
            type: 'DELETE', // Sử dụng DELETE thay vì POST
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success == true) {
                    // Xóa phần tử bình luận khỏi DOM
                    $('#comment-' + commentId).closest('.comment-item').remove();

                    // Cập nhật count nếu là comment gốc
                    if (response.is_parent) {
                        const countElement = $('#comment-count');
                        const currentCount = parseInt(countElement.text().match(/\d+/)[0]);
                        countElement.text((currentCount - 1) + ' Bình Luận');
                    }

                    console.log(response.data);
                    showMessage(response.message, '#4CAF50');
                }
            },
            error: function(xhr) {
                const errorMsg = xhr.responseJSON?.message || 'Lỗi không xác định';
                showMessage(errorMsg, '#dc3545');
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

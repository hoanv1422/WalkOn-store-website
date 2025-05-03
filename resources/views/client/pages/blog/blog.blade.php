<!-- blog area start -->
<div class="blog-main">
    <div class="container">
        <div class="row">
            <!-- Sidebar: Danh mục bài viết -->
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
                                <li>
                                    <a href="{{ route('blog.index') }}">
                                        Tất cả ({{ $totalPosts }})
                                    </a>
                                </li>
                                @foreach ($categories as $category)
                                    <li>
                                        <a href="{{ route('blog.category', $category->slug) }}">
                                            {{ $category->name }} ({{ $category->posts_count }})
                                        </a>
                                    </li>
                                @endforeach
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
            <!-- Main Content: Danh sách bài viết -->
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-12">
                        <div class="sidebar-title">
                            <h2>Bài Đăng</h2>
                        </div>
                        <div class="blog-area">
                            @foreach ($posts as $post)
                                <div class="single-blog-post-page">
                                    <div class="blog-img">
                                        <a href="{{ route('blog.details', $post->slug) }}">
                                            <img src="{{ asset('uploads/posts/' . $post->thumbnail) }}"
                                                alt="{{ $post->title }}">
                                        </a>
                                    </div>
                                    <div class="blog-content">
                                        <a href="{{ route('blog.details', $post->slug) }}"
                                            class="blog-title">{{ $post->title }}</a>
                                        <span>
                                            <a href="#">{{ $post->user->name ?? 'Quản Trị Viên' }} - </a>
                                            {{ $post->created_at->format('d/m/Y') }}
                                            ({{ $post->comments()->count() }} Bình Luận)
                                        </span>
                                        <p>{{ Str::limit($post->content, 150) }}</p>
                                        <a href="{{ route('blog.details', $post->slug) }}" class="readmore">Đọc Thêm
                                            ></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="toolbar-bottom">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- blog area end -->

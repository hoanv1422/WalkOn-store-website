@extends('client.layouts.app')
@section('title', 'blog')
@section('content')

@include('client.layouts.partials.menu_header')
            <div class="mainmenu-area home2 product-items">
                @include('client.layouts.partials.menu_header1')
        <!-- header area end -->
        <!-- blog  banner start -->
   @include('client.layouts.banner.banner3')
        <!-- blog banner end -->
        <!-- blog area start -->
        <div class="blog-main">
            <div class="container">
                @include('client.components.breadcrumb')
                <div class="row">
                    @include('client.layouts.sidebar.sidebar1')
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="sidebar-title">
                                    <h2>Blog Posts</h2>
                                </div>
                                <div class="blog-area">
                                    <div class="single-blog-post-page">
                                        <div class="blog-img">
                                            <a href="blog-details.html">
                                                <img src="client_views/img/blog/5.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="blog-content">
                                            <a href="blog-details.html" class="blog-title">Lorem ipsum dolor sit amet</a>
                                            <span><a href="#">By plaza themes - </a>17 Aug 2015 ( 0 comments )</span>
                                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna...</p>
                                            <a href="blog-details.html" class="readmore">read more ></a>
                                        </div>
                                    </div>
                                    <div class="single-blog-post-page">
                                        <div class="blog-img">
                                            <a href="blog-details.html">
                                                <img src="client_views/img/blog/6.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="blog-content">
                                            <a href="blog-details.html" class="blog-title">Lorem ipsum dolor sit amet</a>
                                            <span><a href="#">By plaza themes - </a>17 Aug 2015 ( 0 comments )</span>
                                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna...</p>
                                            <a href="blog-details.html" class="readmore">read more ></a>
                                        </div>
                                    </div>
                                    <div class="single-blog-post-page">
                                        <div class="blog-img">
                                            <a href="blog-details.html">
                                                <img src="client_views/img/blog/5.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="blog-content">
                                            <a href="blog-details.html" class="blog-title">Lorem ipsum dolor sit amet</a>
                                            <span><a href="#">By plaza themes - </a>17 Aug 2015 ( 0 comments )</span>
                                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna...</p>
                                            <a href="blog-details.html" class="readmore">read more ></a>
                                        </div>
                                    </div>
                                    <div class="single-blog-post-page">
                                        <div class="blog-img">
                                            <a href="blog-details.html">
                                                <img src="client_views/img/blog/6.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="blog-content">
                                            <a href="blog-details.html" class="blog-title">Lorem ipsum dolor sit amet</a>
                                            <span><a href="#">By plaza themes - </a>17 Aug 2015 ( 0 comments )</span>
                                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna...</p>
                                            <a href="blog-details.html" class="readmore">read more ></a>
                                        </div>
                                    </div>
                                    <div class="single-blog-post-page">
                                        <div class="blog-img">
                                            <a href="blog-details.html">
                                                <img src="client_views/img/blog/5.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="blog-content">
                                            <a href="blog-details.html" class="blog-title">Lorem ipsum dolor sit amet</a>
                                            <span><a href="#">By plaza themes - </a>17 Aug 2015 ( 0 comments )</span>
                                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna...</p>
                                            <a href="blog-details.html" class="readmore">read more ></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="toolbar-bottom">
                                    <ul>
                                        <li><span>Pages:</span></li>
                                        <li class="current"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#"> <img src="client_views/img/product/pager_arrow_right.gif" alt=""> </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- blog area end -->
    

@endsection
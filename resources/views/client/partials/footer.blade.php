        <!-- footer top area start -->
        <div class="footer-top-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6">
                        <div class="footer-contact">
                            <img src="http://127.0.0.1:8000/img/logoWalkOn.png" alt="">
                            
                            <ul class="address">
                                {{-- @foreach ($footer as $footers ) --}}
                                    
                               
                                <li>
                                    <span class="fa fa-fax"></span>
                                    {{$footer->address}}
                                </li>
                                <li>
                                    <span class="fa fa-phone"></span>
                                    {{$footer->phone_number}}
                                </li>
                                <li>
                                    <span class="fa fa-envelope-o"></span>
                                    {{$footer->email}}
                                </li>
                                {{-- @endforeach --}}
                            </ul>
                        </div>
                    </div>
                   
                    <div class="col-lg-3 col-md-6">

                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-info">
                            <div class="footer-title">
                                <h3>Our information</h3>
                            </div>
                            <div class="footer-menu">
                                <ul>
                                    <li><a href="{{ route('home.index') }}">Trang Chủ</a></li>
                                    <li><a href="{{ route('shop.index') }}">Cửa hàng</a></li>
                                    <li><a href="{{ route('contact.index') }}">Liên Hệ</a></li>
                                    <li><a href="{{ route('about-us.index') }}">Về Chúng Tôi</a></li>
                                    <li><a href="{{ route('blog.index') }}">Bài Viết</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <footer class="footer-area">
            
            <a href="#" id="scrollUp"><i class="fa fa fa-arrow-up"></i></a>
        </footer>
        <!-- footer area end -->

<section class="main_content dashboard_part large_header_bg">
    <!-- menu header-->
    <div class="container-fluid g-0">
        <div class="row">
            <div class="col-lg-12 p-0">
                <div class="header_iner d-flex justify-content-between align-items-center">
                    <div class="sidebar_icon d-lg-none">
                        <i class="ti-menu"></i>
                    </div>
                    <div class="serach_field-area d-flex align-items-center">
                        <div class="search_inner">
                            <form action="#">
                                <div class="search_field">
                                    <input type="text" placeholder="Search here...">
                                </div>
                                <button type="submit"> <img src="{{asset('admin_views/img/icon/icon_search.svg')}}" alt=""> </button>

                            </form>
                        </div>
                        <span class="f_s_14 f_w_400 ml_25 white_text text_white">Apps</span>
                    </div>
                    <div class="header_right d-flex justify-content-between align-items-center">
                        <div class="header_notification_warp d-flex align-items-center">
                            <li>

                                <a class="bell_notification_clicker nav-link-notify" href="#"> <img src="{{asset('admin_views/img/icon/bell.svg')}}" alt="">


                                </a>
                                <!-- Menu_NOtification_Wrap  -->
                                <div class="Menu_NOtification_Wrap">
                                    <div class="notification_Header">
                                        <h4>Tin nhắn mới</h4>
                                    </div>
                                    <div class="Notification_body">
                                        <!-- single_notify  -->
                                        <div class="single_notify d-flex align-items-center">
                                            <div class="notify_thumb">

                                                <a href="#"><img src="{{asset('admin_views/img/staf/policeHn.jpg')}}" alt=""></a>

                                            </div>
                                            <div class="notify_content">
                                                <a href="#">
                                                    <h5>Ca Hanoi </h5>
                                                </a>
                                                <p>Chào bạn!! tôi là ca hanoi </p>
                                            </div>
                                        </div>
                                        <!-- single_notify  -->
                                        <div class="single_notify d-flex align-items-center">
                                            <div class="notify_thumb">

                                                <a href="#"><img src="{{asset('admin_views/img/staf/2.png')}}" alt=""></a>

                                            </div>
                                            <div class="notify_content">
                                                <a href="#">
                                                    <h5>Long</h5>
                                                </a>
                                                <p>Bạn ơi! Tôi bị bế đi r</p>
                                            </div>
                                        </div>
                                        <!-- single_notify  -->
                                        <div class="single_notify d-flex align-items-center">
                                            <div class="notify_thumb">
                                                <a href="#"><img src="{{asset('admin_views/img/staf/2.png')}}" alt=""></a>

                                            </div>
                                            <div class="notify_content">
                                                <a href="#">
                                                    <h5>Mạnh</h5>
                                                </a>
                                                <p>Bạn ơi CỨU !!</p>
                                            </div>
                                        </div>
                                         <!-- single_notify  -->
                                         <div class="single_notify d-flex align-items-center">
                                            <div class="notify_thumb">
                                                <a href="#"><img src="{{asset('admin_views/img/staf/3.png')}}" alt=""></a>

                                            </div>
                                            <div class="notify_content">
                                                <a href="#">
                                                    <h5>Hòa</h5>
                                                </a>
                                                <p>Công việc đến đâu r ô</p>
                                            </div>
                                        </div>
                                          <!-- single_notify  -->
                                          <div class="single_notify d-flex align-items-center">
                                            <div class="notify_thumb">
                                                <a href="#"><img src="{{asset('admin_views/img/staf/3.png')}}" alt=""></a>

                                            </div>
                                            <div class="notify_content">
                                                <a href="#">
                                                    <h5>Minh</h5>
                                                </a>
                                                <p>Tôi đẩy code lên r lấy nhánh test nhé</p>
                                            </div>
                                        </div>
                                        <div class="nofity_footer">
                                            <div class="submit_button text-center pt_20">
                                                <a href="#" class="btn_1">Xem thêm</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ Menu_NOtification_Wrap  -->
                            </li>
                            <li>

                                <a class="CHATBOX_open nav-link-notify" href="#"> <img src="{{asset('admin_views/img/icon/msg.svg')}}" alt=""> </a>
                            </li>
                        </div>
                        <div class="profile_info">
                            @auth
                            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('admin_views/img/client_img.png') }}" alt="Avatar">
                            <div class="profile_info_iner">
                                <div class="profile_author_name">
                                    <p>{{ Auth::user()->role == 'admin' ? 'Admin' : 'User' }}</p>
                                    <h5>{{ Auth::user()->name ?? Auth::user()->username }}</h5>
                                </div>
                                <div class="profile_info_details">
                                    <a href="{{ route('admin.user.detail', ['id' => Auth::user()->id]) }}">Tài khoản của tôi</a>

                                    <a href="#">Cài đặt</a>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" style="color:white;background: none; border: none; font-weight: bold; cursor: pointer; font-size: 13px">
                                            <a onclick="return confirm('Đăng xuất khỏi tài khoản?')">Đăng xuất</a>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

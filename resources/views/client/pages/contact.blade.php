@extends('client.layouts.app')
@section('title', 'contact')
@section('content')

@include('client.layouts.partials.menu_header')
            <div class="mainmenu-area home2 product-items">
@include('client.layouts.partials.menu_header1')
        <!-- header area end -->
        <!-- contact area start -->
        <div class="contact-area">
            <div class="container">
                @include('client.components.breadcrumb')
                <div class="row">
                  @include('client.layouts.sidebar.sidebar2')
                    <div class="col-lg-9">
                        <div class="contact-info">
                            <div id="googleMap"></div>
                            <div class="contact-details">
                                <div class="contact-title">
                                    <h3>contact us</h3>
                                </div>
                                <div class="contact-form">
                                    <div class="form-title">
                                        <h4>contact information</h4>
                                    </div>
                                    <div class="form-content">
                                        <ul>
                                            <li>
                                                <div class="form-box">
                                                    <div class="form-name">
                                                        <label>Name <em>*</em> </label>
                                                        <input type="text">
                                                    </div>
                                                </div>
                                                <div class="form-box">
                                                    <div class="form-name">
                                                        <label>Email <em>*</em> </label>
                                                        <input type="email">
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-box">
                                                    <div class="form-name">
                                                        <label>telephone </label>
                                                        <input type="text">
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-box">
                                                    <div class="form-name">
                                                        <label>Comment <em>*</em> </label>
                                                        <textarea cols="5" rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="buttons-set">
                                    <p> <em>*</em> Required Fields</p>
                                    <button type="submit">submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- contact area end -->
        <!-- footer top area start -->
       
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBuU_0_uLMnFM-2oWod_fzC0atPZj7dHlU"></script>
        <script>
            function initialize() {
                var mapOptions = {
                    zoom: 15,
                    scrollwheel: false,
                    center: new google.maps.LatLng(23.81033, 90.41252)
                };

                var map = new google.maps.Map(document.getElementById('googleMap'),
                                              mapOptions);


                var marker = new google.maps.Marker({
                    position: map.getCenter(),
                    animation:google.maps.Animation.BOUNCE,
                    icon: 'img/contact/map-marker.png',
                    map: map
                });

            }

            google.maps.event.addDomListener(window, 'load', initialize);
        </script>
@endsection
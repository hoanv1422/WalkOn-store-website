<!-- slider area start -->
        <div class="slider-area home1">
            <div class="bend niceties preview-2">
                <div id="nivoslider" class="slides">
                    @foreach ($banners as $banner)
                    @if ($banner->position == 10)
                    <img src="{{ asset('storage/' . $banner->image_url) }}" alt="slider-10" title="#slider-direction-1" />
                        
                    @elseif ($banner->position == 11)
                    <img src="{{ asset('storage/' . $banner->image_url) }}" alt="slider-11" title="#slider-direction-2" />
                    @endif
                    @endforeach
                </div>
                <!-- direction 1 -->
                <div id="slider-direction-1" class="t-cn slider-direction">
                    <div class="slider-progress"></div>
                    <div class="slider-content t-lfl s-tb slider-1">
                        <div class="title-container s-tb-c title-compress">
                            <h1 class="title1">Giảm giá sản phẩm</h1>
                            <h2 class="title2" >nike Ari max 2015</h2>
                            <h3 class="title3" >Siêu sốc, siêu rẻ, siêu tiết kiệm</h3>
                            <a href="#"><span>Đọc Thêm</span></a>
                        </div>
                    </div>
                </div>
                <!-- direction 2 -->
                <div id="slider-direction-2" class="slider-direction">
                    <div class="slider-progress"></div>
                    <div class="slider-content t-lfl s-tb slider-2">
                        <div class="title-container s-tb-c">
                            <h1 class="title1">Giảm giá sản phẩm</h1>
                            <h2 class="title2" >Giảm giá lên tới 20%</h2>
                            <h3 class="title3" >Sản phẩm chính hãng, chất lượng</h3>
                            <a href="#"><span>Đọc Thêm</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider area end -->
<!-- Bắt đầu tab sản phẩm đơn -->
<div class="single-product-tab-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="single-product-tab">
                    <ul class="nav single-product-tab-navigation" role="tablist">
                        <li role="presentation">
                            <a class="active" href="#tab1" aria-controls="tab1" role="tab"
                                data-bs-toggle="tab">ĐÁNH GIÁ</a>
                        </li>
                        <li role="presentation">
                            <a href="#tab2" aria-controls="tab2" role="tab" data-bs-toggle="tab">GHI CHÚ</a>
                        </li>
                    </ul>

                    <!-- Nội dung tab -->
                    <div class="tab-content single-product-page">
                        <div role="tabpanel" class="tab-pane fade show active" id="tab1">
                            <div class="single-p-tab-content">
                                <div class="row">
                                    @include('client.pages.detail.comments')
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab2">
                            <div class="single-p-tab-content">
                                {{-- {!! $product->description !!} --}}
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
<!-- Kết thúc tab sản phẩm đơn -->


<!-- upsell product area start-->
<div class="upsell-product home2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-title">
                    <h2> đề xuất Sản phẩm </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="upsell-slider">
                @foreach ($upSellProducts as $upSell)
                <div class="col-md-12">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="{{ route('detail.index', $upSell->slug) }}">
                                <img src="{{ Storage::url($upSell->image) }}" alt="" class="primary-img">
                                <img src="{{ Storage::url($upSell->image) }}" alt="" class="secondary-img">
                            </a>
                        </div>
                        <div class="product-price">
                            <div class="product-name">
                                <a href="{{ route('detail.index', $upSell->slug) }}" 
                                   title="{{ $upSell->name }}">
                                   {{ $upSell->name }}
                                </a>
                            </div>
                            <div class="price-rating">
                                <span>{{ number_format($upSell->price, 0, ',', '.') }} VND</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
               
            </div>
        </div>
    </div>
</div>
<!-- upsell product area end-->

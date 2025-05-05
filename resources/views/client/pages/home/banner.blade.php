<!-- banner area start -->
<div class="banner-area">
    <div class="single-banner">
        <div class="part-1">
            @foreach ($banners as $banner)
                @if ($banner->position == 1)
                    <div class="box-1 box">
                        <h4>{{ $banner->title }}</h4>
                        <h2>air superiority</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <a href="{{ $banner->link }}">shopping now</a>
                    </div>
                @elseif ($banner->position == 2)
                    <div class="box-2">
                        <a href="{{ $banner->link }}">
                            <img src="{{ asset('storage/' . $banner->image_url) }}" alt="Banner2">

                        </a>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="part-2">
            <div class="search-box">
                <form action="#">
                    <input type="text">
                    <button type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>

            @foreach ($banners as $banner)
                @if ($banner->position == 3)
                    <div class="box-3">
                        <a href="{{ $banner->link }}">
                            <img src="{{ asset('storage/' . $banner->image_url) }}" alt="Banner3">

                        </a>
                    </div>
                @elseif ($banner->position == 4)
                    <div class="box-4 box">
                        <h4>{{ $banner->title }}</h4>
                        <h2>air superiority</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <a href="{{ $banner->link }}">shopping now</a>
                    </div>
                @elseif ($banner->position == 5)
                    <div class="box-5">
                        <a href="{{ $banner->link }}">
                            <img src="{{ asset('storage/' . $banner->image_url) }}" alt="Banner5">

                        </a>
                    </div>
                @elseif ($banner->position == 6)
                    <div class="box-6">
                        <a href="{{ $banner->link }}">
                            <img src="{{ asset('storage/' . $banner->image_url) }}" alt="Banner6">

                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
<!-- banner area end -->

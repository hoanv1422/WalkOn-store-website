{{-- <!-- product items banner start -->
@foreach ($banners as $banner)
@if ($banner->position == 9)
   
<div class="product-banner">
    <img src="{{ asset('storage/' . $banner->image_url) }}" alt="">
</div>
@endif
@endforeach --}}

<!-- product items banner end -->

<div class="product-details">
    <h1>{{ $product->name }}</h1>
    <div class="product-image">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
    </div>
    <div class="product-description">
        {{ $product->description }}
    </div>
    <div class="product-price">
        {{ number_format($product->price) }} VND
    </div>
    <form action="{{ route('cart.add') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
    </form>
</div>

@if (count($recommendedProducts) > 0)
    <div class="recommended-products">
        <h2>Sản phẩm gợi ý</h2>
        <div class="product-list">  
            @foreach ($recommendedProducts as $recommendation)
                <div class="product-item">
                    <a href="{{ route('products.show', $recommendation['product']->id) }}">
                        <img src="{{ $recommendation['product']->image_url }}"
                            alt="{{ $recommendation['product']->name }}">
                        <h3>{{ $recommendation['product']->name }}</h3>
                        <div class="price">{{ number_format($recommendation['product']->price) }} VND</div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endif

@foreach ($products as $product)
    <a href="{{ route('product.show', $product->product_id) }}" class="card-link">
        <div class="card">
            <img src="{{ $product->image }}" alt="{{ $product->product_name }}" class="product-image"
                 style="width: 100%; height: 300px; object-fit: cover;">
            <h4 style="text-align: center;">{{ $product->product_name }}</h4>
            <p style="text-align: center;">{{ number_format($product->price, 0, ',', '.') }} đ</p>
        </div>
    </a>
@endforeach

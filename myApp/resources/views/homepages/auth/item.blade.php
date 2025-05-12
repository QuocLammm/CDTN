<!-- Item 1-->
<div id="sportShoes">
    <h2 class="header"> Giày thể thao </h2>
    <div class="features">
        @foreach ($sportShoes as $product)
            <a href="{{ route('product.show', $product->product_id) }}" class="card-link" style="text-decoration: none; color: inherit;">
                <div class="card">
                    <img src="{{ $product->image }}" alt="{{ $product->product_name }}" class="product-image"
                         style="width: 100%; height: 300px; object-fit: cover; display: block;">
                    <h4 style="text-align: center;">{{ $product->product_name }}</h4>

                    <p>{{ number_format($product->price, 0, ',', '.') }} đ</p>
                    <div class="color-options">
                        <button class="color-button" style="background-color: #855C40;"></button>
                        <button class="color-button" style="background-color: #000000;"></button>
                        <button class="color-button" style="background-color: #F0E1D4;"></button>
                    </div>
                    <div class="buy-button">Mua</div>
                </div>
            </a>
        @endforeach
        <a href="#" class="view-all">Xem tất cả</a>
    </div>
</div>


<!-- Item 2 -->
<div id="girlShoes">
    <h2 class="header"> Giày thể thao </h2>
    <div class="features">
        @foreach ($girlShoes as $product)
            <a href="{{ route('product.show', $product->product_id) }}" class="card-link" style="text-decoration: none; color: inherit;">
                <div class="card">
                    <img src="{{ $product->image }}" alt="{{ $product->product_name }}" class="product-image"
                         style="width: 100%; height: 300px; object-fit: cover; display: block;">
                    <h4 style="text-align: center;">{{ $product->product_name }}</h4>
                    <p>{{ number_format($product->price, 0, ',', '.') }} đ</p>
                    <div class="color-options">
                        <button class="color-button" style="background-color: #855C40;"></button>
                        <button class="color-button" style="background-color: #000000;"></button>
                        <button class="color-button" style="background-color: #F0E1D4;"></button>
                    </div>
                    <div class="buy-button">Mua</div>
                </div>
            </a>
        @endforeach
        <a href="#" class="view-all">Xem tất cả</a>
    </div>
</div>

<!-- Item 3 -->
<div id="girlDep">
    <h2 class="header"> Giày thể thao </h2>
    <div class="features">
        @foreach ($girlDep as $product)
            <a href="{{ route('product.show', $product->product_id) }}" class="card-link" style="text-decoration: none; color: inherit;">
                <div class="card">
                    <img src="{{ $product->image }}" alt="{{ $product->product_name }}" class="product-image"
                         style="width: 100%; height: 300px; object-fit: cover; display: block;">
                    <h4 style="text-align: center;">{{ $product->product_name }}</h4>
                    <p>{{ number_format($product->price, 0, ',', '.') }} đ</p>
                    <div class="color-options">
                        <button class="color-button" style="background-color: #855C40;"></button>
                        <button class="color-button" style="background-color: #000000;"></button>
                        <button class="color-button" style="background-color: #F0E1D4;"></button>
                    </div>
                    <div class="buy-button">Mua</div>
                </div>
            </a>
        @endforeach
        <a href="#" class="view-all">Xem tất cả</a>
    </div>
</div>


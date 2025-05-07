<div id="featured-products">
    <h2 class="header"> Giày thể thao </h2>
    <div class="features">
        @foreach ($sportShoes as $product)
            <div class="card">
                <img src="{{ $product->image }}" alt="{{ $product->product_name }}" class="product-image"
                     style="width: 100%;
                     height: 300px;
                     object-fit: cover;
                     display: block; ">
                <a href="#"><h4>{{ $product->product_name }}</h4></a>
                <p>{{ number_format($product->price, 0, ',', '.') }} đ</p>
                <div class="color-options">
                    <button class="color-button" style="background-color: #855C40;"></button>
                    <button class="color-button" style="background-color: #000000;"></button>
                    <button class="color-button" style="background-color: #F0E1D4;"></button>
                </div>
                <a href="#" class="buy-button">Mua</a>
            </div>
        @endforeach
        <a href="#" class="view-all">Xem tất cả</a>
    </div>
</div>

<!--Item 2-->
<div id="featured-products">
    <h2 class="header"> Giày nữ </h2>
    <div class="features">
        @foreach ($girlShoes as $product)
            <div class="card">
                <img src="{{ $product->image }}" alt="{{ $product->product_name }}" class="product-image"
                     style="width: 100%;
                     height: 300px;
                     object-fit: cover;
                     display: block; ">
                <a href="#"><h4>{{ $product->product_name }}</h4></a>
                <p>{{ number_format($product->price, 0, ',', '.') }} đ</p>
                <div class="color-options">
                    <button class="color-button" style="background-color: #855C40;"></button>
                    <button class="color-button" style="background-color: #000000;"></button>
                    <button class="color-button" style="background-color: #F0E1D4;"></button>
                </div>
                <a href="#" class="buy-button">Mua</a>
            </div>
        @endforeach
        <a href="#" class="view-all">Xem tất cả</a>
    </div>
</div>

<!--Item 3-->
<div id="featured-products">
    <h2 class="header"> Dép nữ </h2>
    <div class="features">
        @foreach ($girlDep as $product)
            <div class="card">
                <img src="{{ $product->image }}" alt="{{ $product->product_name }}" class="product-image"
                     style="width: 100%;
                     height: 300px;
                     object-fit: cover;
                     display: block; ">
                <a href="#"><h4>{{ $product->product_name }}</h4></a>
                <p>{{ number_format($product->price, 0, ',', '.') }} đ</p>
                <div class="color-options">
                    <button class="color-button" style="background-color: #855C40;"></button>
                    <button class="color-button" style="background-color: #000000;"></button>
                    <button class="color-button" style="background-color: #F0E1D4;"></button>
                </div>
                <a href="#" class="buy-button">Mua</a>
            </div>
        @endforeach
        <a href="#" class="view-all">Xem tất cả</a>
    </div>
</div>

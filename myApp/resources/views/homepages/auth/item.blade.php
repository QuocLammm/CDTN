{{--<!-- Item 1-->--}}
{{--<div id="sportShoes">--}}
{{--    <h2 class="header"> Giày thể thao </h2>--}}
{{--    <div class="features">--}}
{{--        @foreach ($sportShoes as $product)--}}
{{--            <a href="{{ route('product.show', $product->product_id) }}" class="card-link" style="text-decoration: none; color: inherit;">--}}
{{--                <div class="card">--}}
{{--                    <img src="{{ $product->image }}" alt="{{ $product->product_name }}" class="product-image"--}}
{{--                         style="width: 100%; height: 300px; object-fit: cover; display: block;">--}}
{{--                    <h4 style="text-align: center;">{{ $product->product_name }}</h4>--}}

{{--                    <p>{{ number_format($product->price, 0, ',', '.') }} đ</p>--}}
{{--                    <div class="color-options">--}}
{{--                        <button class="color-button" style="background-color: #855C40;"></button>--}}
{{--                        <button class="color-button" style="background-color: #000000;"></button>--}}
{{--                        <button class="color-button" style="background-color: #F0E1D4;"></button>--}}
{{--                    </div>--}}
{{--                    <div class="buy-button">Mua</div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        @endforeach--}}
{{--        <a href="{{ route('products.all') }}" class="view-all">Xem tất cả</a>--}}
{{--    </div>--}}
{{--</div>--}}


{{--<!-- Item 2 -->--}}
{{--<div id="girlShoes">--}}
{{--    <h2 class="header"> Giày thể thao </h2>--}}
{{--    <div class="features">--}}
{{--        @foreach ($girlShoes as $product)--}}
{{--            <a href="{{ route('product.show', $product->product_id) }}" class="card-link" style="text-decoration: none; color: inherit;">--}}
{{--                <div class="card">--}}
{{--                    <img src="{{ $product->image }}" alt="{{ $product->product_name }}" class="product-image"--}}
{{--                         style="width: 100%; height: 300px; object-fit: cover; display: block;">--}}
{{--                    <h4 style="text-align: center;">{{ $product->product_name }}</h4>--}}
{{--                    <p>{{ number_format($product->price, 0, ',', '.') }} đ</p>--}}
{{--                    <div class="color-options">--}}
{{--                        <button class="color-button" style="background-color: #855C40;"></button>--}}
{{--                        <button class="color-button" style="background-color: #000000;"></button>--}}
{{--                        <button class="color-button" style="background-color: #F0E1D4;"></button>--}}
{{--                    </div>--}}
{{--                    <div class="buy-button">Mua</div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        @endforeach--}}
{{--        <a href="{{ route('products.all') }}" class="view-all">Xem tất cả</a>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<!-- Item 3 -->--}}
{{--<div id="girlDep">--}}
{{--    <h2 class="header"> Giày thể thao </h2>--}}
{{--    <div class="features">--}}
{{--        @foreach ($girlDep as $product)--}}
{{--            <a href="{{ route('product.show', $product->product_id) }}" class="card-link" style="text-decoration: none; color: inherit;">--}}
{{--                <div class="card">--}}
{{--                    <img src="{{ $product->image }}" alt="{{ $product->product_name }}" class="product-image"--}}
{{--                         style="width: 100%; height: 300px; object-fit: cover; display: block;">--}}
{{--                    <h4 style="text-align: center;">{{ $product->product_name }}</h4>--}}
{{--                    <p>{{ number_format($product->price, 0, ',', '.') }} đ</p>--}}
{{--                    <div class="color-options">--}}
{{--                        <button class="color-button" style="background-color: #855C40;"></button>--}}
{{--                        <button class="color-button" style="background-color: #000000;"></button>--}}
{{--                        <button class="color-button" style="background-color: #F0E1D4;"></button>--}}
{{--                    </div>--}}
{{--                    <div class="buy-button">Mua</div>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        @endforeach--}}
{{--        <a href="{{ route('products.all') }}" class="view-all">Xem tất cả</a>--}}
{{--    </div>--}}
{{--</div>--}}

<!-- Info Cards Section -->
<section id="info-cards" class="info-cards section light-background">

{{--    <div class="container" data-aos="fade-up" data-aos-delay="100">--}}
{{--    --}}
{{--        <div class="row g-4 justify-content-center">--}}
{{--            <!-- Info Card 1 -->--}}
{{--            <div class="col-12 col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">--}}
{{--                <div class="info-card text-center">--}}
{{--                    <div class="icon-box">--}}
{{--                        <i class="bi bi-truck"></i>--}}
{{--                    </div>--}}
{{--                    <h3>Free Shipping</h3>--}}
{{--                    <p>Nulla sit morbi vestibulum eros duis amet, consectetur vitae lacus. Ut quis tempor felis sed nunc viverra.</p>--}}
{{--                </div>--}}
{{--            </div><!-- End Info Card 1 -->--}}

{{--            <!-- Info Card 2 -->--}}
{{--            <div class="col-12 col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">--}}
{{--                <div class="info-card text-center">--}}
{{--                    <div class="icon-box">--}}
{{--                        <i class="bi bi-piggy-bank"></i>--}}
{{--                    </div>--}}
{{--                    <h3>Money Back Guarantee</h3>--}}
{{--                    <p>Nullam gravida felis ac nunc tincidunt, sed malesuada justo pulvinar. Vestibulum nec diam vitae eros.</p>--}}
{{--                </div>--}}
{{--            </div><!-- End Info Card 2 -->--}}

{{--            <!-- Info Card 3 -->--}}
{{--            <div class="col-12 col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">--}}
{{--                <div class="info-card text-center">--}}
{{--                    <div class="icon-box">--}}
{{--                        <i class="bi bi-percent"></i>--}}
{{--                    </div>--}}
{{--                    <h3>Discount Offers</h3>--}}
{{--                    <p>Nulla ipsum nisi vel adipiscing amet, dignissim consectetur ornare. Vestibulum quis posuere elit auctor.</p>--}}
{{--                </div>--}}
{{--            </div><!-- End Info Card 3 -->--}}

{{--            <!-- Info Card 4 -->--}}
{{--            <div class="col-12 col-sm-6 col-lg-3" data-aos="fade-up" data-aos-delay="500">--}}
{{--                <div class="info-card text-center">--}}
{{--                    <div class="icon-box">--}}
{{--                        <i class="bi bi-headset"></i>--}}
{{--                    </div>--}}
{{--                    <h3>24/7 Support</h3>--}}
{{--                    <p>Ipsum dolor amet sit consectetur adipiscing, nullam vitae euismod tempor nunc felis vestibulum ornare.</p>--}}
{{--                </div>--}}
{{--            </div><!-- End Info Card 4 -->--}}
{{--        </div>--}}

{{--    </div>--}}

</section><!-- /Info Cards Section -->
<!-- Category Cards Section -->
<section id="category-cards" class="category-cards section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="category-slider swiper init-swiper">
            <script type="application/json" class="swiper-config">
                {
                  "loop": true,
                  "autoplay": {
                    "delay": 5000,
                    "disableOnInteraction": false
                  },
                  "grabCursor": true,
                  "speed": 600,
                  "slidesPerView": "auto",
                  "spaceBetween": 20,
                  "navigation": {
                    "nextEl": ".swiper-button-next",
                    "prevEl": ".swiper-button-prev"
                  },
                  "breakpoints": {
                    "320": {
                      "slidesPerView": 2,
                      "spaceBetween": 15
                    },
                    "576": {
                      "slidesPerView": 3,
                      "spaceBetween": 15
                    },
                    "768": {
                      "slidesPerView": 4,
                      "spaceBetween": 20
                    },
                    "992": {
                      "slidesPerView": 5,
                      "spaceBetween": 20
                    },
                    "1200": {
                      "slidesPerView": 6,
                      "spaceBetween": 20
                    }
                  }
                }
            </script>

            <div class="swiper-wrapper">
                <!-- Product -->
                @foreach($categories as $category)
                    <div class="swiper-slide">
                        <div class="category-card" data-aos="fade-up" data-aos-delay="100">
                            <div class="category-image">
                                <img src="{{ asset($category->products->first()->image) }}" alt="{{ $category->category_name }}" class="img-fluid">
                            </div>
                            <h3 class="category-title">{{ $category->category_name }}</h3>
                            <p class="category-count">
                                {{ $category->products->count() }} Sản phẩm
                            </p>
                            <a href="{{ route('products.all', ['category_id' => $category->category_id]) }}" class="stretched-link"></a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

    </div>
</section><!-- /Category Cards Section -->

<section id="best-sellers" class="best-sellers section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Siêu giảm giá</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
            <!-- Product 1 -->
            @foreach($products as $product) <!-- Giả sử bạn đã lấy danh sách sản phẩm -->
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ asset($product->image) }}" class="img-fluid default-image" alt="{{ $product->name }}" loading="lazy">
                        <div class="product-actions">
                            <button class="btn-wishlist" type="button" aria-label="Add to wishlist">
                                <i class="bi bi-heart"></i>
                            </button>
                            <button class="btn-quickview" type="button" aria-label="Quick view">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title"><a href="{{ route('product.show', $product->product_id) }}">{{ $product->product_name }}</a></h3>
                        <div class="product-price">
                            <span class="current-price">${{ $product->price }}</span>
                        </div>
                        <div class="product-rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star"></i>
                            <span class="rating-count">(28)</span>
                        </div>
                        <form action="{{ route('cart.add', $product->product_id) }}" method="POST" style="display: inline;">
                            @csrf <!-- Đảm bảo thêm token CSRF -->
                            <button class="btn btn-add-to-cart">
                                <i class="bi bi-bag-plus me-2"></i>Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- Product 2 -->
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="150">
                <div class="product-card">
                    <div class="product-image">
                        <img src="assets/img/product/product-4.webp" class="img-fluid default-image" alt="Product" loading="lazy">
                        <img src="assets/img/product/product-4-variant.webp" class="img-fluid hover-image" alt="Product hover" loading="lazy">
                        <div class="product-tags">
                            <span class="badge bg-sale">Sale</span>
                        </div>
                        <div class="product-actions">
                            <button class="btn-wishlist" type="button" aria-label="Add to wishlist">
                                <i class="bi bi-heart"></i>
                            </button>
                            <button class="btn-quickview" type="button" aria-label="Quick view">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title"><a href="product-details.html">Consectetur adipiscing elit</a></h3>
                        <div class="product-price">
                            <span class="current-price">$64.99</span>
                            <span class="original-price">$79.99</span>
                        </div>
                        <div class="product-rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star"></i>
                            <span class="rating-count">(28)</span>
                        </div>
                        <button class="btn btn-add-to-cart">
                            <i class="bi bi-bag-plus me-2"></i>Add to Cart
                        </button>
                    </div>
                </div>
            </div><!-- End Product 2 -->

            <!-- Product 3 -->
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="product-card">
                    <div class="product-image">
                        <img src="assets/img/product/product-7.webp" class="img-fluid default-image" alt="Product" loading="lazy">
                        <img src="assets/img/product/product-7-variant.webp" class="img-fluid hover-image" alt="Product hover" loading="lazy">
                        <div class="product-actions">
                            <button class="btn-wishlist" type="button" aria-label="Add to wishlist">
                                <i class="bi bi-heart"></i>
                            </button>
                            <button class="btn-quickview" type="button" aria-label="Quick view">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title"><a href="product-details.html">Sed do eiusmod tempor incididunt</a></h3>
                        <div class="product-price">
                            <span class="current-price">$119.00</span>
                        </div>
                        <div class="product-rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <span class="rating-count">(56)</span>
                        </div>
                        <button class="btn btn-add-to-cart">
                            <i class="bi bi-bag-plus me-2"></i>Add to Cart
                        </button>
                    </div>
                </div>
            </div><!-- End Product 3 -->

            <!-- Product 4 -->
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="250">
                <div class="product-card">
                    <div class="product-image">
                        <img src="assets/img/product/product-12.webp" class="img-fluid default-image" alt="Product" loading="lazy">
                        <img src="assets/img/product/product-12-variant.webp" class="img-fluid hover-image" alt="Product hover" loading="lazy">
                        <div class="product-tags">
                            <span class="badge bg-sold-out">Sold Out</span>
                        </div>
                        <div class="product-actions">
                            <button class="btn-wishlist" type="button" aria-label="Add to wishlist">
                                <i class="bi bi-heart"></i>
                            </button>
                            <button class="btn-quickview" type="button" aria-label="Quick view">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title"><a href="product-details.html">Ut labore et dolore magna aliqua</a></h3>
                        <div class="product-price">
                            <span class="current-price">$75.50</span>
                        </div>
                        <div class="product-rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star"></i>
                            <i class="bi bi-star"></i>
                            <span class="rating-count">(15)</span>
                        </div>
                        <button class="btn btn-add-to-cart btn-disabled" disabled="">
                            <i class="bi bi-bag-plus me-2"></i>Sold Out
                        </button>
                    </div>
                </div>
            </div><!-- End Product 4 -->
        </div>

    </div>

</section><!-- /Best Sellers Section -->

<!-- Product List Section -->
<section id="product-list" class="product-list section">

    <div class="container isotope-layout" data-aos="fade-up" data-aos-delay="100" data-default-filter="*" data-layout="masonry" data-sort="original-order">

        <div class="row">
            <div class="col-12">
                <div class="product-filters isotope-filters mb-5 d-flex justify-content-center" data-aos="fade-up">
                    <ul class="d-flex flex-wrap gap-2 list-unstyled">
                        <li class="filter-active" data-filter="*">All</li>
                        <li data-filter=".filter-clothing">Clothing</li>
                        <li data-filter=".filter-accessories">Accessories</li>
                        <li data-filter=".filter-electronics">Electronics</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row product-container isotope-container" data-aos="fade-up" data-aos-delay="200">

            <!-- Product Item 1 -->
            <div class="col-md-6 col-lg-3 product-item isotope-item filter-clothing">
                <div class="product-card">
                    <div class="product-image">
                        <span class="badge">Sale</span>
                        <img src="assets/img/product/product-11.webp" alt="Product" class="img-fluid main-img">
                        <img src="assets/img/product/product-11-variant.webp" alt="Product Hover" class="img-fluid hover-img">
                        <div class="product-overlay">
                            <a href="cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                            <div class="product-actions">
                                <a href="#" class="action-btn"><i class="bi bi-heart"></i></a>
                                <a href="#" class="action-btn"><i class="bi bi-eye"></i></a>
                                <a href="#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <h5 class="product-title"><a href="product-details.html">Lorem ipsum dolor sit amet</a></h5>
                        <div class="product-price">
                            <span class="current-price">$89.99</span>
                            <span class="old-price">$129.99</span>
                        </div>
                        <div class="product-rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                            <span>(24)</span>
                        </div>
                    </div>
                </div>
            </div><!-- End Product Item -->

            <!-- Product Item 2 -->
            <div class="col-md-6 col-lg-3 product-item isotope-item filter-electronics">
                <div class="product-card">
                    <div class="product-image">
                        <img src="assets/img/product/product-9.webp" alt="Product" class="img-fluid main-img">
                        <img src="assets/img/product/product-9-variant.webp" alt="Product Hover" class="img-fluid hover-img">
                        <div class="product-overlay">
                            <a href="cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                            <div class="product-actions">
                                <a href="#" class="action-btn"><i class="bi bi-heart"></i></a>
                                <a href="#" class="action-btn"><i class="bi bi-eye"></i></a>
                                <a href="#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <h5 class="product-title"><a href="product-details.html">Consectetur adipiscing elit</a></h5>
                        <div class="product-price">
                            <span class="current-price">$249.99</span>
                        </div>
                        <div class="product-rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star"></i>
                            <span>(18)</span>
                        </div>
                    </div>
                </div>
            </div><!-- End Product Item -->

            <!-- Product Item 3 -->
            <div class="col-md-6 col-lg-3 product-item isotope-item filter-accessories">
                <div class="product-card">
                    <div class="product-image">
                        <span class="badge">New</span>
                        <img src="assets/img/product/product-3.webp" alt="Product" class="img-fluid main-img">
                        <img src="assets/img/product/product-3-variant.webp" alt="Product Hover" class="img-fluid hover-img">
                        <div class="product-overlay">
                            <a href="cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                            <div class="product-actions">
                                <a href="#" class="action-btn"><i class="bi bi-heart"></i></a>
                                <a href="#" class="action-btn"><i class="bi bi-eye"></i></a>
                                <a href="#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <h5 class="product-title"><a href="product-details.html">Sed do eiusmod tempor</a></h5>
                        <div class="product-price">
                            <span class="current-price">$59.99</span>
                        </div>
                        <div class="product-rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star"></i>
                            <i class="bi bi-star"></i>
                            <span>(7)</span>
                        </div>
                    </div>
                </div>
            </div><!-- End Product Item -->

            <!-- Product Item 4 -->
            <div class="col-md-6 col-lg-3 product-item isotope-item filter-clothing">
                <div class="product-card">
                    <div class="product-image">
                        <img src="assets/img/product/product-4.webp" alt="Product" class="img-fluid main-img">
                        <img src="assets/img/product/product-4-variant.webp" alt="Product Hover" class="img-fluid hover-img">
                        <div class="product-overlay">
                            <a href="cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                            <div class="product-actions">
                                <a href="#" class="action-btn"><i class="bi bi-heart"></i></a>
                                <a href="#" class="action-btn"><i class="bi bi-eye"></i></a>
                                <a href="#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <h5 class="product-title"><a href="product-details.html">Incididunt ut labore et dolore</a></h5>
                        <div class="product-price">
                            <span class="current-price">$79.99</span>
                            <span class="old-price">$99.99</span>
                        </div>
                        <div class="product-rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <span>(32)</span>
                        </div>
                    </div>
                </div>
            </div><!-- End Product Item -->

            <!-- Product Item 5 -->
            <div class="col-md-6 col-lg-3 product-item isotope-item filter-electronics">
                <div class="product-card">
                    <div class="product-image">
                        <span class="badge">Sale</span>
                        <img src="assets/img/product/product-5.webp" alt="Product" class="img-fluid main-img">
                        <img src="assets/img/product/product-5-variant.webp" alt="Product Hover" class="img-fluid hover-img">
                        <div class="product-overlay">
                            <a href="cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                            <div class="product-actions">
                                <a href="#" class="action-btn"><i class="bi bi-heart"></i></a>
                                <a href="#" class="action-btn"><i class="bi bi-eye"></i></a>
                                <a href="#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <h5 class="product-title"><a href="product-details.html">Magna aliqua ut enim ad minim</a></h5>
                        <div class="product-price">
                            <span class="current-price">$199.99</span>
                            <span class="old-price">$249.99</span>
                        </div>
                        <div class="product-rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                            <i class="bi bi-star"></i>
                            <span>(15)</span>
                        </div>
                    </div>
                </div>
            </div><!-- End Product Item -->

            <!-- Product Item 6 -->
            <div class="col-md-6 col-lg-3 product-item isotope-item filter-accessories">
                <div class="product-card">
                    <div class="product-image">
                        <img src="assets/img/product/product-6.webp" alt="Product" class="img-fluid main-img">
                        <img src="assets/img/product/product-6-variant.webp" alt="Product Hover" class="img-fluid hover-img">
                        <div class="product-overlay">
                            <a href="cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                            <div class="product-actions">
                                <a href="#" class="action-btn"><i class="bi bi-heart"></i></a>
                                <a href="#" class="action-btn"><i class="bi bi-eye"></i></a>
                                <a href="#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <h5 class="product-title"><a href="product-details.html">Veniam quis nostrud exercitation</a></h5>
                        <div class="product-price">
                            <span class="current-price">$45.99</span>
                        </div>
                        <div class="product-rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star"></i>
                            <span>(21)</span>
                        </div>
                    </div>
                </div>
            </div><!-- End Product Item -->

            <!-- Product Item 7 -->
            <div class="col-md-6 col-lg-3 product-item isotope-item filter-clothing">
                <div class="product-card">
                    <div class="product-image">
                        <span class="badge">New</span>
                        <img src="assets/img/product/product-7.webp" alt="Product" class="img-fluid main-img">
                        <img src="assets/img/product/product-7-variant.webp" alt="Product Hover" class="img-fluid hover-img">
                        <div class="product-overlay">
                            <a href="cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                            <div class="product-actions">
                                <a href="#" class="action-btn"><i class="bi bi-heart"></i></a>
                                <a href="#" class="action-btn"><i class="bi bi-eye"></i></a>
                                <a href="#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <h5 class="product-title"><a href="product-details.html">Ullamco laboris nisi ut aliquip</a></h5>
                        <div class="product-price">
                            <span class="current-price">$69.99</span>
                        </div>
                        <div class="product-rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                            <i class="bi bi-star"></i>
                            <span>(11)</span>
                        </div>
                    </div>
                </div>
            </div><!-- End Product Item -->

            <!-- Product Item 8 -->
            <div class="col-md-6 col-lg-3 product-item isotope-item filter-electronics">
                <div class="product-card">
                    <div class="product-image">
                        <img src="assets/img/product/product-8.webp" alt="Product" class="img-fluid main-img">
                        <img src="assets/img/product/product-8-variant.webp" alt="Product Hover" class="img-fluid hover-img">
                        <div class="product-overlay">
                            <a href="cart.html" class="btn-cart"><i class="bi bi-cart-plus"></i> Add to Cart</a>
                            <div class="product-actions">
                                <a href="#" class="action-btn"><i class="bi bi-heart"></i></a>
                                <a href="#" class="action-btn"><i class="bi bi-eye"></i></a>
                                <a href="#" class="action-btn"><i class="bi bi-arrow-left-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">
                        <h5 class="product-title"><a href="product-details.html">Ex ea commodo consequat</a></h5>
                        <div class="product-price">
                            <span class="current-price">$159.99</span>
                        </div>
                        <div class="product-rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <span>(29)</span>
                        </div>
                    </div>
                </div>
            </div><!-- End Product Item -->

        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="#" class="view-all-btn">View All Products <i class="bi bi-arrow-right"></i></a>
        </div>

    </div>

</section><!-- /Product List Section -->

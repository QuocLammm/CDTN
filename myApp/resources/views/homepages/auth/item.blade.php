

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
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Danh mục sản phẩm</h2>
        </div><!-- End Section Title -->
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
                                @php
                                    $firstProduct = $category->products->first();
                                    $firstImage = $firstProduct?->images->first();
                                @endphp

                                @if ($firstImage)
                                    <img src="{{ asset($firstImage->image_path) }}" alt="{{ $category->category_name }}" class="img-fluid">
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" alt="Không có ảnh" class="img-fluid">
                                @endif
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
        <p>Ưu đãi cực sốc – cơ hội mua sắm giá hời không thể bỏ lỡ!</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
            <!-- Product 1 -->
            @foreach($products as $product)
                @php
                    $reviews = $product->reviews;
                    $averageRating = $product->reviews_avg_rating;
                    $reviewCount = $product->reviews_count;
                @endphp
            <div class="col-md-6 col-lg-3" >
                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ $product->images->first()->image_path ?? 'default.jpg' }}" alt="{{ $product->name }}" >
                        <div class="product-actions">
                            <form action="{{ route('wishlist.toggle', $product->product_id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn-wishlist" aria-label="Toggle wishlist" style="background: none; border: none;">
                                    <i class="bi {{ in_array($product->product_id, $wishlistProductIds) ? 'bi-heart-fill text-danger' : 'bi-heart' }}"></i>
                                </button>
                            </form>

                            <button class="btn-quickview" type="button" aria-label="Quick view"
                                    onclick="window.location.href='{{ route('product.show', $product->product_id) }}'">
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
                            @for ($i = 1; $i <= 5; $i++)
                                <span style="color: {{ $reviewCount > 0 && $i <= round($averageRating) ? 'gold' : '#ccc' }};">&#9733;</span>
                            @endfor
                            <span style="color: #666;">({{ $reviewCount }} đánh giá)</span>
                        </div>

                        <form action="{{ route('cart.add', $product->product_id) }}" method="POST" style="display: inline;">
                            @csrf <!-- Đảm bảo thêm token CSRF -->
                            <button class="btn btn-add-to-cart">
                                <i class="bi bi-bag-plus me-2"></i>Thêm vào giỏ hàng
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- Product 2 -->
{{--            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="150">--}}
{{--                <div class="product-card">--}}
{{--                    <div class="product-image">--}}
{{--                        <img src="assets/img/product/product-4.webp" class="img-fluid default-image" alt="Product" loading="lazy">--}}
{{--                        <img src="assets/img/product/product-4-variant.webp" class="img-fluid hover-image" alt="Product hover" loading="lazy">--}}
{{--                        <div class="product-tags">--}}
{{--                            <span class="badge bg-sale">Sale</span>--}}
{{--                        </div>--}}
{{--                        <div class="product-actions">--}}
{{--                            <button class="btn-wishlist" type="button" aria-label="Add to wishlist">--}}
{{--                                <i class="bi bi-heart"></i>--}}
{{--                            </button>--}}
{{--                            <button class="btn-quickview" type="button" aria-label="Quick view">--}}
{{--                                <i class="bi bi-eye"></i>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="product-info">--}}
{{--                        <h3 class="product-title"><a href="product-details.html">Consectetur adipiscing elit</a></h3>--}}
{{--                        <div class="product-price">--}}
{{--                            <span class="current-price">$64.99</span>--}}
{{--                            <span class="original-price">$79.99</span>--}}
{{--                        </div>--}}
{{--                        <div class="product-rating">--}}
{{--                            <i class="bi bi-star-fill"></i>--}}
{{--                            <i class="bi bi-star-fill"></i>--}}
{{--                            <i class="bi bi-star-fill"></i>--}}
{{--                            <i class="bi bi-star-fill"></i>--}}
{{--                            <i class="bi bi-star"></i>--}}
{{--                            <span class="rating-count">(28)</span>--}}
{{--                        </div>--}}
{{--                        <button class="btn btn-add-to-cart">--}}
{{--                            <i class="bi bi-bag-plus me-2"></i>Add to Cart--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div><!-- End Product 2 -->--}}

{{--            <!-- Product 4 -->--}}
{{--            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="250">--}}
{{--                <div class="product-card">--}}
{{--                    <div class="product-image">--}}
{{--                        <img src="assets/img/product/product-12.webp" class="img-fluid default-image" alt="Product" loading="lazy">--}}
{{--                        <img src="assets/img/product/product-12-variant.webp" class="img-fluid hover-image" alt="Product hover" loading="lazy">--}}
{{--                        <div class="product-tags">--}}
{{--                            <span class="badge bg-sold-out">Sold Out</span>--}}
{{--                        </div>--}}
{{--                        <div class="product-actions">--}}
{{--                            <button class="btn-wishlist" type="button" aria-label="Add to wishlist">--}}
{{--                                <i class="bi bi-heart"></i>--}}
{{--                            </button>--}}
{{--                            <button class="btn-quickview" type="button" aria-label="Quick view">--}}
{{--                                <i class="bi bi-eye"></i>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="product-info">--}}
{{--                        <h3 class="product-title"><a href="product-details.html">Ut labore et dolore magna aliqua</a></h3>--}}
{{--                        <div class="product-price">--}}
{{--                            <span class="current-price">$75.50</span>--}}
{{--                        </div>--}}
{{--                        <div class="product-rating">--}}
{{--                            <i class="bi bi-star-fill"></i>--}}
{{--                            <i class="bi bi-star-fill"></i>--}}
{{--                            <i class="bi bi-star-fill"></i>--}}
{{--                            <i class="bi bi-star"></i>--}}
{{--                            <i class="bi bi-star"></i>--}}
{{--                            <span class="rating-count">(15)</span>--}}
{{--                        </div>--}}
{{--                        <button class="btn btn-add-to-cart btn-disabled" disabled="">--}}
{{--                            <i class="bi bi-bag-plus me-2"></i>Sold Out--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div><!-- End Product 4 -->--}}
        </div>

    </div>

</section><!-- /Best Sellers Section -->

<!-- Product List Section -->
{{--<section id="product-list" class="product-list section">--}}

{{--    <div class="container isotope-layout" data-aos="fade-up" data-aos-delay="100" data-default-filter="*" data-layout="masonry" data-sort="original-order">--}}

{{--        <div class="row">--}}
{{--            <div class="col-12">--}}
{{--                <div class="product-filters isotope-filters mb-5 d-flex justify-content-center" data-aos="fade-up">--}}
{{--                    <ul class="d-flex flex-wrap gap-2 list-unstyled">--}}
{{--                        <li class="filter-active" data-filter="*">Tất cả</li>--}}
{{--                        <li data-filter=".filter-clothing">Giày nữ</li>--}}
{{--                        <li data-filter=".filter-accessories">Dép nữ</li>--}}
{{--                        <li data-filter=".filter-electronics">Giày thể thao</li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="row product-container isotope-container" data-aos="fade-up" data-aos-delay="200">--}}
{{--            <!-- Product Item 1 -->--}}
{{--            <div class="col-md-6 col-lg-3 product-item isotope-item filter-clothing">--}}
{{--                <div class="product-card">--}}
{{--                    <div class="product-image">--}}
{{--                        <span class="badge">Sale</span>--}}
{{--                        <img src="assets/img/product/product-11.webp" alt="Product" class="img-fluid main-img">--}}
{{--                        <img src="assets/img/product/product-11-variant.webp" alt="Product Hover" class="img-fluid hover-img">--}}
{{--                        <div class="product-overlay">--}}
{{--                            <a href="{{route('cart.cart')}}" class="btn-cart"><i class="bi bi-cart-plus"></i> Thêm vào giỏ hàng</a>--}}
{{--                            <div class="product-actions">--}}
{{--                                <a href="#" class="action-btn"><i class="bi bi-heart"></i></a>--}}
{{--                                <a href="#" class="action-btn"><i class="bi bi-eye"></i></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="product-info">--}}
{{--                        <h5 class="product-title"><a href="product-details.html">Lorem ipsum dolor sit amet</a></h5>--}}
{{--                        <div class="product-price">--}}
{{--                            <span class="current-price">$89.99</span>--}}
{{--                            <span class="old-price">$129.99</span>--}}
{{--                        </div>--}}
{{--                        <div class="product-rating">--}}
{{--                            <i class="bi bi-star-fill"></i>--}}
{{--                            <i class="bi bi-star-fill"></i>--}}
{{--                            <i class="bi bi-star-fill"></i>--}}
{{--                            <i class="bi bi-star-fill"></i>--}}
{{--                            <i class="bi bi-star-half"></i>--}}
{{--                            <span>(24)</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div><!-- End Product Item -->--}}
{{--        </div>--}}

{{--        <div class="text-center mt-5" data-aos="fade-up">--}}
{{--            <a href="{{route('products.all_products')}}" class="view-all-btn">Xem tất cả sản phẩm <i class="bi bi-arrow-right"></i></a>--}}
{{--        </div>--}}

{{--    </div>--}}

{{--</section>--}}

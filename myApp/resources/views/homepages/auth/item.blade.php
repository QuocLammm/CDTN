
<section id="info-cards" class="info-cards section light-background">
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
                        @if ($product->is_sale)
                            <span class="badge bg-danger" style="position: absolute; top: 10px; left: 10px; z-index: 10;">
                                Sale
                            </span>
                        @endif
                        <img src="{{ $product->images->first()->image_path ?? 'default.jpg' }}" alt="{{ $product->product_name }}">
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
                        <h3 class="product-title" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            <a href="{{ route('product.show', $product->product_id) }}"
                               title="{{ $product->product_name }}"
                               style="display: inline-block; width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ Str::limit($product->product_name, 50) }}
                            </a>
                        </h3>

                        <div class="product-price d-flex align-items-center gap-2">
                            @if ($product->is_sale && $product->sale_price < $product->price)
                                <span class="current-price text-danger fw-bold">{{ number_format($product->sale_price) }} đ</span>
                                <span class="original-price text-muted" style="text-decoration: line-through;">{{ number_format($product->price) }} đ</span>
                                <span class="badge bg-danger" style="font-size: 0.75rem;">
                    -{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}%
                </span>
                            @else
                                <span class="current-price">{{ number_format($product->price) }} đ</span>
                            @endif
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
        </div>
    </div>
</section>

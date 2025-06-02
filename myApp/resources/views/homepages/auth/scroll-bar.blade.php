
<!-- Hero Section -->
<section class="ecommerce-hero-1 hero section" id="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 content-col" data-aos="fade-right" data-aos-delay="100">
                <div class="content">
                    <span class="promo-badge">Thiết kế mới 2025</span>
                    <h1>Khám phá nhiều mẫu <span>giày</span> cho mọi mùa</h1>
                    <p>Thỏa sức lựa chọn những đôi giày thời trang, phù hợp cho mọi mùa trong năm – từ năng động ngày hè đến ấm áp ngày đông.</p>
                    <div class="hero-cta">
                        <a href="{{route('products.all_products')}}" class="btn btn-shop">Mua ngay <i class="bi bi-arrow-right"></i></a>
                        <a href="{{route('products.all_products')}}" class="btn btn-collection">Xem tất cả</a>
                    </div>
                    <div class="hero-features">
                        <div class="feature-item">
                            <i class="bi bi-shield-check"></i>
                            <span>Thanh toán dễ dàng</span>
                        </div>
                        <div class="feature-item">
                            <i class="bi bi-arrow-repeat"></i>
                            <span>Trả hàng thoải mái</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 image-col" data-aos="fade-left" data-aos-delay="200">
                <div class="hero-image">
                    <img src="{{ asset('assets/img/product/product-f-9.webp') }}" alt="Fashion Product" class="main-product" loading="lazy">

                    @foreach($heroProducts as $index => $product)
                        <div class="floating-product product-{{ $index + 1 }}" data-aos="fade-up" data-aos-delay="{{ 300 + ($index * 100) }}">
                            <img src="{{ $product->images->first()->image_path ?? 'default.jpg' }}" alt="{{ $product->product_name }}">
                            <div class="product-info">
                                <h4>{{ $product->product_name }}</h4>
                                <span class="price">{{ number_format($product->price) }} đ</span>
                            </div>
                        </div>
                    @endforeach

                    <div class="discount-badge" data-aos="zoom-in" data-aos-delay="500">
                        <span class="percent">30%</span>
                        <span class="text">OFF</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- /Hero Section -->

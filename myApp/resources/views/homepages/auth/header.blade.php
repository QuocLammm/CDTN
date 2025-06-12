<header id="header" class="header position-relative">
    <div class="main-header">
        <div class="container-fluid container-xl">
            <div class="d-flex py-3 align-items-center justify-content-between">
                <!-- Logo -->
                <a href="{{route('homepage')}}" class="logo d-flex align-items-center">
                    <h1 class="sitename">TRUCDOAN<span style="color: red">PHAM</span></h1>
                </a>

                <!-- Search -->
                <form  action="{{ route('product.search') }}" method="GET" class="search-form desktop-search-form">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm sản phẩm">
                        <button class="btn" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>

                <!-- Actions -->
                <div class="header-actions d-flex align-items-center justify-content-end">

                    <!-- Mobile Search Toggle -->
                    <button class="header-action-btn mobile-search-toggle d-xl-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobileSearch" aria-expanded="false" aria-controls="mobileSearch">
                        <i class="bi bi-search"></i>
                    </button>

                    <!-- Account -->
                    <div class="dropdown account-dropdown">
                        <button class="header-action-btn" data-bs-toggle="dropdown">
                            <i class="bi bi-person"></i>
                        </button>
                        <div class="dropdown-menu">
                            @if (Auth::check())
                                <div class="dropdown-header">
                                    <h6 class="mb-0">Xin chào!</h6>
                                    <h5>{{ auth()->user()->full_name }}</h5>
                                    <span class="sitename">Đã đến với shop của chúng tôi</span>
                                </div>
                            @else
                                <div class="dropdown-header">
                                    <h6 class="mb-0">Chào mừng bạn!</h6>
                                    <span class="sitename">Đã đến với shop của chúng tôi</span>
                                </div>
                            @endif
                            <div class="dropdown-body">
                                @if (Auth::check())
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('profile-user', ['id' => auth()->user()->user_id]) }}">
                                        <i class="bi bi-person-circle me-2"></i>
                                        <span>Trang cá nhân</span>
                                    </a>
                                @else
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('login') }}">
                                        <i class="bi bi-person-circle me-2"></i>
                                        <span>Trang cá nhân</span>
                                    </a>
                                @endif
                                <a class="dropdown-item align-items-center header-action-btn " href="{{ route('cart.cart') }}">
                                    <i class="bi bi-bell me-2"></i>
                                    <span>Thông báo</span>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('wishlist.show') }}">
                                    <i class="bi bi-heart me-2"></i>
                                    <span>Yêu thích</span>
                                </a>
{{--                                <a class="dropdown-item d-flex align-items-center" href="account.html">--}}
{{--                                    <i class="bi bi-gear me-2"></i>--}}
{{--                                    <span>Cài đặt</span>--}}
{{--                                </a>--}}
                            </div>
                            <div class="dropdown-footer">
                                @if(auth()->check())
                                    <form action="{{ route('logout') }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger w-100 mb-2">Đăng xuất</button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary w-100 mb-2">Đăng nhập</a>
                                    <a href="{{ route('register') }}" class="btn btn-outline-primary w-100">Đăng ký</a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Wishlist -->
                    <a href="{{ route('wishlist.show') }}" class="header-action-btn d-none d-md-block">
                        <i class="bi bi-heart"></i>
                        <span class="badge">{{ $wishlistCount }}</span>
                    </a>

                    <!-- Cart -->
                    <a href="{{ route('cart.cart') }}" class="header-action-btn">
                        <i class="bi bi-cart3"></i>
                        <span class="badge">{{ $cartCount }}</span>
                    </a>

                    <!-- Mobile Navigation Toggle -->
                    <i class="mobile-nav-toggle d-xl-none bi bi-list me-0"></i>

                </div>
            </div>
        </div>
    </div>
    <!-- Navigation -->
    <div class="header-nav">
        <div class="container-fluid container-xl">
            <div class="position-relative">
                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a href="{{route('homepage')}}" class="active">Trang chủ</a></li>
                        <li><a href="{{ route('about') }}">Về chúng tôi</a></li>
                        <!-- Products Mega Menu 1 -->
                        <li class="products-megamenu-1"><a href="#"><span>Danh mục sản phẩm</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <!-- Products Mega Menu 1 Desktop ViewPage -->
                            <div class="desktop-megamenu">

                                <div class="megamenu-tabs">
                                    <ul class="nav nav-tabs" id="productMegaMenuTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="featured-tab" data-bs-toggle="tab" data-bs-target="#featured-content-1862" type="button" aria-selected="true" role="tab">Giày</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="new-tab" data-bs-toggle="tab" data-bs-target="#new-content-1862" type="button" aria-selected="false" tabindex="-1" role="tab">Dép</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="sale-tab" data-bs-toggle="tab" data-bs-target="#sale-content-1862" type="button" aria-selected="false" tabindex="-1" role="tab">Sale</button>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Tabs Content -->
                                <div class="megamenu-content tab-content">

                                    <!-- Featured Tab -->
                                    <div class="tab-pane fade show active" id="featured-content-1862" role="tabpanel" aria-labelledby="featured-tab">
                                        <div class="product-grid">
                                            @foreach($shoesProducts as $product)
                                                <div class="product-card fade-in">
                                                    <div class="product-image">
                                                        <img
                                                            src="{{ $product->images->isNotEmpty() ? asset($product->images->first()->image_path) : asset('default-image.jpg') }}"
                                                            alt="{{ $product->product_name }}"
                                                            loading="lazy">
                                                        <span class="badge {{ $product->is_new ? 'badge-new' : 'badge-old' }}">
                                                            {{ $product->is_new ? 'New' : 'Old' }}
                                                        </span>
                                                    </div>
                                                    <div class="product-info">
                                                        <h5 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
                                                            {{ $product->product_name }}
                                                        </h5>
                                                        <p class="price">{{ number_format($product->price, 2) }} đ</p>
                                                        <a href="{{ route('product.show', $product->product_id) }}" class="btn-view">Xem sản phẩm</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div style="text-align: center; margin-top: 20px;">
                                            <a href="{{ route('products.all_products') }}"
                                                style="display: inline-block; padding: 10px 25px; background-color: #333; color: #fff; border-radius: 25px;
                                                text-decoration: none; transition: background-color 0.3s ease;"
                                                onmouseover="this.style.backgroundColor='#555'"
                                                onmouseout="this.style.backgroundColor='#333'">
                                                Xem tất cả
                                            </a>
                                        </div>
                                    </div>

                                    <!-- New Arrivals Tab -->
                                    <div class="tab-pane fade" id="new-content-1862" role="tabpanel" aria-labelledby="new-tab">
                                        <div class="product-grid">
                                            @foreach($depProducts as $product)
                                                <div class="product-card fade-in">
                                                    <div class="product-image">
                                                        <img
                                                            src="{{ $product->images->isNotEmpty() ? asset($product->images->first()->image_path) : asset('default-image.jpg') }}"
                                                            alt="{{ $product->product_name }}"
                                                            loading="lazy">
                                                        @if($product->is_new)
                                                            <span class="badge badge-new">New</span>
                                                        @endif
                                                    </div>
                                                    <div class="product-info">
                                                        <h5 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
                                                            {{ $product->product_name }}
                                                        </h5>
                                                        <p class="price">{{ number_format($product->price, 2) }} vnđ</p>
                                                        <a href="{{ route('product.show', $product->product_id)}}" class="btn-view">Xem sản phẩm</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div style="text-align: center; margin-top: 20px;">
                                            <a href="{{ route('products.all_products') }}"
                                               style="display: inline-block; padding: 10px 25px; background-color: #333; color: #fff; border-radius: 25px;
                                                text-decoration: none; transition: background-color 0.3s ease;"
                                               onmouseover="this.style.backgroundColor='#555'"
                                               onmouseout="this.style.backgroundColor='#333'">
                                                Xem tất cả
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Sale Tab -->
                                    <div class="tab-pane fade" id="sale-content-1862" role="tabpanel" aria-labelledby="sale-tab">
                                        <div class="product-grid">
                                            @foreach($saleProducts as $product)
                                                <div class="product-card fade-in">
                                                    <div class="product-image">
                                                        <img
                                                            src="{{ $product->images->isNotEmpty() ? asset($product->images->first()->image_path) : asset('default-image.jpg') }}"
                                                            alt="{{ $product->product_name }}"
                                                            loading="lazy">
                                                        <span class="badge badge-sale">Sale</span>

                                                    </div>
                                                    <div class="product-info">
                                                        <h5 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
                                                            {{ $product->product_name }}
                                                        </h5>
                                                        <p class="price">
                                                            @if($product->is_sale && $product->sale_price < $product->price)
                                                                <span class="text-danger fw-bold">{{ number_format($product->sale_price) }} vnđ</span>
                                                                <span class="text-muted" style="text-decoration: line-through;">{{ number_format($product->price) }} vnđ</span>
                                                            @else
                                                                <span>{{ number_format($product->price) }} vnđ</span>
                                                            @endif
                                                        </p>
                                                        <a href="{{ route('product.show', $product->product_id)}}" class="btn-view">Xem sản phẩm</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div style="text-align: center; margin-top: 20px;">
                                            <a href="{{ route('products.all_products') }}"
                                               style="display: inline-block; padding: 10px 25px; background-color: #333; color: #fff; border-radius: 25px;
                                                text-decoration: none; transition: background-color 0.3s ease;"
                                               onmouseover="this.style.backgroundColor='#555'"
                                               onmouseout="this.style.backgroundColor='#333'">
                                                Xem tất cả
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Sale Tab -->
{{--                                    <div class="tab-pane fade" id="category-content-1862" role="tabpanel" aria-labelledby="category-tab">--}}
{{--                                        <div class="product-grid">--}}
{{--                                            @if($saleProducts->isEmpty())--}}
{{--                                                <p>Không có sản phẩm sale nào.</p>--}}
{{--                                            @else--}}
{{--                                                @foreach($saleProducts as $product)--}}
{{--                                                    <div class="product-card fade-in">--}}
{{--                                                        <div class="product-image">--}}
{{--                                                            <img--}}
{{--                                                                src="{{ $product->images->isNotEmpty() ? asset($product->images->first()->image_path) : asset('default-image.jpg') }}"--}}
{{--                                                                alt="{{ $product->product_name }}"--}}
{{--                                                                loading="lazy">--}}
{{--                                                            <span class="badge badge-sale">Sale</span>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="product-info">--}}
{{--                                                            <h5 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">--}}
{{--                                                                {{ $product->product_name }}--}}
{{--                                                            </h5>--}}
{{--                                                            <p class="price">--}}
{{--                                                                @if($product->is_sale && $product->sale_price < $product->price)--}}
{{--                                                                    <span class="text-danger fw-bold">{{ number_format($product->sale_price) }} vnđ</span>--}}
{{--                                                                    <span class="text-muted" style="text-decoration: line-through;">{{ number_format($product->price) }} vnđ</span>--}}
{{--                                                                @else--}}
{{--                                                                    <span>{{ number_format($product->price) }} vnđ</span>--}}
{{--                                                                @endif--}}
{{--                                                            </p>--}}

{{--                                                            <a href="#" class="btn-view">Xem sản phẩm</a>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                @endforeach--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                        <div style="text-align: center; margin-top: 20px;">--}}
{{--                                            <a href="{{ route('products.all_products') }}"--}}
{{--                                               style="display: inline-block; padding: 10px 25px; background-color: #333; color: #fff; border-radius: 25px;--}}
{{--                                                text-decoration: none; transition: background-color 0.3s ease;"--}}
{{--                                               onmouseover="this.style.backgroundColor='#555'"--}}
{{--                                               onmouseout="this.style.backgroundColor='#333'">--}}
{{--                                                Xem tất cả--}}
{{--                                            </a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="{{route('contact.index')}}">Liên hệ</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- Mobile Search Form -->
    <div class="collapse" id="mobileSearch">
        <div class="container">
            <form class="search-form">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for products">
                    <button class="btn" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</header>

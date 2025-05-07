<nav>
    <div class="nav-logo">
        <a href="{{route('homepage')}}" id="logo-link">
            <img src="/images/logo1-1.png" alt="Logo" class="logo-img">
            <span class="logo-text" id="logo-text">TRUCDOANPHAM</span>
        </a>
    </div>
    <ul class="nav-links">
        <li class="link"><a href="{{route('homepage')}}">Trang chủ</a></li>
        <li class="link"><a href="#featured-products">Giày thể thao</a></li>
        <li class="link"><a href="#">Giày nữ</a></li>
        <li class="link"><a href="#">Dép nữ</a></li>
        <li class="link"><a href="#">Thông tin cửa hàng</a></li>
        <li class="link">
            <div class="search-container">
                <input type="text" placeholder="Tìm kiếm các sản phẩm" class="search-input">
            </div>
        </li>
    </ul>
    <div class="icon-container">
        <a href="#" class="icon">
            <span class="material-icons-sharp">
                shopping_cart
            </span>
            <span class="notification-count">0</span>
        </a>
        <form action="{{ route('login') }}" style="display:inline;">
            <button type="submit" class="logout-btn">Đăng nhập</button>
        </form>
    </div>
</nav>

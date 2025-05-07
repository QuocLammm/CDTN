<nav>
    <div class="nav-logo">
        <a href="#">
            <img src="/images/logo1-1.png" alt="Logo">
        </a>
    </div>
    <p id="logo-text" style="display: none;"></p>
    <ul class="nav-links">
        <li class="link"><a href="#">Home</a></li>
        <li class="link"><a href="#">Giày nữ</a></li>
        <li class="link"><a href="#featured-products">Sản phẩm bán chạy</a></li>
        <li class="link"><a href="#">Thông tin cửa hàng</a></li>
        <li class="link">
            <div class="search-container">
                <input type="text" placeholder="Tìm kiếm..." class="search-input">
                <a href="#" class="search-icon">
                    <span class="material-icons-sharp">search</span>
                </a>
            </div>
        </li>
    </ul>
    <div class="icon-container">
        <a href="#" class="icon">
            <span class="material-icons-sharp">
                shopping_cart
            </span>
            <span class="notification-count">0</span> <!-- Số lượng thông báo tạm thời -->
        </a>
        <a href="#" class="icon">
            <span class="material-icons-sharp">
                notifications
            </span>
            <span class="notification-count">3</span> <!-- Số lượng thông báo tạm thời -->
        </a>
        <!-- Profile-->
        <a href="{{ route('profile-user', ['id' => auth()->user()->user_id]) }}">
            <img src="{{ auth()->user()->image ?? '/images/default-avatar.png' }}" alt="Avatar" class="user-avatar">
        </a>
        <!-- Nút đăng xuất -->
        <form action="{{ route('logout') }}" style="display:inline;">
            <button type="submit" class="logout-btn">Đăng xuất</button>
        </form>
    </div>
</nav>
<!--End of header-->

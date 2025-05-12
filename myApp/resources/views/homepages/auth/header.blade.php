<nav>
    <div class="nav-logo">
        <a href="{{route('homepage')}}" id="logo-link">
            <img src="/images/logo1-1.png" alt="Logo" class="logo-img">
            <span class="logo-text" id="logo-text">TRUCDOANPHAM</span>
        </a>
    </div>
    <ul class="nav-links">
        <li class="link"><a href="{{route('homepage')}}">Trang chủ</a></li>
        <li class="link"><a href="#sportShoes">Giày thể thao</a></li>
        <li class="link"><a href="#girlShoes">Giày nữ</a></li>
        <li class="link"><a href="#girlDep">Dép nữ</a></li>
        <li class="link"><a href="#shopInfo">Thông tin cửa hàng</a></li>
        <li class="link">
            <div class="search-container">
                <input type="text" placeholder="Tìm kiếm các sản phẩm" class="search-input">
            </div>
        </li>
    </ul>
    <div class="icon-container">
        <a href="{{ route('cart.cart') }}" class="icon">
            <span class="material-icons-sharp">
                shopping_cart
            </span>
            <span class="notification-count">{{ $cartCount }}</span>
        </a>

        <a href="#" class="icon" id="notification-icon">
            <span class="material-icons-sharp">
                notifications
            </span>
            <span class="notification-count">3</span>
        </a>
        <!-- Dropdown thông báo -->
        <div class="notification-dropdown" id="notification-dropdown">
            <ul>
                <li><span class="notification-text">Thông báo 1</span></li>
                <li><span class="notification-text">Thông báo 2</span></li>
                <li><span class="notification-text">Thông báo 3</span></li>
            </ul>
        </div>

        <a href="{{ route('profile-user', ['id' => auth()->user()->user_id]) }}" class="avatar-link">
            <img src="{{ asset(auth()->user()->image ?? 'images/default-avatar.png') }}" alt="Avatar" class="user-avatar">
        </a>
        <form action="{{ route('logout') }}" style="display:inline;">
            <button type="submit" class="logout-btn">Đăng xuất</button>
        </form>
    </div>
</nav>

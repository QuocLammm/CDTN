@extends('homepages.master_page')
@section('header')
    <!--Header-->
    <nav>
        <div class="nav-logo">
            <a href="#">
                <img src="/images/logo1.png" alt="Logo">
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
            <a href="#" class="icon account-icon">
                <img id="user-avatar" src="/default-avatar.jpg" alt="Avatar" class="avatar">
            </a>
        </div>
    </nav>
    <!--End of header-->
    <!--Start of banner-->
    <header class="banner">
        <div class="slider">
            <div class="slides">
                <img src="/images/quoclam.jpg" alt="Image 1">
                <img src="/images/logo1.png" alt="Image 2">
                <img src="/images/quoclam.jpg" alt="Image 3">
            </div>
            <!-- Navigation buttons -->
            <button class="prev">&#10094;</button>
            <button class="next">&#10095;</button>
        </div>
    </header>
    <!--End of banner-->
@endsection
@section('infomation')
    <!-- Start of Store Information Section -->
    <section class="store-info">
        <!-- Cột bên trái: Thông tin khách -->
        <div class="store-info-left">
            <h2 class="header1">Thông tin cửa hàng</h2>
            <div class="store-images">
                <img src="/images/users/store.jpg" alt="Ảnh khách" class="store-image">
                <img src="/images/users/store.jpg" alt="Ảnh khách" class="store-image">
            </div>
        </div>

        <!-- Cột bên phải: Ảnh cửa hàng -->
        <div class="store-info-right">
            <h2>KHÁCH HÀNG TRUCDOANPHAM</h2>
            <div class="store-images">
                <img src="/images/users/customer_store.jpg" alt="Cửa hàng" class="store-image">
                <img src="/images/users/customer_store_1.jpg" alt="Ảnh khách" class="store-image">
            </div>
        </div>
    </section>
    <!-- End of Store Information Section -->
@endsection
@section('footer')
    <footer class="footer">
        <div class="footer-column">
            <h4>Về chúng tôi</h4>
            <ul>
                <li><a href="#">Giới thiệu</a></li>
                <li><a href="#">Dịch vụ</a></li>
                <li><a href="#">Liên hệ</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Hỗ trợ</h4>
            <ul>
                <li><a href="#">Câu hỏi thường gặp</a></li>
                <li><a href="#">Chính sách bảo mật</a></li>
                <li><a href="#">Điều khoản sử dụng</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Hệ thống cửa hàng</h4>
            <ul>
                <li><span class="highlight">CS1:</span> 48 Hoàng Sâm, Cầu Giấy, Hà Nội (147 Hoàng Quốc Việt rẽ vào) -
                    089.887.5522
                </li>
                <li><span class="highlight">CS2:</span> Tầng 7, Gems Empire Tower 201 Trường Chinh, Thanh Xuân, Hà Nội -
                    0839.33.55.22
                </li>
                <li><span class="highlight">Kho T.P.HCM:</span> Landmark 1, 720A Đ. Điện Biên Phủ, Vinhomes Tân Cảng,
                    Bình Thạnh, Thành phố Hồ Chí Minh - 089.897.5522
                </li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Liên hệ</h4>
            <p class="footer-contact">
                Địa chỉ: 123 Đường ABC, TP.Nha Trang<br>
                Email: contact@example.com<br>
                Điện thoại: 0123 456 789<br>
                Giờ mở cửa: 8:00 AM - 22:00 PM
            </p>
        </div>

        <div class="footer-column footer-social-wrap">
            <p>TRUCDOANPHAM lắng nghe bạn!</p>
            <h6>Chúng tôi luôn trân trọng và mong đợi nhận được mọi ý kiến đóng góp từ khách hàng để có thể nâng cấp
                trải nghiệm dịch vụ và sản phẩm tốt hơn nữa.</h6>
            <h4>Theo dõi chúng tôi</h4>
            <div class="footer-social">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
            <button class="feedback-btn">Gửi ý kiến</button>
        </div>
    </footer>
    <div class="footer-bottom">
        © 2025 Cao Nguyễn Quốc Lâm
    </div>

    <!-- End of Footer -->
@endsection


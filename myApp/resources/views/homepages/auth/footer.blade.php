<footer id="footer" class="footer">
    <div class="footer-newsletter">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2>Tham gia các chương trình khuyến mãi</h2>
                    <p>Đăng ký để nhận các ưu đãi đặc biệt, quà tặng miễn phí và các ưu đãi duy nhất.</p>
                    <form action="forms/newsletter.php" method="post" class="php-email-form">
                        <div class="newsletter-form d-flex">
                            <input type="email" name="email" placeholder="Nhập địa chỉ email" required="">
                            <button type="submit">Đăng ký</button>
                        </div>
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your subscription request has been sent. Thank you!</div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-main">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="footer-widget footer-about " style="text-align: center">
                        <a href="{{route('homepage')}}" class="logo" >
                            <span class="sitename">TRUCDOAN<span style="color: red">PHAM</span></span>
                        </a>
                        <p>Chúng tôi luôn mong đợi ý kiến đóng góp từ khách hàng để nâng cấp dịch vụ tốt hơn.</p>
                        <div class="footer-contact mt-4">
                            <div class="contact-item">
                                <i class="bi bi-geo-alt"></i>
                                <span>45 Nguyễn Đình Chiểu, Nha Trang, Khánh Hòa</span>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-telephone"></i>
                                <span>+84 815597300</span>
                            </div>
                            <div class="contact-item">
                                <i class="bi bi-envelope"></i>
                                <span>trucdoanpham@gmail.com</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="footer-widget" style="text-align: center">
                        <h4>Cửa hàng</h4>
                        <ul class="footer-links">
                            <li><a href="category.html">Thông tin cửa hàng</a></li>
                            <li><a href="category.html">Đối tác cung cấp</a></li>
                            <li><a href="category.html">Chính sách và hỗ trợ</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="footer-widget" style="text-align: center">
                        <h4>Sản phẩm</h4>
                        <ul class="footer-links">
                            <li><a href="category.html">Sản phẩm mới</a></li>
                            <li><a href="category.html">Siêu giảm giá</a></li>
                            <li><a href="category.html">Giày nữ</a></li>
                            <li><a href="category.html">Dép nữ</a></li>
                        </ul>
                    </div>
                </div>


                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="footer-widget" style="text-align: center">
                        <h4>Hỗ trợ</h4>
                        <ul class="footer-links">
                            <li><a href="support.html">Chính sách bảo hành</a></li>
                            <li><a href="{{ route('contact.index') }}">Liên hệ</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-widget" style="text-align: center">
                        {{-- Iframe Facebook hiển thị trước dòng "Theo dõi chúng tôi" --}}
                        <div class="fb-page" data-href="https://www.facebook.com/sweetsoft.vn" data-tabs="timeline" data-width="700" data-height="100" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>

                        <div class="social-links mt-4 " style="text-align: center">
                            <h5>Theo dõi chúng tôi</h5>
                            <div class="social-icons">
                                <a href="https://www.facebook.com/profile.php?id=61565294172906" aria-label="Facebook" ><i class="bi bi-facebook"></i></a>
                                <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                                <a href="#" aria-label="TikTok"><i class="bi bi-tiktok"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="copyright text-center">
                <p>© <span>Copyright</span> <span class="sitename" style="color:red">Quốc Lâm SweetSoft</span></p>
            </div>
        </div>
    </div>
</footer>

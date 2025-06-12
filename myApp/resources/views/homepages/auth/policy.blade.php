@extends('homepages.master_page')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/homepage/about.css')}}">
@endpush

@section('header')
    @include('homepages.auth.header')
@endsection

@section('content')
    <div class="main-content">
        <div class="container-about">
            <div class="left">
                <h2 class="highlight">Chính Sách & Bảo Mật</h2>
                <br><br>
                <p class="fade-in">Tại TRUCDOAN<span style="color:red">PHAM</span>, chúng tôi cam kết bảo mật thông tin cá nhân và mang lại trải nghiệm mua sắm an toàn, đáng tin cậy cho khách hàng.</p>
                <p class="fade-in">Chính sách của chúng tôi được xây dựng nhằm đảm bảo quyền lợi và sự an tâm của khách hàng trong suốt quá trình mua sắm, thanh toán và hậu mãi.</p>

                <div class="image-container fade-in">
                    <img src="{{ asset('images/policy.png')}}" alt="Chính sách bảo mật" style="max-width: 100%; border-radius: 5px;">
                </div>
            </div>
            <div class="center">
            </div>
            <div class="right">
                <h3 class="fade-in">Nội Dung Chính Sách</h3>
                <div class="line-container">
                    <ul>
                        <li class="fade-in"><strong>1. Bảo mật thông tin:</strong> Mọi thông tin cá nhân của khách hàng đều được mã hóa và bảo mật tuyệt đối.</li>
                        <li class="fade-in"><strong>2. Cam kết không chia sẻ:</strong> Chúng tôi không chia sẻ dữ liệu khách hàng với bên thứ ba nếu không có sự đồng ý.</li>
                        <li class="fade-in"><strong>3. Giao dịch an toàn:</strong> Hệ thống thanh toán được bảo vệ bởi SSL và các chuẩn bảo mật quốc tế.</li>
                        <li class="fade-in"><strong>4. Chính sách đổi trả:</strong> Hàng hóa có thể được đổi hoặc trả lại trong vòng 7 ngày nếu đáp ứng điều kiện.</li>
                        <li class="fade-in"><strong>5. Bảo hành sản phẩm:</strong> Một số sản phẩm có bảo hành 1-3 tháng tùy theo nhà sản xuất.</li>
                        <li class="fade-in"><strong>6. Chính sách thanh toán:</strong> Hỗ trợ nhiều hình thức: tiền mặt, chuyển khoản, ví điện tử.</li>
                        <li class="fade-in"><strong>7. Email và quảng cáo:</strong> Chúng tôi chỉ gửi email khi khách hàng đăng ký nhận tin, và luôn có tùy chọn hủy.</li>
                    </ul>
                </div>
            </div>
        </div>

        <br><br>
    </div>
@endsection

@section('footer')
    @include('homepages.auth.footer_no_sale')
@endsection

@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const fadeIns = document.querySelectorAll('.fade-in');

            function checkVisibility() {
                fadeIns.forEach(el => {
                    const rect = el.getBoundingClientRect();
                    if (rect.top < window.innerHeight && rect.bottom > 0) {
                        el.classList.add('visible');
                    }
                });
            }

            window.addEventListener('scroll', checkVisibility);
            checkVisibility();
        });
    </script>
@endpush

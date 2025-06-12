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
                <h2 class="highlight">Đối Tác Cung Cấp</h2>
                <br><br>
                <p class="fade-in">TRUCDOAN<span style="color:red">PHAM</span> tự hào hợp tác với những nhà cung cấp giày dép nữ uy tín hàng đầu trong và ngoài nước.</p>
                <p class="fade-in">Chúng tôi luôn lựa chọn kỹ càng các thương hiệu và nhà sản xuất giày dép nữ để đảm bảo chất lượng và mẫu mã đa dạng theo xu hướng mới nhất. Mối quan hệ đối tác lâu dài giúp chúng tôi giữ mức giá hợp lý và ổn định, đồng thời mang lại những chương trình ưu đãi đặc biệt cho khách hàng.</p>

                <div class="image-container fade-in">
                    <img src="{{ asset('images/partners.png')}}" alt="Đối tác giày dép nữ" style="max-width: 100%; border-radius: 5px;">
                </div>
            </div>
            <div class="center">
            </div>
            <div class="right">
                <h3 class="fade-in">Một Số Đối Tác Tiêu Biểu</h3>
                <div class="line-container">
                    <ul>
                        <li class="fade-in"><strong>Nhà máy Trung Quốc:</strong> Chúng tôi hợp tác với các nhà máy sản xuất giày dép uy tín tại Quảng Châu – nơi nổi tiếng về công nghệ và mẫu mã giày hiện đại.</li>
                        <li class="fade-in"><strong>Nhà cung cấp OEM/ODM:</strong> Hợp tác với nhiều đối tác chuyên sản xuất theo yêu cầu, đảm bảo chất lượng và phù hợp thị hiếu người tiêu dùng Việt.</li>
                        <li class="fade-in"><strong>Thương hiệu nội địa chọn lọc:</strong> Chúng tôi vẫn lựa chọn một số sản phẩm đến từ các thương hiệu Việt như Juno, Vascara để đa dạng hóa lựa chọn.</li>
                        <li class="fade-in"><strong>Đối tác nhập khẩu trung gian:</strong> Làm việc với các đơn vị nhập khẩu trung gian đáng tin cậy giúp đảm bảo chất lượng và giá cả ổn định.</li>
                        <li class="fade-in"><strong>Xưởng thủ công chọn lọc:</strong> Một số mẫu đặc biệt được cung cấp từ xưởng giày thủ công tại Việt Nam với sự tỉ mỉ và phong cách riêng biệt.</li>
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
            checkVisibility(); // Kiểm tra ngay khi tải trang
        });
    </script>
@endpush

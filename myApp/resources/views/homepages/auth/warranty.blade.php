@extends('homepages.master_page')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/homepage/about.css') }}">
@endpush

@section('header')
    @include('homepages.auth.header')
@endsection

@section('content')
    <div class="main-content">
        <div class="container-about">
            <div class="left">
                <h2 class="highlight">Chính Sách Bảo Hành</h2>
                <br><br>
                <p class="fade-in">Chúng tôi cam kết mang đến trải nghiệm mua sắm an tâm cho khách hàng với chính sách bảo hành rõ ràng, minh bạch và hỗ trợ nhanh chóng.</p>
                <p class="fade-in">Mỗi sản phẩm đều được kiểm tra kỹ lưỡng trước khi giao đến tay khách hàng. Tuy nhiên, trong trường hợp sản phẩm có lỗi từ nhà sản xuất, chúng tôi áp dụng chính sách bảo hành như sau:</p>

                <ul class="fade-in">
                    <li><strong>Thời gian bảo hành:</strong> Trong vòng <span style="color: red;">7 ngày</span> kể từ ngày nhận hàng.</li>
                    <li><strong>Phạm vi bảo hành:</strong> Bảo hành các lỗi kỹ thuật từ nhà sản xuất như keo bong, đế gãy, lỗi đường may.</li>
                    <li><strong>Không bảo hành đối với:</strong>
                        <ul>
                            <li>Sản phẩm bị hư hỏng do người dùng gây ra (ngấm nước, trầy xước mạnh, bảo quản sai cách...)</li>
                            <li>Sản phẩm đã qua sử dụng trong môi trường không phù hợp (thể thao, vận động mạnh...)</li>
                            <li>Sản phẩm khuyến mãi, xả kho (sẽ được ghi rõ khi mua hàng).</li>
                        </ul>
                    </li>
                    <li><strong>Quy trình bảo hành:</strong>
                        <ol>
                            <li>Khách hàng liên hệ với chúng tôi qua hotline hoặc fanpage để báo lỗi.</li>
                            <li>Gửi hình ảnh/video sản phẩm lỗi.</li>
                            <li>Sau khi xác nhận, khách hàng gửi hàng về cửa hàng theo hướng dẫn.</li>
                            <li>Chúng tôi kiểm tra và xử lý bảo hành (đổi sản phẩm mới nếu cần).</li>
                        </ol>
                    </li>
                    <li><strong>Thời gian xử lý:</strong> Trong vòng 3–5 ngày làm việc kể từ khi nhận sản phẩm lỗi.</li>
                </ul>
            </div>

            <div class="right fade-in">
                <img src="{{ asset('images/warranty.png') }}" alt="Chính sách bảo hành" style="width: 100%; border-radius: 5px;">
                <p style="margin-top: 10px; font-style: italic;">Chúng tôi luôn đồng hành cùng bạn trong suốt quá trình sử dụng sản phẩm.</p>
            </div>
        </div>
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

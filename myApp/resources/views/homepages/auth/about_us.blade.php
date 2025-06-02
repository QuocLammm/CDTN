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
                <h2 class="highlight">Giới Thiệu</h2>
                <br>
                <br>
                <p class="fade-in">TRUCDOAN<span style="color:red">PHAM</span> là cửa hàng giày dép hàng đầu, chuyên cung cấp các sản phẩm chất lượng cao với thiết kế hiện đại.</p>
                <p class="fade-in">Cửa hàng chúng tôi cam kết mang đến cho khách hàng những sản phẩm tốt nhất và dịch vụ hoàn hảo nhất. Đội ngũ nhân viên tận tâm luôn sẵn sàng hỗ trợ bạn chọn lựa sản phẩm phù hợp.
                    Chúng tôi cũng thường xuyên cập nhật các mẫu giày mới nhất theo xu hướng thời trang để đáp ứng nhu cầu của khách hàng.</p>

                <div class="image-container fade-in">
                    <img src="{{ asset('images/users/store.jpg')}}" alt="Hình ảnh cửa hàng" style="max-width: 100%; border-radius: 5px;">
                </div>
            </div>
            <div class="center">

            </div>
            <div class="right">
                <h3 class="fade-in">Tiêu Chí Của Chúng Tôi</h3>
                <div class="line-container">
                    <ul>
                        <li class="fade-in"><strong>Chất lượng sản phẩm:</strong> Chúng tôi chỉ cung cấp giày dép từ những thương hiệu uy tín và chất lượng.</li>
                        <li class="fade-in"><strong>Dịch vụ khách hàng:</strong> Đội ngũ nhân viên luôn sẵn sàng hỗ trợ bạn tận tình và chu đáo.</li>
                        <li class="fade-in"><strong>Giá cả hợp lý:</strong> Chúng tôi cam kết mang đến giá cả cạnh tranh trên thị trường.</li>
                        <li class="fade-in"><strong>Mẫu mã đa dạng:</strong> Cung cấp nhiều kiểu dáng và màu sắc cho mọi phong cách.</li>
                        <li class="fade-in"><strong>Chính sách đổi trả linh hoạt:</strong> Khách hàng có thể đổi hoặc trả hàng trong thời gian quy định.</li>
                        <li class="fade-in"><strong>Giày dép an toàn:</strong> Tất cả sản phẩm đều được kiểm tra chất lượng để đảm bảo an toàn cho người sử dụng.</li>
                        <li class="fade-in"><strong>Khuyến mãi hấp dẫn:</strong> Chúng tôi thường xuyên có chương trình khuyến mãi và giảm giá cho khách hàng.</li>
                    </ul>
                </div>
            </div>
        </div>

        <br>
        <br>
        <div class="staff-left">
            <h2 class="highlight">Nhân sự</h2>
        </div>
        <div class="containers">
            <div class="team">
                @foreach($users as $user)
                    <div class="team-member fade-in">
                        <img src="{{ $user->image ?? asset('default-avatar.png') }}" alt="Ảnh của {{ $user->full_name }}" class="team-image">
                        <h3>{{ $user->full_name }}</h3>
                        <p>
                            @php
                                $displayRole = match($user->role->role_name) {
                                    'Admin' => 'Quản trị viên',
                                    'Staff' => 'Nhân viên',
                                    default => $user->role->role_name
                                };
                            @endphp
                            {{ $displayRole }}
                        </p>
                    </div>
                @endforeach
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
            checkVisibility(); // Kiểm tra ngay khi tải trang
        });
    </script>

@endpush

@extends('homepages.master_page')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/homepage/profile.css') }}">
@endpush
@section('header')
    <div class="site-header">
        @include('homepages.auth.header')
    </div>
@endsection

@section('content')
    <div class="main-content">
        <form action="{{ route('profile.update', ['id' => $user->user_id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="profile-container">

                <!-- Hàng ảnh + tên -->
                <div class="profile-header" style="display: flex; align-items: center; gap: 20px; margin-bottom: 20px;">
                    <div class="avatar-wrapper" style="position: relative; display: inline-block;">
                        <img src="{{ asset($user->image) }}" alt="Profile Image"
                             style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">

                        <!-- Hidden file input -->
                        <input type="file" id="avatarInput" name="image" form="form-personal" style="display: none;">

                        <!-- Bút chỉnh sửa -->
                        <label for="avatarInput"
                               style="
                                   position: absolute;
                                   bottom: 0;
                                   right: 0;
                                   background-color: #fff;
                                   border-radius: 50%;
                                   padding: 4px;
                                   border: 2px solid #ccc;
                                   cursor: pointer;
                               ">
                            <i class="fas fa-pen" style="font-size: 12px; color: #333;"></i>
                        </label>
                    </div>

                    <div class="name-group">
                        <div>{{ $user->full_name }}</div>
                    </div>
                </div>

                <!-- Các nút điều hướng -->
                <div class="section-buttons">
                    <button type="button" data-section="personal" onclick="toggleSection('personal')">Thông tin cá nhân</button>
                    <button type="button" data-section="contact" onclick="toggleSection('contact')">Thông tin liên hệ</button>
                    <button type="button" data-section="orders" onclick="toggleSection('orders')">Đơn hàng</button>
                    <button type="button" data-section="reviews" onclick="toggleSection('reviews')">Đánh giá</button>
                </div>


                <!-- Thông tin cá nhân -->
                <div id="section-personal" class="profile-section" style="display: block;">
                    <h3>Thông tin cá nhân</h3>
                    <div class="form-group">
                        <label>Họ và tên</label>
                        <input type="text" name="full_name" value="{{ $user->full_name }}">
                    </div>

                    <div class="form-group">
                        <label>Ngày sinh</label>
                        <input type="date" name="birthday" value="{{ $user->birthday }}">
                    </div>

                    <button type="submit" name="update_section" value="personal" class="submit-btn">Cập nhật</button>
                </div>

                <!-- Thông tin liên hệ -->
                <div id="section-contact" class="profile-section">
                    <h3>Thông tin liên hệ</h3>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ $user->email }}">
                    </div>

                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" name="phone" value="{{ $user->phone }}">
                    </div>

                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <textarea name="address" rows="3">{{ $user->address }}</textarea>
                    </div>

                    <button type="submit" name="update_section" value="contact" class="submit-btn">Cập nhật</button>
                </div>

                <!-- Đơn hàng -->
                <div id="section-orders" class="profile-section">
                    <h3>Lịch sử mua hàng</h3>
                    @if($orders->isEmpty())
                        <p>Không có đơn hàng nào.</p>
                    @else
                        @foreach($orders as $order)
                            <div class="order-card" style="border: 1px solid #ccc; padding: 15px; margin-bottom: 15px; border-radius: 8px; position: relative;">
                                <h5 style="position: relative;">
                                    Đơn hàng #{{ $order->order_id }}
                                    <span style="position: absolute; right: 15px; padding: 5px ; border-radius: 4px;
                                        background-color:
                                            {{ $order->status === 'Pending' ? '#f97316' :
                                               ($order->status === 'Cancelled' ? '#ef4444' :
                                               ($order->status === 'Success' ? '#22c55e' : '#cbd5e1')) }};
                                        color: white; font-size: 14px; font-weight: 600;">
                                        {{
                                            $order->status === 'Pending' ? 'Đang chờ' :
                                            ($order->status === 'Cancelled' ? 'Đã hủy' :
                                            ($order->status === 'Success' ? 'Hoàn thành' : 'Chưa xác định'))
                                        }}
                                    </span>
                                </h5>


                                <div style="margin-top: 10px;">
                                    @foreach($order->items as $item)
                                        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 10px;">
                                            <img src="{{ asset($item->product->images->first()->image_path ?? 'default.jpg') }}"
                                                 alt="product image"
                                                 style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                                            <div style="display: flex; justify-content: space-between; width: 100%;">
                                                <div>
                                                    <strong>{{ $item->product->product_name }}</strong>
                                                </div>
                                                <div style="white-space: nowrap;">
                                                    {{ $item->quantity }} x {{ number_format($item->price) }}₫
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>

                                <p style="text-align: right;"><strong>Tổng tiền:</strong> {{ number_format($order->total_amount) }}₫</p>


                            @if($order->status === 'Pending')
                                    <button type="button" class="cancel-order-btn"
                                            data-order-id="{{ $order->order_id }}"
                                            style="background-color: red; color: white;">
                                        Hủy đơn hàng
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    @endif
                    <div id="loadMoreBtn-container">
                        <button id="loadMoreBtn" type="button">Xem thêm</button>
                    </div>
                </div>
                <!-- Đánh giá -->
                <div id="section-reviews" class="profile-section">
                    <h3>Đánh giá</h3>

                    @if($reviews->isEmpty())
                        <p>Bạn chưa có đánh giá nào.</p>
                    @else
                        @foreach($reviews as $review)
                            <div class="review-card border rounded p-3 mb-3">
                                <div class="d-flex justify-content-between">
                                    <strong>{{ $review->product->product_name ?? 'Sản phẩm không tồn tại' }}</strong>
                                    <small>{{ $review->created_at->format('d/m/Y') }}</small>
                                </div>
                                <p class="mb-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $review->rating)
                                            <span style="color: gold;">&#9733;</span> {{-- sao đầy --}}
                                        @else
                                            <span style="color: #ccc;">&#9734;</span> {{-- sao rỗng --}}
                                        @endif
                                    @endfor
                                    <strong>({{ $review->rating }}/5)</strong>
                                </p>
                                <p class="mb-0">Nội dung:{!! $review->comment !!}</p>
                            </div>
                        @endforeach
                    @endif
                </div>


            </div>
        </form>
    </div>
    @if(session('order_success'))
        <script>
            window.onload = function () {
                toggleSection('orders');
                // Optional: Scroll đến khu vực đơn hàng
                document.getElementById('section-orders').scrollIntoView({ behavior: 'smooth' });
            };
        </script>
    @endif

@endsection

@section('footer')
    <div class="site-footer">
        @include('homepages.auth.footer_no_sale')
    </div>
@endsection
@push('js')
    <script>
        function toggleSection(section) {
            const sections = ['personal', 'contact', 'orders', 'reviews'];
            sections.forEach(id => {
                document.getElementById(`section-${id}`).style.display = 'none';
            });

            // Hiện phần được chọn
            document.getElementById(`section-${section}`).style.display = 'block';

            // Lưu section hiện tại vào localStorage
            localStorage.setItem('currentSection', section);

            // Highlight nút đang chọn
            const buttons = document.querySelectorAll('.section-buttons button');
            buttons.forEach(btn => {
                btn.classList.remove('active');
                if (btn.dataset.section === section) {
                    btn.classList.add('active');
                }
            });
        }

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Khôi phục section hiện tại từ localStorage
            const currentSection = localStorage.getItem('currentSection') || 'personal';
            toggleSection(currentSection);


            // Lập trình sự kiện cho nút hủy đơn hàng
            const cancelButtons = document.querySelectorAll('.cancel-order-btn');
            // ... (phần còn lại của mã xử lý nút hủy đơn hàng)
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cancelButtons = document.querySelectorAll('.cancel-order-btn');

            cancelButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const orderId = this.getAttribute('data-order-id');
                    if (!confirm('Bạn có chắc muốn hủy đơn hàng này không?')) return;

                    fetch("{{ route('cancel.order') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ order_id: orderId })
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Lỗi khi gửi yêu cầu hủy.');
                            }
                            if (response.redirected) {
                                // Nếu server redirect, thì chuyển trang theo url redirect
                                window.location.href = response.url;
                            } else {
                                // Nếu không redirect, reload lại trang
                                location.reload();
                            }
                        })
                        .catch(error => {
                            alert('Có lỗi xảy ra: ' + error.message);
                        });
                });
            });
        });
    </script>

    <!-- Load More -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const orders = document.querySelectorAll(".order-card");
            const loadMoreBtn = document.getElementById("loadMoreBtn");
            let visibleCount = 4;

            function showOrders() {
                orders.forEach((order, index) => {
                    order.style.display = index < visibleCount ? "block" : "none";
                });

                // Hiện nút nếu còn đơn hàng chưa hiển thị
                if (visibleCount < orders.length) {
                    loadMoreBtn.style.display = "block";
                } else {
                    loadMoreBtn.style.display = "none";
                }
            }

            showOrders();

            loadMoreBtn.addEventListener("click", function () {
                visibleCount += 4; // Hiển thị thêm 4 đơn hàng mỗi lần
                showOrders();
            });
        });
    </script>
@endpush



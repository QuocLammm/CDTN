@extends('layouts.supper_page')
@section('title', 'Trang quản trị')
@section('content')
    <br>
    <br>
    <h1>Trang Quản Trị</h1>
    <!--Analytics-->
    <div class="analyse">
        <div class="sales">
            <div class="status">
                <div class="info">
                    <h3>Doanh số hôm nay</h3>
                    <h1>12,000,000 đ</h1>
                </div>
                <div class="progresss">
                    <svg>
                        <circle cx="38" cy="38" r="36">
                        </circle>
                    </svg>
                    <div class="percentage">
                        <p>+81%</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="visits">
            <div class="status">
                <div class="info">
                    <h3>Khách truy cập</h3>
                    <h1>35,000 <span style="color: silver; font-size: 22px;">lượt</span></h1>
                </div>
                <div class="progresss">
                    <svg>
                        <circle cx="38" cy="38" r="36">
                        </circle>
                    </svg>
                    <div class="percentage">
                        <p>-12%</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="searches">
            <div class="status">
                <div class="info">
                    <h3>Tìm kiếm sản phẩm</h3>
                    <h1>72,000 <span style="color: silver; font-size: 22px;">lượt</span></h1>
                </div>
                <div class="progresss">
                    <svg>
                        <circle cx="38" cy="38" r="36">
                        </circle>
                    </svg>
                    <div class="percentage">
                        <p>+36%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End of Analytics-->

    <!--Start new user-->
    <div class="new-users">
        <h2>Nhân viên</h2>
        <div class="user-list">
            @foreach($recentStaff as $staff)
                <div class="user">
                    <img src="{{ asset('/images/staff/' . $staff->avt) }}" alt="{{ $staff->FullName }}">
                    <h2>{{ $staff->FullName }}</h2>
                    <p>{{ \Carbon\Carbon::parse($staff->CreatedAt)->diffForHumans() }}</p>
                </div>
            @endforeach
            <div class="user">
                <a href="{{ route('staff.create') }}">
                    <img src="{{ asset('/images/plus.jpg') }}" alt="Thêm nhân viên">
                    <h2>More</h2>
                    <p>New User</p>
                </a>
            </div>
        </div>
    </div>

    <!--End of New Users-->
    <!--Recen Order-->
    <div class="recent-orders">
        <h2>Đơn hàng gần đây</h2>
        <table>
            <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Mã sản phẩm</th>
                <th>Thanh toán</th>
                <th>Trạng thái</th>
                <th></th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
        <a href="#">Show All</a>
    </div>
@endsection

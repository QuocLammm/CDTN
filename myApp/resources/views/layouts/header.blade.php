<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <x-breadcrumb :items="$breadcrumbItems ?? []" />
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
            <ul class="navbar-nav justify-content-end">

                {{-- Lời chào --}}
                <li class="nav-item d-flex align-items-center pe-3">
                    <span class="nav-link text-dark font-weight-bold px-0 d-flex align-items-center">
                        <a href="{{ route('show-profile.index') }}" class="text-dark me-2">
                            <i class="fa fa-user"></i>
                        </a>
                        Xin chào! {{ Auth::user()->full_name }}
                    </span>
                </li>

                {{-- Icon cài đặt --}}
                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="{{route('admin.setting.index')}}" class="nav-link text-dark p-0">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li>

                {{-- Icon thông báo --}}

                <li class="nav-item dropdown pe-3 me-3 d-flex align-items-center position-relative">
                    <a href="javascript:;" class="nav-link text-dark p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer" style="color: #ffc107; font-size: 18px;"></i>
                        <span id="notification-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $pendingOrdersCount }}
                    </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton" style="min-width: 300px;">
                        @if($notifications->isEmpty())
                            <li class="dropdown-item">Không có thông báo nào.</li>
                        @else
                            @foreach($notifications as $index => $notification)
                                @if($index < 3) <!-- Hiển thị chỉ 3 thông báo -->
                                <li class="dropdown-item">
                                    <strong>Đơn hàng #{{ $notification->user->orders->first()->order_id ?? 'N/A' }}</strong><br>
                                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                @endif
                            @endforeach
                            <li class="dropdown-item text-center">
                                <a href="{{ route('show-notification.index') }}">Xem lịch sử thông báo</a>
                            </li>
                        @endif
                    </ul>
                </li>

                {{-- Nút đăng xuất --}}
                <li class="nav-item d-flex align-items-center">
                    <form action="{{ route('logout') }}" id="logout-form" class="d-none">
                        @csrf
                    </form>

                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="btn btn-outline-dark border rounded px-3 py-1 d-flex align-items-center mb-0">
                        <i class="fa fa-power-off text-danger me-2"></i>
                        <span class="d-sm-inline d-none">Đăng xuất</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->

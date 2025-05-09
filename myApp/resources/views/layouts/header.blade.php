<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <h6 class="font-weight-bolder text-black mb-0" style="margin-top:20px ">{{ $title }}</h6>
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
                    <a href="javascript:;" class="nav-link text-dark p-0">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li>

                {{-- Icon thông báo --}}
                <li class="nav-item dropdown pe-3 me-3 d-flex align-items-center position-relative">
                    <a href="javascript:;" class="nav-link text-dark p-0" id="dropdownMenuButton"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer" style="color: #ffc107; font-size: 18px;"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                        <!-- Nội dung thông báo -->
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

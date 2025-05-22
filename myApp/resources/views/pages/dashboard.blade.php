@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.header', ['title' => 'Trang quản trị'])
    <div class="container-fluid py-4">
        <div class="row d-flex">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Doanh thu hôm nay</p>
                                    <h5 class="font-weight-bolder">
                                        {{ number_format($doanhThuHomNay, 0, ',', '.') }}₫
                                    </h5>
                                    <p class="mb-0">
                                        @if ($phanTramThayDoi > 0)
                                            <span class="text-success text-sm font-weight-bolder">+{{ round($phanTramThayDoi, 1) }}%</span>
                                        @elseif ($phanTramThayDoi < 0)
                                            <span class="text-danger text-sm font-weight-bolder">{{ round($phanTramThayDoi, 1) }}%</span>
                                        @else
                                            <span class="text-secondary text-sm font-weight-bolder">0%</span>
                                        @endif
                                        hôm trước
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Lượng truy cập hôm nay</p>
                                    <h5 class="font-weight-bolder">
                                        {{ number_format($todayViews) }}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-{{ $percentChangeViews >= 0 ? 'success' : 'danger' }} text-sm font-weight-bolder">
                                            {{ $percentChangeViews >= 0 ? '+' : '' }}{{ round($percentChangeViews, 1) }}%
                                        </span>
                                        ngày trước
                                    </p>

                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Khách hàng mới</p>
                                    <h5 class="font-weight-bolder">
                                        {{ number_format($khachHangThangNay) }}
                                    </h5>
                                    <p class="mb-0">
                                        <span
                                            class="{{ $phanTramKhachHang >= 0 ? 'text-success' : 'text-danger' }} text-sm font-weight-bolder">
                                            {{ $phanTramKhachHang >= 0 ? '+' : '' }}{{ round($phanTramKhachHang, 1) }}%
                                        </span>
                                        tháng trước
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Đơn hàng tháng này</p>
                                    <h5 class="font-weight-bolder">
                                        {{ number_format($donHangThangNay) }} đơn
                                    </h5>
                                    <p class="mb-0">
                                        @if ($phanTramDonHang > 0)
                                            <span class="text-success text-sm font-weight-bolder">+{{ round($phanTramDonHang, 1) }}%</span>
                                        @elseif ($phanTramDonHang < 0)
                                            <span class="text-danger text-sm font-weight-bolder">{{ round($phanTramDonHang, 1) }}%</span>
                                        @else
                                            <span class="text-secondary text-sm font-weight-bolder">0%</span>
                                        @endif
                                        tháng trước
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Tổng quan doanh số bán hàng</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-arrow-{{ $percentChangeRevenueYear >= 0 ? 'up' : 'down' }} text-{{ $percentChangeRevenueYear >= 0 ? 'success' : 'danger' }}"></i>
                            <span class="font-weight-bold">
                                {{ $percentChangeRevenueYear >= 0 ? 'hơn ' : 'giảm ' }}{{ abs(round($percentChangeRevenueYear, 1)) }}%
                            </span> trong năm {{ $year }}
                        </p>

                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-total-year" class="chart-canvas" height="150"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card card-carousel overflow-hidden h-100 p-0">
                    <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                        <div class="carousel-inner border-radius-lg h-100">
                            <div class="carousel-item h-100 active" style="background-image: url('{{ asset('img/carousel-1.jpg') }}');
            background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="ni ni-camera-compact text-dark opacity-10"></i>
                                    </div>
                                    <h5 class="text-white mb-1">Get started with Argon</h5>
                                    <p>There’s nothing I really wanted to do in life that I wasn’t able to get good
                                        at.</p>
                                </div>
                            </div>
                            <div class="carousel-item h-100" style="background-image: url('{{ asset('img/carousel-2.jpg') }}');
            background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="ni ni-bulb-61 text-dark opacity-10"></i>
                                    </div>
                                    <h5 class="text-white mb-1">Faster way to create web pages</h5>
                                    <p>That’s my skill. I’m not really specifically talented at anything except for the
                                        ability to learn.</p>
                                </div>
                            </div>
                            <div class="carousel-item h-100"
                                 style="background-image: url('{{ asset('img/carousel-3.jpg') }}'); background-size: cover;">

                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="ni ni-trophy text-dark opacity-10"></i>
                                    </div>
                                    <h5 class="text-white mb-1">Share with us your design tips!</h5>
                                    <p>Don’t be afraid to be wrong because you can’t learn anything from a
                                        compliment.</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev w-5 me-3" type="button"
                                data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next w-5 me-3" type="button"
                                data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Doanh thu theo nhân viên</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center ">
                            <tbody>
                            @foreach($revenuePerStaff as $item)
                                <tr>
                                    <td class="w-30">
                                        <div class="d-flex px-2 py-1 align-items-center">
                                            <div>
                                                <img src="{{ asset($item->staff->image ?? 'default.png') }}" alt="Ảnh nhân viên" style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;">
                                            </div>

                                            <div class="ms-4">
                                                <p class="text-xs font-weight-bold mb-0">Nhân viên:</p>
                                                <h6 class="text-sm mb-0">
                                                    {{ $item->staff ? $item->staff->full_name : 'Không rõ' }}
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Đã bán:</p>
                                            <h6 class="text-sm mb-0">{{ $item->orders_count }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Doanh thu:</p>
                                            <h6 class="text-sm mb-0">{{ number_format($item->total_revenue, 2) }} vnđ</h6>
                                        </div>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <div class="col text-center">
                                            <p class="text-xs font-weight-bold mb-0">Tăng/Giảm</p>
                                            @if (!is_null($item->change_percent))
                                                @if ($item->change_percent >= 0)
                                                    <i class="fa fa-arrow-up text-success"></i>
                                                    <h6 class="text-sm mb-0">+{{ $item->change_percent }}%</h6>
                                                @else
                                                    <i class="fa fa-arrow-down text-danger"></i>
                                                    <h6 class="text-sm mb-0">{{ $item->change_percent }}%</h6>
                                                @endif
                                            @else
                                                <h6 class="text-sm mb-0">Không có dữ liệu</h6>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Lịch sử hoạt động</h6>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group">
                            @foreach ($logs as $log)
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        {{-- Hình ảnh người dùng --}}
                                        <div class="icon icon-shape icon-sm me-3 shadow text-center">
                                            <img src="{{ $log->user_image }}" alt="{{ $log->user_name }}" width="40" height="40" class="me-3 border rounded-2">
                                        </div>

                                        {{-- Thông tin log --}}
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">
                                                <span class="text-primary fw-bold">{{ $log->user_name }}</span> {{ $log->action }}
                                            </h6>
                                            <span class="text-xs text-secondary">
                                                {{ $log->created_at->diffForHumans() }}
{{--                                                @if ($log->module)--}}
{{--                                                    - {{ $log->module }}--}}
{{--                                                @endif--}}
                                            </span>
                                        </div>
                                    </div>

                                    {{-- Nút chi tiết (tuỳ chọn) --}}
                                    <div class="d-flex">
                                        <button class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto">
                                            <i class="ni ni-bold-right" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
    </div>
@endsection

@push('js')
    <script src="{{asset('/assets/js/plugins/chartjs.min.js')}}"></script>
    <script>
        var ctx1 = document.getElementById("chart-total-year").getContext("2d");
        const data = @json(array_values($data));
        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Doanh thu (₫)",
                    tension: 0.4,
                    pointRadius: 0,
                    borderColor: "#fb6340",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: data,
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
@endpush

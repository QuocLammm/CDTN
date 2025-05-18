<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/admin/apple-touch-icon.png') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=settings"/>
    <link rel="icon" type="image/png" href="{{asset('assets/img/admin/logo.png')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=male" />
    <title>
        TrucDoanPham | Chuyên giày dép nữ
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
    <!-- Nucleo Icons -->
    <link href="{{ asset('/assets/css/nucleo-icons.css')}}" rel="stylesheet"/>
    <link href="{{ asset('/assets/css/nucleo-svg.css')}}" rel="stylesheet"/>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('/assets/css/nucleo-svg.css')}}" rel="stylesheet"/>
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('/assets/css/argon-dashboard.css')}}" rel="stylesheet"/>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Thêm CSS cho Pickr -->
    <link href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" rel="stylesheet" />

    <link href="{{ asset('/assets/css/homepage/style.css')}}" rel="stylesheet"/>
    @stack('css')
</head>

<body class="{{ $class ?? '' }}">

{{--    @guest--}}
{{--        @yield('content')--}}
{{--    @endguest--}}
@include('layouts.sidenav')
<main class="main-content border-radius-lg">
    @yield('content')
</main>
@include('components.fixed-plugin')

<!--   Core JS Files   -->
<script src="{{asset('/assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('/assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('/assets/js/argon-dashboard.js')}}"></script>
<!-- jQuery + DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<!-- Beams Notification-->
<script src="https://js.pusher.com/beams/2.1.0/push-notifications-cdn.js"></script>
<script>
    const beamsClient = new PusherPushNotifications.Client({
        instanceId: '573a3ca7-cef7-4741-b7d9-4c46d4925a47',
    });

    beamsClient.start()
        .then(() => beamsClient.addDeviceInterest('orders'))
        .then(() => console.log('Successfully registered and subscribed!'))
        .catch(console.error);
</script>
<!-- Xử lý readtime header notification-->
<script>
    $(document).ready(function() {
        function fetchNotifications() {
            $.ajax({
                url: '/api/notifications',
                method: 'GET',
                success: function(data) {
                    $('#notification-count').text(data.count).toggle(data.count > 0);
                    $('.dropdown-menu').empty();

                    if(data.notifications.length === 0) {
                        $('.dropdown-menu').append('<li class="dropdown-item">Không có thông báo nào.</li>');
                    } else {
                        data.notifications.forEach(function(notification, index) {
                            if(index < 3) { // Hiển thị chỉ 3 thông báo
                                $('.dropdown-menu').append(`
                                <li class="dropdown-item">
                                    <strong>Đơn hàng #${notification.order_id}</strong><br>
                                    <small class="text-muted">${notification.created_at}</small>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                            `);
                            }
                        });
                        $('.dropdown-menu').append('<li class="dropdown-item text-center"><a href="{{ route("show-notification.index") }}">Xem lịch sử thông báo</a></li>');
                    }
                }
            });
        }

        $('#dropdownMenuButton').on('click', function() {
            fetchNotifications();
        });

        setInterval(fetchNotifications, 2000); // 30 giây
    });
</script>
<!--Realtime cho Views-->
<script>
    function loadDashboardData() {
        $.getJSON('/dashboard-data', function(data) {
            $('#doanhThuHomNay').text(new Intl.NumberFormat().format(data.doanhThuHomNay));
            $('#phanTramThayDoi').text(data.phanTramThayDoi + '%');

            $('#todayViews').text(new Intl.NumberFormat().format(data.todayViews));
            $('#percentChangeViews').text(data.percentChangeViews + '%');

            $('#donHangThangNay').text(data.donHangThangNay);
            $('#phanTramDonHang').text(data.phanTramDonHang + '%');
        });
    }

    $(document).ready(function() {
        loadDashboardData(); // lần đầu
        setInterval(loadDashboardData, 2000); // cập nhật mỗi 60s
    });
</script>
@stack('js')

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Thêm JavaScript cho Pickr -->
<script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
</body>
</html>

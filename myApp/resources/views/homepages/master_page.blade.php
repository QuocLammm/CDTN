<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Thêm favicon -->
    <link rel="icon" href="{{asset('assets/img/admin/favicon.ico')}}">
    <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/drift-zoom/drift-basic.css')}}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
{{--    <style>--}}
{{--        body {--}}
{{--            background-image: url('{{ asset("/images/background.jpeg") }}');--}}
{{--        }--}}
{{--    </style>--}}
    <!-- Main CSS File -->
    <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">
    <title>TRUCDOANPHAM | Chuyên giày dép nữ</title>
    @stack('css')
    <style>
        .swal2-toast {
            background-color: green !important; /* nền xanh dương */
            color: #ffffff !important;           /* chữ trắng */
            font-weight: 500;
            border: 1px solid green;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }
        .swal2-icon-success {
            color: #ffffff !important; /* biểu tượng cũng trắng cho đồng bộ */
        }
        .product-info h4 {
            white-space: nowrap;       /* Không xuống dòng */
            overflow: hidden;          /* Ẩn phần vượt quá */
            text-overflow: ellipsis;   /* Hiện dấu "..." */
            max-width: 200px;          /* Giới hạn chiều rộng */
        }
    </style>
</head>
<body class="index-page">

<header>
    @yield('header')
</header>
<main class="main">
    @yield('scroll')
    @yield('item')
    @yield('content')
    @yield('information')
</main>
<footer>
    @yield('footer')
</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>
<div id="fb-root"></div>
<!-- Embed iframe fb -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v22.0"></script>
<!-- Vendor JS Files -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
<script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
<script src="{{asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
<script src="{{asset('assets/vendor/drift-zoom/Drift.min.js')}}"></script>
<script src="{{asset('assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Main JS File -->
<script src="{{asset('assets/js/main.js')}}"></script>
<!-- Beams Notification-->
<script src="https://js.pusher.com/beams/2.1.0/push-notifications-cdn.js"></script>
<script>
    const user_id = "{{ auth()->check() ? auth()->user()->user_id : '' }}";

    const beamsClient = new PusherPushNotifications.Client({
        instanceId: '573a3ca7-cef7-4741-b7d9-4c46d4925a47',
    });

    beamsClient.start()
        .then(() => {
            if (user_id) {
                beamsClient.addDeviceInterest(`user_${user_id}`);
            }
        })
        .catch(console.error);
</script>

<!--Scroll -->
<script>
    let index = 0;
    const products = document.querySelectorAll('.fade-product');
    const total = products.length;

    function showNextProduct() {
        products.forEach(p => p.classList.remove('active'));
        products[index].classList.add('active');
        index = (index + 1) % total;
    }

    setInterval(showNextProduct, 30000); // mỗi 30 giây đổi
</script>

<!-- Toast thông báo -->
@if (session('status'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: '{{ session('status') }}',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
        });
    </script>
@endif
@stack('js')
</body>
</html>

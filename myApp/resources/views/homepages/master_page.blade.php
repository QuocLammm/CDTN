<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('/assets/css/users/style.css')}}">
    <!-- Thêm favicon -->
    <link rel="icon" href="path_to_your_favicon.ico" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>TRUCDOANPHAM</title>
    @stack('css')
</head>
<body>
<header>
    @yield('header')
</header>
    @yield('scroll')
    @yield('item')
    @yield('content') {{-- Nội dung động của từng trang --}}
    @yield('information')
<footer>
    @yield('footer')
</footer>

<script src="{{ asset('assets/js/homepages/style.js')}}"></script>
@stack('js')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @yield('reserved_css') <!--Thêm riêng các css riêng cho các trang riêng-->
    <!--CSS-->
    <link rel="stylesheet" href="{{ asset('css/login/login.css')}}">
    <!--Font and AJAX-->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!--Sweetalert2-->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!--Datatable-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
</head>
<body>
<div class="container">
    @include('layouts.sidebar')
        <main>
{{--            <h1>@yield('header')</h1>--}}
            @yield('content')
        </main>
    @include('layouts.right_section')
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{ asset('/js/login/index.js') }}"></script>
<script>
    var successMessage = @json(session('success'));
</script>
<script src="{{ asset('/js/admin/index.js') }}"></script>
<!-- JS của Datatable -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
@yield('reserved_js') <!--Thêm các js riêng cho các trang riêng-->

</body>
</html>


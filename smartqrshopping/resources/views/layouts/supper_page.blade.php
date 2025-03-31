<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/login/login.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    @include('layouts.sidebar')
        <main>
            @yield('content')
        </main>
    @include('layouts.right_section')
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/login/order.js')}}"></script>
<script src="{{ asset('/js/login/index.js') }}"></script>
<script src="{{ asset('/js/staff/create.js') }}"></script>
<script>
    var successMessage = @json(session('success'));
</script>
<script src="{{ asset('/js/admin/index.js') }}"></script>
</body>
</html>


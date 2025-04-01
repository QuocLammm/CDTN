<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/users/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Homepage</title>
</head>
<body>
    @yield('header')
    @include('homepages.item')
    @yield('infomation')
    @yield('footer')
</body>
<script src="{{ asset('/js/homepages/style.js')}}"></script>
</html>

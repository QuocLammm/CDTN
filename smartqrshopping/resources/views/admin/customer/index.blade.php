<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khách hàng</title>
    <link rel="stylesheet" href="/css/login/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
</head>
<body>
<div class="container">
    @include('layouts.sidebar')
    <main>
        <h1>Danh sách khách hàng</h1>
        <div class="loading-overlay" id="loadingOverlay" style="display: none;">
            <div class="infinity-loader">
                <div class="infinity"></div>
            </div>
        </div>
    </main>
    @include('layouts.right_section')
</div>

<script src="/js/login/order.js"></script>
<script src="/js/login/index.js"></script>
</body>
</html>

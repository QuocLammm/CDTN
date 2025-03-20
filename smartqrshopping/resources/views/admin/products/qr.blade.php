<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/login/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Sharp" rel="stylesheet" />
</head>
<body>
<div class="container">
    @include('layouts.sidebar')
    <main>
        <div class="main-container">
            <h2>Mã QR cho sản phẩm: {{ $product->ProductName }}</h2>
            <div id="qrcode">
                <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="QR Code">
            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#qrcode').qrcode({
                        text: "{{ $url }}",
                        width: 200,
                        height: 200
                    });
                });
            </script>
        </div>
    </main>
    @include('layouts.right_section')
</div>

<script src="/js/login/order.js"></script>
<script src="/js/login/index.js"></script>
</body>
</html>

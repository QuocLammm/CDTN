<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Đơn hàng đã sẵn sàng</title>
</head>
<body>
<h2>Xin chào khách hàng {{ $order->user->full_name }},</h2>
<p>Đơn hàng của bạn (Mã đơn: <strong>#{{ $order->order_id }}</strong>) đã được chuẩn bị sẵn sàng và đang chờ bạn tại quầy.</p>
<p>Vui lòng đến nhận sớm nhé!</p>
<p>Cảm ơn bạn đã đặt hàng ❤️</p>
</body>
</html>

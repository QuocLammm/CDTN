<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('assets/img/admin/favicon.ico')}}" type="image/x-icon">
    <title>Đăng ký | TRUCDOANPHAM</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('/assets/css/login/style.css') }}">
</head>
<body>

<div class="container">
    <div class="form-container sign-up-container">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h1>Đăng ký tài khoản</h1>
            <div class="social-container">
                <a href="#" class="social facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="{{ route('auth.google') }}" class="social google"><i class="fab fa-google-plus-g"></i></a>
            </div>
            <div class="infield">
                <input type="text" name="account_name" placeholder="Tên tài khoản" required />
            </div>
            <div class="infield">
                <input type="email" name="email" placeholder="Nhập Email" required />
            </div>
            <div class="infield">
                <input type="password" name="password" placeholder="Nhập mật khẩu" required />
            </div>
            <div class="infield">
                <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu" required />
            </div>

            <button type="submit">Đăng ký</button>
        </form>
    </div>
</div>

</body>
</html>

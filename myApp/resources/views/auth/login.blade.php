<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('/assets/css/login/style.css') }}">
</head>
<body>

<div class="container">
    <div class="form-container sign-in-container">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h1>Đăng nhập</h1>
{{--            <div class="social-container">--}}
{{--                <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>--}}
{{--                <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>--}}
{{--                <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>--}}
{{--            </div>--}}
{{--            <span>or use your account</span>--}}


            <div class="infield">
                <input type="text" name="account_name"  placeholder="Tên tài khoản" required />
            </div>
            <div class="infield">
                <input type="password" name="password"  placeholder="Mật khẩu" required />
            </div>
            <!-- Display error message if login fails -->
            @if ($errors->any())
                <div class="error-messages">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <!-- Quên mật khẩu -->
            <div class="forgot-password-wrapper">
                <a href="#" class="forgot">Quên mật khẩu?</a>
            </div>
            <!-- Nút đăng nhập -->
            <div class="submit-button-wrapper">
                <button type="submit">Đăng nhập</button>
            </div>

        </form>

    </div>
</div>

</body>
</html>

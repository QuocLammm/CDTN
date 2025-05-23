<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập | Cửa Hàng Giày Dép</title>
    <!-- Thêm favicon -->
    <link rel="icon" href="{{asset('assets/img/admin/favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('/assets/css/login/style.css') }}">
</head>
<body>
<div class="col">
    <h1 style="text-align: center">TRUCDOAN<span style="color: red">PHAM</span></h1>
    <div class="container">
        <div class="form-container sign-in-container">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1>Đăng nhập</h1>
                <!-- Tên tài khoản -->
                <div class="infield">
                    <input type="text" name="account_name" placeholder="Tên tài khoản" value="{{ old('account_name') }}" required />
                    @error('account_name')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <br>
                <!-- Mật khẩu -->
                <div class="infield">
                    <input type="password" name="password" placeholder="Mật khẩu" required />
                    @error('password')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Quên mật khẩu và Lưu mật khẩu -->
                <div class="forgot-password-wrapper">
                    <div class="remember-wrapper">
                        <input type="checkbox" name="remember" id="remember" />
                        <label for="remember">Lưu mật khẩu</label>
                    </div>

                    <a href="{{ route('password.request') }}" class="forgot">Quên mật khẩu?</a>

                </div>

                <!-- Nút đăng nhập -->
                <div class="submit-button-wrapper">
                    <button type="submit">Đăng nhập</button>
                </div>
                <!-- Đăng ký nếu chưa có tài khoản -->
                <div class="register-link">
                    <p>Bạn chưa có tài khoản? <a href="{{route('register')}}">Đăng ký ngay</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
@if(session('success'))
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Thành công',
            text: '{{ session("success") }}',
            showConfirmButton: true,
            confirmButtonText: 'OK',
            timer: 3000,
            timerProgressBar: true,
        });
    </script>
@endif
</body>
</html>

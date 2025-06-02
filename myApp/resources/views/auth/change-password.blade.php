<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/admin/apple-touch-icon.png') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=settings"/>
    <link rel="icon" type="image/png" href="{{asset('assets/img/admin/logo.png')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=male" />
    <title>
        TrucDoanPham | Chuyên giày dép nữ
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet"/>
    <!-- Nucleo Icons -->
    <link href="{{ asset('/assets/css/nucleo-icons.css')}}" rel="stylesheet"/>
    <link href="{{ asset('/assets/css/nucleo-svg.css')}}" rel="stylesheet"/>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('/assets/css/nucleo-svg.css')}}" rel="stylesheet"/>
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('/assets/css/argon-dashboard.css')}}" rel="stylesheet"/>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Thêm CSS cho Pickr -->
    <link href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" rel="stylesheet" />

    <link href="{{ asset('/assets/css/homepage/style.css')}}" rel="stylesheet"/>
</head>
<body>
<div>

    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <h3 style="text-align: center">TRUCDOAN<span style="color:red">PHAM</span></h3>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="card-header pb-0 text-start" >
                                    <h4 class="font-weight-bolder" style="text-align:center">Cập nhật mật khẩu</h4>
                                    <p class="mb-0" style="text-align:center">Đặt mật khẩu mới cho email của bạn</p>
                                </div>
                                <div class="card-body">
                                    @if(session('status'))
                                        <div class="alert alert-success text-sm text-center">
                                            {{ session('status') }}
                                        </div>
                                    @endif

                                    @if($errors->any())
                                        <div class="alert alert-danger text-sm text-center">
                                            {{ $errors->first() }}
                                        </div>
                                    @endif

                                    <form role="form" method="POST" action="{{ route('password.update') }}" >
                                        @csrf
                                        <!-- Token hidden -->
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <input type="hidden" name="email" value="{{ $email }}">

                                        <div class="flex flex-col mb-3">
                                            <input type="password" name="password" class="form-control form-control-lg" placeholder="Mật khẩu" aria-label="Password" >
                                            @error('password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                        <div class="flex flex-col mb-3">
                                            <input type="password" name="password_confirmation" class="form-control form-control-lg" placeholder="Xác nhận mật khẩu" aria-label="Password" >
                                            @error('password_confirmation')
                                            <p class="text-danger text-xs pt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <div class="g-recaptcha" data-sitekey="6LdlgFMrAAAAAM3EDhCo9Xr0-9s3PH4YT2A9eky9"></div>
                                            @error('g-recaptcha-response')
                                            <p class="text-danger text-xs pt-1">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Cập nhật</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                 style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
              background-size: cover;">
                                <span class="mask bg-gradient-primary opacity-6"></span>
                                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Giày chất – Gu riêng, bước chất"</h4>
                                <p class="text-white position-relative">Không chỉ là giày, mà là cá tính dưới từng bước chân.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
</body>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
</html>

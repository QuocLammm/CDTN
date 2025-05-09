<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="/css/login/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div class="container">
    <div class="Form login-form">
        <h2>Login</h2>
        <form action="#">
            <div class="input-box">
                <i class='bx bxs-user'></i>
                <label for="#">Username</label>
                <input type="text" placeholder="Enter Your Username*">
            </div>
            <div class="input-box">
                <i class='bx bxs-envelope' ></i>
                <input type="text" placeholder="Enter Your Password*">
                <label for="#">Password</label>
            </div>
            <div class="forgot-section">
                <span><input type="checkbox" name="" id="checked">Remember Me</span>
                <span><a href="#">Forgot Password ?</a></span>
            </div>
            <button class="btn">Login</button>
        </form>
        <p>Or Sign up using</p>
        <div class="social-media">
            <i class='bx bxl-facebook'></i>
            <i class='bx bxl-google'></i>
            <i class='bx bxl-twitter'></i>
        </div>
        <p class="RegisteBtn RegiBtn"><a href="#">Register Now</a></p>
    </div>
    <div class="Form Register-form">
        <h2>Register</h2>
        <form action="#">
            <div class="input-box">
                <i class='bx bxs-user'></i>
                <label for="#">Username</label>
                <input type="text" placeholder="Enter Your Username*">
            </div>
            <div class="input-box">
                <i class='bx bxs-envelope' ></i>
                <input type="text" placeholder="Enter Your Password*">
                <label for="#">Password</label>
            </div>
            <div class="input-box">
                <i class='bx bxs-envelope' ></i>
                <input type="text" placeholder="Enter Your Password*">
                <label for="#">Confirm Password</label>
            </div>
            <div class="forgot-section">
                <span><input type="checkbox" name="" id="checked">Remember Me</span>
                <span><a href="#">Forgot Password ?</a></span>
            </div>
            <button class="btn" class="loginBtn">Register</button>
        </form>
        <p>Or Sign up using</p>
        <div class="social-media">
            <i class='bx bxl-facebook'></i>
            <i class='bx bxl-google'></i>
            <i class='bx bxl-twitter'></i>
        </div>
        <p class="LoginBtn"><a href="#">Login Now</a></p>
    </div>
</div>
<script>
    const container=document.querySelector(".container") ;
    const loginForm=document.querySelector('.login-form')
    const RegisterForm=document.querySelector('.Register-form');
    const RegiBtn=document.querySelector('.RegiBtn');
    const LoginBtn=document.querySelector('.LoginBtn');
    RegiBtn.addEventListener('click',()=>{
        RegisterForm.classList.add('active');
        loginForm.classList.add('active')
    })
    LoginBtn.addEventListener('click',()=>{
        RegisterForm.classList.remove('active');
        loginForm.classList.remove('active')
    })
</script>
</body>
</html>

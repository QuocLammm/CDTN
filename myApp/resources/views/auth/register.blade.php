<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('/assets/css/login/style.css') }}">
</head>
<body>

<div class="container">
    <div class="form-container sign-up-container">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <h1>Create Account</h1>
            <div class="social-container">
                <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <span>or use your email for registration</span>

            <div class="infield">
                <input type="text" name="name" placeholder="Name" required />
            </div>
            <div class="infield">
                <input type="email" name="email" placeholder="Email" required />
            </div>
            <div class="infield">
                <input type="password" name="password" placeholder="Password" required />
            </div>
            <div class="infield">
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required />
            </div>

            <button type="submit">Sign Up</button>
        </form>
    </div>
</div>

</body>
</html>

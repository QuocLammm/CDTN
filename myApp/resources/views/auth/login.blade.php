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
            <h1>Sign In</h1>
            <div class="social-container">
                <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <span>or use your account</span>

            <!-- Email input field -->
            <div class="infield">
                <input type="email" name="email"  placeholder="Email" required />
            </div>

            <div class="infield">
                <input type="password" name="password"  placeholder="Password" required />
            </div>

            <!-- Display error message if login fails -->
            @if ($errors->any())
                <div class="error-messages">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <a href="#" class="forgot">Forgot your password?</a>

            <button type="submit">Sign In</button>
        </form>

    </div>
</div>

</body>
</html>

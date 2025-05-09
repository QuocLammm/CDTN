<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\auth\CartController;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    //loggin
    public function showLogin() {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        // Thử xác thực với email và mật khẩu
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Đồng bộ cart tạm vào database
            app(CartController::class)->syncSessionCartToDatabase();

            // Lấy thông tin người dùng đã đăng nhập
            $user = Auth::user();

            // Kiểm tra role_id để điều hướng
            if ($user->role_id === 1) {
                return redirect()->intended('dashboard'); // Admin
            } else {
                return redirect()->intended('homepages'); // User
            }
        }

        // Thông báo lỗi chung
        return back()->withErrors([
            'login' => 'Thông tin đăng nhập không chính xác.',
        ])->onlyInput('email');
    }

    //Register
    public function showRegister() {
        $user = Auth::user();
        return view('auth.register', compact('user'));
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->account_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Register success! Please login.');
    }

    //Logout
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }



    // Login in Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt(uniqid()) // random password
            ]
        );

        Auth::login($user);

        return redirect()->intended('/home'); // hoặc dashboard
    }
}

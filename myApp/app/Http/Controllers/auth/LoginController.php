<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    // Đăng nhập
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
            if ($user->role_name === 'Admin' || $user->role_name === 'Staff') {
                return redirect()->intended('admin.dashboard'); // Admin
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
            'account_name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'role_id' => 2,
            'full_name' => $request->account_name,
            'account_name' => $request->account_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }

    //Logout
    public function logout(Request $request) {
        // Lấy role_id trước khi logout
        $roleId = $request->user() ? $request->user()->role_id : null;

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($roleId === 1 || $roleId === 3) {
            // Admin hoặc Staff
            return redirect()->route('login');
        } elseif ($roleId === 2) {
            // User thường
            return redirect()->route('homepage');
        }

        // Mặc định redirect homepage nếu không xác định được role
        return redirect()->route('homepage');
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
                'password' => bcrypt(uniqid())
            ]
        );

        Auth::login($user);

        return redirect()->intended('/homepages'); // hoặc dashboard
    }
}

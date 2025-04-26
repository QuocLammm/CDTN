<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //loggin
    public function showLogin() {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        // Lấy dữ liệu đã được validated từ LoginRequest
        $credentials = $request->validated();

        // Thử xác thực với email và mật khẩu
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('home');
        }

        // Kiểm tra xem email có tồn tại trong hệ thống không
        $user = User::where('email', $request->email)->first();

        // Nếu email tồn tại, thì lỗi là do mật khẩu sai
        if ($user) {
            return back()->withErrors([
                'password' => 'Mật khẩu không chính xác.',
            ])->onlyInput('email');
        }

        // Nếu email không tồn tại, thông báo lỗi
        return back()->withErrors([
            'email' => 'Email không chính xác.',
        ])->onlyInput('email');
    }

    //Register
    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
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
}

<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{

    // Hiển thị Form đổi mật khẩu
    public function showResetForm(Request $request, $token)
    {
        return view('auth.change-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }


    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'token.required' => 'Token không hợp lệ',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->setRememberToken(Str::random(60));
                $user->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            Auth::logout();
            return redirect()->route('login')->with('success', 'Bạn đã cập nhật mật khẩu thành công. Xin mời đăng nhập!');
        } else {
            return back()->withErrors(['email' => 'Email hoặc token không hợp lệ hoặc đã hết hạn']);
        }
    }


}

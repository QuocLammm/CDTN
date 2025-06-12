<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ChangePassword extends Controller
{

    protected $user;

    public function __construct()
    {
        Auth::logout();

        $id = intval(request()->id);
        $this->user = User::find($id);
    }

    public function show()
    {
        return view('auth.change-password');
    }

    public function getCaptcha()
    {
        $code = Str::upper(Str::random(6));
        Session::put('captcha_code', $code);

        $width = 150;
        $height = 40;
        $image = imagecreate($width, $height);

        // Màu nền và màu chữ
        $bgColor = imagecolorallocate($image, 255, 255, 255); // trắng
        $textColor = imagecolorallocate($image, 0, 0, 0);     // đen
        $noiseColor = imagecolorallocate($image, 100, 120, 180); // xanh nhạt

        // Thêm nhiễu chấm
        for ($i = 0; $i < 100; $i++) {
            imagesetpixel($image, rand(0, $width), rand(0, $height), $noiseColor);
        }

        // Thêm nhiễu đường cong
        for ($i = 0; $i < 3; $i++) {
            imageline($image, rand(0, $width), rand(0, $height),
                rand(0, $width), rand(0, $height), $noiseColor);
        }

        // Vẽ từng ký tự tại vị trí ngẫu nhiên
        for ($i = 0; $i < strlen($code); $i++) {
            $x = 10 + ($i * 22);
            $y = rand(5, 15);
            imagestring($image, 5, $x, $y, $code[$i], $textColor);
        }

        ob_start();
        imagepng($image);
        $imgData = ob_get_clean();

        $base64 = 'data:image/png;base64,' . base64_encode($imgData);

        return response()->json([
            'status' => true,
            'captcha' => $base64
        ]);
    }



    public function update(Request $request)
    {
        $request->validate([
            'captcha' => 'required|string',
            'email' => ['required'],
            'password' => ['required', 'min:5'],
            'confirm-password' => ['same:password']
        ]);

        if (strtoupper($request->input('captcha')) !== Session::get('captcha_code')) {
            return back()->withErrors(['captcha' => 'Mã CAPTCHA không đúng.'])->withInput();
        }

        $existingUser = User::where('email', $request->input('email'))->first();

        if ($existingUser) {
            $existingUser->update([
                'password' => $request->input('password'),
            ]);
            return redirect('login');
        } else {
            return back()->with('error', 'Email không khớp với yêu cầu đổi mật khẩu.');
        }
    }


//    public function update(Request $request)
//    {
//        $secretKey = Setting::where('key', 'recaptcha_secret_key')->value('value');
//
//        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
//            'secret' => $secretKey,
//            'response' => $request->input('g-recaptcha-response'),
//        ]);
//
//        $result = $response->json();
//
//        if (!($result['success'] ?? false)) {
//            return back()->withErrors(['g-recaptcha-response' => 'Xác minh reCAPTCHA không thành công. Vui lòng thử lại.'])->withInput();
//        }
//
//
//        $attributes = $request->validate([
//            'email' => ['required'],
//            'password' => ['required', 'min:5'],
//            'confirm-password' => ['same:password']
//        ]);
//
//        $existingUser = User::where('email', $attributes['email'])->first();
//        if ($existingUser) {
//            $existingUser->update([
//                'password' => $attributes['password']
//            ]);
//            return redirect('login');
//        } else {
//            return back()->with('error', 'Your email does not match the email who requested the password change');
//        }
//    }
}

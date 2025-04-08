<?php

use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\VNPayController;

//--Login--
Route::get('/login', function () {
    return view('pages.sign-up-static');
});

// Định nghĩa route logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); // Chuyển hướng về trang login sau khi logout
})->name('logout');

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Dashboard
Route::get('/home', function () {
    return view('pages.dashboard');
})->name('home');

// Profile
Route::get('/profile', function () {
    return view('pages.profile-static');
})->name('show-profile');

Route::get('/profile-static', function () {
    return view('pages.profile-static');
})->name('profile-static');

//Customer
Route::resource('/customer',CustomerController::class)->names('show-customer');

//Sản phẩm
Route::resource('/product', ProductController::class)->names('show-product');



// Route cho việc hiển thị các sản phẩm và thực hiện thanh toán (GET)
Route::get('/vnpay', [VNPayController::class, 'showPaymentPage'])->name('vnpay.payment.product');

// Route cho việc tạo thanh toán (POST)
Route::post('/vnpay', [VNPayController::class, 'createPayment'])->name('vnpay.createPayment');
// Route trả về sau khi thanh toán thành công hoặc thất bại
Route::get('/vnpay/return', [VNPayController::class, 'returnPayment'])->name('vnpay.return');

// Các route thành công và thất bại
Route::get('/vnpay/success', [VNPayController::class, 'paymentSuccess'])->name('vnpay.success');
Route::get('/vnpay/failure', [VNPayController::class, 'paymentFailure'])->name('vnpay.failure');




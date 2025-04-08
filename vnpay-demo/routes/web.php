<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\VNPayController;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
return view('welcome');
});

// Route cho việc hiển thị các sản phẩm và thực hiện thanh toán (GET)
Route::get('/vnpay', [VNPayController::class, 'showPaymentPage'])->name('vnpay.payment.product');

// Route cho việc tạo thanh toán (POST)
Route::post('/vnpay', [VNPayController::class, 'createPayment'])->name('vnpay.createPayment');
// Route trả về sau khi thanh toán thành công hoặc thất bại
Route::get('/vnpay/return', [VNPayController::class, 'returnPayment'])->name('vnpay.return');

// Các route thành công và thất bại
Route::get('/vnpay/success', [VNPayController::class, 'paymentSuccess'])->name('vnpay.success');
Route::get('/vnpay/failure', [VNPayController::class, 'paymentFailure'])->name('vnpay.failure');


Route::get('/contact', [ContactController::class, 'create'])->name('contact.form');
Route::post('/contact',[ContactController::class,'store'])->name('contact.submit');

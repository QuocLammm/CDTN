<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SaleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\VNPayController;

//Homepage
Route::get('/homepages', function () {
    return view('homepages.homepage');
});

// Chặn người đã đăng nhập truy cập login/register
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [LoginController::class, 'showRegister'])->name('register');
    Route::post('/register', [LoginController::class, 'register']);
});

// Chặn người chưa đăng nhập truy cập dashboard
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});


//Nhân viên
// Nhân viên




Route::middleware('auth')->group(function () {
    // Staff
    Route::resource('/staff', UserController::class)->names('show-staff');

    // Permission Admin + Staff
    Route::get('staff/{user}/permissions', [UserController::class, 'permissions'])->name('show-staff.permissions');
    Route::post('staff/{user}/permissions', [UserController::class, 'updatePermissions'])->name('update-staff.permissions');

    // Customer
    Route::resource('/customer',CustomerController::class)->names('show-customer');

    // Permission Customer
    Route::get('customer/{user}/permissions', [CustomerController::class, 'permissions'])->name('show-customer.permissions');
    Route::post('customer/{user}/permissions', [CustomerController::class, 'updatePermissions'])->name('update-customer.permissions');

    // Sản phẩm
    Route::resource('/product', ProductController::class)->names('show-product');

    // Khuyến mãi
    Route::resource('/permission', PermissionController::class)->names('show-permission');

    // Loại sản phẩm
    Route::resource('/category',CategoryController::class)->names('show-category');

    // Đơn hàng
    Route::resource('/order', OrderController::class)->names('show-order');

//Khuyến mãi
    Route::resource('/sale', SaleController::class)->names('show-sale');

// Route cho việc hiển thị các sản phẩm và thực hiện thanh toán (GET)
    Route::get('/vnpay', [VNPayController::class, 'showPaymentPage'])->name('vnpay.payment.product');

// Route cho việc tạo thanh toán (POST)
    Route::post('/vnpay', [VNPayController::class, 'createPayment'])->name('vnpay.createPayment');
// Route trả về sau khi thanh toán thành công hoặc thất bại
    Route::get('/vnpay/return', [VNPayController::class, 'returnPayment'])->name('vnpay.return');

// Các route thành công và thất bại
    Route::get('/vnpay/success', [VNPayController::class, 'paymentSuccess'])->name('vnpay.success');
    Route::get('/vnpay/failure', [VNPayController::class, 'paymentFailure'])->name('vnpay.failure');
});


//Settings
Route::get('/settings', function () {
    return view('pages.settings');
})->name('settings');


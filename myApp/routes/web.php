<?php

use App\Http\Controllers\admin\AccountController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SaleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\auth\HomePageController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\VNPayController;


Route::get('/homepages', [HomePageController::class, 'index'])->name('home');
Route::get('/profile/{id}', [HomePageController::class, 'showProfile'])->name('profile-user');
//Route::get('/product/{id}', [HomePageController::class, 'show'])->name('product.show');

// Chặn người đã đăng nhập truy cập login/register
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [LoginController::class, 'showRegister'])->name('register');
    Route::post('/register', [LoginController::class, 'register']);
});

// Chặn người chưa đăng nhập truy cập dashboard
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});


Route::middleware('auth')->group(function () {
    // Staff
    Route::resource('/staff', UserController::class)->names('show-staff');
//    Route::get('/reset-password', [UserController::class, 'resetPassword'])->name('reset-password');

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
    Route::get('/api/qr-code/{productId}', [ProductController::class, 'getQrCode']);

    // Khuyến mãi
    Route::resource('/permission', PermissionController::class)->names('show-permission');

    // Loại sản phẩm
    Route::resource('/category',CategoryController::class)->names('show-category');

    // Đơn hàng
    Route::resource('/order', OrderController::class)->names('show-order');

    //Khuyến mãi
    Route::resource('/sale', SaleController::class)->names('show-sale');

    //Account
    Route::resource('/profile', AccountController::class)->names('show-profile');

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




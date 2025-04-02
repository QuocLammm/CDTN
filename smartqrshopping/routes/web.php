<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\admin\DashboardController;
use \App\Http\Controllers\admin\UserController;
use \App\Http\Controllers\admin\CategoriesController;
use \App\Http\Controllers\admin\ProductController;

use \App\Http\Controllers\admin\RoleController;
use \App\Http\Controllers\admin\StaticController;
use \App\Http\Controllers\admin\CustomerController;
use \App\Http\Controllers\admin\OrderController;
use \App\Http\Controllers\admin\SaleController;

//Test - login
Route::get('/login', function () {
    return view('login.login');
});

//Homegpage -Users
Route::get('/homepage', function () {
    return view('homepages.homepage');
});

// Dashboard
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

//Khách hàng
Route::resource('customer', CustomerController::class)->except(['show']);

// Nhân viên
Route::resource('staff', UserController::class)->except(['show']);

//Categories
Route::resource('categories', CategoriesController::class)->except(['show']);

//Product
Route::resource('products', ProductController::class)->except(['show']);

//Phân quyền
Route::resource('roles', RoleController::class)->except(['show']);

//Thống kê
Route::prefix('statics')->group(function () {
    Route::get('/index', [StaticController::class, 'index'])->name('statics.index');
});

//Đơn hàng
Route::resource('orders', OrderController::class)->except(['show']);
// Khuyến mãi
Route::prefix('sales')->group(function () {
    Route::get('/index', [SaleController::class, 'index'])->name('sales.index');
});

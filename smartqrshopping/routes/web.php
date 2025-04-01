<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\admin\DashboardController;
use \App\Http\Controllers\admin\UserController;
use \App\Http\Controllers\admin\CategoriesController;
use \App\Http\Controllers\admin\ProductController;
use \App\Http\Controllers\admin\FaqController;
use \App\Http\Controllers\admin\RoleController;
use \App\Http\Controllers\admin\StaticController;
use \App\Http\Controllers\admin\CustomerController;
use \App\Http\Controllers\admin\OrderController;
use \App\Http\Controllers\admin\SaleController;

//Test - login
Route::get('/', function () {
    return view('welcome');
});

//Homegpage -Users
Route::get('/homepage', function () {
    return view('users.homepage');
});

// Dashboard
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

// Khách hàng
Route::prefix('customer')->group(function () {
    Route::get('/index', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::post('/store', [CustomerController::class, 'store'])->name('customer.store');
    Route::put('/update/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
});

// Nhân viên
Route::prefix('staff')->group(function () {
    Route::get('/index', [UserController::class, 'index'])->name('staff.index');
    Route::get('/create', [UserController::class, 'create'])->name('staff.create');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('staff.edit');
    Route::post('/store', [UserController::class, 'store'])->name('staff.store');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('staff.update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('staff.destroy');
    Route::post('/checkmail', [UserController::class, 'checkEmail'])->name('staff.checkmail');
});

//Categories
Route::prefix('categories')->group(function () {
    Route::get('/index', [CategoriesController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoriesController::class, 'create'])->name('categories.create');
    Route::get('/edit/{id}', [CategoriesController::class, 'edit'])->name('categories.edit');
    Route::post('/store', [CategoriesController::class, 'store'])->name('categories.store'); // Đã sửa tên
    Route::put('/update/{id}', [CategoriesController::class, 'update'])->name('categories.update'); // Đã sửa tên
    Route::delete('/destroy/{id}', [CategoriesController::class, 'destroy'])->name('categories.destroy'); // Thêm route cho destroy
});

//Product
Route::prefix('products')->group(function () {
    Route::get('/index', [ProductController::class, 'index'])->name('products.index');
    Route::get('/{id}/qr', [ProductController::class, 'showQRCode'])->name('products.qr');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/store', [ProductController::class, 'store'])->name('products.store'); // Đã sửa tên
    Route::put('/update/{id}', [ProductController::class, 'update'])->name('products.update'); // Đã sửa tên
    Route::delete('/destroy/{id}', [ProductController::class, 'destroy'])->name('products.destroy'); // Thêm route cho destroy
});

//FAQ
Route::prefix('faqs')->group(function () {
    Route::get('/index', [FaqController::class, 'index'])->name('faqs.index');

});

//Phân quyền
Route::prefix('roles')->group(function () {
    Route::get('/index', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
    Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/store', [RoleController::class, 'store'])->name('roles.store');
    Route::put('/update/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/destroy/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
});

//Thống kê
Route::prefix('statics')->group(function () {
    Route::get('/index', [StaticController::class, 'index'])->name('statics.index');
});

//Đơn hàng
Route::prefix('orders')->group(function () {
    Route::get('/index', [OrderController::class, 'index'])->name('orders.index');
});
// Khuyến mãi
Route::prefix('sales')->group(function () {
    Route::get('/index', [SaleController::class, 'index'])->name('sales.index');
});

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

Route::get('/', function () {
    return view('welcome');
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
});

//FAQ
Route::prefix('faqs')->group(function () {
    Route::get('/index', [FaqController::class, 'index'])->name('faqs.index');
});

//Phân quyền
Route::prefix('roles')->group(function () {
    Route::get('/index', [RoleController::class, 'index'])->name('roles.index');
});

//Thống kê
Route::prefix('statics')->group(function () {
    Route::get('/index', [StaticController::class, 'index'])->name('statics.index');
});

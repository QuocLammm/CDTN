<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\admin\DashboardController;
use \App\Http\Controllers\admin\UserController;
use \App\Http\Controllers\admin\CategoriesController;
use \App\Http\Controllers\admin\ProductController;
use \App\Http\Controllers\admin\FaqController;
use \App\Http\Controllers\admin\RoleController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

Route::prefix('customer')->group(function () {
    Route::get('/index', [UserController::class, 'index'])->name('customer.index');
    Route::get('/create', [UserController::class, 'create'])->name('customer.create');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('customer.edit');
    Route::post('/store', [UserController::class, 'store'])->name('customer.store');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('customer.update');
    Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('customer.destroy');

});

//Categories
Route::prefix('categories')->group(function () {
    Route::get('/index', [CategoriesController::class, 'index'])->name('categories.index');

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

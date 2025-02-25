<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\admin\DashboardController;
use \App\Http\Controllers\admin\CustomerController;
use \App\Http\Controllers\admin\CategoriesController;
use \App\Http\Controllers\admin\ProductController;
use \App\Http\Controllers\admin\FaqController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

Route::prefix('customer')->group(function () {
    Route::get('/index', [CustomerController::class, 'index'])->name('customer.index');
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

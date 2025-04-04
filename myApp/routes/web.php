<?php

use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('profile');
})->name('show-profile');

//Sản phẩm
Route::resource('product', ProductController::class);

Route::get('/profile-static', function () {
    return view('pages.profile-static');
})->name('profile-static');

Route::get('/{page}', function ($page) {
    return view("pages.$page");
})->where('page', 'user-management|tables|billing')->name('page');

// User Management
Route::get('/user-management', function () {
    return view('pages.user-management');
})->name('user-management');

// Tables
Route::get('/tables', function () {
    return view('pages.tables');
})->name('tables');

// Billing
Route::get('/billing', function () {
    return view('pages.billing');
})->name('billing');

// Virtual Reality
Route::get('/virtual-reality', function () {
    return view('pages.virtual-reality');
})->name('virtual-reality');

// RTL
Route::get('/rtl', function () {
    return view('pages.rtl');
})->name('rtl');

// Sign In
Route::get('/sign-in', function () {
    return view('pages.sign-in');
})->name('sign-in-static');

// Sign Up
Route::get('/sign-up', function () {
    return view('pages.sign-up');
})->name('sign-up-static');


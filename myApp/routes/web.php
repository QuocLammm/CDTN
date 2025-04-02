<?php

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

Route::get('/profile-static', function () {
    return view('profile-static');
})->name('profile-static');

// User Management
Route::get('/user-management', function () {
    return view('user-management');
})->name('page')->defaults('page', 'user-management');

// Tables
Route::get('/tables', function () {
    return view('tables');
})->name('page')->defaults('page', 'tables');

// Billing
Route::get('/billing', function () {
    return view('billing');
})->name('page')->defaults('page', 'billing');

// Virtual Reality
Route::get('/virtual-reality', function () {
    return view('virtual-reality');
})->name('virtual-reality');

// RTL
Route::get('/rtl', function () {
    return view('rtl');
})->name('rtl');

// Sign In
Route::get('/sign-in', function () {
    return view('auth.sign-in');
})->name('sign-in-static');

// Sign Up
Route::get('/sign-up', function () {
    return view('auth.sign-up');
})->name('sign-up-static');


<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

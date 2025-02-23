<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Hiển thị trang bắt đầu đăng nhập vào admin
    public function index()
    {
        return view('admin.dashboard.index');
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Hiển thị trang bắt đầu đăng nhập vào admin
    public function index()
    {
        // Lấy 3 nhân viên mới nhất
        $recentStaff = Users::whereIn('RoleID', [1, 3])
            ->orderBy('CreatedAt', 'desc')
            ->take(3)
            ->get();
        return view('admin.dashboard.index', compact('recentStaff'));
    }
}

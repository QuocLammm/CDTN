<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|object
     */
    public function index()
    {
        // Lấy số lượng đơn hàng đang chờ xử lý cho tất cả khách hàng
        $pendingOrdersCount = Order::whereHas('user', function($query) {
            $query->whereHas('role', function($query) {
                $query->where('role_name', 'Customer'); // Kiểm tra tên vai trò
            });
        })->where('status', 'Pending')->count();

        // Lấy danh sách thông báo đơn hàng cho tất cả khách hàng
        $notifications = Order::whereHas('user', function($query) {
            $query->whereHas('role', function($query) {
                $query->where('role_name', 'Customer'); // Kiểm tra tên vai trò
            });
        })->where('status', 'pending')->get();
        if ($notifications->isNotEmpty()) {
            $message = 'Có thông báo mới!';
        }
//        dd($pendingOrdersCount,$notifications);
        return view('pages.dashboard', compact('pendingOrdersCount', 'notifications', 'message'));
    }


}

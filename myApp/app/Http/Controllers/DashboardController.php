<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Order;
use App\Models\View;
use Carbon\Carbon;
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
        // Card - 1
        $doanhThuHomNay = Order::whereDate('created_at', Carbon::today())
            ->where('status', 'Success')
            ->sum('total_amount');

        // Doanh thu hôm qua
        $doanhThuHomQua = Order::whereDate('created_at', Carbon::yesterday())
            ->where('status', 'Success')
            ->sum('total_amount');

        // Tính phần trăm tăng/giảm
        if ($doanhThuHomQua > 0) {
            $phanTramThayDoi = (($doanhThuHomNay - $doanhThuHomQua) / $doanhThuHomQua) * 100;
        } else {
            $phanTramThayDoi = $doanhThuHomNay > 0 ? 100 : 0;
        }

        // Card- 3
        $today = Carbon::today()->toDateString();

        // Số khách hôm nay
        $todayViews = View::where('view_date', $today)->value('total_views') ?? 0;

        // Tổng khách tháng này
        $currentMonthViews = View::whereYear('view_date', Carbon::now()->year)
            ->whereMonth('view_date', Carbon::now()->month)
            ->sum('total_views');

        // Tổng khách tháng trước
        $previousMonthViews = View::whereYear('view_date', Carbon::now()->subMonth()->year)
            ->whereMonth('view_date', Carbon::now()->subMonth()->month)
            ->sum('total_views');

        // Tính phần trăm tăng giảm
        if ($previousMonthViews == 0) {
            $percentChange = $currentMonthViews > 0 ? 100 : 0;
        } else {
            $percentChange = (($currentMonthViews - $previousMonthViews) / $previousMonthViews) * 100;
        }


        // Card - 4
        // Đơn hàng tháng này
        $donHangThangNay = Order::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Đơn hàng tháng trước
        $donHangThangTruoc = Order::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();

        // Tính phần trăm thay đổi
        if ($donHangThangTruoc > 0) {
            $phanTramDonHang = (($donHangThangNay - $donHangThangTruoc) / $donHangThangTruoc) * 100;
        } else {
            $phanTramDonHang = $donHangThangNay > 0 ? 100 : 0;
        }

        return view('pages.dashboard', compact(
            'doanhThuHomNay',
            'phanTramThayDoi',
            'donHangThangNay',
            'phanTramDonHang',
            'todayViews',
            'percentChange'
        ));
    }




}

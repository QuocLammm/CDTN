<?php

namespace App\View\Composers;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\ViewPage;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
class DashboardComposer
{
    public function compose(View $view)
    {
        $year = Carbon::now()->year;
        $lastYear = $year - 1;

        // Doanh thu hôm nay
        $doanhThuHomNay = Order::whereDate('created_at', Carbon::today())
            ->where('status', 'Success')
            ->sum('total_amount');

        // Doanh thu hôm qua
        $doanhThuHomQua = Order::whereDate('created_at', Carbon::yesterday())
            ->where('status', 'Success')
            ->sum('total_amount');

        $phanTramThayDoi = ($doanhThuHomQua > 0)
            ? (($doanhThuHomNay - $doanhThuHomQua) / $doanhThuHomQua) * 100
            : ($doanhThuHomNay > 0 ? 100 : 0);

        // Lượt truy cập hôm nay và hôm qua
        $today = Carbon::today()->toDateString();
        $yesterday = Carbon::yesterday()->toDateString();

        $todayViews = ViewPage::where('view_date', $today)->value('total_views') ?? 0;
        $yesterdayViews = ViewPage::where('view_date', $yesterday)->value('total_views') ?? 0;

        $percentChangeViews = ($yesterdayViews == 0)
            ? ($todayViews > 0 ? 100 : 0)
            : (($todayViews - $yesterdayViews) / $yesterdayViews) * 100;

        // Đơn hàng tháng này và tháng trước
        $donHangThangNay = Order::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', $year)
            ->count();

        $donHangThangTruoc = Order::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();

        $phanTramDonHang = ($donHangThangTruoc > 0)
            ? (($donHangThangNay - $donHangThangTruoc) / $donHangThangTruoc) * 100
            : ($donHangThangNay > 0 ? 100 : 0);

        // Doanh thu từng tháng năm hiện tại
        $monthlyRevenue = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_amount) as total')
        )
            ->whereYear('created_at', $year)
            ->where('status', 'Success')
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->get();

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthData = $monthlyRevenue->firstWhere('month', $i);
            $data[$i] = $monthData ? (float) $monthData->total : 0;
        }

        $totalCurrentYear = array_sum($data);

        $totalLastYear = Order::whereYear('created_at', $lastYear)
            ->where('status', 'Success')
            ->sum('total_amount');

        $percentChangeRevenue = ($totalLastYear > 0)
            ? (($totalCurrentYear - $totalLastYear) / $totalLastYear) * 100
            : 0;

        $view->with([
            'doanhThuHomNay' => $doanhThuHomNay,
            'phanTramThayDoi' => $phanTramThayDoi,
            'donHangThangNay' => $donHangThangNay,
            'phanTramDonHang' => $phanTramDonHang,
            'todayViews' => $todayViews,
            'percentChangeViews' => $percentChangeViews,
            'monthlyRevenueData' => $data,
            'percentChangeRevenue' => $percentChangeRevenue,
            'year' => $year,
        ]);
    }
}

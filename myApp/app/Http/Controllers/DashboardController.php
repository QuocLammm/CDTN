<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Notification;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\User;
use App\Models\ViewPage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        // Card- 2
        // Ngày hôm nay
        $today = Carbon::today()->toDateString();

        // Ngày hôm qua
        $yesterday = Carbon::yesterday()->toDateString();

        // Số khách hôm nay
        $todayViews = ViewPage::where('view_date', $today)->value('total_views') ?? 0;

        // Số khách hôm qua
        $yesterdayViews = ViewPage::where('view_date', $yesterday)->value('total_views') ?? 0;

        // Tính phần trăm tăng giảm so với ngày hôm qua
        if ($yesterdayViews == 0) {
            $percentChangeViews = $todayViews > 0 ? 100 : 0;
        } else {
            $percentChangeViews = (($todayViews - $yesterdayViews) / $yesterdayViews) * 100;
        }

        // Card - 3
        // Khách hàng mới tháng này
        $khachHangThangNay = User::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        // Khách hàng mới tháng trước
        $khachHangThangTruoc = User::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();

        // Tính phần trăm thay đổi so với tháng trước
        if ($khachHangThangTruoc > 0) {
            $phanTramKhachHang = (($khachHangThangNay - $khachHangThangTruoc) / $khachHangThangTruoc) * 100;
        } else {
            $phanTramKhachHang = $khachHangThangNay > 0 ? 100 : 0;
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

        // Chart - Doanh số bán hàng trong năm
        $year = Carbon::now()->year;
        $lastYear = $year - 1;

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

        // Tạo mảng tháng => doanh thu (nếu không có tháng nào thì 0)
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthData = $monthlyRevenue->firstWhere('month', $i);
            $data[$i] = $monthData ? (float) $monthData->total : 0;
        }

        // Tổng doanh thu năm hiện tại
        $totalCurrentYear = array_sum($data);

        // Tổng doanh thu năm trước
        $totalLastYear = Order::whereYear('created_at', $lastYear)
            ->where('status', 'Success')
            ->sum('total_amount');

        // Tính phần trăm thay đổi doanh thu năm nay so với năm trước
        if ($totalLastYear > 0) {
            $percentChangeRevenueYear = (($totalCurrentYear - $totalLastYear) / $totalLastYear) * 100;
        } else {
            $percentChangeRevenueYear = 0;
        }

        // Chart - Thống kê đánh giá/phản hồi của khách lên sản phẩm
        $datas = ProductReview::selectRaw('product_id, COUNT(*) as review_count, AVG(rating) as avg_rating')
            ->groupBy('product_id')
            ->with('product')
            ->get();

        $labels = [];
        $ratings = [];
        $counts = [];

        foreach ($datas as $item) {
            $labels[] = $item->product->product_name ?? 'Không rõ';
            $ratings[] = round($item->avg_rating, 1);
            $counts[] = $item->review_count;
        }

        // Doanh thu theo 4 nhân viên cao nhất
        $now = Carbon::now();
        $currentMonth = $now->format('m');
        $lastMonth = $now->copy()->subMonth()->format('m');

        // Doanh thu tháng hiện tại
        $currentRevenue = DB::table('orders')
            ->where('status', 'Success')
            ->whereMonth('created_at', $currentMonth)
            ->select('staff_id',DB::raw('COUNT(*) as orders_count'), DB::raw('SUM(total_amount) as total_revenue'))
            ->groupBy('staff_id')
            ->orderByDesc('total_revenue')
            ->limit(4)
            ->get();

        // Lấy danh sách staff_id
        $staffIds = $currentRevenue->pluck('staff_id')->toArray();

        // Doanh thu tháng trước
        $lastRevenue = DB::table('orders')
            ->where('status', 'Success')
            ->whereMonth('created_at', $lastMonth)
            ->whereIn('staff_id', $staffIds)
            ->select('staff_id', DB::raw('COUNT(*) as orders_count'),DB::raw('SUM(total_amount) as total_revenue'))
            ->groupBy('staff_id')
            ->get()
            ->keyBy('staff_id');

        // Lấy thông tin nhân viên
        $staffs = User::whereIn('user_id', $staffIds)->get()->keyBy('user_id');

        // Gộp dữ liệu + tính % tăng/giảm
        $revenuePerStaff = $currentRevenue->map(function ($item) use ($lastRevenue, $staffs) {
            $last = $lastRevenue->get($item->staff_id);
            $lastAmount = $last ? $last->total_revenue : 0;

            $changePercent = $lastAmount > 0
                ? round((($item->total_revenue - $lastAmount) / $lastAmount) * 100, 2)
                : null;

            $item->change_percent = $changePercent;
            $item->staff = $staffs->get($item->staff_id);

            return $item;
        });

        // Ghi Logs
        $logs = ActivityLog::latest()->take(5)->get();


        return view('pages.dashboard', compact(
            'doanhThuHomNay',
            'phanTramThayDoi',
            'khachHangThangNay',
            'phanTramKhachHang',
            'donHangThangNay',
            'phanTramDonHang',
            'todayViews',
            'percentChangeViews',
            'data',
            'percentChangeRevenueYear',
            'year',
            'revenuePerStaff',
            'logs',
            'labels',
            'ratings',
            'counts',
        ));
    }



}

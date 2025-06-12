<?php

use App\Exports\ContactsExport;
use App\Http\Controllers\admin\AccountController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\DiscountController;
use App\Http\Controllers\admin\NotificationController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SupplierController;
use App\Http\Controllers\auth\ForgotPasswordController;
use App\Http\Controllers\auth\ProductDetailController;
use App\Http\Controllers\admin\SaleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\auth\CartController;
use App\Http\Controllers\auth\HomePageController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\ResetPasswordController;
use App\Http\Controllers\auth\WishListController;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
use App\Models\Contact;
use App\Models\Notification;
use App\Models\Order;
use App\Models\User;
use App\Models\ViewPage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\VNPayController;
use Maatwebsite\Excel\Facades\Excel;


Route::get('/homepages', [HomePageController::class, 'index'])->name('homepage');// Trang chủ
Route::get('/showProduct',[HomePageController::class, 'showProduct'])->name('showProduct');// Hiển thị sản phẩm ở trang chủ
Route::get('/products/all/{category_id}', [HomePageController::class, 'viewAll'])->name('products.all'); // Xem all sản phẩm theo từng danh mục
Route::get('/products/all/', [HomePageController::class, 'viewAllProduct'])->name('products.all_products'); // Xem all sản phẩm
Route::get('/load-more-products', [HomePageController::class, 'loadMore'])->name('products.loadMore'); // Load More
Route::get('/search', [ProductController::class, 'search'])->name('product.search');// Tìm kiểm sản phẩm
Route::get('/product/{id}', [ProductDetailController::class, 'show'])->name('product.show'); // Hiển thị chi tiết sản phẩm
Route::get('/contact', [HomePageController::class, 'showContact'])->name('contact.index');// Show contact
Route::post('/contact/send', [HomePageController::class, 'send'])->name('contact.send'); // Contact Send

Route::get('/api/captcha', [ChangePassword::class, 'getCaptcha']);

// Gửi đăng ký mã sale
Route::post('/newsletter', [HomePageController::class, 'subscribe'])->name('newsletter.subscribe');



Route::post('/wishlist/toggle/{product_id}', [HomePageController::class, 'toggle'])->name('wishlist.toggle');

// About Us
Route::get('/about-us', [HomePageController::class, 'showAboutUs'])->name('about');
Route::get('/doi-tac', function () {
    return view('homepages.auth.partners');
})->name('partners');

Route::get('/chinh-sach', function () {
    return view('homepages.auth.policy');
})->name('policy');

Route::get('/bao-hanh', function () {
    return view('homepages.auth.warranty');
})->name('warranty');


Route::put('/profile/{id}', [HomePageController::class, 'updateProfile'])->name('profile.update');


// Giỏ hàng User session
Route::get('/cart-user', [HomePageController::class, 'showCart'])->name('cart-user');

// Giỏ hàng khi đăng nhập
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.cart');
    Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');// Mua trong giỏ hàng
    Route::get('/buy-now/{id}', [CartController::class, 'buyNow'])->name('buy.now'); // Mua ngay trong chi tiết sản phẩm
    Route::post('/cancel-order', [CartController::class, 'cancelOrder'])->name('cancel.order');

    Route::get('/vnpay/checkout', [VNPayController::class, 'createPayment'])->name('vnpay.checkout'); // Thanh toán bằng VNpay

    Route::post('/process', [CartController::class, 'confirm'])->name('order.process');

    // Profile User
    Route::get('/profile/{id}', [HomePageController::class, 'showProfile'])->name('profile-user');

    // load More Đơn hàng
    Route::get('/orders/load-more', [HomePageController::class, 'loadMore'])->name('orders.loadMore');

    // Hiển thị page yêu thích
    Route::get('/wishlist', [WishListController::class, 'showWishList'])->name('wishlist.show');
    Route::delete('/wishlist/remove/{wishlist_id}', [WishListController::class, 'remove'])->name('wishlist.remove');


    Route::post('/apply-voucher', [CartController::class, 'applyVoucher'])->name('apply.voucher');
});

// Đăng nhập bằng GG
Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [loginController::class, 'handleGoogleCallback']);

// Quên mật khẩu và cập nhật mật khẩu
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request'); // Form nhập email
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email'); // Gửi mail chứa link khôi phục
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset'); // Form đặt lại mật khẩu (khi nhấn vào link trong email)
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update'); // Xử lý cập nhật mật khẩu mới


// Chặn người đã đăng nhập truy cập login/register
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [LoginController::class, 'showRegister'])->name('register');
    Route::post('/register', [LoginController::class, 'register']);

});

// Đăng xuất
Route::middleware('auth')->group(function () {
    // Đăng xuất
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

    // Trang quản trị
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
    Route::get('/navbar', [DashboardController::class, 'showNavbar'])->name('show.navbar');
    // Staff
    Route::resource('/staff', UserController::class)->names('show-staff');
    //Route::get('/reset-password', [UserController::class, 'resetPassword'])->name('reset-password');

    // Permission Admin + Staff
    Route::get('staff/{user}/permissions', [UserController::class, 'permissions'])->name('show-staff.permissions');
    Route::post('staff/{user}/permissions', [UserController::class, 'updatePermissions'])->name('update-staff.permissions');

    // Customer
    Route::resource('/customer',CustomerController::class)->names('show-customer');

    // Permission Customer
    Route::get('customer/{user}/permissions', [CustomerController::class, 'permissions'])->name('show-customer.permissions');
    Route::post('customer/{user}/permissions', [CustomerController::class, 'updatePermissions'])->name('update-customer.permissions');

    // Sản phẩm
    Route::resource('/product', ProductController::class)->names('show-product');
    Route::get('/qr-code/{id}', [ProductController::class, 'getQrCode']);
    Route::delete('/product-images/{id}', [ProductController::class, 'destroyImage']);

    // Phân quyền
    Route::resource('/permission', PermissionController::class)->names('show-permission');

    // Nhà cung cấp
    Route::resource('/suppliers', SupplierController::class)->names('show-supplier');
    // Loại sản phẩm
    Route::resource('/category',CategoryController::class)->names('show-category');

    // Đơn hàng
    Route::resource('/order', OrderController::class)->names('show-order');

    // Khuyến mãi
    Route::resource('/sale', SaleController::class)->names('show-sale');
    Route::resource('/discounts', DiscountController::class)->names('show-discount');

    // Liên hệ
    Route::get('/contacts', [ContactController::class, 'index'])->name('admin.contact.index');
    Route::get('/contacts/{id}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
    Route::post('/contacts/{id}/reply', [ContactController::class, 'reply'])->name('contacts.reply');


    //Account
    Route::resource('/profile', AccountController::class)->names('show-profile');

    // Thông báo
    Route::resource('/notification', NotificationController::class)->names('show-notification');
    Route::get('/notification/unread-count', function () {
        $userId = Auth::id();

        $count = \App\Models\Notification::where('status', 0)
            ->where('user_id', $userId)
            ->count();

        return response()->json(['count' => $count]);
    });

    // Cài đặt
    Route::get('/settings', [SettingController::class, 'index'])->name('admin.setting.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('admin.setting.update');


// Route cho việc hiển thị các sản phẩm và thực hiện thanh toán (GET)
    Route::get('/vnpay', [VNPayController::class, 'showPaymentPage'])->name('vnpay.payment.product');

// Route cho việc tạo thanh toán (POST)
    Route::post('/vnpay', [VNPayController::class, 'createPayment'])->name('vnpay.createPayment');
// Route trả về sau khi thanh toán thành công hoặc thất bại
    Route::get('/vnpay/return', [VNPayController::class, 'returnPayment'])->name('vnpay.return');

// Các route thành công và thất bại
    Route::get('/vnpay/success', [VNPayController::class, 'paymentSuccess'])->name('vnpay.success');
    Route::get('/vnpay/failure', [VNPayController::class, 'paymentFailure'])->name('vnpay.failure');
});

// API đếm số thông báo
Route::get('/api/notifications', function () {
    $notifications = Notification::with('user.orders') // Lấy thông tin user và orders
    ->latest()
        ->take(3)
        ->get();

    $pendingOrdersCount = Notification::where('status', 0)->count(); // Đếm số thông báo chưa đọc

    return response()->json([
        'count' => $pendingOrdersCount,
        'notifications' => $notifications,
    ]);
});

//// API 4 card dashboard
//Route::get('/dashboard-data', function () {
//    // Card - 1: Doanh thu hôm nay và phần trăm thay đổi
//    $doanhThuHomNay = Order::whereDate('created_at', Carbon::today())
//        ->where('status', 'Success')
//        ->sum('total_amount');
//
//    $doanhThuHomQua = Order::whereDate('created_at', Carbon::yesterday())
//        ->where('status', 'Success')
//        ->sum('total_amount');
//
//    if ($doanhThuHomQua > 0) {
//        $phanTramThayDoi = (($doanhThuHomNay - $doanhThuHomQua) / $doanhThuHomQua) * 100;
//    } else {
//        $phanTramThayDoi = $doanhThuHomNay > 0 ? 100 : 0;
//    }
//
//    // Card - 3: Lượng truy cập hôm nay + phần trăm thay đổi tháng
//    $today = Carbon::today()->toDateString();
//
//    $todayViews = ViewPage::where('view_date', $today)->value('total_views') ?? 0;
//
//    $currentMonthViews = ViewPage::whereYear('view_date', Carbon::now()->year)
//        ->whereMonth('view_date', Carbon::now()->month)
//        ->sum('total_views');
//
//    $previousMonthViews = ViewPage::whereYear('view_date', Carbon::now()->subMonth()->year)
//        ->whereMonth('view_date', Carbon::now()->subMonth()->month)
//        ->sum('total_views');
//
//    if ($previousMonthViews == 0) {
//        $percentChange = $currentMonthViews > 0 ? 100 : 0;
//    } else {
//        $percentChange = (($currentMonthViews - $previousMonthViews) / $previousMonthViews) * 100;
//    }
//
//    // Card - 4: Đơn hàng tháng này + phần trăm thay đổi
//    $donHangThangNay = Order::whereMonth('created_at', Carbon::now()->month)
//        ->whereYear('created_at', Carbon::now()->year)
//        ->count();
//
//    $donHangThangTruoc = Order::whereMonth('created_at', Carbon::now()->subMonth()->month)
//        ->whereYear('created_at', Carbon::now()->subMonth()->year)
//        ->count();
//
//    if ($donHangThangTruoc > 0) {
//        $phanTramDonHang = (($donHangThangNay - $donHangThangTruoc) / $donHangThangTruoc) * 100;
//    } else {
//        $phanTramDonHang = $donHangThangNay > 0 ? 100 : 0;
//    }
//
//    return response()->json([
//        'doanhThuHomNay' => $doanhThuHomNay,
//        'phanTramThayDoi' => round($phanTramThayDoi, 1),
//
//        'todayViews' => $todayViews,
//        'percentChangeViews' => round($percentChange, 1),
//
//        'donHangThangNay' => $donHangThangNay,
//        'phanTramDonHang' => round($phanTramDonHang, 1),
//    ]);
//});

// Trả về số lượng liên hệ để fetch
Route::get('/admin/unread-contacts-count', function () {
    return response()->json([
        'count' => Contact::where('status', 'unread')->count()
    ]);
})->name('admin.unread-contacts-count')->middleware('auth');

// Trả về số lượng thông báo để fetch
Route::get('/admin/unread-notification-count', function () {
    return response()->json([
        'count' => Notification::where('status', 0)->count()
    ]);
})->name('admin.unread-notification-count')->middleware('auth');

Route::post('/upload-image', function(Request $request) {
    $file = $request->file('upload');
    $filename = time() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('uploads'), $filename);
    return response()->json([
        'url' => asset('uploads/' . $filename)
    ]);
})->name('upload.image');


// web.php
Route::post('/products/{product}/review', [ProductDetailController::class, 'store'])
    ->name('product.review.store')
    ->middleware('auth');

// Xuất file CSV
Route::get('/contacts/export', function () {
    return Excel::download(new ContactsExport, 'danh_sach_lien_he.xlsx');
})->name('contacts.export');

// Done hàng cho khách
Route::post('/orders/{id}/done', [OrderController::class, 'markAsDone']);

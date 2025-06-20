<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\homepage\ContactRequest;
use App\Http\Requests\homepage\ProfileRequest;
use App\Mail\PromoCodeMail;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Discount;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Setting;
use App\Models\User;
use App\Models\ViewPage;
use App\Models\WishList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class HomePageController extends Controller
{
    public function index()
    {
        // Chỉ lấy sản phẩm đang giảm giá
        $products = Product::where('is_sale', true)
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->get();

        // Lấy tất cả danh mục với products và images
        $categories = Category::with(['products.images'])->get();


        // Lấy danh sách yêu thích của user (nếu đăng nhập)
        $wishlistProductIds = [];
        if (auth()->check()) {
            $wishlistProductIds = Wishlist::where('user_id', auth()->id())
                ->pluck('product_id')
                ->toArray();
        }

        // Lượt truy cập web hôm nay
        $today = Carbon::today()->toDateString();
        if (!session()->has('view_counted_today')) {
            $view = ViewPage::firstOrCreate(
                ['view_date' => $today],
                ['total_views' => 0]
            );
            $view->increment('total_views');
            session(['view_counted_today' => true]);
        }

        // Lấy riêng sản phẩm thuộc danh mục "Giày nữ"
        $shoes = Product::whereHas('category', function ($query) {
            $query->where(function ($q) {
                $q->where('product_name', 'like', '%nữ%');
//                    ->orWhere('category_name', 'like', '%nữ%');
            });
        })
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->with('images')
            ->get();

        // Trả dữ liệu sang view, thêm $shoesProducts
        return view('homepages.homepage', compact('categories', 'products', 'wishlistProductIds', 'today','shoes'));
    }


    // Profile User
    public function showProfile($id)
    {
        $user = User::findOrFail($id);
        // Lấy danh sách đơn hàng của user (giả sử có quan hệ orders)
        $orders = Order::with('items.product')->where('user_id', $id)->latest()->get();

        // Lấy đánh giá của user này
        $reviews = ProductReview::with('product') // nếu có quan hệ product()
        ->where('user_id', $id)
            ->latest()
            ->get();
        return view('homepages.profile', compact('user', 'orders', 'reviews'));
    }

    // Cập nhật Profile
    public function updateProfile(ProfileRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validated();
        $user->update($data);

        return redirect()->back()->with('success', 'Cập nhật hồ sơ thành công!');
    }

    // Giỏ hàng tạm thời
    public function showCart()
    {
        $cart = session()->get('cart', []);
        return view('homepages.guest.cart', compact('cart'));
    }


    // Load More đơn hàng
    public function loadMore(Request $request)
    {
        $page = $request->query('page', 1);
        $perPage = 4;

        $orders = Order::with('items.product.images')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        if ($orders->isEmpty()) {
            return response()->json(['html' => '']);
        }

        $html = '';
        foreach ($orders as $order) {
            $html .= view('partials.order-card', compact('order'))->render();
        }

        return response()->json(['html' => $html]);
    }

    // Hiển thị danh sách sản phẩm
    public function showProduct()
    {
        // Lấy tất cả danh mục
        $categories = Category::all();

        $products = Product::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->get();


        // Lấy riêng sản phẩm thuộc danh mục "Giày nữ"
        $shoes = Product::whereHas('category', function ($query) {
            $query->where('category_name', 'like', '%nữ%')
                ->where('category_name', 'like', '%giày%');
        })
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->with('images')
            ->get();

        return view('homepages.auth.item', compact('categories', 'products', 'shoes'));
    }



    // Hiển thị toàn bộ sản phẩm ở phần xem tất cả theo từng danh mục
    public function viewAll($category_id)
    {
        $category = Category::findOrFail($category_id);
        $products = Product::where('category_id', $category_id)->get();
        return view('homepages.auth.view_all_products_categories', compact('products','category'));
    }


    // Hiênr thị full sản phẩm
    public function viewAllProduct(){
        $products = Product::all();
        return view('homepages.auth.view_all_products', compact('products'));
    }

    // Thêm và hủy mục yêu thích
    public function toggle($productId)
    {
        $userId = auth()->id();

        $wishlist = Wishlist::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            $message = 'Đã xóa khỏi mục yêu thích!';
        } else {
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $productId,
            ]);
            $message = 'Đã thêm vào mục yêu thích!';
        }

        return back()->with('success', $message);
    }



    // Hiển thị liên hệ
    public function showContact()
    {
        $settings = [
            'address' => Setting::getValue('contact_address', 'Chưa có địa chỉ'),
            'phone' => Setting::getValue('contact_phone', 'Chưa có số điện thoại'),
            'email' => Setting::getValue('contact_email', 'Chưa có email'),
            'opening_hours' => Setting::getValue('contact_opening_hours', 'Chưa có giờ mở cửa'),
            'google_map_iframe' => Setting::getValue('contact_google_map_iframe', ''),
        ];
        return view('homepages.auth.contact', compact('settings'));
    }

    // Gửi liên hệ
    public function send(ContactRequest $request)
    {
        $data = $request->validated();

        Contact::create([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'subject' => $data['subject'],
            'message' => $data['message'],
            'status' => 'unread',
            'sent_date' => Carbon::now(),
        ]);


        return redirect()->back()->with('success', 'Liên hệ của bạn đã được gửi thành công.');

    }

    // Trang About Us
    public function showAboutUs()
    {
        $admin = User::with('role')
            ->where('role_id', 1)
            ->first(); // Lấy 1 người role_id = 1

        $staffs = User::with('role')
            ->where('role_id', 3)
            ->take(3)
            ->get(); // Lấy 3 người role_id = 3

        // Gộp lại thành 1 collection
        $users = collect([$admin])->merge($staffs);

        return view('homepages.auth.about_us', compact('users'));
    }

    public function subscribe(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        // Tìm user theo email
        $user = User::where('email', $request->email)->first();

        // Nếu user đã có mã
        if ($user->promo_code) {
            return back()->with('message', 'Bạn đã nhận mã: ' . $user->promo_code);
        }

        // Gán mã khuyến mãi cố định
        $promoCode = 'WELCOME10';

        // Lưu vào user
        $user->promo_code = $promoCode;
        $user->save();

        // Gửi email
        Mail::to($request->email)->send(new PromoCodeMail($promoCode));

        return redirect()->route('homepage')->with('status', 'Mã khuyến mãi đã được gửi đến email của bạn.');
    }


}

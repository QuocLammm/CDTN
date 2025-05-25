<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\homepage\ContactRequest;
use App\Http\Requests\homepage\ProfileRequest;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use App\Models\ViewPage;
use App\Models\WishList;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        // Lấy tất cả sản phẩm từ database
        $products = Product::withAvg('reviews', 'rating')->withCount('reviews')->get();
        $categories = Category::with(['products.images'])->get();

        // Lấy danh sách yêu thích
        $wishlistProductIds = [];
        if (auth()->check()) {
            $wishlistProductIds = Wishlist::where('user_id', auth()->id())
                ->pluck('product_id')
                ->toArray();
        }

        // Lượt truy cập web
        $today = Carbon::today()->toDateString();
        // Nếu chưa có bản ghi hôm nay thì tạo, nếu có thì lấy ra
        if (!session()->has('view_counted_today')) {
            $view = ViewPage::firstOrCreate(
                ['view_date' => $today],
                ['total_views' => 0]
            );
            $view->increment('total_views');
            session(['view_counted_today' => true]);
        }
        // Trả dữ liệu sang view
        return view('homepages.homepage', compact('categories','products','wishlistProductIds','today'));
    }

    // Profile User
    public function showProfile($id)
    {
        $user = User::findOrFail($id);
        // Lấy danh sách đơn hàng của user (giả sử có quan hệ orders)
        $orders = Order::with('items.product')->where('user_id', $id)->latest()->get();
        return view('homepages.profile', compact('user', 'orders'));
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
        // Lấy tất cả sản phẩm
        $categories = Category::all();
        $products = Product::withAvg('reviews', 'rating')->withCount('reviews')->get();

        // Trả dữ liệu sang view
        return view('homepages.item', compact('categories','products'));
    }

    // Hiển thị toàn bộ sản phẩm ở phần xem tất cả theo từng danh mục
    public function viewAll($category_id)
    {
        $products = Product::where('category_id', $category_id)->get(); // Lấy sản phẩm theo danh mục
        return view('homepages.auth.view_all_products_categories', compact('products'));
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
            // Đã yêu thích → xóa
            $wishlist->delete();
            $message = 'Đã xóa khỏi mục yêu thích!';
        } else {
            // Chưa yêu thích → thêm
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

}

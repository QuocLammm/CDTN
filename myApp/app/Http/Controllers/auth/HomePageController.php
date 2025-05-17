<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\homepage\ProfileRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $sportShoes = Product::whereHas('category', function($query) {
            $query->where('category_name', 'Giày thể thao');
        })->get();
        $girlShoes = Product::whereHas('category', function($query) {
            $query->where('category_name', 'Giày nữ');
        })->get();
        $girlDep = Product::whereHas('category', function($query) {
            $query->where('category_name', 'Dép nữ');
        })->get();

        // Lấy tất cả sản phẩm từ database
        $products = Product::all();
        $categories = Category::with(['products.images'])->get();

        // Lượt truy cập web
        $today = Carbon::today()->toDateString();
        // Nếu chưa có bản ghi hôm nay thì tạo, nếu có thì lấy ra
        if (!session()->has('view_counted_today')) {
            $view = View::firstOrCreate(
                ['view_date' => $today],
                ['total_views' => 0]
            );
            $view->increment('total_views');
            session(['view_counted_today' => true]);
        }
        // Trả dữ liệu sang view
        return view('homepages.homepage', compact('categories','products','sportShoes','girlShoes','girlDep'));
    }

    // Profile User
    public function showProfile($id)
    {
        $user = User::findOrFail($id);
        return view('homepages.profile', compact('user'));
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

    // Hiển thị sản phẩm ở trang chủ
//    public function showProduct()
//    {
//        $sportShoes = Product::whereHas('category', function($query) {
//            $query->where('category_name', 'Giày thể thao');
//        })->get();
//
//        $girlShoes = Product::whereHas('category', function($query) {
//            $query->where('category_name', 'Giày nữ');
//        })->get();
//
//        $girlDep = Product::whereHas('category', function($query) {
//            $query->where('category_name', 'Dép nữ');
//        })->get();
//
//        // Trả dữ liệu sang view
//        return view('homepages.item', compact('sportShoes','girlShoes','girlDep'));
//    }
    public function showProduct()
    {
        // Lấy tất cả sản phẩm
        $categories = Category::all();

        // Trả dữ liệu sang view
        return view('homepages.item', compact('categories'));
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


    // Load More
    public function loadMore(Request $request)
    {
        $page = $request->get('page', 1);
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $products = Product::skip($offset)->take($limit)->get();

        if ($products->isEmpty()) {
            return response()->json(['html' => '', 'end' => true]);
        }

        $html = view('components.product_items', compact('products'))->render();
        return response()->json(['html' => $html]);
    }





}

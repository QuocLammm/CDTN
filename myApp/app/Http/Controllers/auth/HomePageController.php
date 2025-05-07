<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\homepage\ProfileRequest;
use App\Models\Product;
use App\Models\User;
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

        // Trả dữ liệu sang view
        return view('homepages.homepage', compact('products','sportShoes','girlShoes','girlDep'));
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


    public function showProduct()
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

        // Trả dữ liệu sang view
        return view('homepages.item', compact('sportShoes','girlShoes','girlDep'));
    }

}

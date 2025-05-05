<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomePageController extends Controller
{
    public function index()
    {
        // Lấy tất cả sản phẩm từ database
        $products = Product::all();

        // Trả dữ liệu sang view
        return view('homepages.homepage', compact('products'));
    }
}

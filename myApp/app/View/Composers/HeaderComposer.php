<?php

namespace App\View\Composers;
use App\Models\Notification;
use App\Models\Product;
use Illuminate\View\View;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
class HeaderComposer
{
    public function compose(View $view)
    {
        // Lấy 4 sản phẩm thuộc category có tên chứa "giày"
        $shoesProducts = Product::whereHas('category', function ($query) {
            $query->where('category_name', 'like', '%giày%');
        })->with('images')->take(4)->get();

        // Lấy 4 sản phẩm thuộc category có tên chứa "giày"
        $depProducts = Product::whereHas('category', function ($query) {
            $query->where('category_name', 'like', '%dép%');
        })->with('images')->take(4)->get();

        // Lấy 4 sản phẩm thuộc category có tên chứa "sale"
        $depProducts = Product::whereHas('category', function ($query) {
            $query->where('category_name', 'like', '%dép%');
        })->with('images')->take(4)->get();

        $view->with('shoesProducts', $shoesProducts);
        $view->with('depProducts', $depProducts);
    }
}

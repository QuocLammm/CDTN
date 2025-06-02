<?php

namespace App\Providers;
use App\Models\WishList;
use App\View\Composers\DashboardComposer;
use App\View\Composers\HeaderComposer;
use App\View\Composers\NavbarComposer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\CartItem;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $cartCount = 0;
            $wishlistCount = 0;
            if (Auth::check()) {
                // Người dùng đã đăng nhập → lấy giỏ hàng theo user_id
                $cartCount = DB::table('cart_items')
                    ->join('carts', 'cart_items.cart_id', '=', 'carts.cart_id')
                    ->where('carts.user_id', Auth::id())
                    ->sum('cart_items.quantity');

                // Đếm số lượng wishlist của user trong DB
                $wishlistCount = Wishlist::where('user_id', Auth::id())->count();

            } else {
                // Người chưa đăng nhập → lấy giỏ hàng từ session
                $sessionCart = Session::get('cart', []);
                foreach ($sessionCart as $item) {
                    $cartCount += $item['quantity'] ?? 1;
                }
                $wishlistCount = 0;
            }

            $view->with('cartCount', $cartCount)
                ->with('wishlistCount', $wishlistCount);
        });
        View::composer('layouts.header', NavbarComposer::class);
        View::composer('pages.dashboard', DashboardComposer::class);
        View::composer('homepages.auth.header', HeaderComposer::class);
        View::composer('homepages.auth.scroll-bar', HeaderComposer::class);
    }
}

<?php

namespace App\Providers;
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

            if (Auth::check()) {
                // Người dùng đã đăng nhập → lấy giỏ hàng theo user_id
                $cartCount = DB::table('cart_items')
                    ->join('carts', 'cart_items.cart_id', '=', 'carts.cart_id')
                    ->where('carts.user_id', Auth::id())
                    ->sum('cart_items.quantity');
            } else {
                // Người chưa đăng nhập → lấy giỏ hàng từ session
                $sessionCart = Session::get('cart', []);
                foreach ($sessionCart as $item) {
                    $cartCount += $item['quantity'] ?? 1;
                }
            }

            $view->with('cartCount', $cartCount);
        });
        View::composer('layouts.header', NavbarComposer::class);
    }
}

<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function syncSessionCartToDatabase()
    {
        $sessionCart = session()->get('cart', []);

        if (Auth::check() && !empty($sessionCart)) {
            $userId = Auth::id();

            // Tìm hoặc tạo cart active
            $cart = DB::table('carts')
                ->where('user_id', $userId)
                ->first();

            if (!$cart) {
                $cartId = DB::table('carts')->insertGetId([
                    'user_id' => $userId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                $cartId = $cart->cart_id;
            }

            // Duyệt qua từng sản phẩm trong session cart
            foreach ($sessionCart as $productDetailId => $item) {
                $existingItem = DB::table('cart_items')
                    ->where('cart_id', $cartId)
                    ->where('product_detail_id', $productDetailId)
                    ->first();

                if ($existingItem) {
                    // Nếu đã có thì cộng số lượng
                    DB::table('cart_items')
                        ->where('cart_id', $cartId)
                        ->where('product_detail_id', $productDetailId)
                        ->update([
                            'quantity' => $existingItem->quantity + $item['quantity'],
                            'updated_at' => now(),
                        ]);
                } else {
                    // Nếu chưa có thì thêm mới
                    DB::table('cart_items')->insert([
                        'cart_id' => $cartId,
                        'product_detail_id' => $productDetailId,
                        'quantity' => $item['quantity'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            // Xoá cart tạm khỏi session
            session()->forget('cart');
        }
    }

    // Hiển thị giỏ hàng khi đã đăng nhập
    public function showCart($userId)
    {
        // Kiểm tra xem người dùng có đăng nhập và ID khớp không
        if (Auth::check() && Auth::id() == $userId) {
            // Lấy tất cả sản phẩm trong giỏ hàng của người dùng
            $cartItems = CartItem::whereHas('cart', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })->get();

            return view('homepages.auth.cart', compact('cartItems'));
        } else {
            return redirect()->route('login');
        }
    }
}

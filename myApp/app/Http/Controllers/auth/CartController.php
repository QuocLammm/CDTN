<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
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
    public function showCart()
    {
        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart) {
            return view('homepages.auth.cart', ['items' => collect()]);
        }

        $cartItems = $cart->items()->with('product')->get();
        return view('homepages.auth.cart', compact('cartItems'));
    }



    // Thêm vào giỏ hàng
    public function addToCart(Request $request, $id)
    {
        $user = auth()->user();
        $product = Product::findOrFail($id);

        // Tìm hoặc tạo cart của user
        $cart = Cart::firstOrCreate(['user_id' => $user->user_id]);

        // Tìm cart item có sẵn
        $item = CartItem::where('cart_id', $cart->cart_id)
            ->where('product_id', $product->product_id)
            ->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            CartItem::create([
                'cart_id' => $cart->cart_id,
                'product_id' => $product->product_id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('cart.cart');

    }


    // Hàm xóa sản phẩm khỏi giỏ hàng
    public function remove($id)
    {
        $userId = Auth::id();

        $cartItem = CartItem::where('cart_item_id', $id)
            ->whereHas('cart', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->first();

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->route('cart.cart')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
        }

        return redirect()->route('cart.cart')->with('error', 'Sản phẩm không tồn tại trong giỏ hàng.');
    }



    public function checkout()
    {
        // Lấy người dùng hiện tại
        $userId = Auth::id();

        // Lấy thông tin giỏ hàng của người dùng
        $cartItems = CartItem::where('user_id', $userId)->get();

        // Nếu giỏ hàng trống
        if ($cartItems->isEmpty()) {
            return redirect()->route('homepages.auth.cart')->with('error', 'Giỏ hàng của bạn trống. Vui lòng thêm sản phẩm trước khi thanh toán.');
        }

        // Tính tổng tiền giỏ hàng
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Thực hiện các bước thanh toán (giả sử bạn đã có phần xử lý thanh toán)
        // Lưu đơn hàng vào bảng `orders`, hoặc các bước thanh toán khác

        // Xóa giỏ hàng sau khi thanh toán
        $cartItems->each->delete();

        // Redirect đến trang thanh toán thành công
        return redirect()->route('cart.index')->with('success', 'Thanh toán thành công! Cảm ơn bạn đã mua sắm.');
    }

}

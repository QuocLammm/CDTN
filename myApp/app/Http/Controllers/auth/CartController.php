<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
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
        $cart = Cart::where('user_id', $userId)->first();

        // Nếu không tìm thấy giỏ hàng
        if (!$cart) {
            return redirect()->route('homepages.auth.cart')->with('error', 'Giỏ hàng của bạn trống. Vui lòng thêm sản phẩm trước khi thanh toán.');
        }

        // Lấy tất cả các mục trong giỏ hàng
        $cartItems = $cart->items;

        // Nếu giỏ hàng trống
        if ($cartItems->isEmpty()) {
            return redirect()->route('homepages.auth.cart')->with('error', 'Giỏ hàng của bạn trống. Vui lòng thêm sản phẩm trước khi thanh toán.');
        }

        // Tính tổng tiền giỏ hàng
        $total = 0;
        foreach ($cartItems as $item) {
            if ($item->product) { // Kiểm tra xem sản phẩm có tồn tại không
                $total += $item->product->price * $item->quantity;
            } else {
                // Xử lý trường hợp không có sản phẩm
                return redirect()->route('homepages.auth.cart')->with('error', 'Một sản phẩm trong giỏ hàng không còn tồn tại.');
            }
        }

        // Tạo bản ghi đơn hàng
        $order = Order::create([
            'user_id' => $userId,
            'total_amount' => $total,
            'status' => 'pending', // Hoặc trạng thái bạn muốn
        ]);

        // Lưu các mục đơn hàng
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->order_id,
                'product_detail_id' => $item->product->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // Xóa giỏ hàng sau khi thanh toán
        $cartItems->each->delete();

        // Redirect đến trang thanh toán thành công
        return redirect()->route('homepage')->with('success', 'Thanh toán thành công! Cảm ơn bạn đã mua sắm.');
    }

}

<?php

namespace App\Http\Controllers\auth;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Discount;
use App\Models\DiscountTarget;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
        $order = Order::where('user_id', $userId)->first();
        $product = Product::all();
        if (!$cart) {
            return view('homepages.auth.cart', ['items' => collect()]);
        }

        $cartItems = $cart->items()->with('product')->get();
        return view('homepages.auth.cart', compact('cartItems','order','product'));
    }



    // Thêm vào giỏ hàng
    public function addToCart(Request $request, $id)
    {
        $user = auth()->user();
        $product = Product::findOrFail($id);

        // Tìm cart hoặc tạo mới
        $cart = Cart::firstOrCreate(['user_id' => $user->user_id]);
        $color = $request->input('color');
        $size = $request->input('size');
        // Tìm cart item đã có
        $item = CartItem::where('cart_id', $cart->cart_id)
            ->where('product_id', $product->product_id)
            ->where('color', $color)
            ->where('size', $size)
            ->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            CartItem::create([
                'cart_id' => $cart->cart_id,
                'product_id' => $product->product_id,
                'quantity' => 1,
                'color' => $color,
                'size' => $size,
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


    public function checkout(Request $request)
    {
        $userId = Auth::id();

        // Kiểm tra phương thức thanh toán
        $paymentMethod = $request->input('payment_method');

        if ($paymentMethod === 'cod') {
            // Lấy thông tin giỏ hàng
            $cart = Cart::where('user_id', $userId)->first();
            if (!$cart || $cart->items->isEmpty()) {
                return redirect()->route('cart.cart')->with('error', 'Giỏ hàng của bạn trống.');
            }

            // Tính tổng và tạo đơn hàng
            $total = 0;
            foreach ($cart->items as $item) {
                if (!$item->product) {
                    return redirect()->route('cart.cart')->with('error', 'Một sản phẩm trong giỏ hàng không còn tồn tại.');
                }

                $unitPrice = $item->product->is_sale ? $item->product->sale_price : $item->product->price;
                $total += $unitPrice * $item->quantity;
            }

            // 2. Áp dụng mã giảm giá (nếu có)
            $voucherCode = $request->input('voucher_code');
            if ($voucherCode) {
                $voucher = Discount::where('discount_code', $voucherCode)
                    ->where('status', true)
                    ->where('start_date', '<=', now())
                    ->where('end_date', '>=', now())
                    ->first();

                if ($voucher) {
                    $discountAmount = 0;

                    foreach ($cart->items as $item) {
                        $unitPrice = $item->product->is_sale ? $item->product->sale_price : $item->product->price;
                        $discountAmount += ($unitPrice * $item->quantity) * ($voucher->discount_amount / 100);
                    }

                    if ($voucher->max_discount && $discountAmount > $voucher->max_discount) {
                        $discountAmount = $voucher->max_discount;
                    }

                    $total = max(0, $total - $discountAmount);
                }
            }

            $order = Order::create([
                'user_id' => $userId,
                'total_amount' => $total,
                'status' => 'pending',
                'payment_method' => $paymentMethod,
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->order_id,
                    'product_detail_id' => $item->product->product_id,
                    'quantity' => $item->quantity,
                    'price' => $total,
                    'color' => $item->color,
                    'size' => $item->size,
                ]);
            }



            // Xóa giỏ hàng
            $cart->items->each->delete();

            // Gửi thông báo Pusher
            $beamsInstanceId = '573a3ca7-cef7-4741-b7d9-4c46d4925a47';
            Http::withHeaders([
                'Authorization' => 'Bearer ' . env('PRIMARY_KEY'),
                'Content-Type' => 'application/json',
            ])->post("https://{$beamsInstanceId}.pushnotifications.pusher.com/publish_api/v1/instances/{$beamsInstanceId}/publishes/interests", [
                'interests' => ['orders'],
                'web' => [
                    'notification' => [
                        'title' => 'Đơn hàng mới!',
                        'body' => 'Có đơn hàng mới từ khách hàng.',
                        'deep_link' => route('show-order.index'),
                    ]
                ]
            ]);

            // Tạo thông báo hệ thống
            Notification::create([
                'user_id' => $userId,
                'content' => 'Đơn hàng mã #' . $order->order_id . ' đã được tạo thành công.',
                'status' => 0,
            ]);

            return redirect()->route('profile-user', ['id' => $userId])->with('order_success', true);

        } elseif ($paymentMethod === 'bank') {
            return redirect()->route('vnpay.checkout'); // route này bạn cần định nghĩa
        } else {
            return redirect()->back()->with('error', 'Phương thức thanh toán không hợp lệ.');
        }
    }


    // Mua trong chi tiết sản phẩm
    public function buyNow($productId)
    {
        $userId = Auth::id();

        // Thêm sản phẩm vào giỏ hàng (hoặc tạo mới giỏ hàng)
        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        // Thêm hoặc cập nhật số lượng sản phẩm trong giỏ hàng
        $cartItem = $cart->items()->where('product_id', $productId)->first();
        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            $cart->items()->create([
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }

        // Sau đó redirect thẳng đến checkout
        return redirect()->route('checkout');
    }

    // Thanh toán
    public function confirm()
    {
        $user = Auth::user();

        $cart = $user->cart()->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.cart')->with('error', 'Giỏ hàng trống.');
        }

        $cartItems = $cart->items;

        $total = $cartItems->sum(function ($item) {
            $unitPrice = $item->product->is_sale ? $item->product->sale_price : $item->product->price;
            return $unitPrice * $item->quantity;
        });

        return view('homepages.auth.payment', compact('cartItems', 'total'));
    }

    public function applyVoucher(Request $request)
    {
        $code = $request->input('voucher_code');
        Log::info("Voucher code nhận được: $code");

        $discount = Discount::where('discount_code', $code)
            ->where('status', 1)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        if (!$discount) {
            Log::info("Voucher không hợp lệ hoặc hết hạn: $code");
            return response()->json([
                'success' => false,
                'message' => 'Mã giảm giá không hợp lệ hoặc đã hết hạn.'
            ]);
        }

        $userId = auth()->id();
        Log::info("User ID: $userId");

        $cartId = Cart::where('user_id', $userId)->value('cart_id');
        Log::info("Cart ID: $cartId");

        $cartItems = CartItem::with('product')
            ->where('cart_id', $cartId)
            ->get();

        if ($cartItems->isEmpty()) {
            Log::info("Giỏ hàng trống cho user: $userId");
            return response()->json([
                'success' => false,
                'message' => 'Giỏ hàng của bạn đang trống.'
            ]);
        }

        $originalTotal = 0;
        $newTotal = 0;

        foreach ($cartItems as $item) {
            $product = $item->product;

            if (!$product) {
                Log::warning("Sản phẩm không tồn tại trong cart item ID: {$item->id}");
                continue;
            }

            $price = $product->is_sale ? $product->sale_price : $product->price;
            $quantity = $item->quantity;

            $subtotal = $price * $quantity;
            $originalTotal += $subtotal;

            // **Bỏ qua kiểm tra isDiscountApplicable, áp dụng giảm cho tất cả**
            $subtotal *= (1 - $discount->discount_amount / 100);

            $newTotal += $subtotal;
        }

        Log::info("Tổng tiền gốc: $originalTotal, Tổng tiền sau giảm: $newTotal");

        return response()->json([
            'success' => true,
            'message' => "Áp dụng thành công! Giảm {$discount->discount_amount}%.",
            'discount_percent' => $discount->discount_amount,
            'discount_amount' => round($originalTotal - $newTotal),
            'original_total' => round($originalTotal),
            'new_total' => round($newTotal),
        ]);
    }

    // Hủy đơn hàng
    public function cancelOrder(Request $request)
    {
        $userId = Auth::id();

        $orderId = $request->input('order_id');


        // Lưu ý: chữ hoa "Pending" đúng với CSDL
        $order = Order::where('order_id', $orderId)
            ->where('user_id', $userId)
            ->where('status', 'Pending')
            ->first();

        if ($order) {
            $order->status = 'Cancelled';
            $order->save();
            return redirect()->route('profile-user', ['id' => $userId])->with('order_success', true);
        }

        return redirect()->route('profile-user', ['id' => $userId])->with('order_success', false);
    }


}

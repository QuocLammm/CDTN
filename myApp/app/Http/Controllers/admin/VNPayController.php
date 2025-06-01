<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Discount;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VNPayController extends Controller
{
    public function createPayment(Request $request)
    {
        $userId = Auth::id();

        // Lấy giỏ hàng user
        $cart = Cart::where('user_id', $userId)->first();
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.cart')->with('error', 'Giỏ hàng của bạn trống.');
        }

        // Tính tổng tiền
        $total = 0;

        foreach ($cart->items as $item) {
            if (!$item->product) {
                return redirect()->route('cart.cart')->with('error', 'Một sản phẩm trong giỏ hàng không còn tồn tại.');
            }

            $unitPrice = $item->product->is_sale ? $item->product->sale_price : $item->product->price;
            $total += $unitPrice * $item->quantity;
        }

        // Áp dụng mã giảm giá nếu có
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


        // Tạo đơn hàng mới với trạng thái chờ thanh toán
        $order = Order::create([
            'user_id' => $userId,
            'total_amount' => $total,
            'status' => 'pending',
            'payment_method' => 'bank', // thanh toán qua VNPay
        ]);
        Log::info('VNPay Total:', ['total' => $total]);

        // Lưu order_id vào session
        session(['vnp_order_id' => $order->order_id]);

        // Tạo chi tiết đơn hàng
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

        // Xóa giỏ hàng sau khi tạo đơn
        $cart->items->each->delete();

        // Thông tin VNPay
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return'); // route trả về sau thanh toán
        $vnp_TmnCode = env('VNPAY_TMN_CODE');
        $vnp_HashSecret = env('VNPAY_HASH_SECRET');

        $vnp_TxnRef = $order->order_id; // mã giao dịch dùng mã order cho dễ quản lý
        $vnp_OrderInfo = 'Thanh toán đơn hàng #' . $order->order_id;
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $total * 100; // VNPay tính theo đơn vị nhỏ nhất (đồng * 100)
        $vnp_Locale = 'vn';
        $vnp_BankCode = $request->input('bank_code', '');
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        if ($vnp_BankCode !== '') {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        // Sắp xếp dữ liệu
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        // Tạo chữ ký
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url = $vnp_Url . "?" . $query . 'vnp_SecureHash=' . $vnpSecureHash;

        // Chuyển hướng sang trang thanh toán VNPay
        return redirect($vnp_Url);
    }


    public function returnPayment(Request $request)
    {
        $vnp_ResponseCode = $request->vnp_ResponseCode;

        $orderId = session('vnp_order_id'); // Lấy order_id từ session
        if ($orderId) {
            $order = Order::find($orderId);
            if ($order) {
                if ($vnp_ResponseCode == '00') {
                    // Thanh toán thành công
                    $order->status = 'Pending';
                    $order->save();

                    // Xóa giỏ hàng
                    $cart = Cart::where('user_id', $order->user_id)->first();
                    if ($cart) {
                        $cart->items->each->delete();
                    }

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
                        'user_id' => $order->user_id,
                        'content' => 'Đơn hàng mã #' . $order->order_id . ' đã được thanh toán thành công.',
                        'status' => 0,
                    ]);

                    return redirect()->route('homepage');
                } else {
                    // Thanh toán thất bại → Cập nhật trạng thái
                    $order->status = 'Cancelled';
                    $order->save();

                    return redirect()->route('homepage');
                }
            }
        }

        // Nếu không có orderId thì quay lại homepage
        return redirect()->route('homepage');
    }


}

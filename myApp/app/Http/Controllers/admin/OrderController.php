<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.product')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.order.index', compact('orders'));
    }


    public function markAsDone($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->status = 'Success';
            $order->save();

            // Gửi thông báo cho người dùng
            $this->sendPreparationNotification($order->user, $order);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    protected function sendPreparationNotification($user, $order)
    {
        // Gửi thông báo qua Beams
        $beamsInstanceId = '573a3ca7-cef7-4741-b7d9-4c46d4925a47';
        Http::withHeaders([
            'Authorization' => 'Bearer ' . env('PRIMARY_KEY'),
            'Content-Type' => 'application/json',
        ])->post("https://{$beamsInstanceId}.pushnotifications.pusher.com/publish_api/v1/instances/{$beamsInstanceId}/publishes/interests", [
            'interests' => ["user_{$user->user_id}"],
            'web' => [
                'notification' => [
                    'title' => 'Đơn hàng đã sẵn sàng!',
                    'body' => 'Đơn hàng của bạn đã sẵn sàng tại quầy.',
                    'deep_link' => route('show-order.index'),
                ]
            ]
        ]);

        // Cập nhật thông báo vào cơ sở dữ liệu
        Notification::where('user_id', $user->user_id)
            ->latest('created_at')  // lấy thông báo mới nhất
            ->limit(1)
            ->update([
                'content' => 'Đơn hàng mã #' . $order->order_id . ' đã được sẵn sàng tại quầy.',
                'status' => 1,
            ]);


    }

    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('show-order.show', compact('order')); // Đảm bảo đường dẫn đúng
    }

}

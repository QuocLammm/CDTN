<?php

namespace App\View\Composers;

use App\Models\Notification;
use Illuminate\View\View;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
class NavbarComposer
{
    public function compose(View $view)
    {
        // Nếu bạn chỉ muốn thông báo của user hiện tại
        $userId = Auth::id();

        $pendingOrdersCount = Notification::where('status', 0)->count();

        $notifications = Notification::with('user.orders')  // nếu bạn cần show user name
        ->orderBy('created_at', 'desc')
            ->latest()
            ->take(3)
            ->get();

        $view->with(compact('pendingOrdersCount', 'notifications'));
    }
}

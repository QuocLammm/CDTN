<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
class NavbarComposer
{
    public function compose(View $view)
    {
        $userId = Auth::id();

        $pendingOrdersCount = Order::where('user_id', $userId)->where('status', 'pending')->count();
        $notifications = Order::where('user_id', $userId)->where('status', 'pending')->get();

        $view->with(compact('pendingOrdersCount', 'notifications'));
    }
}

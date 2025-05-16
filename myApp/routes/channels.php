<?php
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('orders.{userId}', function ($user, $userId) {
    return (int) $user->user_id === (int) $userId;
});

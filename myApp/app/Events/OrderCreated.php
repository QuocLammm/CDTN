<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCreated  implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $userId;  // ai nhận
    public $orderId; // thông tin order
    public $createdAt;

    public function __construct($userId, $orderId, $createdAt)
    {
        $this->userId = $userId;
        $this->orderId = $orderId;
        $this->createdAt = $createdAt;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('orders.' . $this->userId);
    }

    public function broadcastWith()
    {
        return [
            'order_id' => $this->orderId,
            'created_at' => $this->createdAt,
        ];
    }
}

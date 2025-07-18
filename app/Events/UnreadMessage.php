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

class UnreadMessage implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $senderId;
    public $receiverId;

    public $unreadMessageCount;

    /**
     * Create a new event instance.
     */
    public function __construct($senderId, $receiverId, $unreadMessageCount)
    {
        $this->senderId = $senderId;
        $this->receiverId = $receiverId;
        $this->unreadMessageCount = $unreadMessageCount;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('unread-channel.' . $this->receiverId),
        ];
    }


    /**
     * Summary of broadcastWith
     * @return array{receiverId: mixed, senderId: mixed, unreadMessageCount: mixed}
     */
    public function broadcastWith()
    {
        return [
            'senderId' => $this->senderId,
            'receiverId' => $this->receiverId,
            'unreadMessageCount' => $this->unreadMessageCount
        ];
    }
}

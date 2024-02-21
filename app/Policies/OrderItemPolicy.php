<?php

namespace App\Policies;

use App\Models\OrderItem;
use App\Models\User;

class OrderItemPolicy
{
    /**
     * Create a new policy instance.
     */
    public function delete(User $user, OrderItem $orderItem): bool
    {
        return $user->id === $orderItem->order->user_id
            && $orderItem->order->status === "cart";
    }
}

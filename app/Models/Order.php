<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "total",
        "status",
    ];

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function calculateTotal(): void
    {
        $total = 0;
        foreach ($this->orderItems as $orderItem) {
            $total += $orderItem->price * $orderItem->quantity;
        };

        $this->update([
            "total" => $total,
        ]);
    }
}

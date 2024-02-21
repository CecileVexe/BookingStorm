<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        "book_id",
        "quantity",
        "price"
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    // Permet de relier le OrderItem au Book
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class); /*belongTo(Editor::class, "editor_id, "id")*/
    }
}

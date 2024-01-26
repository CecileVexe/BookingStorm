<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;


    protected $casts = [
        "published_at" => "datetime",
    ];

    public function editor(): BelongsTo
    {
        return $this->belongsTo(Editor::class); /*belongTo(Editor::class, "editor_id, "id")*/
    }

    protected $fillable = [
        'title',
        'resume',
        'published_at',
        'cover',
        'price',
        "editor_id",
    ];
}

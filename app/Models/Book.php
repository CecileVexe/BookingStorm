<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class); /*belongTo(Category::class, "category_id, "id")*/
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'released_at',
        'description',
        'isbn',
        'image_url',
        'price',
    ];

    protected function casts(): array
    {
        return [
            'released_at' => 'date',
        ];
    }

    public function decoratePrice()
    {
        return "$this->price руб.";
    }

    public function scopeWithAuthor($query, int|string $authorId)
    {
        $query->whereHas('authors', function ($query) use ($authorId) {
            $query->where('authors.id', $authorId);
        });
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }
}

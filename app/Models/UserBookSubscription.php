<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserBookSubscription extends Pivot
{
    protected $table = 'user_book_subscriptions';

    protected $foreignKey = 'user_id';
    protected $relatedKey = 'book_id';


    public function books()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

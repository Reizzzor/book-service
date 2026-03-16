<?php

namespace App\Events;

use App\Models\Book;
use Illuminate\Queue\SerializesModels;

class BookPriceReducedEvent
{
    use SerializesModels;

    public function __construct(public Book $book, public int $oldPrice)
    {
    }
}

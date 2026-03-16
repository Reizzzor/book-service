<?php

namespace App\Services;

use App\Models\Book;
use App\Models\User;
use App\Notifications\BookPriceReducedNotification;

class UsersService
{
    public function notifyBookPriceReduced(Book $book, int $oldPrice): void
    {
        User::whereHas('bookSubscriptions', function ($query) use ($book) {
            $query->where('book_id', $book->id);
        })
            ->chunk(100, function ($users) use ($book, $oldPrice) {
                $users->each(function (User $user) use ($book, $oldPrice) {
                    $user->notify(new BookPriceReducedNotification($book, $oldPrice));
                });
            });
    }
}

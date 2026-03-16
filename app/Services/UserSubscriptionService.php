<?php

namespace App\Services;

use App\Models\User;

class UserSubscriptionService
{
    public function __construct(private User $user)
    {
    }

    public function subscribeToBook(int $bookId): void
    {
        $this->user->bookSubscriptions()->attach($bookId);
    }

    public function unsubscribeFromBook(int $bookId): void
    {
        $this->user->bookSubscriptions()->detach($bookId);
    }
}

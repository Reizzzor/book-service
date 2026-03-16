<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckUserBookSubscriptionRule implements ValidationRule
{
    public function __construct(private User $user)
    {
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($this->user->bookSubscriptions()->where('book_id', $value)->exists()) {
            $fail("Подписка уже оформлена");
        }
    }
}

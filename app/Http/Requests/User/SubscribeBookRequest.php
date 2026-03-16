<?php

namespace App\Http\Requests\User;

use App\Rules\CheckUserBookSubscriptionRule;
use Illuminate\Foundation\Http\FormRequest;

class SubscribeBookRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'book_id' => [
                'required',
                'exists:books,id',
                new CheckUserBookSubscriptionRule($this->user())
            ]
        ];
    }
}

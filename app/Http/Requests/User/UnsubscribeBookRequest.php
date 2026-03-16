<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UnsubscribeBookRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'book_id' => [
                'required',
                'exists:books,id',
            ]
        ];
    }
}

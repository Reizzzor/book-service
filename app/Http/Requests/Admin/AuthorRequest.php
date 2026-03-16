<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'surname' => 'required|string|between:2,255',
            'first_name' => 'required|string|between:2,255',
            'last_name' => 'required|string|between:2,255',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => 'required|max:255',
            'surname' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => ['required', 'max:255', 'confirmed', Password::min(6)->mixedCase()],
        ];
    }
}

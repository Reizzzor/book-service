<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|between:2,255',
            'released_at' => 'required|date',
            'description' => 'required|string|between:20,255',
            'isbn' => [
                'required',
                'string',
                'between:10,10',
                Rule::unique('books', 'isbn')->ignore($this->book?->id)
            ],
            'image_url' => 'required|url|max:1024',
            'price' => 'required|int|min:1',
            'author_ids' => 'array|min:1',
            'author_ids.*' => 'integer|exists:authors,id',
        ];
    }
}

<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BookService
{
    public function __construct(private Book $book)
    {
    }

    public function create(array $params): Book
    {
        return DB::transaction(function () use ($params) {
            $this->book = new Book();
            $this->book->fill($params);
            $this->book->save();

            $this->book->authors()->attach($params['author_ids']);

            return $this->book;
        });
    }

    public function update(array $params): Book
    {
        return DB::transaction(function () use ($params) {
            $this->book->fill($params);
            $this->book->save();

            $this->book->authors()->sync($params['author_ids']);

            return $this->book;
        });
    }
}

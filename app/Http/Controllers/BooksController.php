<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index(Request $request)
    {
        return view('books.index', [
            'books' => Book::with('authors')
                ->when($request->input('author_id'), function ($query, string $authorId) {
                    $query->withAuthor($authorId);
                })
                ->get()
        ]);
    }
}

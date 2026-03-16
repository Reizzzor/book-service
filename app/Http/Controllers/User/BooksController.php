<?php

namespace App\Http\Controllers\User;

use App\Facades\Auth;
use App\Http\Controllers\BooksController as PublicBooksController;
use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends PublicBooksController
{
    public function index(Request $request)
    {
        return view('user.books.index', [
            'books' => Book::with('authors')
                ->when($request->input('author_id'), function ($query, string $authorId) {
                    $query->withAuthor($authorId);
                })
                ->get(),
            'bookSubscriptionIds' => Auth::user()->bookSubscriptions()->pluck('book_id')->toArray(),
        ]);
    }
}

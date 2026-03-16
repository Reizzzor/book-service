<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Services\BookService;

class BooksController extends Controller
{
    public function index()
    {
        return view('admin.books.index', ['books' => Book::withTrashed()->with('authors')->get()]);
    }

    public function create()
    {
        return view('admin.books.create', ['authors' => Author::get()]);
    }

    public function store(BookRequest $request)
    {
        $book = app(BookService::class)->create($request->validated());

        return redirect()->route('admin.books.index')->with([
            'success' => "Книга [$book->title] успешно добавлена",
        ]);
    }

    public function show($id)
    {
    }

    public function edit(Book $book)
    {
        return view('admin.books.edit', ['book' => $book, 'authors' => Author::get()]);
    }

    public function update(BookRequest $request, Book $book)
    {
        app(BookService::class, compact('book'))->update($request->validated());

        return redirect()->route('admin.books.index')->with([
            'success' => 'Книга успешно добавлена',
        ]);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('admin.books.index')->with([
            'success' => 'Успешно удалено',
        ]);
    }

    public function restore(Book $book)
    {
        $book->restore();

        return redirect()->route('admin.books.index')->with([
            'success' => 'Успешно восстановлено',
        ]);
    }
}

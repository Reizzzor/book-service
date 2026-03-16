<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthorRequest;
use App\Models\Author;

class AuthorsController extends Controller
{
    public function index()
    {
        return view('admin.authors.index', ['authors' => Author::withTrashed()->get()]);
    }

    public function create()
    {
        return view('admin.authors.create');
    }

    public function store(AuthorRequest $request)
    {
        Author::create($request->validated());

        return redirect()->route('admin.authors.index');
    }

    public function show($id)
    {
    }

    public function edit(Author $author)
    {
        return view('admin.authors.edit', ['author' => $author]);
    }

    public function update(AuthorRequest $request, Author $author)
    {
        $author->update($request->validated());

        return redirect()->route('admin.authors.index')->with([
            'success' => 'Данные успешно обновлены'
        ]);
    }

    public function destroy(Author $author)
    {
        $author->delete();

        return redirect()->route('admin.authors.index')->with([
            'success' => 'Успешно удален'
        ]);
    }

    public function restore(Author $author)
    {
        $author->restore();

        return redirect()->route('admin.authors.index')->with([
            'success' => 'Успешно восстановлен'
        ]);
    }
}

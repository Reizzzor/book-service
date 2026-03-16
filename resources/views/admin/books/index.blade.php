@php
    /** @var \App\Models\Book $book */
    /** @var \App\Models\Author $author */
@endphp

@extends('layouts.app-layout')

@section('title', 'Книги')

@section('body')
    <div class="row justify-content-between">
        <div class="col-auto align-self-center">
            <h3>Список книг</h3>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.books.create') }}" class="btn btn-success">Добавить</a>
        </div>
        <div class="col-12 mt-3">
            <table class="table caption-top">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Название</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Дата выпуска</th>
                    <th scope="col">Описание</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">Авторы</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                @forelse($books as $book)
                    <tr @class(['table-secondary' => $book->trashed()])>
                        <th scope="row">{{ $book->id }}</th>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->decoratePrice() }}</td>
                        <td>{{ $book->released_at->format('Y-m-d') }}</td>
                        <td>{{ $book->description }}</td>
                        <td>{{ $book->isbn }}</td>
                        <td>
                            @foreach($book->authors as $author)
                                <a href="{{ route('admin.authors.edit', $author) }}">
                                    {{ $author->getFullName() }}
                                </a>@if(!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-auto">
                                    <a
                                        href="{{ route('admin.books.edit', $book) }}"
                                        class="btn btn-link text-primary p-0"
                                    >
                                        изменить
                                    </a>
                                </div>
                                @if($book->trashed())
                                    <div class="col-auto">
                                        <form action="{{ route('admin.books.restore', $book) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-link text-success p-0">
                                                восстановить
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <div class="col-auto">
                                        <form action="{{ route('admin.books.destroy', $book) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-0">
                                                удалить
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <th colspan="7">Данные отсутствуют</th>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

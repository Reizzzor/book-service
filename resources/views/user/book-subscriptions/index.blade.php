@extends('layouts.app-layout')

@section('title', 'Подписки')

@section('body')
    <div class="row justify-content-between">
        <div class="col-auto align-self-center">
            <h3>Список </h3>
        </div>
        <div class="col-12 mt-3">
            <table class="table caption-top">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Название</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Описание</th>
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
                        <td>{{ $book->description }}</td>
                        <td>
                            @foreach($book->authors as $author)
                                <a href="{{ route('user.books.index', ['author_id' => $author->id]) }}">
                                    {{ $author->getFullName() }}
                                </a>@if(!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-auto">
                                    <form action="{{ route('user.books.unsubscribe') }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                                        <button type="submit" class="btn btn-link text-danger">
                                            отписаться
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <th colspan="6">Данные отсутствуют</th>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

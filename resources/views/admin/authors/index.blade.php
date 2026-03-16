@php
    /** @var \App\Models\Author[] $authors */
@endphp
@extends('layouts.app-layout')

@section('title', 'Книги')

@section('body')
    <div class="row justify-content-between">
        <div class="col-auto align-self-center">
            <h3>Список авторов</h3>
        </div>
        <div class="col-auto">
            <a href="{{ route('admin.authors.create') }}" class="btn btn-success">Добавить</a>
        </div>
        <div class="col-12 mt-3">
            <table class="table caption-top">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ФИО</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                @forelse($authors as $author)
                    <tr @class(['table-secondary' => $author->trashed()])>
                        <th scope="row">{{ $author->id }}</th>
                        <td>{{ $author->getFullName() }}</td>
                        <td>
                            <div class="row">
                                <div class="col-auto">
                                    <a
                                        href="{{ route('admin.authors.edit', $author) }}"
                                        class="btn btn-link text-primary p-0"
                                    >
                                        изменить
                                    </a>
                                </div>
                                @if($author->trashed())
                                    <div class="col-auto">
                                        <form action="{{ route('admin.authors.restore', $author) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-link text-success p-0">
                                                восстановить
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <div class="col-auto">
                                        <form action="{{ route('admin.authors.destroy', $author) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger p-0">удалить</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <th colspan="3">Данные отсутствуют</th>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

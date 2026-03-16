@php
    /** @var \App\Models\Book $book */
@endphp
@extends('layouts.app-layout')

@section('title', 'Книги')

@section('body')
    <div class="row">
        @foreach($books as $book)
            <div class="col-4">
                <div class="card">
                    <img src="{{ $book->image_url }}" class="card-img-top" alt="{{ $book->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text">{{ $book->description }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <b>Авторы:</b> {{ $book->authors->map(fn ($author) => $author->getFullName())->join(', ') }}
                        </li>
                        <li class="list-group-item"><b>Цена:</b> {{ $book->decoratePrice() }}</li>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
@endsection


@php
    /** @var \App\Models\Book $book */
@endphp
@extends('layouts.app-layout')

@section('title', 'Книги')

@section('body')
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
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
                    <div class="card-body">
                        <div class="row text-center justify-content-center">
                            @unless(in_array($book->id, $bookSubscriptionIds))
                                <div class="col-auto">
                                    <form action="{{ route('user.books.subscribe') }}" method="post">
                                        @csrf
                                        <input hidden name="book_id" value="{{ $book->id }}">
                                        <button type="submit" class="btn btn-sm btn-outline-primary">
                                            Уведомить о снижении цены
                                        </button>
                                    </form>
                                </div>
                            @endunless
                            <div class="col-auto">
                                <a href="#" class="btn btn-sm btn-outline-success">Купить</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection


@php
/** @var \App\Models\Author[] $authors */
@endphp
@extends('layouts.app-layout')

@section('title', 'Книги')

@section('body')
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Редактировать книгу[{{ $book->title }}]</h4>
                    <form
                        class="row g-3 justify-content-md-center card-text"
                        action="{{ route('admin.books.update', $book) }}"
                        method="post"
                    >
                        @csrf
                        @method('PUT')
                        <div class="col-12 col-md-8">
                            <select class="form-selectl @error('author_ids') is-invalid @enderror" aria-label="Авторы" multiple name="author_ids[]">
                                @foreach($authors as $author)
                                    <option
                                        value="{{ $author->id }}"
                                        @selected(in_array($author->id, old('author_ids', $book->authors->pluck('id')->all())))
                                    >
                                        {{ $author->getFullName() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('author_ids')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-8">
                            <label for="title" class="form-label">Название</label>
                            <input
                                type="text"
                                class="form-control @error('title') is-invalid @enderror"
                                name="title"
                                id="title"
                                value="{{ old('title', $book->title) }}"
                                required
                            >
                            @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-8">
                            <label for="price" class="form-label">Цена</label>
                            <div class="row">
                                <div class="col-10 col-md-4">
                                    <input
                                        type="number"
                                        class="form-control @error('price') is-invalid @enderror"
                                        name="price"
                                        id="price"
                                        value="{{ old('price', $book->price) }}"
                                        required
                                    >
                                </div>
                                <span class="col-auto align-self-center">руб.</span>
                            </div>
                            @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-8">
                            <label for="released_at" class="form-label">Дата выпуска</label>
                            <input
                                type="date"
                                class="form-control @error('released_at') is-invalid @enderror"
                                name="released_at"
                                id="released_at"
                                value="{{ old('released_at', $book->released_at->format('Y-m-d')) }}"
                                required
                            >
                            @error('released_at')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-8">
                            <label for="description" class="form-label">Описание</label>
                            <textarea
                                type="text"
                                class="form-control @error('description') is-invalid @enderror"
                                name="description"
                                id="description"
                                required
                            >{{ old('description', $book->description) }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-8">
                            <label for="isbn" class="form-label">ISBN</label>
                            <input
                                type="text"
                                class="form-control @error('isbn') is-invalid @enderror"
                                name="isbn"
                                id="isbn"
                                value="{{ old('isbn', $book->isbn) }}"
                                required
                            >
                            @error('isbn')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-8">
                            <label for="image_url" class="form-label">URL картинки</label>
                            <div class="col-12">
                                <img src="{{ $book->image_url }}" alt="">
                            </div>
                            <input
                                type="text"
                                class="form-control @error('image_url') is-invalid @enderror"
                                name="image_url"
                                id="image_url"
                                value="{{ old('image_url', $book->image_url) }}"
                                required
                            >
                            @error('image_url')
                            <div id="image_url" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary" type="submit">Обновить данные</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

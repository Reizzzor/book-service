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
                    <h4 class="card-title text-center">Добавить книгу</h4>
                    <form
                        class="row g-3 justify-content-md-center card-text"
                        action="{{ route('admin.books.store') }}"
                        method="post"
                    >
                        @csrf
                        <div class="col-12 col-md-8">
                            <select class="form-selectl @error('author_ids') is-invalid @enderror" aria-label="Авторы" multiple name="author_ids[]">
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}">{{ $author->getFullName() }}</option>
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
                                value="{{ old('title') }}"
                                required
                            >
                            @error('title')
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
                                value="{{ old('released_at') }}"
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
                            >{{ old('description') }}</textarea>
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
                                value="{{ old('isbn') }}"
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
                            <input
                                type="text"
                                class="form-control @error('image_url') is-invalid @enderror"
                                name="image_url"
                                id="image_url"
                                value="{{ old('image_url') }}"
                                required
                            >
                            @error('image_url')
                            <div id="image_url" class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary" type="submit">Добавить книгу</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

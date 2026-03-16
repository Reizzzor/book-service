@extends('layouts.app-layout')

@section('title', 'Добавить автора')

@section('body')
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Добавить автора</h4>
                    <form
                        class="row g-3 justify-content-md-center card-text"
                        action="{{ route('admin.authors.store') }}"
                        method="post"
                    >
                        @csrf
                        <div class="col-12 col-md-8">
                            <label for="surname" class="form-label">Фамилия</label>
                            <input
                                type="text"
                                class="form-control @error('surname') is-invalid @enderror"
                                name="surname"
                                id="surname"
                                value="{{ old('surname') }}"
                                required
                            >
                            @error('surname')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-8">
                            <label for="first_name" class="form-label">Имя</label>
                            <input
                                type="text"
                                class="form-control @error('first_name') is-invalid @enderror"
                                name="first_name"
                                id="first_name"
                                value="{{ old('first_name') }}"
                                required
                            >
                            @error('first_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-8">
                            <label for="last_name" class="form-label">Отчество</label>
                            <input
                                type="text"
                                class="form-control @error('last_name') is-invalid @enderror"
                                name="last_name"
                                id="last_name"
                                value="{{ old('last_name') }}"
                                required
                            >
                            @error('last_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary" type="submit">Добавить автора</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

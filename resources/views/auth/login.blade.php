@extends('layouts.app-layout')

@section('title', 'Авторизация')

@section('body')
    <div class="row justify-content-md-center">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center">Вход</h4>
                    <form
                        class="row g-3 justify-content-md-center card-text"
                        action="{{ route('auth.login') }}"
                        method="post"
                    >
                        @csrf
                        <div class="col-12 col-md-8">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="" required>
                        </div>
                        <div class="col-12 col-md-8">
                            <label for="password" class="form-label">Пароль</label>
                            <input type="password" class="form-control" name="password" id="password" value="" required>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary" type="submit">Войти</button>
                            <a href="{{ route('register.index') }}" class="mx-3 card-link">Нет аккаунта?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

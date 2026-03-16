<?php

use App\Http\Controllers\Admin\Auth\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\AuthorsController;
use App\Http\Controllers\Admin\BooksController;
use App\Http\Controllers\User\Auth\AuthController;
use App\Http\Controllers\User\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::prefix('auth')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'index'])->name('user.auth.index');
        Route::post('login', [AuthController::class, 'login'])->name('user.auth.login');
        Route::get('register', [RegisterController::class, 'index'])->name('user.register.index');
        Route::post('register', [RegisterController::class, 'store'])->name('user.register.store');
    });
});

Route::middleware('auth:web')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('user.auth.logout');

});

Route::prefix('admin')->group(function () {
    Route::prefix('auth')->middleware('guest')->group(function () {
        Route::get('login', [AdminAuthController::class, 'index'])->name('admin.auth.index');
        Route::post('login', [AdminAuthController::class, 'login'])->name('admin.auth.login');
    });
    Route::middleware('auth:web-admin')->group(function () {
        Route::get('logout', [AuthController::class, 'logout'])->name('admin.auth.logout');

        Route::resource('authors', AdminAuthorsController::class)->names('admin.authors');
        Route::post('authors/{author}/restore', [AdminAuthorsController::class, 'restore'])
            ->name('admin.authors.restore')
            ->withTrashed();

        Route::resource('books', AdminBooksController::class)->names('admin.books');
        Route::post('books/{book}/restore', [AdminBooksController::class, 'restore'])
            ->name('admin.books.restore')
            ->withTrashed();
    });
});



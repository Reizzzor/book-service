<?php

use App\Http\Controllers\Admin\Auth\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\AuthorsController as AdminAuthorsController;
use App\Http\Controllers\Admin\BooksController as AdminBooksController;
use App\Http\Controllers\User\Auth\AuthController;
use App\Http\Controllers\User\Auth\RegisterController;
use App\Http\Controllers\User\BooksController as UserBooksController;
use App\Http\Controllers\User\BookSubscriptionsController;
use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('guest')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('login', [AuthController::class, 'index'])->name('user.auth.index');
        Route::post('login', [AuthController::class, 'login'])->name('user.auth.login');
        Route::get('register', [RegisterController::class, 'index'])->name('user.register.index');
        Route::post('register', [RegisterController::class, 'store'])->name('user.register.store');
    });

    Route::get('books', [BooksController::class, 'index'])->name('books.index');
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

Route::middleware('auth:web')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('user.auth.logout');

    Route::get('book-subscriptions', [BookSubscriptionsController::class, 'index'])->name('user.books.subscriptions');
    Route::post('book-subscriptions', [BookSubscriptionsController::class, 'subscribe'])->name('user.books.subscribe');
    Route::delete('book-subscriptions', [BookSubscriptionsController::class, 'unsubscribe'])->name('user.books.unsubscribe');

    Route::get('books', [UserBooksController::class, 'index'])->name('user.books.index');
});


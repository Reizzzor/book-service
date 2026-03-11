<?php

use App\Http\Controllers\User\Auth\AuthController;
use App\Http\Controllers\User\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::prefix('auth')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'index'])->name('auth.index');
        Route::post('login', [AuthController::class, 'login'])->name('auth.login');
        Route::get('register', [RegisterController::class, 'index'])->name('register.index');
        Route::post('register', [RegisterController::class, 'store'])->name('register.store');
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
});



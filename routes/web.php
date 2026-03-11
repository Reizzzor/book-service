<?php

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

    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
});



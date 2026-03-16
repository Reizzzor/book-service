<?php

namespace App\Providers;

use App\Facades\Auth;
use App\Models\Book;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::if('authAdmin', function () {
            return !empty(Auth::admin());
        });
        Blade::if('canSubscribeBook', function (Book $book) {
            if (empty(Auth::user())) {
                return false;
            }
            return !Auth::user()->bookSubscriptions->pluck('id')->contains($book->id);
        });
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\SubscribeBookRequest;
use App\Http\Requests\User\UnsubscribeBookRequest;
use App\Services\UserSubscriptionService;

class BookSubscriptionsController extends Controller
{
    public function index()
    {
        return view('user.book-subscriptions.index', [
            'books' => Auth::user()->bookSubscriptions()->get()
        ]);
    }

    public function subscribe(SubscribeBookRequest $request)
    {
        app(UserSubscriptionService::class, ['user' => Auth::user()])->subscribeToBook($request->book_id);

        return redirect()->route('user.books.index')->with([
            'success' => 'Подписка успешно оформлена',
        ]);
    }

    public function unsubscribe(UnsubscribeBookRequest $request)
    {
        app(UserSubscriptionService::class, ['user' => Auth::user()])->unsubscribeFromBook($request->book_id);

        return redirect()->route('user.books.subscriptions')->with([
            'success' => 'Успешно отписались',
        ]);
    }
}

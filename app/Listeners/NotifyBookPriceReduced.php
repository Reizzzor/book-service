<?php

namespace App\Listeners;

use App\Events\BookPriceReducedEvent;
use App\Services\UsersService;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyBookPriceReduced implements ShouldQueue
{
    public $queue = 'default';

    public function handle(BookPriceReducedEvent $event): void
    {
        app(UsersService::class)->notifyBookPriceReduced($event->book, $event->oldPrice);
    }
}

<?php

namespace App\Notifications;

use App\Models\Book;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookPriceReducedNotification extends Notification
{
    public function __construct(private Book $book, private int $oldPrice)
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(sprintf('Снижение цены на книгу[%s]', $this->book->title))
            ->line(sprintf('Цена снижена с %d на %d', $this->book->price, $this->oldPrice))
            ->action('Посмотреть по ссылке', route('user.books.subscriptions'));
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}

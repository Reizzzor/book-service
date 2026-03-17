<?php

namespace Tests\Unit;

use App\Events\BookPriceReducedEvent;
use App\Models\Author;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class BookServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Event::fake();
    }

    public function testCreateBook()
    {
        $authorOne = Author::factory()->create();
        $authorTwo = Author::factory()->create();
        $params = [
            'title' => 'Example Book',
            'released_at' => '2019-01-01',
            'description' => 'Description',
            'isbn' => '1234567890',
            'image_url' => 'https://google.com/',
            'price' => 100,
            'author_ids' => [$authorOne->id, $authorTwo->id],
        ];

        $book = (new BookService())->create($params);

        $this->assertEquals($params['title'], $book->title);
        $this->assertInstanceOf(Carbon::class, $book->released_at);
        $this->assertEquals($params['description'], $book->description);
        $this->assertEquals($params['isbn'], $book->isbn);
        $this->assertEquals($params['image_url'], $book->image_url);
        $this->assertEquals($params['price'], $book->price);
        $this->assertCount(count($params['author_ids']), $book->authors);
        $this->assertEquals($authorOne->id, $book->authors[0]->id);
        $this->assertEquals($authorTwo->id, $book->authors[1]->id);
    }

    public function testUpdateBook()
    {
        $book = Book::factory()->has(Author::factory()->count(2))->create([
            'title' => 'Example Book',
            'released_at' => '2019-01-01',
            'description' => 'Description',
            'isbn' => '1234567890',
            'image_url' => 'https://google.com/',
            'price' => 100,
        ]);
        $author = Author::factory()->create();
        $params = [
            'title' => 'Edited Book',
            'description' => 'Edited Description',
            'isbn' => '1234567890',
            'image_url' => 'https://ya.ru/',
            'price' => 200,
            'author_ids' => [$author->id],
        ];

        (new BookService($book))->update($params);

        $this->assertEquals($params['title'], $book->title);
        $this->assertInstanceOf(Carbon::class, $book->released_at);
        $this->assertEquals($params['description'], $book->description);
        $this->assertEquals($params['isbn'], $book->isbn);
        $this->assertEquals($params['image_url'], $book->image_url);
        $this->assertEquals($params['price'], $book->price);
        $this->assertCount(count($params['author_ids']), $book->authors);
        $this->assertEquals($author->id, $book->authors[0]->id);
    }

    public function testRunBookPriceReduceEvent()
    {
        $oldPrice = 100;
        $book = Book::factory()->create([
            'price' => $oldPrice,
        ]);
        $params = [
            'price' => 50,
            'author_ids' => [Author::factory()->create()->id],
        ];

        (new BookService($book))->update($params);

        Event::assertDispatched(
            BookPriceReducedEvent::class,
            function ($event) use ($oldPrice, $book) {
                return $oldPrice === $event->oldPrice && $event->book->id === $book->id;
            },
        );
    }
}

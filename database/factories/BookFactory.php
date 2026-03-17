<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'released_at' => Carbon::now(),
            'description' => $this->faker->text(),
            'isbn' => $this->faker->word(),
            'image_url' => $this->faker->imageUrl(),
            'price' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Book $book) {
            // Привязываем существующие роли или создаем новые
            $book->authors()->attach(Author::factory(3)->create()->pluck('id')->all());
        });
    }
}

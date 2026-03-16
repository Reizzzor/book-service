<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('released_at');
            $table->string('description');
            $table->string('isbn')->unique();
            $table->string('image_url', 1024);
            $table->unsignedBigInteger('price');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('surname');
            $table->string('first_name');
            $table->string('last_name');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('author_book', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('book_id');

            $table->foreign('author_id')->references('id')->on('authors');
            $table->foreign('book_id')->references('id')->on('books');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('author_book');
        Schema::dropIfExists('books');
        Schema::dropIfExists('authors');
    }
};

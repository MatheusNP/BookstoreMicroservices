<?php

namespace App\Events;

use App\Models\Book;

class BookCreatedEvent extends Event
{
    public $book;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Book $book)
    {
        $this->book = $book->toArray();
    }
}

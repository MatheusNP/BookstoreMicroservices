<?php

namespace App\Events;

class BookCreatedEvent extends Event
{
    public $book;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($book)
    {
        $this->book = $book;
    }
}

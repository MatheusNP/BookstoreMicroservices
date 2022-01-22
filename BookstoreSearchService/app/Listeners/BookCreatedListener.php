<?php

namespace App\Listeners;

use App\Events\BookCreatedEvent;
use App\Models\Book;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookCreatedListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\BookCreatedEvent  $event
     * @return void
     */
    public function handle(BookCreatedEvent $event)
    {
        Book::create(json_decode(json_encode($event), true)['book']);
    }
}

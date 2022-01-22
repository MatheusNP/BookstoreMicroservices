<?php

namespace App\Listeners;

use App\Events\BookCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;

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
        Log::info(json_encode($event));
    }
}

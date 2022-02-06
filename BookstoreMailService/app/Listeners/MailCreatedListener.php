<?php

namespace App\Listeners;

use App\Events\MailCreatedEvent;
use App\Models\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;

class MailCreatedListener implements ShouldQueue
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
     * @param  \App\Events\MailCreatedEvent  $event
     * @return void
     */
    public function handle(MailCreatedEvent $event)
    {
        // Log::info(json_encode($event));
        Mail::create(json_decode(json_encode($event), true)['mail']);
    }
}

<?php

namespace App\Listeners;

use App\Events\TicketCreatedEvent;
use App\Models\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;

class TicketCreatedListener implements ShouldQueue
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
    public function handle(TicketCreatedEvent $event)
    {
        // Log::info(json_encode($event));
        $ticket = json_decode(json_encode($event), true)['ticket'];

        Mail::create([
            'to' => env('MAIL_SUPPORT_TO', "support.bookstore@gmail.com"),
            'subject' => env('MAIL_SUPPORT_SUBJECT', "Query from bookstore"),
            'message' => "Name: {$ticket["username"]}\nEmail: {$ticket["email"]}\n\n{$ticket["description"]}",
            'additional_headers' => "From: {$ticket["username"]} <{$ticket["email"]}>",
        ]);

        Mail::create([
            'to' => $ticket["email"],
            'subject' => env('MAIL_SUPPORT_RES_SUBJECT', "Confirmation of receiving your query"),
            'message' => "Dear {$ticket["username"]}\n\nThanks for reaching us.\nThis is to inform you that we have received your query. We will get back to you asap.\n\nNote : This is an auto-generated mail do not reply to this.",
            'additional_headers' => "",
        ]);
    }
}

<?php

namespace App\Events;

class TicketCreatedEvent extends Event
{
    public $ticket;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }
}

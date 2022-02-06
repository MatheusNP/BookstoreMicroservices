<?php

namespace App\Events;

class MailCreatedEvent extends Event
{
    public $mail;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($mail)
    {
        $this->mail = $mail;
    }
}

<?php

namespace App\Events;

use App\Models\Mail;

class MailCreatedEvent extends Event
{
    public $mail;

    /**
     * Create a new event instance.
     *
     * @param Mail $mail
     * @return void
     */
    public function __construct(Mail $mail)
    {
        $this->mail = $mail->toArray();
    }
}

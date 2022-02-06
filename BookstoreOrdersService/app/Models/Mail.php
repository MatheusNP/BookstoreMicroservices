<?php

namespace App\Models;

class Mail
{
    /** @var string */
    private $to;
    /** @var string */
    private $subject;
    /** @var string */
    private $message;
    /** @var string */
    private $additional_headers;

    public function __construct(
        string $to,
        string $subject,
        string $message,
        string $additional_headers = ""
    ) {
        $this->to = $to;
        $this->subject = $subject;
        $this->message = $message;
        $this->additional_headers = $additional_headers;
    }

    /**
     * Get the attributes and values of instance;
     *
     * @return array
     */
    public function toArray(): array
	{
		return get_object_vars($this);
	}
}

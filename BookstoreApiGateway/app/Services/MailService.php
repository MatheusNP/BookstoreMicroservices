<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class MailService
{
    use ConsumesExternalService;

    /**
     * Base uri to consume mail service
     *
     * @var string
     */
    public $baseUri;

    /**
     * Secret to consume mail service
     *
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.mail.base_uri');
        $this->secret = config('services.mail.secret');
    }

    /**
     * Obtain the full list of mail from the book service;
     *
     * @return string
     */
    public function index(): string
    {
        return $this->performRequest('GET', '/mail');
    }
}
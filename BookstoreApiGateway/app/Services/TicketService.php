<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class TicketService
{
    use ConsumesExternalService;

    /**
     * Base uri to consume support service
     *
     * @var string
     */
    public $baseUri;

    /**
     * Secret to consume support service
     *
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.support.base_uri');
        $this->secret = config('services.support.secret');
    }

    /**
     * Obtain the list of tickets by user from the support service;
     *
     * @param integer $user_id
     * @return string
     */
    public function list(int $user_id): string
    {
        return $this->performRequest('GET', "/tickets/{$user_id}");
    }

    /**
     * Creates a new ticket;
     *
     * @param array $data
     * @return string
     */
    public function store(array $data): string
    {
        return $this->performRequest('POST', "/tickets", $data);
    }
}
<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class OrderService
{
    use ConsumesExternalService;

    /**
     * Base uri to consume orders service
     *
     * @var string
     */
    public $baseUri;

    /**
     * Secret to consume orders service
     *
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.orders.base_uri');
        $this->secret = config('services.orders.secret');
    }

    /**
     * Obtain the list of orders by user from the orders service;
     *
     * @param integer $user_id
     * @return string
     */
    public function list(int $user_id): string
    {
        return $this->performRequest('GET', "/orders/user/{$user_id}");
    }

    /**
     * Creates a new order;
     *
     * @return string
     */
    public function store(array $data): string
    {
        return $this->performRequest('POST', "/orders", $data);
    }

    /**
     * Removes an order;
     *
     * @param integer $id
     * @return string
     */
    public function destroy(int $id, array $data): string
    {
        return $this->performRequest('DELETE', "/orders/{$id}", $data);
    }
}
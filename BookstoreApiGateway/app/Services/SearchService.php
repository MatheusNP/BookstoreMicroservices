<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class SearchService
{
    use ConsumesExternalService;

    /**
     * Base uri to consume search service
     *
     * @var string
     */
    public $baseUri;

    /**
     * Secret to consume search service
     *
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.search.base_uri');
        $this->secret = config('services.search.secret');
    }

    /**
     * Search by a term in the search service;
     *
     * @param array $query
     * @return string
     */
    public function show(array $query): string
    {
        return $this->performRequest('GET', "/search", [], $query);
    }
}
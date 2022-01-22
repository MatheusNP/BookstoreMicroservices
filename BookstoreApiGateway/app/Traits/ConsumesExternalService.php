<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumesExternalService
{

    /**
     * Send a request to any service;
     *
     * @param string $method
     * @param string $requestUrl
     * @param array $formParams
     * @param array $headers
     * @return string
     */
    public function performRequest(
        string $method,
        string $requestUrl,
        array $formParams = [],
        array $query = [],
        array $headers = []
    ): string
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        if (isset($this->secret)) {
            $headers['Authorization'] = $this->secret;
        }

        $response = $client->request(
            $method,
            $requestUrl,
            [
                'form_params' => $formParams,
                'query' => $query,
                'headers' => $headers,
            ]
        );

        return $response->getBody()->getContents();
    }
}

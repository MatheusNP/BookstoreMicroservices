<?php

return [
    'books' => [
        'base_uri' => env('BOOKS_SERVICE_BASE_URL'),
        'secret' => env('BOOKS_SERVICE_SECRET'),
    ],
    'orders' => [
        'base_uri' => env('ORDERS_SERVICE_BASE_URL'),
        'secret' => env('ORDERS_SERVICE_SECRET'),
    ],
    'support' => [
        'base_uri' => env('SUPPORT_SERVICE_BASE_URL'),
        'secret' => env('SUPPORT_SERVICE_SECRET'),
    ],
    'search' => [
        'base_uri' => env('SEARCH_SERVICE_BASE_URL'),
        'secret' => env('SEARCH_SERVICE_SECRET'),
    ],
    'mail' => [
        'base_uri' => env('MAIL_SERVICE_BASE_URL'),
        'secret' => env('MAIL_SERVICE_SECRET'),
    ],
];

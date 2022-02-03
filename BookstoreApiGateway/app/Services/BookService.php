<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class BookService
{
    use ConsumesExternalService;

    /**
     * Base uri to consume books service
     *
     * @var string
     */
    public $baseUri;

    /**
     * Secret to consume books service
     *
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.books.base_uri');
        $this->secret = config('services.books.secret');
    }

    /**
     * Obtain the full list of books from the book service;
     *
     * @return string
     */
    public function index(): string
    {
        return $this->performRequest('GET', '/books');
    }

    /**
     * Obtain the list of books by category from the book service;
     *
     * @param array $query
     * @return string
     */
    public function listCategory(array $query): string
    {
        return $this->performRequest('GET', '/books/category/', [], $query);
    }

    /**
     * Obtain the list of books by author from the book service;
     *
     * @param array $query
     * @return string
     */
    public function listAuthor(array $query): string
    {
        return $this->performRequest('GET', '/books/author/', [], $query);
    }

    /**
     * Obtain a book from the book service;
     *
     * @param string $product_id
     * @return string
     */
    public function show(string $product_id): string
    {
        return $this->performRequest('GET', "/books/{$product_id}");
    }

    /**
     * Obtain the list of books;
     *
     * @param array $query
     * @return string
     */
    public function ordered(array $query): string
    {
        return $this->performRequest('GET', '/books/ordered/', [], ['book_id' => $query]);
    }
}
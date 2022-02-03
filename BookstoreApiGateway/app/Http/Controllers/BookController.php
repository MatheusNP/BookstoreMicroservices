<?php

namespace App\Http\Controllers;

use App\Services\BookService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the books microservice;
     *
     * @var BookService
     */
    private $bookService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Return the list of books;
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        return $this->validResponse($this->bookService->index());
    }

    /**
     * List books from a category;
     *
     * @param Request $request
     * @return Response
     */
    public function listCategory(Request $request): Response
    {
        return $this->validResponse($this->bookService->listCategory($request->query()));
    }

    /**
     * List books from an author;
     *
     * @param Request $request
     * @return Response
     */
    public function listAuthor(Request $request): Response
    {
        return $this->validResponse($this->bookService->listAuthor($request->query()));
    }

    /**
     * Obtains and show a book;
     *
     * @param Request $request
     * @param string $product_id
     * @return Response
     */
    public function show(Request $request, string $product_id): Response
    {
        return $this->validResponse($this->bookService->show($product_id));
    }
}

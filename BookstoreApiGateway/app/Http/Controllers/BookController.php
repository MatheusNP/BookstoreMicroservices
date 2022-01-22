<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return the list of books;
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        
    }

    /**
     * List books from a category;
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function list(Request $request): JsonResponse
    {
        
    }

    /**
     * Obtains and show a book;
     *
     * @param string $product_id
     * @return JsonResponse
     */
    public function show(string $product_id): JsonResponse
    {
        
    }
}

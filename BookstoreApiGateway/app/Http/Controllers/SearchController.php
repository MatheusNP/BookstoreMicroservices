<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SearchController extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the search microservice;
     *
     * @var SearchService
     */
    private $searchService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * Obtains and show a book by terms;
     *
     * @param Request $request
     * @return Response
     */
    public function show(Request $request): Response
    {
        return $this->validResponse($this->searchService->show($request->query()));
    }
}

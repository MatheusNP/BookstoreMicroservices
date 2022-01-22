<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
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
     * List all the user's tickets;
     *
     * @param Request $request
     * @param integer $user_id
     * @return JsonResponse
     */
    public function list(Request $request, int $user_id): JsonResponse
    {
        
    }

    /**
     * Create a ticket for the user;
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        
    }
}

<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
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
     * List all the user's orders;
     *
     * @param Request $request
     * @param integer $user_id
     * @return JsonResponse
     */
    public function list(Request $request, int $user_id): JsonResponse
    {

    }

    /**
     * Create an order for the user;
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        
    }

    /**
     * Delete an user's order;
     *
     * @param Request $request
     * @param integer $id
     * @return JsonResponse
     */
    public function destroy(Request $request, int $id): JsonResponse
    {
        
    }
}

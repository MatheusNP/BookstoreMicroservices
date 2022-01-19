<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $tickets = Ticket::where('user_id', $user_id)->get();

        return $this->successResponse($tickets);
    }

    /**
     * Create a ticket for the user;
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $rules = [
            'user_id' => 'required|min:1',
            'email' => 'required|email',
            'description' => 'required|max:255',
        ];

        $this->validate($request, $rules);

        $ticket = Ticket::create($request->all());

        return $this->successResponse($ticket, Response::HTTP_CREATED);
    }
}

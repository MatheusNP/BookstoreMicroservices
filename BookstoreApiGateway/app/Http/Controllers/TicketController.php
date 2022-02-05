<?php

namespace App\Http\Controllers;

use App\Services\TicketService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TicketController extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the support microservice;
     *
     * @var TicketService
     */
    private $ticketService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    /**
     * List all the user's tickets;
     *
     * @param Request $request
     * @return Response
     */
    public function list(Request $request): Response
    {
        $user_id = $request->user()->id;
        return $this->validResponse($this->ticketService->list($user_id));
    }

    /**
     * Create a ticket for the user;
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        $data['username'] = $request->user()->username;

        return $this->validResponse($this->ticketService->store($data));
    }
}

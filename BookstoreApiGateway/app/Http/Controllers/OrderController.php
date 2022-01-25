<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    use ApiResponser;

    /**
     * The service to consume the orders microservice;
     *
     * @var OrderService
     */
    private $orderService;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * List all the user's orders;
     *
     * @param Request $request
     * @return Response
     */
    public function list(Request $request): Response
    {
        $user_id = $request->user()->id;
        return $this->validResponse($this->orderService->list($user_id));
    }

    /**
     * Create an order for the user;
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $data = $request->all();
        $data['user_id'] = $request->user()->id;

        return $this->validResponse($this->orderService->store($data));
    }

    /**
     * Delete an user's order;
     *
     * @param Request $request
     * @param integer $id
     * @return Response
     */
    public function destroy(Request $request, int $id): Response
    {
        $data['user_id'] = $request->user()->id;

        return $this->validResponse($this->orderService->destroy($id, $data));
    }
}

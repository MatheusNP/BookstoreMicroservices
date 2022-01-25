<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $orders = Order::where('user_id', $user_id)->get();

        return $this->successResponse($orders);
    }

    /**
     * Create an order for the user;
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $rules = [
            'user_id' => 'required|min:1',
            'book_id' => 'required|min:1',
            'quantity' => 'required|min:1',
        ];

        $this->validate($request, $rules);

        $order = Order::create($request->all());

        return $this->successResponse($order, Response::HTTP_CREATED);
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
        $order = Order::findOrFail($id);

        if ($order->user_id !== ($request->get('user_id') ?? 0)) {
            return $this->errorResponse('This order is not yours.', Response::HTTP_BAD_REQUEST);
        }

        $order->delete();

        return $this->successResponse($order);
    }
}

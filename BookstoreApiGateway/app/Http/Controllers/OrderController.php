<?php

namespace App\Http\Controllers;

use App\Services\BookService;
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
    public function __construct(OrderService $orderService, BookService $bookService)
    {
        $this->orderService = $orderService;
        $this->bookService = $bookService;
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
        $result_orders = json_decode($this->orderService->list($user_id), true)['data'];
        // $result_orders = json_decode($this->orderService->list(3), true)['data'];

        $books_id = array_column($result_orders, 'book_id');
        $result_books = json_decode($this->bookService->ordered($books_id), true)['data'];

        $data = array_map(function($val) use ($result_books, $books_id) {
            $val['book'] = $result_books[array_search($val['book_id'], $books_id)];

            return $val;
        }, $result_orders);

        $result = json_encode(['data' => $data]);

        return $this->validResponse($result);
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

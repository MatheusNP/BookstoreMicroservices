<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponser
{


    /**
     * Build success responses;
     *
     * @param object|array $data
     * @param integer $code
     * @return JsonResponse
     */
    public function successResponse($data, int $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json(['data' => $data], $code);
    }

    /**
     * Build error responses;
     *
     * @param string|array $message
     * @param integer $code
     * @return JsonResponse
     */
    public function errorResponse($message, int $code): JsonResponse
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    /**
     * Build valid responses;
     *
     * @param string $data
     * @param integer $code
     * @return Response
     */
    public function validResponse(string $data, int $code = Response::HTTP_OK): Response
    {
        return response($data, $code)->header('Content-Type', 'application/json');
    }

    /**
     * Build invalid responses;
     *
     * @param string $message
     * @param integer $code
     * @return Response
     */
    public function invalidResponse(string $message, int $code): Response
    {
        return response($message, $code)->header('Content-Type', 'application/json');
    }
}

<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponser {

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
}

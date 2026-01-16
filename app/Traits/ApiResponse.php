<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Throwable;

trait ApiResponse
{
    protected function successResponse(array $data, string $message = null, int $code = 200): JsonResponse
    {
        return response()->json([
            'status'  => true,
            'message' => $message,
            'data'    => $data
        ], $code);
    }

    protected function errorResponse(int $code, Throwable $error): JsonResponse
    {
        return response()->json([
            'status'  => false,
            'message' => $error->getMessage() ,
            'data'    => null
        ], $code);
    }
}
<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * Return a success JSON response.
     */
    protected function successResponse($data = null, string $message = 'Success', int $code = 200): JsonResponse
    {
        return response()->json([
            'status'  => true,
            'message' => $message,
            'data'    => $data,
            'code'    => $code
        ], $code);
    }

    /**
     * Return an error JSON response.
     */
    protected function errorResponse(string $message, $error = null, int $code = 500): JsonResponse
    {
        return response()->json([
            'status'  => false,
            'message' => $message,
            'error'   => $error,
            'code'    => $code
        ], $code);
    }

    /**
     * Return a validation error JSON response.
     */
    protected function validationErrorResponse(string $message = 'Invalid data', $errors = null, int $code = 422): JsonResponse
    {
        return response()->json([
            'status'  => false,
            'message' => $message,
            'errors'  => $errors,
            'code'    => $code
        ], $code);
    }

    /**
     * Return a not found JSON response.
     */
    protected function notFoundResponse(string $message = 'Resource not found', int $code = 404): JsonResponse
    {
        return response()->json([
            'status'  => false,
            'message' => $message,
            'code'    => $code
        ], $code);
    }

    /**
     * Return a created JSON response.
     */
    protected function createdResponse($data = null, string $message = 'Created successfully', int $code = 201): JsonResponse
    {
        return response()->json([
            'status'  => true,
            'message' => $message,
            'data'    => $data,
            'code'    => $code
        ], $code);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\StockInRequest;
use App\Services\StockService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StockController extends Controller
{
    public function in(StockInRequest $request, StockService $service): JsonResponse
    {
        try {
            $dataValidated = $request->validated();
            $data          = $service->in($dataValidated);

            return response()->json([
                'status'  => true,
                'message' => 'registered entry stock successfully',
                'data'    => $data,
                'code'    => 200,
            ]);
        } catch (ValidationException  $e) {
            return response()->json([
                'status'  => false,
                'message' => 'validation error: ' . $e->getMessage(),
                'code'    => 422
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'error registering entry stock: ' . $e->getMessage(),
                'code'    => 500
            ]);
        }
    }
}

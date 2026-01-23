<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\StockInRequest;
use App\Http\Requests\Stock\StockOutRequest;
use App\Http\Requests\Stock\StockTransferRequest;
use App\Services\StockService;
use Illuminate\Http\JsonResponse;

class StockController extends Controller
{
    public function __construct(protected StockService $stockService){}
    
    public function in(StockInRequest $request): JsonResponse
    {
        $this->stockService->input($request->validated());

        return response()->json([
            'status'  => true,
            'message' => 'registered entry stock successfully',
        ], 201  );
    }

    public function out(StockOutRequest $request): JsonResponse
    {
        $this->stockService->out($request->validated());

        return response()->json([
            'status'  => true,
            'message' => 'registered exit stock successfully',
        ], 200);
        
    }

    public function transfer(StockTransferRequest $request): JsonResponse
    {
        $this->stockService->transfer($request->validated());

        return response()->json([
            'status'  => true,
            'message' => 'stock transferred successfully',
        ], 200);
    }
}
              
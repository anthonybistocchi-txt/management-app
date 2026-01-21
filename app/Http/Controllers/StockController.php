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
        try {
            $this->stockService->inputStock($request->validated());

            return response()->json([
                'status'  => true,
                'message' => 'registered entry stock successfully',
            ], 201  );
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'error registering entry stock: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function out(StockOutRequest $request): JsonResponse
    {
        try {
            $this->stockService->outStock($request->validated());

            return response()->json([
                'status'  => true,
                'message' => 'registered exit stock successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'error registering exit stock: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function transfer(StockTransferRequest $request): JsonResponse
    {
        
        try {
            $this->stockService->transferStock($request->validated());

            return response()->json([
                'status'  => true,
                'message' => 'stock transferred successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'error transferring stock: ' . $e->getMessage(),
            ], 500);
        }
    }
}
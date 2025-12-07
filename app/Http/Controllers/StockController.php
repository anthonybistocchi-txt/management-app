<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Stock\StockInRequest;
use App\Http\Requests\Stock\StockOutRequest;
use App\Http\Requests\Stock\StockTransferRequest;
use App\Services\StockService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StockController extends Controller
{
    protected StockService $service;

    public function __construct(StockService $stockService)
    {
        $this->service = $stockService;
    }
    
    public function in(StockInRequest $request): JsonResponse
    {
        try {
            $dataValidated = $request->validated();
            $data          = $this->service->inputStock($dataValidated);

            return response()->json([
                'status'  => true,
                'message' => 'registered entry stock successfully',
                'data'    => $data,
                'code'    => 200,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'error registering entry stock: ' . $e->getMessage(),
                'code'    => 500
            ]);
        }
    }

    public function out(StockOutRequest $request): JsonResponse
    {
        try {
            $dataValidated = $request->validated();
            $data          = $this->service->outStock($dataValidated);

            return response()->json([
                'status'  => true,
                'message' => 'registered exit stock successfully',
                'data'    => $data,
                'code'    => 200,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'error registering exit stock: ' . $e->getMessage(),
                'code'    => 500
            ]);
        }
    }

    public function transfer(StockTransferRequest $request): JsonResponse
    {
        
        try {
            $dataValidated = $request->validated();
            $data          = $this->service->transferStock($dataValidated);

            return response()->json([
                'status'  => true,
                'message' => 'stock transferred successfully',
                'data'    => $data,
                'code'    => 200,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'error transferring stock: ' . $e->getMessage(),
                'code'    => 500
            ]);
        }
    }
}
<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class InOutController extends Controller
{
    public function __construct(protected InOutService $inOutService){}

    public function getAll(): JsonResponse
    {
        $inOuts = $this->inOutService->getAll();

        return response()->json([
            'status'  => true,
            'message' => 'InOuts retrieved successfully',
            'data'    => $inOuts,
        ], 200);
    
    }
}

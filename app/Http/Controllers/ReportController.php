<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{
    public function getInOutReport(ReportInOutRequest $request): JsonResponse
    {
        $data = $this->reportService->getInOutReport($request->validated());

        return response()->json([
            'status'  => true,
            'message' => 'Report retrieved successfully',
            'data'    => $data,
        ]);
    }

    public function getStockTurnoverReport(ReportStockTurnoverRequest $request): JsonResponse
    {
        $data = $this->reportService->getStockTurnoverReport($request->validated());

        return response()->json([
            'status'  => true,
            'message' => 'Report retrieved successfully',
            'data'    => $data,
        ]);
    }

    public function getInventoryReport(ReportInventoryRequest $request): JsonResponse
    {
        $data = $this->reportService->getInventoryReport($request->validated());

        return response()->json([
            'status'  => true,
            'message' => 'Report retrieved successfully',
            'data'    => $data,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\StockTurnoverRequest;
use App\Services\Reports\StockTurnoverService;
use Illuminate\Http\JsonResponse;

class StockTurnoverController extends Controller
{
    public function __construct(protected StockTurnoverService $stockTurnoverService) {}

    public function getAll(StockTurnoverRequest $request): JsonResponse
    {
        $report = $this->stockTurnoverService->getStockTurnoverData($request->validated());

        return response()->json([
            'status'          => true,
            'message'         => 'Stock turnover report retrieved successfully',
            'recordsTotal'    => $report['recordsTotal']    ?? 0,
            'recordsFiltered' => $report['recordsFiltered'] ?? 0,
            'data'            => $report['data']            ?? [],
        ]);
    }
}

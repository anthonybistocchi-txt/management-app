<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\StockCardRequest;
use App\Services\Reports\StockCardService;
use Illuminate\Http\JsonResponse;

class StockCardController extends Controller
{
    public function __construct(protected StockCardService $stockCardService) {}

    public function getAll(StockCardRequest $request): JsonResponse
    {
        $report = $this->stockCardService->getStockCardData($request->validated());

        return response()->json([
            'status'          => true,
            'message'         => 'Stock card report retrieved successfully',
            'recordsTotal'    => $report['recordsTotal']    ?? 0,
            'recordsFiltered' => $report['recordsFiltered'] ?? 0,
            'data'            => $report['data']            ?? [],
        ]);
    }
}

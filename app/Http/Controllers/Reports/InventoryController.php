<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\InventoryRequest;
use App\Services\Reports\InventoryService;
use Illuminate\Http\JsonResponse;

class InventoryController extends Controller
{
    public function __construct(protected InventoryService $inventoryService) {}

    public function getAll(InventoryRequest $request): JsonResponse
    {
        $report = $this->inventoryService->getInventoryData($request->validated());

        return response()->json([
            'status'          => true,
            'message'         => 'Inventory report retrieved successfully',
            'recordsTotal'    => $report['recordsTotal']    ?? 0,
            'recordsFiltered' => $report['recordsFiltered'] ?? 0,
            'data'            => $report['data']            ?? [],
        ]);
    }
}

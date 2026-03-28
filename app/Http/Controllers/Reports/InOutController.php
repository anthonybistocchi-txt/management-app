<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\InOutRequest;
use App\Services\Reports\InOutService;
use Illuminate\Http\JsonResponse;

class InOutController extends Controller
{
    public function __construct(protected InOutService $inOutService){}

    public function getAll(InOutRequest $request): JsonResponse
    {
        $report = $this->inOutService->getInOutReportData($request->validated());

        return response()->json([
            'status'          => true,
            'message'         => 'report in out retrieved successfully',
            'recordsTotal'    => $report['recordsTotal']    ?? 0,
            'recordsFiltered' => $report['recordsFiltered'] ?? 0,
            'data'            => $report['data']            ?? [],
        ], 200);
    
    }
}

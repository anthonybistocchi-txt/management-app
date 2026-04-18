<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\Exports\InventoryExportRequest;
use App\Http\Requests\Reports\InventoryRequest;
use App\Services\Reports\Exports\InventoryExportService;
use App\Services\Reports\Exports\ReportCsvExporter;
use App\Services\Reports\Exports\ReportPdfExporter;
use App\Services\Reports\InventoryService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class InventoryController extends Controller
{
    public function __construct(
        protected InventoryService        $inventoryService,
        protected InventoryExportService  $inventoryExportService,
        protected ReportCsvExporter       $csvExporter,
        protected ReportPdfExporter       $pdfExporter,
    ) {}

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

    public function exportCsv(InventoryExportRequest $request): Response
    {
        return $this->csvExporter->download(
            $this->inventoryExportService->buildPayload($request->validated()),
        );
    }

    public function exportPdf(InventoryExportRequest $request): Response
    {
        return $this->pdfExporter->download(
            $this->inventoryExportService->buildPayload($request->validated()),
        );
    }
}

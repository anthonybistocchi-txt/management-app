<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\Exports\StockTurnoverExportRequest;
use App\Http\Requests\Reports\StockTurnoverRequest;
use App\Services\Reports\Exports\ReportCsvExporter;
use App\Services\Reports\Exports\ReportPdfExporter;
use App\Services\Reports\Exports\StockTurnoverExportService;
use App\Services\Reports\StockTurnoverService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StockTurnoverController extends Controller
{
    public function __construct(
        protected StockTurnoverService        $stockTurnoverService,
        protected StockTurnoverExportService  $stockTurnoverExportService,
        protected ReportCsvExporter           $csvExporter,
        protected ReportPdfExporter           $pdfExporter,
    ) {}

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

    public function exportCsv(StockTurnoverExportRequest $request): Response
    {
        return $this->csvExporter->download(
            $this->stockTurnoverExportService->buildPayload($request->validated()),
        );
    }

    public function exportPdf(StockTurnoverExportRequest $request): Response
    {
        return $this->pdfExporter->download(
            $this->stockTurnoverExportService->buildPayload($request->validated()),
        );
    }
}

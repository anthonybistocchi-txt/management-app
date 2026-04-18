<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\Exports\StockCardExportRequest;
use App\Http\Requests\Reports\StockCardRequest;
use App\Services\Reports\Exports\ReportCsvExporter;
use App\Services\Reports\Exports\ReportPdfExporter;
use App\Services\Reports\Exports\StockCardExportService;
use App\Services\Reports\StockCardService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StockCardController extends Controller
{
    public function __construct(
        protected StockCardService        $stockCardService,
        protected StockCardExportService  $stockCardExportService,
        protected ReportCsvExporter       $csvExporter,
        protected ReportPdfExporter       $pdfExporter,
    ) {}

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

    public function exportCsv(StockCardExportRequest $request): Response
    {
        return $this->csvExporter->download(
            $this->stockCardExportService->buildPayload($request->validated()),
        );
    }

    public function exportPdf(StockCardExportRequest $request): Response
    {
        return $this->pdfExporter->download(
            $this->stockCardExportService->buildPayload($request->validated()),
        );
    }
}

<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\Exports\InOutExportRequest;
use App\Http\Requests\Reports\InOutRequest;
use App\Services\Reports\Exports\InOutExportService;
use App\Services\Reports\Exports\ReportCsvExporter;
use App\Services\Reports\Exports\ReportPdfExporter;
use App\Services\Reports\InOutService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class InOutController extends Controller
{
    public function __construct(
        protected InOutService        $inOutService,
        protected InOutExportService  $inOutExportService,
        protected ReportCsvExporter   $csvExporter,
        protected ReportPdfExporter   $pdfExporter,
    ) {}

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

    public function exportCsv(InOutExportRequest $request): Response
    {
        return $this->csvExporter->download(
            $this->inOutExportService->buildPayload($request->validated()),
        );
    }

    public function exportPdf(InOutExportRequest $request): Response
    {
        return $this->pdfExporter->download(
            $this->inOutExportService->buildPayload($request->validated()),
        );
    }
}

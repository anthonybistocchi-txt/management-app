<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\DashboardRequest;
use App\Services\DashboardService;
use Illuminate\Http\JsonResponse;
class DashboardController extends Controller
{
    public function __construct(protected DashboardService $dashboardService){}

    public function getDashboardData(DashboardRequest $request): JsonResponse
    {
        try {
            $data = $this->dashboardService->getDashboardData($request->validated());
    
            return response()->json([
                'status'  => true,
                'message' => 'Dashboard data retrieved successfully',
                'data'    => $data
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Error retrieving dashboard data: ' . $e->getMessage(),
                'data'    => null
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\ProductCategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function __construct(protected ProductCategoryService $productCategoryService){}

    public function getAll(): JsonResponse
    {
        $categories = $this->productCategoryService->getAll();

        return response()->json([
            'status'  => true,
            'message' => "success",
            'data'    => $categories,
        ], 200);
    }
}

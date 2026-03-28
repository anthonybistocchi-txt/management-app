<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use ProductCategoryService;

class ProductCategory extends Controller
{
    public function __construct(protected ProductCategoryService $productCategoryService){}

    public function getAll(): JsonResponse
    {
        $productCategories = $this->productCategoryService->getAll();

        return response()->json([
            'status'  => true,
            'message' => 'Product categories retrieved successfully',
            'data'    => $productCategories,
        ], 200);

    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\DeleteProductRequest;
use App\Http\Requests\Product\GetProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService){}

    public function getAll(): JsonResponse
    {
        $products = $this->productService->getAll();

        return response()->json([
            'status'  => true,
            'message' => "success",
            'data'    => $products,
        ],200);
    }

    public function create(CreateProductRequest $request): JsonResponse
    {    
        $this->productService->create($request->validated());

        return response()->json([
            'status'  => true,
            'message' => "product created successfully",
        ],201);
    }

    public function update(UpdateProductRequest $request, int $id): JsonResponse
    {
        $this->productService->update(array_merge(
            $request->validated(),
            ['id' => $id],
        ));

        return response()->json([
            'status'  => true,
            'message' => "product updated successfully",
        ],200);
    }

    public function delete(DeleteProductRequest $request): JsonResponse
    {
        $this->productService->delete($request->validated()['id']);

        return response()->json([
            'status'  => true,
            'message' => 'product deleted successfully',
        ],200);
    }

    public function get(GetProductRequest $request): JsonResponse
    {
        $products = $this->productService->get($request->validated()['id']);

        return response()->json([
            'status'  => true,
            'message' => "success",
            'data'    => $products,
        ], 200);
    }

    public function search(Request $request): JsonResponse
    {
        $query    = $request->query('q', '');
        $products = $this->productService->search($query);

        return response()->json($products);
    }
    
}
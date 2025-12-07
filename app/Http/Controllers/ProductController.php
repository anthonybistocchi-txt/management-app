<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(): JsonResponse
    {
        try {
            $products = $this->productService->getAllProducts();

            return response()->json([
                'status'  => true,
                'message' => "Success",
                'data'    => $products,
                'code'    => 200
            ]);

        } catch (\Exception $e) {
            return $this->errorResponse('Error fetching products', $e);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $product = $this->productService->getProduct($id);
            return response()->json([
                'status'  => true,
                'message' => "Success",
                'data'    => $product,
                'code'    => 200
            ]);

        } catch (\Exception $e) {
            return $this->errorResponse('Error retrieving product', $e);
        }
    }

    public function store(CreateProductRequest $request): JsonResponse
    {    
        try {
            $product = $this->productService->createProduct($request->validated());

            return response()->json([
                'status'  => true,
                'message' => "Product created successfully",
                'data'    => $product,
                'code'    => 201
            ]);

        } catch (\Exception $e) {
            return $this->errorResponse('Error creating product', $e);
        }
    }

    public function update(UpdateProductRequest $request, $id): JsonResponse
    {
        try {
            $product = $this->productService->updateProduct($id, $request->validated());

            return response()->json([
                'status'  => true,
                'message' => "Product updated successfully",
                'data'    => $product,
                'code'    => 200
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Product not found',
                'code'    => 404
            ]);
        } catch (\Exception $e) {
            return $this->errorResponse('Error updating product', $e);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {

            $this->productService->deleteProduct($id);

            return response()->json([
                'status'  => true,
                'message' => 'Product deleted successfully',
                'code'    => 200
            ]);

        } catch (\Exception $e) {
            return $this->errorResponse('Error deleting product', $e);
        }
    }

    private function errorResponse($message, \Exception $e)
    {
        return response()->json([
            'status'  => false,
            'message' => $message,
            'error'   => $e->getMessage(),
            'code'    => 500 
        ]);
    }
}
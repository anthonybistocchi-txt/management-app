<?php

namespace App\Http\Controllers;


use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\getProductsByIdsRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService){}

    public function getAllProducts(): JsonResponse
    {
        try {
            $products = $this->productService->getAllProducts();

            return response()->json([
                'status'  => true,
                'message' => "Success",
                'data'    => $products,
            ],200);

        } catch (\Exception $error) {
            return response()->json([
                'status'  => false,
                'message' => 'Error fetching products',
            ],500);
        }
    }

    public function getProduct($id): JsonResponse
    {
        try {
            $product = $this->productService->getProduct($id);
            
            return response()->json([
                'status'  => true,
                'message' => "Success",
                'data'    => $product,
            ],200);

        } catch (\Exception $error) {
            return response()->json([
                'status'  => false,
                'message' => 'Error fetching product',
            ],500);
        }
    }

    public function createProduct(CreateProductRequest $request): JsonResponse
    {    
        try {
            $product = $this->productService->createProduct($request->validated());

            return response()->json([
                'status'  => true,
                'message' => "Product created successfully",
                'data'    => $product,
            ],201);

        } catch (\Exception $error) {
            return response()->json([
                'status'  => false,
                'message' => 'Error creating product',
            ],500);
        }
    }

    public function updateProduct(UpdateProductRequest $request, $id): JsonResponse
    {
        try {
            $product = $this->productService->updateProduct($id, $request->validated());

            return response()->json([
                'status'  => true,
                'message' => "Product updated successfully",
                'data'    => $product,
            ],200);
        } catch (\Exception $error) {
            return response()->json([
                'status'  => false,
                'message' => 'Error updating product',
            ],500);
        }
    }

    public function deleteProduct($id): JsonResponse
    {
        try {
            $this->productService->deleteProduct($id);

            return response()->json([
                'status'  => true,
                'message' => 'Product deleted successfully',
            ],200);

        } catch (\Exception $error) {
            return response()->json([
                'status'  => false,
                'message' => 'Error deleting product',
            ],500);
        }
    }

    public function getProductsByIds(getProductsByIdsRequest $request): JsonResponse
    {
        try {
            $products = $this->productService->getProductsByIds($request->validated());

            return response()->json([
                'status'  => true,
                'message' => "Success",
                'data'    => $products,
                
            ],200);

        } catch (\Exception $error) {
            return response()->json([
                'status'  => false,
                'message' => 'Error fetching products',
            ],500);
        }
    }
    
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Traits\ApiResponse;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    use ApiResponse;

    public function createProduct(CreateProductRequest $request, ProductService $productService): JsonResponse
    {
        try {
            $dataValidated = $request->validated();
            $product       = $productService->createProduct($dataValidated);

            return $this->createdResponse($product, 'Product created successfully');
        } catch (ValidationException $e) {
            return $this->validationErrorResponse('Invalid data', $e->getMessage());
        } catch (\Exception $e) {
            return $this->errorResponse('Error creating product', $e->getMessage());
        }
    }
    
    public function deleteProduct($id, ProductService $productService): JsonResponse
    {
        try {
            $product = $productService->deleteProduct($id);

            if ($product) {
                return $this->successResponse(null, 'Product deleted successfully');
            }
            
            return $this->notFoundResponse('Product not found');
        } catch (\Exception $e) {
            return $this->errorResponse('Error deleting product', $e->getMessage());
        }
    }
    
    public function updateProduct(UpdateProductRequest $request, $id, ProductService $productService): JsonResponse
    {
        try {
            $dataValidated = $request->validated();
            $product       = $productService->updateProduct($id, $dataValidated);

            return $this->successResponse($product, 'Product updated successfully');
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Product not found');
        } catch (ValidationException $e) {
            return $this->validationErrorResponse('Invalid data', $e->errors());
        } catch (\Exception $e) {
            return $this->errorResponse('Error updating product', $e->getMessage());
        }
    }
    
    public function getProduct(Request $request, ProductService $productService): JsonResponse
    {
        if (!$request->has('id') || empty($request->id)) {
            return $this->errorResponse('ID parameter is required', null, 400);
        }

        try {
            $product = $productService->getProduct($request->id);

            if ($product->isEmpty()) {
                return $this->notFoundResponse('Product not found');
            }
            
            return $this->successResponse($product);
        } catch (\Exception $e) {
            return $this->errorResponse('Error retrieving product', $e->getMessage());
        }
    }

    public function getAllProducts(ProductService $productService): JsonResponse
    {
        try {
            $products = $productService->getAllProducts();

            if (empty($products)) {
                return $this->notFoundResponse('Products not found');
            }
            
            return $this->successResponse($products);
        } catch (\Exception $e) {
            return $this->errorResponse('Error retrieving products', $e->getMessage());
        }
    }
}


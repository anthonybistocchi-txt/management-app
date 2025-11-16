<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function createProduct(CreateProductRequest $request, ProductService $productService): JsonResponse
    {
        try {
            $dataValidated = $request->validated();
            $product       = $productService->createProduct($dataValidated);

            return response()->json([
                'status'  => true,
                'message' => "product created successfully",
                'data'    => $product,
                'code'    => 201
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status'   => false,
                'message'  => 'invalid datas',
                'errors'   => $e->getMessage(),
                'code'     => 422
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => "error creating product",
                'error'   => $e->getMessage(),
                'code'    => 422
            ]);
        }
    }
    public function deleteProduct($id, ProductService $productService): JsonResponse
    {
        try {
            $product = $productService->deleteProduct($id);

            if ($product) {
                return response()->json([
                    'status'   => true,
                    'message'  => 'product delete with successful',
                    'code'     => 200
                ]);
            }
            return response()->json([
                'status'  => true,
                'error'   => 'error to delete product',
                'message' => 'product not found',
                'code'    => 404

            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => "error deleting product",
                'error'   => $e->getMessage(),
                'code'    => 422
            ]);
        }
    }
    public function updateProduct(UpdateProductRequest $request, $id, ProductService $productService)
    {
        try {
            $dataValidated = $request->validated();
            $product       = $productService->updateProduct($id, $dataValidated);

            return response()->json([
                'status'  => true,
                'message' => "product updated successfully",
                'data'    => $product,
                'code'    => 200
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => false,
                'message' => 'product not found',
                'code'    => 404
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status'  => false,
                'message' => 'invalid data',
                'errors'  => $e->errors(),
                'code'    => 422
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => "error updating product",
                'error'   => $e->getMessage(),
                'code'    => 422
            ]);
        }
    }
    public function getProduct(Request $request, ProductService $productService): JsonResponse
    {
        if (!$request->has('id') || empty($request->id)) {
            return response()->json([
                'status'  => false,
                'message' => 'id parameter is required',
                'code'    => 400
            ]);
        }

        try {
            $product = $productService->getProduct($request->id);

            if ($product->isEmpty()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'product not found',
                    'code'    => 404
                ]);
            }
            return response()->json([
                'status'  => true,
                'message' => "sucess",
                'data'    => $product,
                'code'    => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => "error retrieving product",
                'error'   => $e->getMessage(),
                'code'    => 422
            ]);
        }
    }

    public function getAllProducts(ProductService $productService): JsonResponse
    {
        try {
            $products = $productService->getAllProducts();

            if (empty($products)) {
                return response()->json([
                    'status'  => false,
                    'message' => 'products not found',
                    'code'    => 404
                ]);
            }
            return response()->json([
                'status'  => true,
                'message' => "sucess",
                'data'    => $products,
                'code'    => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => "error to get products",
                'error'   => $e->getMessage(),
                'code'    => 422
            ]);
        }
    }
}

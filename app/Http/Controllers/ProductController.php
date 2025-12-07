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

        } catch (\Exception $error) {
            return $this->errorResponse('Error fetching products', $error);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $product = $this->productService->getProduct($id);

            if (!$product) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Product not found',
                    'code'    => 404
                ]);
            }
            
            return response()->json([
                'status'  => true,
                'message' => "Success",
                'data'    => $product,
                'code'    => 200
            ]);

        } catch (\Exception $error) {
            return $this->errorResponse('Error retrieving product', $error);
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

        } catch (\Exception $error) {
            return $this->errorResponse('Error creating product', $error);
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

        } catch (ModelNotFoundException $error) {
            return response()->json([
                'status'  => false,
                'message' => 'Product not found',
                'code'    => 404
            ]);
        } catch (\Exception $error) {
            return $this->errorResponse('Error updating product', $error);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $deleted = $this->productService->deleteProduct($id);

            if (!$deleted) {
                 return response()->json([
                    'status'  => false,
                    'message' => 'Product not found or could not be deleted',
                    'code'    => 404
                ]);
            }

            return response()->json([
                'status'  => true,
                'message' => 'Product deleted successfully',
                'code'    => 200
            ]);

        } catch (\Exception $error) {
            return $this->errorResponse('Error deleting product', $error);
        }
    }

    public function getProductsByIds(getProductsByIdsRequest $request): JsonResponse
    {
        try {
            $data     = $request->validated();
            $products = $this->productService->getProductsByIds($data['ids']);

            return response()->json([
                'status'  => true,
                'message' => "Success",
                'data'    => $products,
                'code'    => 200
            ]);

        } catch (\Exception $error) {
            return $this->errorResponse('Error fetching products by IDs', $error);
        }
    }
    
    private function errorResponse($message, \Exception $error)
    {
        return response()->json([
            'status'  => false,
            'message' => $message,
            'error'   => $error->getMessage(),
            'code'    => 500 
        ]);
    }
}
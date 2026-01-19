<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProviderRequest;
use App\Http\Requests\Provider\GetProviderRequest;
use App\Http\Requests\Provider\UpdateProviderRequest;
use App\Services\ProviderService;
use Illuminate\Http\JsonResponse;


class ProviderController extends Controller
{
    public function __construct(protected ProviderService $providerService){}
    
    public function createProvider(CreateProviderRequest $request): JsonResponse
    {
        try {
            $this->providerService->createProvider($request->validated());

            return response()->json([
                'status'  => true,
                'message' => 'provider created with successful',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'error to create provider',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function deleteProvider($id): JsonResponse
    {
        try {
            $this->providerService->deleteProvider($id);

                return response()->json([
                    'status'   => true,
                    'message'  => 'provider delete with successful',
                ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'error to delete provider',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function updateProvider($id, UpdateProviderRequest $request): JsonResponse
    {
        try {
            $provider = $this->providerService->updateProvider($id, $request->validated());

            return response()->json([
                'status'  => true,
                'message' => 'provider updated with sucessful',
                'data'    => $provider,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'error to update provider',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }


    public function getProvider(GetProviderRequest $request): JsonResponse
    {
        try {   
            $provider = $this->providerService->getProvider($request->validated());
            return response()->json([
                'status'  => true,
                'message' => 'success',
                'data'    => $provider,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'error to get provider',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function getAllProviders(): JsonResponse
    {
        try {
            $providers = $this->providerService->getAllProviders();

            return response()->json([
                'status'  => true,
                'message' => 'success',
                'data'    => $providers,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'error to get providers',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}

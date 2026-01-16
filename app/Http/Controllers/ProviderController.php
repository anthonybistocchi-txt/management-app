<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProviderRequest;
use App\Http\Requests\Provider\DeleteProviderRequest;
use App\Http\Requests\Provider\GetProviderRequest;
use App\Http\Requests\Provider\UpdateProviderRequest;
use App\Services\ProviderService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProviderController extends Controller
{
    protected $providerService;

    public function __construct(ProviderService $providerService)
    {
        $this->providerService = $providerService;
    }
    
    public function createProvider(CreateProviderRequest $request): JsonResponse
    {
        try {
            $dataValidated = $request->validated();
            $provider      = $this->providerService->createProvider($dataValidated);

            return response()->json([
                'status'  => true,
                'message' => 'provider created with sucessful',
                'data'    => $provider,
                'code'    => 201
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status'  => false,
                'message' => 'invalid data',
                'errors'  => $e->errors(), // Mostra os erros
                'code'    => 422
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'error to create provider',
                'error'   => $e->getMessage(),
                'code'    => 500
            ]);
        }
    }

    public function deleteProvider($id, ProviderService $providerService): JsonResponse
    {
        try {
                $this->providerService->deleteProvider($id);

                return response()->json([
                    'status'   => true,
                    'message'  => 'provider delete with successful',
                    'code'     => 200
                ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'error to delete provider',
                'error'   => $e->getMessage(),
                'code'    => 500
            ]);
        }
    }

    public function updateProvider($id, UpdateProviderRequest $request): JsonResponse
    {
        try {
            $request->validated();
            $provider = $this->providerService->updateProvider($id, $request->all());

            return response()->json([
                'status'  => true,
                'message' => 'provider updated with sucessful',
                'data'    => $provider,
                'code'    => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'error to update provider',
                'error'   => $e->getMessage(),
                'code'    => 500
            ], 500);
        }
    }


    public function getProvider(GetProviderRequest $request, ProviderService $providerService): JsonResponse
    {
        try {
            $data     = $request->validated();
            $provider = $providerService->getProvider($data['ids']);

            return response()->json([
                'status'  => true,
                'message' => 'success',
                'data'    => $provider,
                'code'    => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'error to get provider',
                'error'   => $e->getMessage(),
                'code'    => 500
            ]);
        }
    }

    public function getAllProviders(ProviderService $providerService): JsonResponse
    {
        try {
            $providers = $providerService->getAllProviders();

            if (empty($providers)) {
                return response()->json([
                    'status'  => false,
                    'message' => 'providers not found',
                    'code'    => 404

                ]);
            }
            return response()->json([
                'status'  => true,
                'message' => 'success',
                'data'    => $providers,
                'code'    => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'error to get providers',
                'error'   => $e->getMessage(),
                'code'    => 500
            ]);
        }
    }
}

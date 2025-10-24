<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use ProviderService;

class ProviderController extends Controller
{
    public function createProvider(Request $request, ProviderService $providerService): JsonResponse
    {
        try {
            $provider = $providerService->createProvider($request);

            return response()->json([
                'status'     => true,
                'message'    => 'provider create with successful',
                'data'       => $provider,
                'code'       => 201
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
                'status'     => false,
                'message'    => 'error to create provider',
                'error'      => $e->getMessage(),
                'code'       => 500
            ]);
        }
    }

    public function deleteProvider(Request $request, ProviderService $providerService): JsonResponse
    {
        try {
            $provider = $providerService->deleteProvider($request->all());

            if ($provider) {
                return response()->json([
                    'status'   => true,
                    'message'  => 'provider delete with successful',
                    'code'     => 200
                ]);
            }

            return response()->json([
                'status'  => true,
                'error'   => 'error to delete provider',
                'message' => 'provider not found',
                'code'    => 404

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

    public function updateProvider($id, Request $request, ProviderService $providerService): JsonResponse
    {
        try {
            $provider = $providerService->updateProvider($request, $id);

            return response()->json([
                'status'  => true,
                'message' => 'provider updated with sucessful',
                'data'    => $provider,
                'code'    => 200
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => false,
                'message' => 'provider not found',
                'code'    => 404
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
                'message' => 'error to update provider',
                'error'   => $e->getMessage(),
                'code'    => 500
            ], 500);
        }
    }


    public function getProvider(Request $request, ProviderService $providerService): JsonResponse
    {

        if (!$request->has('id') || empty($request->id)) {
            return response()->json([
                'status'  => false,
                'message' => 'id parameter is required',
                'code'    => 400
            ]);
        }

        try {
            $provider = $providerService->getProvider($request->id);

            if ($provider->isEmpty()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'provider not found',
                    'code'    => 404
                ]);
            }

            return response()->json([
                'status'  => true,
                'message' => 'sucess',
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

            if (!$providers) {
                return response()->json([
                    'status'  => false,
                    'message' => 'providers not found',
                    'code'    => 404

                ]);
            }
            return response()->json([
                'status'  => true,
                'message' => 'sucess',
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

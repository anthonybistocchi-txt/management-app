<?php

namespace App\Http\Controllers;

use App\Http\Requests\Provider\CreateProviderRequest;
use App\Http\Requests\Provider\UpdateProviderRequest;
use App\Http\Traits\ApiResponse;
use App\Services\ProviderService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProviderController extends Controller
{
    use ApiResponse;

    public function createProvider(CreateProviderRequest $request, ProviderService $providerService): JsonResponse
    {
        try {
            $dataValidated = $request->validated();
            $provider      = $providerService->createProvider($dataValidated);

            return $this->createdResponse($provider, 'Provider created successfully');
        } catch (ValidationException $e) {
            return $this->validationErrorResponse('Invalid data', $e->getMessage());
        } catch (\Exception $e) {
            return $this->errorResponse('Error creating provider', $e->getMessage());
        }
    }

    public function deleteProvider($id, ProviderService $providerService): JsonResponse
    {
        try {
            $provider = $providerService->deleteProvider($id);

            if ($provider) {
                return $this->successResponse(null, 'Provider deleted successfully');
            }

            return $this->notFoundResponse('Provider not found');
        } catch (\Exception $e) {
            return $this->errorResponse('Error deleting provider', $e->getMessage());
        }
    }

    public function updateProvider($id, UpdateProviderRequest $request, ProviderService $providerService): JsonResponse
    {
        try {
            $dataValidated = $request->validated();
            $provider      = $providerService->updateProvider($id, $dataValidated);

            return $this->successResponse($provider, 'Provider updated successfully');
        } catch (ModelNotFoundException $e) {
            return $this->notFoundResponse('Provider not found');
        } catch (ValidationException $e) {
            return $this->validationErrorResponse('Invalid data', $e->errors());
        } catch (\Exception $e) {
            return $this->errorResponse('Error updating provider', $e->getMessage());
        }
    }


    public function getProvider(Request $request, ProviderService $providerService): JsonResponse
    {

        if (!$request->has('id') || empty($request->id)) {
            return $this->errorResponse('ID parameter is required', null, 400);
        }

        try {
            $provider = $providerService->getProvider($request->id);

            if ($provider->isEmpty()) {
                return $this->notFoundResponse('Provider not found');
            }

            return $this->successResponse($provider);
        } catch (\Exception $e) {
            return $this->errorResponse('Error retrieving provider', $e->getMessage());
        }
    }

    public function getAllProviders(ProviderService $providerService): JsonResponse
    {
        try {
            $providers = $providerService->getAllProviders();

            if (empty($providers)) {
                return $this->notFoundResponse('Providers not found');
            }
            
            return $this->successResponse($providers);
        } catch (\Exception $e) {
            return $this->errorResponse('Error retrieving providers', $e->getMessage());
        }
    }
}

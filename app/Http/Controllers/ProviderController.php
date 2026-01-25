<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProviderRequest;
use App\Http\Requests\Provider\DeleteProviderRequest;
use App\Http\Requests\Provider\GetProviderRequest;
use App\Http\Requests\Provider\UpdateProviderRequest;
use App\Services\ProviderService;
use Illuminate\Http\JsonResponse;


class ProviderController extends Controller
{
    public function __construct(protected ProviderService $providerService){}
    
    public function create(CreateProviderRequest $request): JsonResponse
    {
        $this->providerService->create($request->validated());

        return response()->json([
            'status'  => true,
            'message' => 'provider created with successful',
        ], 201);
    }  


    public function delete(DeleteProviderRequest $request): JsonResponse
    {
        $this->providerService->delete($request->validated()['id']);

        return response()->json([
            'status'   => true,
            'message'  => 'provider delete with successful',
        ], 200);
    }

    public function update(UpdateProviderRequest $request): JsonResponse
    {
        $this->providerService->update($request->validated());

        return response()->json([
            'status'  => true,
            'message' => 'provider updated with sucessful',
        ], 200);
    }


    public function get(GetProviderRequest $request): JsonResponse
    {   
        $provider = $this->providerService->get($request->validated()['id']);

        return response()->json([
            'status'  => true,
            'message' => 'success',
            'data'    => $provider,
        ], 200);
    }

    public function getAll(): JsonResponse
    {   
        $providers = $this->providerService->getAll();

        return response()->json([
            'status'  => true,
            'message' => 'success',
            'data'    => $providers,
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLocationRequest;
use App\Http\Requests\DeleteLocationRequest;
use App\Http\Requests\GetLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Services\LocationService;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
    public function __construct(protected LocationService $service){}

    public function getAll(): JsonResponse
    {
       $data = $this->service->getAllLocations();

       return response()->json([
            'status' => true,
            'message'=> 'Locations retrieved successfully',
            'data'   => $data
        ],200);
    }

    public function create(CreateLocationRequest $request): JsonResponse
    {
        $this->service->create($request->validated());

        return response()->json([
            'status'  => true,
            'message' => 'Location created successfully',
        ],201);
    }

    public function update(UpdateLocationRequest $request): JsonResponse
    {
        $this->service->update($request->validated());

        return response()->json([
            'status'  => true,
            'message' => 'Location updated successfully',
        ],200);
    }

    public function delete(DeleteLocationRequest $request): JsonResponse
    {
        $this->service->delete($request->validated()['id']);

        return response()->json([
            'status'  => true,
            'message' => 'Location deleted successfully',
        ],200);
    }

    public function get(GetLocationRequest $request): JsonResponse
    {
        $data = $this->service->get($request->validated()['id']);
        return response()->json([
            'status'  => true,
            'message' => 'Location(s) retrieved successfully',
            'data'    => $data
        ],200);
    }
}

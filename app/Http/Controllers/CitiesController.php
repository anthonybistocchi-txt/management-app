<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CitiesAllRequest;
use App\Services\CitiesService;
use Illuminate\Http\JsonResponse;

class CitiesController extends Controller
{
    public function __construct(protected CitiesService $citiesService){}
    public function getAll(CitiesAllRequest $request):JsonResponse
    {
        return response()->json($this->citiesService->getAllCities($request->validated()['uf_id'] ?? null));
    }

    public function getCityByCEP(string $cep):JsonResponse
    {
        return response()->json($this->citiesService->getCityByCEP($cep));
    }
}

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
        return $this->citiesService->getAllCities($request->validated()['uf_id']);
    }

    public function getCityByCEP(string $cep):JsonResponse
    {
        return $this->citiesService->getCityByCEP($cep);
    }
}

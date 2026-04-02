<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CitiesAllRequest;
use App\Services\CitiesService;

class CitiesController extends Controller
{
    public function __construct(protected CitiesService $citiesService){}
    public function getAll(CitiesAllRequest $request)
    {
        return $this->citiesService->getAllCities($request->validated()['uf_id']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CEPRequest;
use App\Services\CepService;
use Illuminate\Http\Request;

class CEPController extends Controller
{
    public function __construct(protected CepService $cepService){}

    public function getAddress(CEPRequest $request)
    {
        return $this->cepService->getAddressByCep($request->validated()['cep']);
    }
}

<?php 

namespace App\Services;

use Illuminate\Support\Facades\Http;

class  CepService
{
    public function getAddressByCep(string $cep)
    {
       return Http::get("https://viacep.com.br/ws/$cep/json/")
            ->json();
    }
}
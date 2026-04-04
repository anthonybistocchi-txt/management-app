<?php 

namespace App\Services;

use Illuminate\Support\Facades\Http;

class  CepService
{
    public function getAddressByCep(string $cep)
    {
       $cep = Http::get("https://viacep.com.br/ws/$cep/json/")
            ->json();

        if(!$cep) 
        {
            throw new \Exception('Error fetching address for the provided CEP.', 500);
        }

        return $cep;
    }
}
<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class CitiesService
{
    public function getAllCities(string $uf)
    {
        return Http::get("https://servicodados.ibge.gov.br/api/v1/localidades/estados/$uf/municipios")
            ->json();

    }
}
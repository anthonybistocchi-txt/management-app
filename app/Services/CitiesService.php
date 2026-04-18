<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class CitiesService
{
    public function __construct(protected CepService $cepService){}
    public function getAllCities(?string $uf): array
    {
        $url = $uf
            ? "https://servicodados.ibge.gov.br/api/v1/localidades/estados/$uf/municipios"
            : "https://servicodados.ibge.gov.br/api/v1/localidades/municipios";

        $cities = Http::get($url)->json();

        if (!$cities) {
            throw new \Exception('No cities found for the provided state ID.', 404);
        }

        return $cities;
    }

    public function getCityByCEP(string $cep): array
    {
        $cepData = $this->cepService->getAddressByCep($cep);

        if (!$cepData) {
            throw new \Exception('No city found for the provided CEP.', 404);
        }

      return [
            'city'  => $cepData['localidade'] ?? null,
            'uf'    => $cepData['uf']         ?? null,
            'state' => $cepData['estado']     ?? null,
        ];
    }
}
<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class UFService
{
    public function getAllUFs()
    {
        return Http::get('https://servicodados.ibge.gov.br/api/v1/localidades/estados')
            ->json();
    }
}
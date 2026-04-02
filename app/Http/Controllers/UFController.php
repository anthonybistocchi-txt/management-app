<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\UFService;

class UFController extends Controller
{
    public function __construct(protected UFService $ufService){}
    public function getAll()
    {
        return $this->ufService->getAllUFs();
    }
}

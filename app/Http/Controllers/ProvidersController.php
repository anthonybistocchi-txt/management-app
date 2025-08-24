<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProvidersController extends Controller
{
    public function providers()
    {
        return view('webSite.providers');
    }
}

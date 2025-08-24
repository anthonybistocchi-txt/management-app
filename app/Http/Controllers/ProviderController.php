<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function providers()
    {
        return view('webSite.provider');
    }
}

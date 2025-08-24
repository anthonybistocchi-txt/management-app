<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function clients()
    {
        return view('webSite.clients');
    }
}

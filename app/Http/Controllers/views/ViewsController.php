<?php

namespace App\Http\Controllers\views;

use App\Http\Controllers\Controller;

class ViewsController extends Controller
{
     public function showLogin()
    {
        return view('auth.login');
    }

    public function showCreateUser()
    {
        return view('auth.create-user');
    }

    public function showResetPassword()
    {
        return view('auth.reset-password');
    }

    public function showDashboard()
    {
        return view('index.dashboard');
    }

    public function showUsers()
    {
        return view('index.management-users');
    }

    public function showProviders()
    {
        return view('index.management-providers');
    }

    public function showProducts()
    {
        return view('index.management-products');
    }

    public function showStock()
    {
        return view('index.management-stock-in');
    }

    public function showStockOut()
    {
        return view('index.management-stock-out');
    }

    public function showMovements()
    {
        return view('index.management-movements');
    }


}

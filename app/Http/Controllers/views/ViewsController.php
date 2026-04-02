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

    public function showLocations()
    {
        return view('index.management-locations');
    }

    public function showRegisterProvider()
    {
        return view('index.register-provider');
    }

    public function showProducts()
    {
        return view('index.management-products');
    }

    public function showCategories()
    {
        return view('index.management-categories');
    }

    public function showRegisterProduct()
    {
        return view('index.register-product');
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

    public function showReportInOut()
    {
        return view('index.report-in-out');
    }

    public function showReportStockTurnover()
    {
        return view('index.report-stock-turnover');
    }

    public function showReportInventory()
    {
        return view('index.report-inventory');
    }

    public function showStockCard()
    {
        return view('index.stock-card');
    }
}

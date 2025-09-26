<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProvidersController;


route::get('/gestao-pro', [IndexController::class, 'index'])->name('index');
route::get('/sobre-nos', [AboutUsController::class, 'aboutUs'])->name('aboutUs');
route::get('/contato', [ContactController::class, 'contact'])->name('contact');
route::get('/login', [LoginController::class, 'login'])->name('login');

Route::prefix('/dashboard')->group(function () {
     route::get('/clientes', [ClientsController::class, 'clients'])->name('clients');
     route::get('/produtos', [ProductsController::class, 'products'])->name('products');
     route::get('/fornecedores', [ProvidersController::class, 'providers'])->name('providers');
});
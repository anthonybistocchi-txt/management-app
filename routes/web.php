<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ReasonController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProviderController;


Route::get('/login', [LoginController::class, 'login'])->name('get.login');
Route::post('/login', [LoginController::class, 'login'])->name('post.login');

Route::get('/cadastro', [RegisterController::class, 'register'])->name('get.register');
Route::post('/cadastro', [RegisterController::class, 'register'])->name('post.register');

/*
|--------------------------------------------------------------------------
| Rotas protegidas 
|--------------------------------------------------------------------------
*/

// Route::middleware(['auth'])->group(function () {

Route::get('/gestao-pro', [IndexController::class, 'index'])->name('get.index');


Route::get('/reasons/{id}', [ReasonController::class, 'getReason'])->name('get.reasons');
Route::post('/reasons', [ReasonController::class, 'createReason'])->name('post.reasons');
Route::put('/reasons/{id}', [ReasonController::class, 'updateReasons'])->name('put.reasons');
Route::delete('/reasons/{id}', [ReasonController::class, 'deleteReasons'])->name('delete.reasons');

Route::get('/users/{id}', [UserController::class, 'getUser'])->name('get.users');
Route::post('/users', [UserController::class, 'createUser'])->name('post.users');
Route::put('/users/{id}', [UserController::class, 'updateUser'])->name('put.users');
Route::delete('/users/{id}', [UserController::class, 'deleteUser'])->name('delete.users');


Route::get('/providers/{id}', [ProviderController::class, 'getProvider'])->name('get.providers');
Route::post('/providers', [ProviderController::class, 'createProvider'])->name('post.providers');
Route::put('/providers/{id}', [ProviderController::class, 'updateProvider'])->name('put.providers');
Route::delete('/providers/{id}', [ProviderController::class, 'deleteProvider'])->name('delete.providers');

// });

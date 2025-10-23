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

Route::get('/getUser/{id}', [UserController::class, 'getUser'])->name('get.user');
Route::get('/getAllUsers', [UserController::class, 'getAllUser'])->name('getAll.user');
Route::post('/createUser', [UserController::class, 'createUser'])->name('create.user');
Route::put('/updateUser/{id}', [UserController::class, 'updateUser'])->name('update.user');
Route::delete('/deleteUser/{id}', [UserController::class, 'deleteUser'])->name('delete.user');


Route::get('/providers/{id}', [ProviderController::class, 'getProvider'])->name('get.providers');
Route::post('/providers', [ProviderController::class, 'createProvider'])->name('post.providers');
Route::put('/providers/{id}', [ProviderController::class, 'updateProvider'])->name('put.providers');
Route::delete('/providers/{id}', [ProviderController::class, 'deleteProvider'])->name('delete.providers');

// });

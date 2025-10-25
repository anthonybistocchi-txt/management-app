<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProviderController;


Route::get('/login', [LoginController::class, 'login'])->name('get.login');
Route::get('/login', [LoginController::class, 'loginAttempt'])->name('post.loginAttempt');
Route::get('/logout',[LoginController::class, 'logout'])->name('post.logout');

Route::get('/cadastro', [RegisterController::class, 'register'])->name('get.register');
Route::post('/cadastro', [RegisterController::class, 'register'])->name('post.register');

/*
|--------------------------------------------------------------------------
| Rotas protegidas 
|--------------------------------------------------------------------------
*/

// Route::middleware(['auth'])->group(function () {
Route::prefix('index')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dasboard'])->name('get.dasboard');
});

Route::prefix('users')->group(function () {
    Route::get('/getUser', [UserController::class, 'getUser'])->name('get.user');
    Route::get('/getAllUsers', [UserController::class, 'getAllUsers'])->name('getAll.user');
    Route::post('/createUser', [UserController::class, 'createUser'])->name('create.user');
    Route::put('/updateUser/{id}', [UserController::class, 'updateUser'])->name('update.user');
    Route::delete('/deleteUser/{id}', [UserController::class, 'deleteUser'])->name('delete.user');
});

Route::get('/providers/{id}', [ProviderController::class, 'getProvider'])->name('get.providers');
Route::post('/providers', [ProviderController::class, 'createProvider'])->name('post.providers');
Route::put('/providers/{id}', [ProviderController::class, 'updateProvider'])->name('put.providers');
Route::delete('/providers/{id}', [ProviderController::class, 'deleteProvider'])->name('delete.providers');

// });

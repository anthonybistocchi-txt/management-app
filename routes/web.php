<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\views\ViewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::prefix('/')->group(function () {
    Route::get('login', [ViewsController::class, 'showLogin'])->name('login');
    Route::get('create-user', [ViewsController::class, 'showCreateUser'])->name('createUser');
    Route::get('reset-password', [ViewsController::class, 'showResetPassword'])->name('resetPassword');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('users')->group(function () {
        Route::get('/getLogged', [UserController::class, 'getUserLogged'])->name('users.logged');
    });

    // Recursos necessários para registrar entrada/saída de estoque (todos os perfis autenticados)
    Route::middleware('role:1,2,3')->group(function () {
        Route::prefix('products')->group(function () {
            Route::get('/getAll', [ProductController::class, 'getAll'])->name('products.index');
            Route::post('/get', [ProductController::class, 'get'])->name('products.show');
        });

        Route::prefix('providers')->group(function () {
            Route::get('/getAll', [ProviderController::class, 'getAll'])->name('providers.index');
            Route::post('/get', [ProviderController::class, 'get'])->name('providers.show');
        });

        Route::prefix('locations')->group(function () {
            Route::get('/getAll', [LocationController::class, 'getAll'])->name('locations.index');
            Route::post('/get', [LocationController::class, 'get'])->name('locations.show');
        });

        Route::prefix('stock')->group(function () {
            Route::post('/in', [StockController::class, 'in'])->name('stock.in');
            Route::post('/out', [StockController::class, 'out'])->name('stock.out');
        });

        Route::prefix('index')->group(function () {
            Route::get('/stock-in', [ViewsController::class, 'showStock'])->name('stock');
            Route::get('/stock-out', [ViewsController::class, 'showStockOut'])->name('stockOut');
        });
    });

    Route::middleware('role:1,2')->group(function () {
        Route::prefix('users')->group(function () {
            Route::post('/getAll', [UserController::class, 'getAll'])->name('users.index');
            Route::post('/getByIds', [UserController::class, 'getByIds'])->name('users.show');
            Route::get('/getById/{id}', [UserController::class, 'getById'])->name('users.showById');
            Route::put('/update', [UserController::class, 'update'])->name('users.update');
            Route::post('/create', [UserController::class, 'create'])->name('users.store');
            Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('users.destroy');
        });

        Route::prefix('providers')->group(function () {
            Route::put('/update/{id}', [ProviderController::class, 'update'])->name('providers.update');
            Route::post('/create', [ProviderController::class, 'create'])->name('providers.store');
            Route::delete('/delete/{id}', [ProviderController::class, 'delete'])->name('providers.destroy');
        });

        Route::prefix('products')->group(function () {
            Route::post('/create', [ProductController::class, 'create'])->name('products.store');
            Route::put('/update/{id}', [ProductController::class, 'update'])->name('products.update');
            Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('products.destroy');
        });

        Route::prefix('locations')->group(function () {
            Route::post('/create', [LocationController::class, 'create'])->name('locations.store');
            Route::put('/update', [LocationController::class, 'update'])->name('locations.update');
            Route::delete('/delete', [LocationController::class, 'delete'])->name('locations.destroy');
        });

        Route::prefix('admin')->group(function () {
            Route::post('/dashboard', [DashboardController::class, 'getDashboardData']);
        });

        Route::prefix('stock')->group(function () {
            Route::post('/transfer', [StockController::class, 'transfer'])->name('stock.transfer');
        });


        // ************************ VIEWS ***************************** */

        Route::prefix('index')->group(function () {
            Route::get('/dashboard', [ViewsController::class, 'showDashboard'])->name('dashboard');
            Route::get('/users', [ViewsController::class, 'showUsers'])->name('users');
            Route::get('/providers', [ViewsController::class, 'showProviders'])->name('providers');
            Route::get('/products', [ViewsController::class, 'showProducts'])->name('products');
            Route::get('/movements', [ViewsController::class, 'showMovements'])->name('movements');
            Route::get('/register-user', [ViewsController::class, 'showCreateUser'])->name('registerUser');
            Route::get('/register-provider', [ViewsController::class, 'showCreateProvider'])->name('registerProvider');
        });
    });
});

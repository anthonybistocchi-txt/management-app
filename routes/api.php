<?php

use App\Http\Controllers\CEPController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\Reports\InOutController;
use App\Http\Controllers\Reports\StockCardController;
use App\Http\Controllers\Reports\StockTurnoverController;
use App\Http\Controllers\Reports\InventoryController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UFController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
       
Route::middleware(['auth'])->group(function () {

    Route::prefix('users')->group(function () {
        Route::get('/getLogged', [UserController::class, 'getUserLogged'])->name('users.logged');
    });

        Route::prefix('products')->group(function () {
            Route::get('/getAll', [ProductController::class, 'getAll'])->name('products.index');
            Route::get('/search', [ProductController::class, 'search'])->name('products.search');
            Route::post('/get', [ProductController::class, 'get'])->name('products.show');
        });

        Route::prefix('product-categories')->group(function () {
            Route::get('/getAll', [ProductCategoryController::class, 'getAll'])->name('product-categories.index');
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

    Route::middleware('admin.or.gestor')->group(function () {
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

        Route::prefix('uf')->group(function () {
            Route::get('/getAll', [UFController::class, 'getAll'])->name('ufs.index');
        });

        Route::prefix('cities')->group(function () {
            Route::get('/getAll', [CitiesController::class, 'getAll'])->name('cities.index');
        });

        Route::prefix('cep')->group(function () {
            Route::get('/get/{cep}', [CEPController::class, 'getAddress'])->name('cep.get');
        });


        Route::prefix('admin')->group(function () {
            Route::post('/dashboard', [DashboardController::class, 'getDashboardData']);
        });

        Route::prefix('reports')->group(function () {
            Route::post('/in-out', [InOutController::class, 'getAll'])->name('reports.in-out');
            Route::post('/stock-card', [StockCardController::class, 'getAll'])->name('reports.stock-card');
            Route::post('/stock-turnover', [StockTurnoverController::class, 'getAll'])->name('reports.stock-turnover');
            Route::post('/inventory', [InventoryController::class, 'getAll'])->name('reports.inventory');
        });

        Route::prefix('stock')->group(function () {
            Route::post('/transfer', [StockController::class, 'transfer'])->name('stock.transfer');
        });
    });
});

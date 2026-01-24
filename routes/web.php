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

Route::middleware(['auth'])->group(function () {


});

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);  // testado e funcionando
    
    Route::prefix('users')->group(function () {
        Route::get('/getAll', [UserController::class, 'getAll'])->name('users.index');
        Route::post('/get', [UserController::class, 'get'])->name('users.show');
        Route::get('/getLogged', [UserController::class, 'getUserLogged'])->name('users.logged');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('users.update');  // testado e funcionando
        Route::post('/create', [UserController::class, 'create'])->name('users.store');
        Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('users.destroy');
    });
        
    Route::prefix('providers')->group(function () {
        Route::get('/getAll', [ProviderController::class, 'getAll'])->name('providers.index');
        Route::post('/get', [ProviderController::class, 'get'])->name('providers.show');
        Route::put('/update/{id}', [ProviderController::class, 'update'])->name('providers.update');  // testado e funcionando
        Route::post('/create', [ProviderController::class, 'create'])->name('providers.store');
        Route::delete('/delete/{id}', [ProviderController::class, 'delete'])->name('providers.destroy');
    });

    Route::prefix('products')->group(function () {
        Route::get('/getAll', [ProductController::class, 'getAll'])->name('products.index');  
        Route::post('/get', [ProductController::class, 'get'])->name('products.show');
        Route::post('/create', [ProductController::class, 'create'])->name('products.store');     // testado e funcionando
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/delete/{id}', [ProductController::class, 'delete'])->name('products.destroy');
    });

    Route::prefix('locations')->group(function () {
        Route::get('/getAll', [LocationController::class, 'getAll'])->name('locations.index');  
        Route::post('/create', [LocationController::class, 'create'])->name('locations.store');        // testado e funcionando
        Route::put('/update', [LocationController::class, 'update'])->name('locations.update');
        Route::delete('/delete', [LocationController::class, 'delete'])->name('locations.destroy');
        Route::post('/get', [LocationController::class, 'get'])->name('locations.show');
    });
    
    Route::prefix('admin')->group(function () {
            Route::post('/dashboard',[DashboardController::class,'getDashboardData']); // testado e funcionando
        });

    Route::prefix('stock')->group(function () {
        Route::post('/in', [StockController::class, 'in'])->name('stock.in');  // testado e funcionando
        Route::post('/out', [StockController::class, 'out'])->name('stock.out');
        Route::post('/transfer', [StockController::class, 'transfer'])->name('stock.transfer');
    });

    ///////// Views Routes /////////

    Route::prefix('/')->group(function () {
        Route::get('login', [ViewsController::class, 'showLogin'])->name('login');
        Route::get('create-user', [ViewsController::class, 'showCreateUser'])->name('createUser');
        Route::get('reset-password', [ViewsController::class, 'showResetPassword'])->name('resetPassword');
    });

    Route::prefix('index')->group(function () {
        Route::get('/dashboard', [ViewsController::class, 'showDashboard'])->name('dashboard');
        Route::get('/users', [ViewsController::class, 'showUsers'])->name('users');
        Route::get('/providers', [ViewsController::class, 'showProviders'])->name('providers');
        Route::get('/products', [ViewsController::class, 'showProducts'])->name('products');
        Route::get('/stock-in', [ViewsController::class, 'showStock'])->name('stock');
        Route::get('/stock-out', [ViewsController::class, 'showStockOut'])->name('stockOut');
        Route::get('/movements', [ViewsController::class, 'showMovements'])->name('movements');
        Route::get('/register-user', [ViewsController::class, 'showCreateUser'])->name('registerUser');
        Route::get('/register-provider', [ViewsController::class, 'showCreateProvider'])->name('registerProvider');
    });
// });

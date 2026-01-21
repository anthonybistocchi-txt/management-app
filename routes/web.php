<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\views\ViewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::middleware(['auth'])->group(function () {


});

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);  // testado e funcionando
    Route::post('/dashboard',[DashboardController::class,'getDashboardData']); // testado e funcionando

    Route::prefix('users')->group(function () {
        Route::get('/all', [UserController::class, 'getAllUsers'])->name('users.index');
        Route::post('/get', [UserController::class, 'getUser'])->name('users.show');
        Route::put('/update/{id}', [UserController::class, 'updateUser'])->name('users.update');  // testado e funcionando
        Route::post('/create', [UserController::class, 'createUser'])->name('users.store');
        Route::delete('/delete/{id}', [UserController::class, 'deleteUser'])->name('users.destroy');
    });

    Route::prefix('providers')->group(function () {
        Route::get('/all', [ProviderController::class, 'getAllProviders'])->name('providers.index');
        Route::post('/get', [ProviderController::class, 'getProvider'])->name('providers.show');
        Route::put('/update/{id}', [ProviderController::class, 'updateProvider'])->name('providers.update');  // testado e funcionando
        Route::post('/create', [ProviderController::class, 'createProvider'])->name('providers.store');
        Route::delete('/delete/{id}', [ProviderController::class, 'deleteProvider'])->name('providers.destroy');
    });

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'getAllProducts'])->name('products.getAll');  
        Route::get('/{id}', [ProductController::class, 'getProduct'])->name('products.getProduct');
        Route::post('/', [ProductController::class, 'createProduct'])->name('products.createProduct');     // testado e funcionando
        Route::put('/{id}', [ProductController::class, 'updateProduct'])->name('products.updateProduct');
        Route::delete('/{id}', [ProductController::class, 'deleteProduct'])->name('products.deleteProduct');
        Route::post('/ids', [ProductController::class, 'getProductsByIds'])->name('products.getProductsByIds');
    });

    Route::prefix('stock')->group(function () {
        Route::post('/in', [StockController::class, 'in'])->name('stock.in');
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

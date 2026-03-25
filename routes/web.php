<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\views\ViewsController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::prefix('/')->group(function () {
    Route::get('login', [ViewsController::class, 'showLogin'])->name('login');
    Route::get('create-user', [ViewsController::class, 'showCreateUser'])->name('createUser');
    Route::get('reset-password', [ViewsController::class, 'showResetPassword'])->name('resetPassword');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

        Route::prefix('index')->group(function () {
            Route::get('/stock-in', [ViewsController::class, 'showStock'])->name('stock');
            Route::get('/stock-out', [ViewsController::class, 'showStockOut'])->name('stockOut');
        });

    Route::middleware('admin.or.gestor')->group(function () {
        Route::prefix('index')->group(function () {
            Route::get('/dashboard', [ViewsController::class, 'showDashboard'])->name('dashboard');
            Route::get('/users', [ViewsController::class, 'showUsers'])->name('users');
            Route::get('/providers', [ViewsController::class, 'showProviders'])->name('providers');
            Route::get('/products', [ViewsController::class, 'showProducts'])->name('products');
            Route::get('/movements', [ViewsController::class, 'showMovements'])->name('movements');
            Route::get('/report-in-out', [ViewsController::class, 'showReportInOut'])->name('reportInOut');
            Route::get('/report-stock-turnover', [ViewsController::class, 'showReportStockTurnover'])->name('reportStockTurnover');
            Route::get('/report-inventory', [ViewsController::class, 'showReportInventory'])->name('reportInventory');
            Route::get('/register-user', [ViewsController::class, 'showCreateUser'])->name('registerUser');
            Route::get('/register-provider', [ViewsController::class, 'showCreateProvider'])->name('registerProvider');
        });
    });
});

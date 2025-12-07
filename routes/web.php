 <?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\StockController;



Route::middleware(['auth'])->group(function () {
    
    
});
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
        
        Route::prefix('users')->group(function () {
            Route::get('/getUser', [UserController::class, 'getUser'])->name('get.user');
            Route::get('/getAllUsers', [UserController::class, 'getAllUsers'])->name('getAll.user');
            Route::post('/createUser', [UserController::class, 'createUser'])->name('create.user');
            Route::put('/updateUser/{id}', [UserController::class, 'updateUser'])->name('update.user');
            Route::delete('/deleteUser/{id}', [UserController::class, 'deleteUser'])->name('delete.user');
        });

        Route::prefix('providers')->group(function () {
            Route::get('/getProvider', [ProviderController::class, 'getProvider'])->name('get.provider');
            Route::get('/getAllProvider', [ProviderController::class, 'getAllProviders'])->name('getAll.Provider');
            Route::post('/createProvider', [ProviderController::class, 'createProvider'])->name('create.provider');
            Route::put('/updateProvider/{id}', [ProviderController::class, 'updateProvider'])->name('update.provider');
            Route::delete('/deleteProvider/{id}', [ProviderController::class, 'deleteProvider'])->name('delete.provider');
        });

        Route::prefix('products')->group(function () {
            Route::get('/getProduct', [ProductController::class, 'getProduct'])->name('get.product');
            Route::get('/getAllProduct', [ProductController::class, 'getAllProducts'])->name('getAll.product');
            Route::post('/createProduct', [ProductController::class, 'createProduct'])->name('create.product');
            Route::put('/updateProduct/{id}', [ProductController::class, 'updateProduct'])->name('update.product');
            Route::delete('/deleteProduct/{id}', [ProductController::class, 'deleteProduct'])->name('delete.product');
        });

Route::prefix('stock')->group(function () {
    Route::post('/in', [StockController::class, 'in'])->name('stock.in');
    Route::post('/out', [StockController::class, 'out'])->name('stock.out');
    Route::post('/transfer', [StockController::class, 'transfer'])->name('stock.transfer');
});

// });

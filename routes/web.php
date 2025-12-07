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
        Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');  // testado e funcionando
        
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
            Route::post('/', [UserController::class, 'store'])->name('users.store');
            Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
            Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        });

        Route::prefix('providers')->group(function () {
            Route::get('/getProvider', [ProviderController::class, 'getProvider'])->name('get.provider');
            Route::get('/getAllProvider', [ProviderController::class, 'getAllProviders'])->name('getAll.Provider');
            Route::post('/createProvider', [ProviderController::class, 'createProvider'])->name('create.provider');
            Route::put('/updateProvider/{id}', [ProviderController::class, 'updateProvider'])->name('update.provider');
            Route::delete('/deleteProvider/{id}', [ProviderController::class, 'deleteProvider'])->name('delete.provider');
        });

        Route::prefix('products')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('products.index');
            Route::get('/{id}', [ProductController::class, 'show'])->name('products.show');
            Route::post('/', [ProductController::class, 'store'])->name('products.store');     // testado e funcionando
            Route::put('/{id}', [ProductController::class, 'update'])->name('products.update');
            Route::delete('/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
            Route::post('/ids', [ProductController::class, 'getProductsByIds'])->name('products.byIds');
        });

Route::prefix('stock')->group(function () {
    Route::post('/in', [StockController::class, 'in'])->name('stock.in');
    Route::post('/out', [StockController::class, 'out'])->name('stock.out');
    Route::post('/transfer', [StockController::class, 'transfer'])->name('stock.transfer');
});

// });

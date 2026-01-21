<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin.or.gestor'     => \App\Http\Middleware\AdminAndGestorMiddleware::class,
            'auth' => \App\Http\Middleware\AuthenticatedMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $e, $request) {

            if ($request->expectsJson()) {

                logger()->error($e);

                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                    'data'    => null,
                ], 500);
            }
        });
    })->create();

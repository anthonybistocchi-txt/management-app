<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// Importante: Adicione os imports das suas classes aqui
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Eloquent\ProductRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Aqui você diz ao Laravel: 
        // "Sempre que alguém pedir a Interface (ProductRepositoryInterface),
        // entregue a implementação concreta (ProductRepository)."
        
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
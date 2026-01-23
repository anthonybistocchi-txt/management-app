<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\DashboardRepositoryInterface;
use App\Repositories\Interfaces\LocationRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Repositories\Interfaces\StockRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Eloquent\DashboardRepository;
use App\Repositories\Eloquent\LocationRepository;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Eloquent\ProviderRepository;
use App\Repositories\Eloquent\StockRepository;
use App\Repositories\Eloquent\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Mapeamento de todas as interfaces para suas implementações.
     *
     * @var array
     */
    public $bindings = [
        DashboardRepositoryInterface::class => DashboardRepository::class,
        LocationRepositoryInterface::class  => LocationRepository::class,
        ProductRepositoryInterface::class   => ProductRepository::class,
        ProviderRepositoryInterface::class  => ProviderRepository::class,
        StockRepositoryInterface::class     => StockRepository::class,
        UserRepositoryInterface::class      => UserRepository::class,
    ];

    /**
     * Register services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
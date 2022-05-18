<?php

namespace App\Providers;

use App\Repositories\OrderRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\OrderRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    //liên kết ràng buộc OrderRepositoryInterface và OrderRepository
    public function register()
    {
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

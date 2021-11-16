<?php

namespace BinanceApi;

use BinanceApi\Commands\GetTickers;
use BinanceApi\Models\Ticker;
use BinanceApi\Observers\TickerObserver;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class BinanceApiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->importMigrations();
        $this->registerCommands();
        $this->registerObservers();
        $this->loadRoutes();
        $this->loadViews();
    }

    protected function registerObservers(): void
    {
        Ticker::observe(TickerObserver::class);
    }

    protected function loadViews()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'binance-api');
    }

    protected function loadRoutes()
    {
        Route::middleware(['api'])
             ->group(function () {
                 include __DIR__.'/../routes/api.php';
             });

        Route::middleware(['web'])
             ->group(function () {
                 include __DIR__.'/../routes/web.php';
             });
    }

    public function register()
    {
        Schema::defaultStringLength(191);
    }

    protected function importMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    protected function registerCommands(): void
    {
        $this->commands([
            GetTickers::class,
        ]);
    }
}

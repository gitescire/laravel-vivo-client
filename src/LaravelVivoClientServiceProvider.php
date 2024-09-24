<?php

namespace Gitescire\LaravelVivoClient;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/**
 * Registers the LaravelVivoClient class in the IoC container.
 *
 * @see https://laravel.com/docs/master/providers
 */
class LaravelVivoClientServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the package services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/laravel-vivo-client.php' => config_path('laravel-vivo-client.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__ . '/../config/laravel-vivo-client.php',
            'laravel-vivo-client'
        );

        $this->loadRoutesFrom(__DIR__ . "/../routes/web.php");
        $this->loadViewsFrom(__DIR__ . '/../views', 'laravel-vivo-client');

        Blade::componentNamespace("Gitescire\\LaravelVivoClient\\Components", 'laravel-vivo-client');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(LaravelVivoClient::class, function () {
            return new LaravelVivoClient();
        });
    }
}

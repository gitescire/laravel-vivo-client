<?php

namespace Gitescire\LaravelVivoClient;

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
            __DIR__ . '/../config/laravelVivoClient.php' => config_path('laravelVivoClient.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__ . '/../config/laravelVivoClient.php',
            'laravelVivoClient'
        );
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

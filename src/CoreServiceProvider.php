<?php

namespace Atom\Core;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            path: __DIR__.'/../config/core.php',
            key: 'core'
        );

        $this->loadMigrationsFrom(
            paths: __DIR__.'/../database/migrations'
        );

        $this->loadRoutesFrom(
            path: __DIR__.'/../routes/web.php'
        );

        $this->loadRoutesFrom(
            path: __DIR__.'/../routes/api.php'
        );

        $this->commands([
            Console\Commands\ImportBadgeCommand::class,
            Console\Commands\BadgeSyncCommand::class,
            Console\Commands\BackgroundSyncCommand::class,
            Console\Commands\UiTextSyncCommand::class,
            Console\Commands\ProductDataSyncCommand::class,
            Console\Commands\FurnitureDataSyncCommand::class,
            Console\Commands\CatalogImageSyncCommand::class,
        ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.force_https')) {
            URL::forceScheme('https');
        }

        if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
        }

        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        $this->app->bind(
            \Kielabokkie\Ipdata::class,
            fn () => new \Kielabokkie\Ipdata(config('services.ipdata.key'))
        );
    }
}

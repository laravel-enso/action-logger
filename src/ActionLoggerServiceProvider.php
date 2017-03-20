<?php

namespace LaravelEnso\ActionLogger;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\ActionLogger\Http\Middleware\ActionLogger;

class ActionLoggerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->app['router']->aliasMiddleware('actionLogger', ActionLogger::class);

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'actionLogger-migration');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

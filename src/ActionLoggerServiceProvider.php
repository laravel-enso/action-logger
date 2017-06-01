<?php

namespace LaravelEnso\ActionLogger;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\ActionLogger\app\Http\Middleware\ActionLogger;

class ActionLoggerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->app['router']->aliasMiddleware('action-logger', ActionLogger::class);
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

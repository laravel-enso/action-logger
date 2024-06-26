<?php

namespace LaravelEnso\ActionLogger;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\ActionLogger\Http\Middleware\ActionLogger;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ActionLogger::class);
    }

    public function boot(): void
    {
        $this->app['router']->aliasMiddleware('action-logger', ActionLogger::class);

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }
}

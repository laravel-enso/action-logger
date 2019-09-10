<?php

namespace LaravelEnso\ActionLogger;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\ActionLogger\app\Http\Middleware\ActionLogger;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app['router']->aliasMiddleware(
            'action-logger', ActionLogger::class
        );

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }
}

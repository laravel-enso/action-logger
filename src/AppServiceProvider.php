<?php

namespace LaravelEnso\ActionLogger;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\ActionLogger\app\Http\Middleware\ActionLogger;
use LaravelEnso\ActionLogger\app\Commands\UpdateActionLogsTable;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->app['router']
            ->aliasMiddleware('action-logger', ActionLogger::class);

        $this->commands([
            UpdateActionLogsTable::class,
        ]);
    }

    public function register()
    {
        //
    }
}

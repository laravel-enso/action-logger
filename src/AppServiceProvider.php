<?php

namespace LaravelEnso\ActionLogger;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\ActionLogger\DynamicsRelations\ActionLogs;
use LaravelEnso\ActionLogger\Http\Middleware\ActionLogger;
use LaravelEnso\Core\Models\User;
use LaravelEnso\DynamicMethods\Services\Methods;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app['router']->aliasMiddleware('action-logger', ActionLogger::class);

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        Methods::bind(User::class, [ActionLogs::class]);
    }
}

<?php

namespace LaravelEnso\ActionLogger;

use Illuminate\Support\ServiceProvider;
use LaravelEnso\ActionLogger\App\Http\Middleware\ActionLogger;

class ActionLoggerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/database/migrations' => database_path('migrations'),
        ], 'logger-migration');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->app['router']->aliasMiddleware('actionLogger', ActionLogger::class);
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

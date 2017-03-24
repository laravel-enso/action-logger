# ActionLogger

Middleware for logging user's actions

## Upgrade from laravel-enso v2

Add in App\Http\Kernel.php "core" middleware groups

```
\LaravelEnso\ActionLogger\App\Http\Middleware\ActionLogger::class,
```
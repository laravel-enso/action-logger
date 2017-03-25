# ActionLogger
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/dc3819bf2c654b3d8dcaaed8898b214f)](https://www.codacy.com/app/laravel-enso/ActionLogger?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=laravel-enso/ActionLogger&amp;utm_campaign=Badge_Grade)

Middleware for logging user's actions

## Upgrade from laravel-enso v2

Add in App\Http\Kernel.php "core" middleware groups

```
\LaravelEnso\ActionLogger\App\Http\Middleware\ActionLogger::class,
```
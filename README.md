# ActionLogger
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/dc3819bf2c654b3d8dcaaed8898b214f)](https://www.codacy.com/app/laravel-enso/ActionLogger?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=laravel-enso/ActionLogger&amp;utm_campaign=Badge_Grade)
[![StyleCI](https://styleci.io/repos/85554059/shield?branch=master)](https://styleci.io/repos/85554059)
[![Total Downloads](https://poser.pugx.org/laravel-enso/actionlogger/downloads)](https://packagist.org/packages/laravel-enso/actionlogger)
[![Latest Stable Version](https://poser.pugx.org/laravel-enso/actionlogger/version)](https://packagist.org/packages/laravel-enso/actionlogger)

Middleware for logging user's actions.

It creates the "action-logger" middleware, the action_logs table and the ActionLog model.
It will log all the acceses for the routes under 'action-logger' middleware.

### Installation Steps

1. Add `'LaravelEnso\ActionLogger\ActionLoggerServiceProvider::class'` to your providers list in config/app.php.

2. Run the migration. The migration will use the table for your config.auth.model to create a foreign key.

3. Add a relationship in the `User.php` model like this:

```php
    public function action_logs()
    {
        return $this->hasMany('LaravelEnso\ActionLogger\app\Models\ActionLog');
    }
```

4. Add in the `$routeMiddleware` array from App\Http\Kernel.php the "action-logger" middleware.

```
	protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        ...
		'action-logger' => \LaravelEnso\ActionLogger\app\Http\Middleware\ActionLogger::class,
		...
	]
```

5. Use the middleware in `web.php` file on the desired routes.

### Note

The laravel-enso/core package comes with this middleware included (required in package.json).

### Contributions

... are welcome
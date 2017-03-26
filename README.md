# ActionLogger
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/dc3819bf2c654b3d8dcaaed8898b214f)](https://www.codacy.com/app/laravel-enso/ActionLogger?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=laravel-enso/ActionLogger&amp;utm_campaign=Badge_Grade)
[![StyleCI](https://styleci.io/repos/85554059/shield?branch=master)](https://styleci.io/repos/85554059)
[![Total Downloads](https://poser.pugx.org/laravel-enso/actionlogger/downloads)](https://packagist.org/packages/laravel-enso/actionlogger)
[![Latest Stable Version](https://poser.pugx.org/laravel-enso/actionlogger/version)](https://packagist.org/packages/laravel-enso/actionlogger)

Middleware for logging user's actions.

It creates the "actionLogger" middleware, the action_histories table and the ActionHistory model.
It will log all the acceses for the routes under 'actionLogger' middleware.

### Installation

1. Add `'LaravelEnso\ActionLogger\ActionLoggerServiceProvider::class'` to your providers list in config/app.php.

2. Run the migration. The migration assumes that you have an users table. If you use a different table you can publish the migration with

`php artisan vendor:publish --tag=logger-migration`

and later edit it.

3. Add a relationship in the `User.php` model like this:

```php
    public function action_histories()
    {
        return $this->hasMany('LaravelEnso\ActionLogger\App\Models\ActionHistory');
    }
```

4. Add in the `$routeMiddleware` array from App\Http\Kernel.php the "actionLogger" middleware.

```
	protected $routeMiddleware = [

        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        ...
		'actionLogger' => \LaravelEnso\ActionLogger\App\Http\Middleware\ActionLogger::class,
		...
	]
```

### Note

The laravel-enso/core package comes with this middleware included.

### Contributions

are welcome
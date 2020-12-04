<?php

namespace LaravelEnso\ActionLogger\Http\Middleware;

use Closure;
use LaravelEnso\ActionLogger\Models\ActionLog;

class ActionLogger
{
    public function handle($request, Closure $next)
    {
        $attributes = [
            'url' => $request->url(),
            'user_id' => $request->user()->id,
            'route' => $request->route()->getName(),
            'method' => $request->method(),
        ];

        dispatch(fn () => ActionLog::create($attributes))->afterResponse();

        return $next($request);
    }
}

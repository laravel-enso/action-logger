<?php

namespace LaravelEnso\ActionLogger\Http\Middleware;

use Closure;
use LaravelEnso\ActionLogger\Models\ActionLog;

class ActionLogger
{
    public function handle($request, Closure $next)
    {
        $log = ActionLog::create([
            'user_id' => $request->user()->id,
            'url' => $request->url(),
            'route' => $request->route()->getName(),
            'method' => $request->method(),
        ]);

        dispatch(fn () => $log->fill([
            'duration' => min(999.999, microtime(true) - LARAVEL_START),
        ])->save())->afterResponse();

        return $next($request);
    }
}

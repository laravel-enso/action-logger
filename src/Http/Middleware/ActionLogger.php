<?php

namespace LaravelEnso\ActionLogger\Http\Middleware;

use Closure;
use LaravelEnso\ActionLogger\Models\ActionLog;

class ActionLogger
{
    public function handle($request, Closure $next)
    {
        ActionLog::create([
            'user_id' => $request->user()->id,
            'url' => $request->url(),
            'route' => $request->route()->getName(),
            'method' => $request->method(),
        ]);

        return $next($request);
    }
}

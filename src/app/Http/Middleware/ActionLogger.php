<?php

namespace LaravelEnso\ActionLogger\app\Http\Middleware;

use Closure;
use LaravelEnso\ActionLogger\app\Models\ActionLog;

class ActionLogger
{
    public function handle($request, Closure $next)
    {
        ActionLog::store($request);

        return $next($request);
    }
}

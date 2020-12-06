<?php

namespace LaravelEnso\ActionLogger\Http\Middleware;

use Closure;
use LaravelEnso\ActionLogger\Models\ActionLog;

class ActionLogger
{
    public function handle($request, Closure $next)
    {
        $actionLog = ActionLog::make([
            'user_id' => $request->user()->id,
            'url' => $request->url(),
            'route' => $request->route()->getName(),
            'method' => $request->method(),
        ]);

        dispatch(fn () => $actionLog->save())->afterResponse();

        return $next($request);
    }
}

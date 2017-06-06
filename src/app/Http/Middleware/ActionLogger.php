<?php

namespace LaravelEnso\ActionLogger\app\Http\Middleware;

use Closure;
use LaravelEnso\ActionLogger\app\Models\ActionLog;

class ActionLogger
{
    public function __construct()
    {
        $this->actionLogger = new ActionLog();
    }

    public function handle($request, Closure $next)
    {
        $this->actionLogger->create([
            'user_id' => $request->user()->id,
            'url'     => $request->url(),
            'route'   => $request->route()->getName(),
            'action'  => $request->method(),
        ]);

        return $next($request);
    }
}

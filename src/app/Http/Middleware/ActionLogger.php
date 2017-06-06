<?php

namespace LaravelEnso\ActionLogger\app\Http\Middleware;

use Closure;
use LaravelEnso\ActionLogger\app\Models\ActionLog;

class ActionLogger
{
    private $actionLog;

    public function __construct()
    {
        $this->actionLog = new ActionLog();
    }

    public function handle($request, Closure $next)
    {
        $this->actionLog->create([
            'user_id' => $request->user()->id,
            'url'     => $request->url(),
            'route'   => $request->route()->getName(),
            'action'  => $request->method(),
        ]);

        return $next($request);
    }
}

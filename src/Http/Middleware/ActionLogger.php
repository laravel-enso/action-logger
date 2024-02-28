<?php

namespace LaravelEnso\ActionLogger\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use LaravelEnso\ActionLogger\Models\ActionLog;
use Symfony\Component\HttpFoundation\Response;

class ActionLogger
{
    private ActionLog $log;

    public function handle(Request $request, Closure $next): Response
    {
        $this->log = ActionLog::make([
            'user_id' => $request->user()->id,
            'url' => $request->url(),
            'route' => $request->route()->getName(),
            'method' => $request->method(),
        ]);

        return $next($request);
    }

    public function terminate(Request $request, Response $response): void
    {
        $this->log->fill([
            'duration' => min(999.999, microtime(true) - LARAVEL_START),
        ])->save();
    }
}

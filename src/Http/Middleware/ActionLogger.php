<?php

namespace LaravelEnso\ActionLogger\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelEnso\ActionLogger\Models\ActionLog;
use Symfony\Component\HttpFoundation\Response;

class ActionLogger
{
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }

    public function terminate(Request $request, Response $response): void
    {
        if (! Auth::check()) {
            return;
        }

        ActionLog::create([
            'user_id' => $request->user()->id,
            'url' => $request->url(),
            'route' => $request->route()->getName(),
            'method' => $request->method(),
            'duration' => min(999.999, microtime(true) - LARAVEL_START),
        ]);
    }
}

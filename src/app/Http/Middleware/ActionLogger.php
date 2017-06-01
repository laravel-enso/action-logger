<?php

namespace LaravelEnso\ActionLogger\app\Http\Middleware;

use Closure;
use LaravelEnso\ActionLogger\app\Models\ActionLog;

class ActionLogger
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        ActionLog::create([
            'user_id' => $request->user()->id,
            'url'     => $request->url(),
            'route'   => $request->route()->getName(),
            'action'  => $request->method(),
        ]);

        return $next($request);
    }
}

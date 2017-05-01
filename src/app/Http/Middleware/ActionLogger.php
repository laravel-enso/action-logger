<?php

namespace LaravelEnso\ActionLogger\app\Http\Middleware;

use Closure;
use LaravelEnso\ActionLogger\app\Models\ActionHistory;

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
        $history = ActionHistory::create([
            'user_id' => $request->user()->id,
            'url'     => $request->url(),
            'route'   => $request->route()->getName(),
            'action'  => $request->method(),
        ]);

        return $next($request);
    }
}

<?php

namespace LaravelEnso\ActionLogger\App\Http\Middleware;

use Closure;
use LaravelEnso\ActionLogger\App\Models\ActionHistory;

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
        $history = new ActionHistory([
            'user_id' => $request->user()->id,
            'route'   => $request->url(),
            'action'  => $request->method(),
        ]);

        $history->save();

        return $next($request);
    }
}

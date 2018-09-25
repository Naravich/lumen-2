<?php

namespace App\Http\Middleware;

use Log;
use Closure;
use Illuminate\Http\Request;

class HelloMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (preg_match('/seagame$/i', $request->getRequestUri())) {
            return response('YOU SHALL NOT PASS!!!', 403);
        }
        return $next($request);
    }
}
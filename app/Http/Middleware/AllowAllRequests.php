<?php

namespace App\Http\Middleware;

use Closure;

class AllowAllRequests
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}

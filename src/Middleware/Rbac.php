<?php

namespace PHPZen\LaravelRbac\Middleware;

use Closure;

class Rbac
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $level, $permission)
    {
        dd([$level, $permission]);
        return $next($request);
    }
}

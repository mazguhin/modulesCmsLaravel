<?php

namespace Modules\Dashboard\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RoleHelper;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (RoleHelper::isAdmin()) {
          return $next($request);
        }
        return redirect('/');
    }
}

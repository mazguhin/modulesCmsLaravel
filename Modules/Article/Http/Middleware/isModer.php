<?php

namespace Modules\Article\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RoleHelper;

class isModer
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
        if (RoleHelper::isModer()) {
          return $next($request);
        }
        return redirect('/');
    }
}

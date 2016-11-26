<?php

namespace Modules\Article\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

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
        if (Auth::check() && Auth::user()->role->name=="moderator") {
          return $next($request);
        }
        return redirect('/');
    }
}

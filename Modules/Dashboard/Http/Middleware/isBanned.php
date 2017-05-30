<?php

namespace Modules\Dashboard\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RoleHelper;

class isBanned
{
    public function handle(Request $request, Closure $next)
    {
      if (!(RoleHelper::isBanned())) {
        return $next($request);
      }

      return response()->view('errors.banned');
    }
}

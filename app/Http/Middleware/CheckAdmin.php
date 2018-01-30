<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;
use Redirect;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if(!Auth::check() or !Auth::user()->is_admin) {
        return Redirect::back();
      }
        return $next($request);
    }
}

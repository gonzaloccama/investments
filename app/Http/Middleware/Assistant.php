<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class Assistant
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (in_array(Auth::user()->group, [1, 2, 3])) {
            return $next($request);
        } elseif (in_array(Auth::user()->group, [4, 5])) {
            Auth::logout();
            return redirect(route('login'));
        } else {
            return redirect(route('admin.dashboard'));
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::guard('administrators')->check()) {
            $user = Auth::guard('administrators')->user();
            if (in_array($user->role, $roles)) {
                return $next($request);
            }
        } elseif (Auth::guard('web')->check() && in_array('user', $roles)) {
            return $next($request);
        }

        // return redirect()->route('signin.view');
        abort(403, 'UnAuthorized action.');
    }
}

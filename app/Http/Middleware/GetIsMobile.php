<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;

class GetIsMobile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $isMobile = false;
        $user_agent =  $request->header('User-Agent');
        if ((strpos($user_agent, 'iPhone') !== false)
            || (strpos($user_agent, 'iPod') !== false)
            || (strpos($user_agent, 'Android') !== false)) {
            $isMobile = true;
        }
        View::share('isMobile', $isMobile);
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class EventCheckInAuthMiddleware
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
        $is_logged_in = $request->session()->get('event_manager_logged_in');

        if (!$is_logged_in || !session()->has('event_manager_id')) {
            return redirect('/vw_event/login');
        }

        return $next($request);
    }
}

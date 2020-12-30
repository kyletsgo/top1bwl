<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class EventAuthMiddleware
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
        $login_user = Auth::user()->id;
        $login_name = Auth::user()->name;
        $admin_accounts = ['admin', 'volkswagen'];

        if (in_array($login_name, $admin_accounts)) {
            if (!session()->has('event_is_admin')) {
                session()->put('event_is_admin', true);
            }
        } else {
            // 確認登入
            $is_logged_in = $request->session()->get('event_manager_logged_in');

            if (!$is_logged_in || !session()->has('event_manager_id')) {
                return redirect('/backend/event/sessions/logout');
            }
        }

        return $next($request);
    }
}

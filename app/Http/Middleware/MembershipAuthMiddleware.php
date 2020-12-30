<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class MembershipAuthMiddleware
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
        $is_logged_in = $request->session()->get('membership_account_logged_in');

        if (!$is_logged_in || !session()->has('membership_account_id')) {
            return redirect('/membership/login');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class RedirectIfAuthenticated
{    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //判斷來源
        $intended_url = Session::get('url.intended', url('/'));

        if (strpos($intended_url, '/api/APP') !== false) 
        {
            return response()->json([
                'Result' => 'N',
                'ErrorCode' => '',
                'ErrorMsg' => 'token 無效',
                'UserToken' => '',
            ], 200)->withHeaders([
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
            ]);;
        }
        
        if (strpos($intended_url, '/backend') !== false) 
        {
            if (Auth::guard($guard)->check()) {
                return redirect('/backend');
            }
        }       
       
        return $next($request);
        
    }
}

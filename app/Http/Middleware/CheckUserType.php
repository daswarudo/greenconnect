<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $type)
    {
        
        // Check if user is logged in and matches the required type
        /*if (session('userType') !== $type) {
            // Redirect to login or an unauthorized page
            return redirect('/login')->with('fail', 'Access denied!');
        }*/

        return $next($request);
        
    }
}

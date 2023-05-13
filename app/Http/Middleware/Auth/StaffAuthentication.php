<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StaffAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            if ((!auth()->user()->status == true)) {
                return redirect()->route('getLogin')->with('error', 'You do not have permission to access the page');
            }
        } else {
            return redirect()->route('getLogin')->with('error', 'You must log in to access the page');
        }
        return $next($request);
    }
}

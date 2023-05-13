<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PatientAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        {
            if (!Auth::guard('patient')->check()) {
                if ((!auth()->guard('patient')->id())) {
                    return redirect()->route('getLogin')->with('error', 'You have to login to access the page');
                } else {
                    return redirect()->route('getLogin')->with('error', 'You do not have permission to access the page');
                }
            }
            return $next($request);
        }
    }
}

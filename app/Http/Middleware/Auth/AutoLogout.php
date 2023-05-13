<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Symfony\Component\HttpFoundation\Response;

class AutoLogout
{
    protected $session;
    protected $timeout = 1;

    public function __construct(Store $session){
        $this->session = $session;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        $is_logged_in = $request->path() != 'authentication/dashboard';
        if(!session('last_active')){
            $this->session->put('last_active', time());
        } elseif(time() - $this->session->get('last_active') > $this->timeout) {
            $this->session->forget('last_active');
            
            $cookie = cookie('intend', $is_logged_in ? url()->current() : 'authentication/dashboard');
            auth()->logout();
        }
        
        $is_logged_in ? $this->session->put('last_active', time()) : $this->session->forget('last_active');

        return $next($request);
    }
}

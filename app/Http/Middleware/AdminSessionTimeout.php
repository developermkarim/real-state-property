<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Closure;

class AdminSessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user && $user->role == 'admin' &&  $this->sessionExpired()) {
            
            \Log::info('Admin session expired. Redirecting to /admin/login');

            return redirect('admin/login');
        }elseif ($user && $user->role == 'agent' && $this->sessionExpired()) {
            return redirect('agent/login');
        }

        return $next($request);
    }

    private function sessionExpired()
    {
        $lastActivity = session('last_activity_time', 0);
        $sessionLifetime = config('session.lifetime') * 60; // Convert minutes to seconds

        return time() - $lastActivity > $sessionLifetime;
    }
}

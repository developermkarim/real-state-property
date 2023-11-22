<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
      //  return $request->expectsJson() ? null : route('login');

      if(! $request->user()){
        return $request->expectsJson() ? null : route('login');
      }

      // check The user's role and redirect accordingly
      $role = $request->user()->role;
      switch ($role) {
        case 'admin':
            return route('admin.login');
            case 'agent':
                return route('agent.login');
        default:
            return route('login');
      }

      // Or
      /*
              // Check if the user is an admin or agent
        if ($user && $user->role === 'admin') {
            return route('admin.login'); // Assuming you have a named route for admin login
        } elseif ($user && $user->role === 'agent') {
            return route('agent.login'); // Assuming you have a named route for agent login
        } else {
            return route('login'); // Default redirection for other users
        }
        
      */
    }
}

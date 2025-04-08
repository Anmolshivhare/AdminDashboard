<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class InactivityTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Check if the user is authenticated
        if (Auth::check()) {
            // Get the last activity timestamp from the session
            $lastActivity = session('last_activity');

            // If the user has been inactive for more than 1 minute (60 seconds), log them out
            if ($lastActivity && time() - $lastActivity > 3600) {
                // Log the user out and invalidate the session
                Auth::logout();
                session()->invalidate();
                session()->regenerateToken();
            }
        }

        // Update the last activity timestamp on each request
        session(['last_activity' => time()]);

        return $next($request);
    }
}

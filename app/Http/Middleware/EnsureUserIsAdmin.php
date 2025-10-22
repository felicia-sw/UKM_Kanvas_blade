<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
   
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is logged in AND if they are an admin
        if (!Auth::check() || !Auth::user()->is_admin) {
            // If not, redirect them to the homepage.
            return redirect()->route('home')->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    /**
     * Show the admin login form.
     */
    public function showLoginForm()
    {
        // Simple view for login, separate from the main site layout
        return view('admin.auth.login');
    }

    /**
     * Handle an admin login attempt.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // --- IMPORTANT: Implement Admin Check Logic ---
        // This is a basic check. You NEED to add logic here
        // to ensure only ADMIN users can log in.
        // For example, add an 'is_admin' column to your users table.
        // --- --- --- --- --- --- --- --- --- --- --- ---

        // Attempt login using the default 'web' guard for now
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Check if the authenticated user is an admin (replace with your logic)
            // if (Auth::user()->is_admin) { // Example check
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            // } else {
            //     Auth::logout(); // Logout if not admin
            //     throw ValidationException::withMessages([
            //         'email' => ['You do not have admin privileges.'],
            //     ])->status(403);
            // }
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records.'],
        ]);
    }

    /**
     * Log the admin user out.
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Use the default guard
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('status', 'You have been logged out.');
    }
}
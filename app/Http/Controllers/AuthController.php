<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    
    protected function redirectTo()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return route('admin.dashboard');
        }
        return route('home');
    }


    public function login(Request $request) 
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
        } catch (ValidationException $e) {
            // If validation fails, redirect  to home with modal errors
            return redirect()->route('home')
                ->withErrors($e->errors())
                ->withInput($request->only('email'));
        }

       if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            if (Auth::user()->is_admin) {
                // If user is admin, redirect to admin dashboard
                // force redirect to admin dashboard without using intended() to avoid page expired issues
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Welcome back, Admin');
            }

                // If regular user, redirect to intended page or home
                return redirect()->intended(route('home'))
                    ->with('success', 'Welcome back, ' . Auth::user()->name);
        }

        // If authentication fails, redirect back to home with error
        return redirect()->route('home')
            ->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])
            ->withInput($request->only('email'));
    }
    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                // ensure the password field from the modal is named 'password' and has a minimum length
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

              $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                // password must be hashed before saving
                'password' => Hash::make($validated['password']),
                'is_admin' => false, // will then b set as regular user
            ]);

            Auth::login($user);

            return redirect()->route('home')->with('success', 'Registration successful! Welcome to UKM Kanvas, ' . $user->name . '!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()
                ->withErrors($e->errors())
                ->withInput($request->except('password', 'password_confirmation'));
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Registration failed: ' . $e->getMessage())
                ->withInput($request->except('password', 'password_confirmation'));
        }
    }

    public function logout(Request $request) 
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'You have been logged out.');
    }

    public function showLoginForm()
    {
        return redirect()->route('home');
    }

    public function showRegistrationForm()
    {
        return redirect()->route('home');
    }
}

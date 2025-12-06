<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role; // <--- ADDED THIS IMPORT
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected function redirectTo()
    {
        // FIX 1: Check Role instead of 'is_admin' column
        if (Auth::check() && Auth::user()->hasRole('Admin')) {
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
            return redirect()->route('home')
                ->withErrors($e->errors())
                ->withInput($request->only('email'));
        }

       if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // FIX 2: Check Role instead of 'is_admin' column
            if (Auth::user()->hasRole('Admin')) {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Welcome back, Admin');
            }

            return redirect()->intended(route('home'))
                ->with('success', 'Welcome back, ' . Auth::user()->name);
        }

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
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            // FIX 3: Remove 'is_admin' => false
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // FIX 4: Assign 'Member' Role automatically
            $memberRole = Role::where('name', 'Member')->first();
            if ($memberRole) {
                $user->roles()->attach($memberRole);
            }

            // FIX 5: Create an empty Profile to prevent future errors
            $user->profile()->create([
                'nim' => null,
                'jurusan' => null,
                'no_telp' => null,
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
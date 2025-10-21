<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // this is to handle incoming authentication requests [login]
    // this method handles the POST request from the login modal

    public function login(Request $request) 
    {
        // 1. validate the incoming request data 
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2, attempt to log the user in
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // regeneration of the session prevents session fixation attacks
            $request->session()->regenerate();
            // redirect the user to their desired page (e.g., home or a dashboard)
            return redirect()->intended(route('home'))->with('success', 'You are now logged in!');
        }

        // 3. if authentication fails, redirect back with an error
        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records.'],
        ]);
    }

    // handle a registration request.
    // this method handles the POST request from the register model
    public function register(Request $request)
    {
        // 1. validate the incoming 
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // ensure the password field from the modal is named 'password' and has a minimum length
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // 2. create the new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            // password must be hashed before saving
            'password' => Hash::make($request->password),
        ]);

        // 3. log the new user in immediately
        Auth::login($user);

        // 4. Redirect the user
        return redirect()->route('home')->with('success', 'Registration successsful! Welcome to UKM Kanvas!');
    }

    // log the user out of the application
    // this is needed for the post /logout route.

    public function logout(Request $request) 
    {
        // log the current user out
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // redirect to home page 
        return redirect()->route('home')->with('success', 'You have been logged out.');
    }

    // Since you are using pop-up modals, you likely don't need these views.
    // However, they are often required by Laravel to resolve the 'login' and 'register' named routes.
    // If you get an error that the 'login' route is not defined, you can uncomment these and create simple views.
    
    // public function showLoginForm()
    // {
    //     return redirect()->route('home'); // Redirect to home if they hit the /login URL directly
    // }
    
    // public function showRegistrationForm()
    // {
    //     return redirect()->route('home'); // Redirect to home if they hit the /register URL directly
    // }
}

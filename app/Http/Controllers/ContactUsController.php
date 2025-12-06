<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactUsController extends Controller
{
    /**
     * Store a newly created contact submission.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tele_number' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        ContactUs::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'tele_number' => $validated['tele_number'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'user_id' => Auth::check() ? Auth::id() : null,
        ]);

        return redirect()->route('contact')
            ->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}

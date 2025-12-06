<?php

namespace App\Http\Controllers;

use App\Notifications\PaymentVerified;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class EventRegistrationController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Calculate amount - use event price
        $amount = $event->price ?? 0;

        // Store payment proof
        $paymentProofPath = $request->file('payment_proof')->store('payment-proofs', 'public');

        $registration = EventRegistration::create([
            'event_id' => $event->id,
            'user_id' => Auth::id(),
            'payment_proof' => $paymentProofPath,
            'payment_status' => 'pending',
            'amount_paid' => $amount,
        ]);

        // Create notification for user - using link_url instead of event_id
        Notification::create([
            'user_id' => Auth::id(),
            'type' => 'registration',
            'message' => "You have successfully registered for {$event->title}. Your payment is being verified.",
            'is_read' => false,
            'link_url' => route('events.show', $event->id),
        ]);

        return redirect()->back()->with('success', 'Registration submitted successfully! Please wait for payment verification.');
    }

    public function updateStatus(Request $request, EventRegistration $registration)
    {
        $validated = $request->validate([
            'payment_status' => 'required|in:pending,verified,rejected',
        ]);

        $registration->update($validated);

        // If payment is verified, send a notification to the user.
        if ($validated['payment_status'] === 'verified') {
            // We notify the user associated with the registration
            $user = $registration->user;
            $user->notify(new PaymentVerified($registration));
        }

        return redirect()->back()->with('success', 'Registration status updated successfully!');
    }
}

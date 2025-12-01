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
            'nim' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'asal_universitas' => 'required|string|max:255',
            'nomor_telp' => 'required|string|max:20',
            'is_kanvas_member' => 'required|boolean',
            'days_attending' => $event->has_multiple_days ? 'required|in:day_1,day_2,both' : 'nullable',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Calculate amount based on days
        $amount = $event->price ?? 0;
        if ($event->has_multiple_days && $request->days_attending) {
            $amount = match ($request->days_attending) {
                'day_1' => $event->day_1_price ?? 0,
                'day_2' => $event->day_2_price ?? 0,
                'both' => $event->both_days_price ?? 0,
                default => $event->price ?? 0,
            };
        }

        // Store payment proof
        $paymentProofPath = $request->file('payment_proof')->store('payment-proofs', 'public');

        $registration = EventRegistration::create([
            'event_id' => $event->id,
            'user_id' => Auth::id(),
            'name' => Auth::user()->name,
            'nim' => $validated['nim'],
            'jurusan' => $validated['jurusan'],
            'asal_universitas' => $validated['asal_universitas'],
            'nomor_telp' => $validated['nomor_telp'],
            'is_kanvas_member' => $validated['is_kanvas_member'],
            'days_attending' => $validated['days_attending'] ?? null,
            'payment_proof' => $paymentProofPath,
            'amount_paid' => $amount,
        ]);

        // Create notification for user
        Notification::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'type' => 'registration',
            'message' => "You have successfully registered for {$event->title}. Your payment is being verified.",
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

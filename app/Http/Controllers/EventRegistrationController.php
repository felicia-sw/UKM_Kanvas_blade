<?php

namespace App\Http\Controllers;

use App\Notifications\PaymentVerified;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Notification;
use App\Models\EventBudgetItem;
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

        $oldStatus = $registration->payment_status;
        $registration->update($validated);

        // If payment is verified, send a notification to the user.
        if ($validated['payment_status'] === 'verified') {
            // We notify the user associated with the registration
            $user = $registration->user;
            $user->notify(new PaymentVerified($registration));
        }

        // Update automatic registration income entry
        $this->updateRegistrationIncomeEntry($registration->event);

        return redirect()->back()->with('success', 'Registration status updated successfully!');
    }

    /**
     * Create or update automatic income entry for all verified registrations
     */
    private function updateRegistrationIncomeEntry(Event $event)
    {
        // Get all verified registrations
        $verifiedRegistrations = $event->registrations()
            ->where('payment_status', 'verified')
            ->get();

        $totalCount = $verifiedRegistrations->count();
        $totalAmount = $verifiedRegistrations->sum('amount_paid');

        // Find existing registration income entry
        $registrationIncome = EventBudgetItem::where('event_id', $event->id)
            ->where('type', 'income')
            ->where('item_name', 'Biaya Registrasi')
            ->first();

        if ($totalCount > 0) {
            // Calculate average price per registration
            $averagePrice = $totalCount > 0 ? $totalAmount / $totalCount : 0;

            if ($registrationIncome) {
                // Update existing entry
                $registrationIncome->update([
                    'price' => $averagePrice,
                    'quantity' => $totalCount,
                ]);
            } else {
                // Create new entry
                EventBudgetItem::create([
                    'event_id' => $event->id,
                    'type' => 'income',
                    'item_name' => 'Biaya Registrasi',
                    'price' => $averagePrice,
                    'quantity' => $totalCount,
                ]);
            }
        } else {
            // If no verified registrations, delete the entry if it exists
            if ($registrationIncome) {
                $registrationIncome->delete();
            }
        }
    }
}

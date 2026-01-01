<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Notification;
use App\Models\EventBudgetItem;
use App\Notifications\PaymentVerified;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EventRegistrationController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'phone_number' => 'nullable|string|max:20',
        ]);

        $user = Auth::user();

        // Update or create phone number in profile if provided
        if ($request->filled('phone_number')) {
            /** @var \App\Models\User $user */
            $profile = $user->profile;
            if ($profile) {
                // Profile exists, update phone number
                $profile->update(['no_telp' => $request->phone_number]);
            } else {
                // Profile doesn't exist - create with phone number and placeholder values for required fields
                // Using user ID + timestamp to ensure unique NIM
                $user->profile()->create([
                    'nim' => 'REG-' . $user->id . '-' . now()->timestamp, // Temporary unique NIM for registration
                    'jurusan' => 'Belum diisi', // Placeholder - user should update in profile
                    'asal_universitas' => 'Belum diisi', // Placeholder - user should update in profile
                    'no_telp' => $request->phone_number,
                ]);
            }
        }

        // Calculate amount - use event price
        $amount = $event->price ?? 0;

        // Store payment proof
        $paymentProofPath = $request->file('payment_proof')->store('payment-proofs', 'public');

        $registration = EventRegistration::create([
            'event_id' => $event->id,
            'user_id' => $user->id,
            'payment_proof' => $paymentProofPath,
            'payment_status' => 'pending',
            'amount_paid' => $amount,
        ]);

        // Create notification for user - using link_url instead of event_id
        Notification::create([
            'user_id' => $user->id,
            'type' => 'registration',
            'message' => "You have successfully registered for {$event->title}. Your payment is being verified.",
            'is_read' => false,
            'link_url' => route('events.show', $event->id),
        ]);

        $message = 'Registration submitted successfully! Please wait for payment verification.';
        if ($request->filled('phone_number')) {
            $message .= ' You will receive a WhatsApp confirmation when your payment is verified.';
        } else {
            $message .= ' Note: Add your WhatsApp number to receive verification confirmation.';
        }

        return redirect()->back()->with('success', $message);
    }

    public function updateStatus(Request $request, EventRegistration $registration, WhatsAppService $whatsAppService)
    {
        try {
            $validated = $request->validate([
                'payment_status' => 'required|in:pending,verified,rejected',
            ]);

            $registration->load(['user.profile', 'event']);
            $oldStatus = $registration->payment_status;
            $registration->update($validated);

            $whatsappSent = false;
            $whatsappMessage = 'Registration status updated successfully!';

            if ($validated['payment_status'] === 'verified') {
                $user = $registration->user;

                // 1. Create the in-app notification manually for consistency with original code.
                Notification::create([
                    'user_id' => $user->id,
                    'type' => 'payment_verified',
                    'message' => "Your payment for '{$registration->event->title}' has been verified.",
                    'is_read' => false,
                    'link_url' => route('events.show', $registration->event_id),
                ]);

                // 2. Handle WhatsApp sending to get synchronous feedback for the AJAX response.
                if (empty(config('fonnte.token'))) {
                    $whatsappMessage = 'Registration verified, but WhatsApp not sent (FONNTE_TOKEN not configured).';
                } elseif (!$user->profile || !$user->profile->no_telp) {
                    $whatsappMessage = 'Registration verified, but WhatsApp not sent (no phone number in profile).';
                } else {
                    try {
                        // Reuse the message formatting from the notification class to avoid duplicating logic.
                        $notification = new PaymentVerified($registration);
                        $message = $notification->toWhatsApp($user);
                        
                        $whatsappSent = $whatsAppService->sendMessage($user->profile->no_telp, $message);
                        
                        if ($whatsappSent) {
                            $whatsappMessage = 'Registration verified successfully! WhatsApp confirmation sent.';
                        } else {
                            $whatsappMessage = 'Registration verified, but WhatsApp message failed to send (check logs).';
                        }
                    } catch (\Exception $e) {
                         Log::error('Error sending WhatsApp from controller', ['error' => $e->getMessage(), 'registration_id' => $registration->id]);
                         $whatsappMessage = 'Registration verified, but an error occurred while sending WhatsApp.';
                    }
                }
            }

            try {
                $this->updateRegistrationIncomeEntry($registration->event);
            } catch (\Exception $e) {
                Log::error('Failed to update registration income entry. This did not prevent payment verification.', [
                    'event_id' => $registration->event_id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }

            if ($request->ajax() || $request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                $finalMessage = ($validated['payment_status'] === 'verified') ? $whatsappMessage : 'Registration status updated successfully!';
                
                return response()->json([
                    'success' => true,
                    'message' => $finalMessage,
                    'payment_status' => $registration->payment_status,
                    'whatsapp_sent' => $whatsappSent,
                ]);
            }
            
            $finalMessage = ($validated['payment_status'] === 'verified') ? $whatsappMessage : 'Registration status updated successfully!';
            return redirect()->back()->with('success', $finalMessage);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error in updateStatus', [
                'errors' => $e->errors()
            ]);
            return redirect()->back()->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {
            Log::error('Error updating payment status', [
                'registration_id' => $registration->id ?? 'unknown',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'An error occurred while verifying payment. Please try again.');
        }
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

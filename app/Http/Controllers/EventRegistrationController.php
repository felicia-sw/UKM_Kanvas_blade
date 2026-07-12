<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRegistrationRequest;
use App\Models\Event;
use App\Models\EventBudgetItem;
use App\Models\EventRegistration;
use App\Models\Notification;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EventRegistrationController extends Controller
{
    /**
     * Handles the initial registration of a user for an event.
     * Processes payment proof upload via Cloudinary, creates an EventRegistration record,
     * and sends an initial in-app notification to the user.
     *
     * @param  \Illuminate\Http\Request  $request  The HTTP request containing registration data.
     * @param  \App\Models\Event  $event  The event being registered for.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success message.
     */
    public function store(StoreEventRegistrationRequest $request, Event $event)
    {
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
                    'nim' => 'REG-'.$user->id.'-'.now()->timestamp, // Temporary unique NIM for registration
                    'jurusan' => 'Belum diisi', // Placeholder - user should update in profile
                    'asal_universitas' => 'Belum diisi', // Placeholder - user should update in profile
                    'no_telp' => $request->phone_number,
                ]);
            }
        }

        // Calculate amount - use event price
        $amount = $event->price ?? 0;

        $registration = EventRegistration::create([
            'event_id' => $event->id,
            'user_id' => $user->id,
            // The 'payment_proof' field automatically uses the CloudinaryUpload trait
            // to handle the file upload and store the public ID.
            'payment_proof' => $request->file('payment_proof'),
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

    /**
     * Updates the payment status of an event registration.
     * This method is typically called by an administrator to verify or reject a payment.
     * Upon verification, it sends both an in-app notification and a WhatsApp message to the user.
     *
     * @param  \Illuminate\Http\Request  $request  The HTTP request containing the new payment status.
     * @param  \App\Models\EventRegistration  $registration  The event registration to update.
     * @param  \App\Services\WhatsAppService  $whatsAppService  The WhatsApp service for sending messages.
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
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

                // 1. Create an in-app notification for the user to confirm payment verification.
                Notification::create([
                    'user_id' => $user->id,
                    'type' => 'payment_verified',
                    'message' => "Your payment for '{$registration->event->title}' has been verified.",
                    'is_read' => false,
                    'link_url' => route('events.show', $registration->event_id),
                ]);

                // 2. Send the WhatsApp confirmation; the service owns the
                // preconditions (token, phone number) and error handling.
                $whatsApp = $whatsAppService->sendPaymentVerifiedMessage($registration);
                $whatsappSent = $whatsApp['sent'];
                $whatsappMessage = $whatsApp['feedback'];
            }

            try {
                $this->updateRegistrationIncomeEntry($registration->event);
            } catch (\Exception $e) {
                Log::error('Failed to update registration income entry. This did not prevent payment verification.', [
                    'event_id' => $registration->event_id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
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
                'errors' => $e->errors(),
            ]);

            return redirect()->back()->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {
            Log::error('Error updating payment status', [
                'registration_id' => $registration->id ?? 'unknown',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
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

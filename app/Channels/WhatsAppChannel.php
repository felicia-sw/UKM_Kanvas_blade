<?php

namespace App\Channels;

use App\Services\WhatsAppService;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

/**
 * Class WhatsAppChannel
 *
 * @package App\Channels
 *
 * This custom Laravel Notification Channel is responsible for sending notifications
 * via WhatsApp, by delegating the actual message sending to the `WhatsAppService`.
 * It allows notifications to be sent through the standard Laravel `Notification` facade
 * or `notifiable->notify()` method, provided the notification defines a `toWhatsApp` method.
 */
class WhatsAppChannel
{
    protected WhatsAppService $whatsAppService;

    /**
     * Create a new WhatsApp channel instance.
     * The `WhatsAppService` is injected to handle the underlying API communication.
     *
     * @param \App\Services\WhatsAppService $whatsAppService
     */
    public function __construct(WhatsAppService $whatsAppService)
    {
        $this->whatsAppService = $whatsAppService;
    }

    /**
     * Send the given notification.
     * This method is automatically called by Laravel's Notification system when
     * this channel is specified in the notification's `via()` method.
     *
     * @param mixed $notifiable The entity sending the notification (e.g., a User model).
     * @param \Illuminate\Notifications\Notification $notification The notification instance.
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        try {
            // Ensure the notification has a `toWhatsApp` method to generate the message content.
            if (!method_exists($notification, 'toWhatsApp')) {
                Log::warning('Notification missing toWhatsApp method', [
                    'notification' => get_class($notification)
                ]);
                return;
            }

            // Retrieve the recipient's phone number from their profile.
            // This assumes the notifiable object (e.g., User) has a `profile` relationship.
            $phoneNumber = $notifiable->profile->no_telp ?? null;

            // If no phone number is found, log a warning and do not send the message.
            if (!$phoneNumber) {
                Log::warning('User has no phone number to send WhatsApp to', [
                    'user_id' => $notifiable->id
                ]);
                return;
            }

            // Get the formatted message content from the notification's `toWhatsApp` method.
            $message = $notification->toWhatsApp($notifiable);

            Log::info('Attempting to send WhatsApp via channel', [
                'user_id' => $notifiable->id,
                'phone' => $phoneNumber
            ]);

            // Use the injected WhatsAppService to send the message.
            $result = $this->whatsAppService->sendMessage($phoneNumber, $message);

            if ($result) {
                Log::info('WhatsApp sent successfully via channel', [
                    'user_id' => $notifiable->id
                ]);
            } else {
                Log::error('WhatsApp failed to send via channel', [
                    'user_id' => $notifiable->id
                ]);
            }

        } catch (\Exception $e) {
            // Catch and log any exceptions that occur during the channel's operation.
            Log::error('WhatsApp channel exception caught', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => $notifiable->id ?? 'unknown'
            ]);
        }
    }
}

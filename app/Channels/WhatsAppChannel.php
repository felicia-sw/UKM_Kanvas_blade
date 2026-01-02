<?php

namespace App\Channels;

use App\Services\WhatsAppService;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class WhatsAppChannel
{
    protected WhatsAppService $whatsAppService;

    public function __construct(WhatsAppService $whatsAppService)
    {
        $this->whatsAppService = $whatsAppService;
    }

    public function send($notifiable, Notification $notification)
    {
        try {
            if (!method_exists($notification, 'toWhatsApp')) {
                Log::warning('Notification missing toWhatsApp method', [
                    'notification' => get_class($notification)
                ]);
                return;
            }

            $phoneNumber = $notifiable->profile->no_telp ?? null;

            if (!$phoneNumber) {
                Log::warning('User has no phone number', [
                    'user_id' => $notifiable->id
                ]);
                return;
            }

            $message = $notification->toWhatsApp($notifiable);

            Log::info('Sending WhatsApp via channel', [
                'user_id' => $notifiable->id,
                'phone' => $phoneNumber
            ]);

            $result = $this->whatsAppService->sendMessage($phoneNumber, $message);

            if ($result) {
                Log::info('WhatsApp sent successfully via channel', [
                    'user_id' => $notifiable->id
                ]);
            } else {
                Log::error('WhatsApp failed via channel', [
                    'user_id' => $notifiable->id
                ]);
            }

        } catch (\Exception $e) {
            Log::error('WhatsApp channel exception', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => $notifiable->id ?? 'unknown'
            ]);
        }
    }
}

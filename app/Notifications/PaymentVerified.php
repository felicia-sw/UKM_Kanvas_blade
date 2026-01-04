<?php

namespace App\Notifications;

use App\Models\EventRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class PaymentVerified extends Notification
{
    use Queueable;

    protected EventRegistration $registration;

    /**
     * Create a new notification instance.
     */
    public function __construct(EventRegistration $registration)
    {
        $this->registration = $registration;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        $channels = ['database'];

        // Only add WhatsApp if user has phone number
        if ($notifiable->profile && $notifiable->profile->no_telp) {
            $channels[] = \App\Channels\WhatsAppChannel::class;
        }

        return $channels;
    }

    /**
     * Format WhatsApp message
     */
    public function toWhatsApp($notifiable)
    {
        try {
            $eventName = $this->registration->event->title;
            $userName = $notifiable->name;
            $eventDate = $this->registration->event->start_date->format('d F Y, H:i');
            $eventLocation = $this->registration->event->location ?? 'TBA';

            $message = "✅ *PEMBAYARAN TERVERIFIKASI*\n\n";
            $message .= "Halo {$userName},\n\n";
            $message .= "Pembayaran Anda untuk event *{$eventName}* telah diverifikasi oleh Admin UKM Kanvas.\n\n";
            $message .= "*Detail Event:*\n";
            $message .= "📅 Tanggal: {$eventDate}\n";
            $message .= "📍 Lokasi: {$eventLocation}\n\n";
            $message .= "Terima kasih telah mendaftar! Sampai jumpa di acara.\n\n";
            $message .= "_Pesan otomatis - Jangan balas_";

            return $message;
        } catch (\Exception $e) {
            Log::error('Error creating WhatsApp message', [
                'error' => $e->getMessage(),
                'registration_id' => $this->registration->id
            ]);
            return "Pembayaran Anda telah diverifikasi.";
        }
    }


    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'payment_verified',
            'message' => "Your payment for '{$this->registration->event->title}' has been verified.",
            'is_read' => false,
            'link_url' => route('events.show', $this->registration->event_id),
        ];
    }
}
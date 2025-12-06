<?php

namespace App\Notifications;

use App\Models\EventRegistration;
use App\Services\WhatsAppService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class PaymentVerified extends Notification implements ShouldQueue
{
    use Queueable;

    protected EventRegistration $registration;

    /**
     * Create a new notification instance.
     *
     * @param EventRegistration $registration
     */
    public function __construct(EventRegistration $registration)
    {
        $this->registration = $registration;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // We can define a custom channel for WhatsApp
        return ['database', \App\Channels\WhatsAppChannel::class];
    }

    /**
     * Get the WhatsApp representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    public function toWhatsApp($notifiable)
    {
        $eventName = $this->registration->event->title;
        return "Your Payment for the Event: *{$eventName}* has been verified by Kanvas Admin. Thank you for registering!";
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'type' => 'payment_verified',
            'message' => "Your payment for '{$this->registration->event->title}' has been verified.",
            'is_read' => false,
            'link_url' => route('events.show', $this->registration->event_id),
        ];
    }
}

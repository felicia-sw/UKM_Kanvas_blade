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

    /**
     * Send the given notification.
     */
    public function send($notifiable, Notification $notification)
    {
        // Check if notification has toWhatsApp method
        if (!method_exists($notification, 'toWhatsApp')) {
            Log::warning('Notification does not have toWhatsApp method', [
                'notification_class' => get_class($notification)
            ]);
            return;
        }

        // Get phone number from user's profile
        $phoneNumber = $notifiable->profile->no_telp ?? null;

        if (!$phoneNumber) {
            Log::warning('User has no phone number', [
                'user_id' => $notifiable->id,
                'user_name' => $notifiable->name
            ]);
            return;
        }

        // Get message from notification
        $message = $notification->toWhatsApp($notifiable);

        Log::info('Sending WhatsApp notification', [
            'user_id' => $notifiable->id,
            'phone' => $phoneNumber,
            'notification_type' => get_class($notification)
        ]);

        // Send message
        $result = $this->whatsAppService->sendMessage($phoneNumber, $message);

        if ($result) {
            Log::info('WhatsApp notification sent successfully', [
                'user_id' => $notifiable->id
            ]);
        } else {
            Log::error('WhatsApp notification failed', [
                'user_id' => $notifiable->id,
                'phone' => $phoneNumber
            ]);
        }
    }
}

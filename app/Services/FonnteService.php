namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected $token;
    protected $url;

    public function __construct()
    {
        $this->token = config('fonnte.token');
        $this->url = config('fonnte.url');
    }

    /**
     * Send WhatsApp message via Fonnte API
     * 
     * @param string $to - Phone number (will be formatted automatically)
     * @param string $message - Message to send
     * @return bool - Success status
     */
    public function sendMessage(string $to, string $message): bool
    {
        try {
            // Format phone number - remove non-numeric characters
            $phoneNumber = preg_replace('/[^0-9]/', '', $to);
            
            // Add Indonesia country code if not present
            if (substr($phoneNumber, 0, 1) === '0') {
                $phoneNumber = '62' . substr($phoneNumber, 1);
            } elseif (substr($phoneNumber, 0, 2) !== '62') {
                $phoneNumber = '62' . $phoneNumber;
            }

            Log::info('Attempting to send WhatsApp', [
                'original_number' => $to,
                'formatted_number' => $phoneNumber,
                'message_length' => strlen($message)
            ]);

            // Make API call to Fonnte
            $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])->post($this->url, [
                'target' => $phoneNumber,
                'message' => $message,
                'countryCode' => '62',
            ]);

            // Log full response for debugging
            Log::info('Fonnte API Response', [
                'status_code' => $response->status(),
                'response_body' => $response->json(),
                'phone' => $phoneNumber
            ]);

            // Check if successful
            if ($response->successful()) {
                $data = $response->json();
                
                // Fonnte returns 'status' => true on success
                if (isset($data['status']) && $data['status'] === true) {
                    Log::info('WhatsApp sent successfully', [
                        'phone' => $phoneNumber,
                        'response' => $data
                    ]);
                    return true;
                } else {
                    Log::error('Fonnte returned failure', [
                        'phone' => $phoneNumber,
                        'reason' => $data['reason'] ?? 'Unknown',
                        'response' => $data
                    ]);
                    return false;
                }
            }

            Log::error('Fonnte API request failed', [
                'status_code' => $response->status(),
                'phone' => $phoneNumber,
                'response' => $response->body()
            ]);
            return false;

        } catch (\Exception $e) {
            Log::error('WhatsApp sending exception', [
                'error' => $e->getMessage(),
                'phone' => $to,
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }
}

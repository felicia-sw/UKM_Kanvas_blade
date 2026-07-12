<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Class WhatsAppService
 *
 * @package App\Services
 *
 * This service class acts as an abstraction layer for sending messages via the Fonnte WhatsApp API.
 * It handles API configuration, phone number formatting, and making HTTP requests to the Fonnte endpoint.
 */
class WhatsAppService
{
    protected $token; // The API token for Fonnte.
    protected $url;   // The Fonnte API endpoint URL.

    /**
     * WhatsAppService constructor.
     * Initializes the service by loading the Fonnte API token and URL from configuration.
     */
    public function __construct()
    {
        // Retrieve the Fonnte API token from Laravel's configuration (config/fonnte.php).
        $this->token = config('fonnte.token');
        // Retrieve the Fonnte API URL from configuration, with a fallback default.
        $this->url = config('fonnte.url', 'https://api.fonnte.com/send');
    }

    /**
     * Sends a WhatsApp message to a specified phone number.
     *
     * @param string $to The recipient's phone number.
     * @param string $message The message content to be sent.
     * @return bool True if the message was successfully queued/sent by Fonnte, false otherwise.
     */
    public function sendMessage(string $to, string $message): bool
    {
        try {
            // Validate that the Fonnte API token is configured.
            if (empty($this->token)) {
                Log::error('Fonnte token not configured');
                return false;
            }

            // Format the phone number to ensure it starts with '62' (Indonesia's country code)
            // and contains only digits, as required by the Fonnte API.
            $phoneNumber = preg_replace('/[^0-9]/', '', $to);
            
            if (substr($phoneNumber, 0, 1) === '0') {
                // If number starts with '0', replace it with '62'.
                $phoneNumber = '62' . substr($phoneNumber, 1);
            } elseif (substr($phoneNumber, 0, 2) !== '62') {
                // If number does not start with '62', prepend '62'.
                $phoneNumber = '62' . $phoneNumber;
            }

            Log::info('Sending to Fonnte API', [
                'phone' => $phoneNumber,
                'url' => $this->url
            ]);

            // Make an HTTP POST request to the Fonnte API.
            $response = Http::timeout(10)->withHeaders([
                'Authorization' => $this->token, // Authenticate with the Fonnte API token.
            ])->post($this->url, [
                'target' => $phoneNumber,  // The formatted recipient phone number.
                'message' => $message,     // The message text.
                'countryCode' => '62',     // Explicitly set country code for Fonnte.
            ]);

            Log::info('Fonnte response', [
                'status' => $response->status(),
                'body' => $response->json()
            ]);

            // Check if the HTTP request was successful (2xx status code).
            if ($response->successful()) {
                $data = $response->json();
                
                // Fonnte API typically returns a 'status' field in its JSON response.
                if (isset($data['status']) && $data['status'] === true) {
                    return true; // Message successfully processed by Fonnte.
                }
                
                // Log if Fonnte API indicates an error despite a successful HTTP status.
                Log::error('Fonnte returned false status', [
                    'response' => $data
                ]);
                return false;
            }

            // Log if the HTTP request itself failed.
            Log::error('Fonnte HTTP error', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            return false;

        } catch (\Exception $e) {
            // Catch and log any exceptions that occur during the process.
            Log::error('WhatsApp service exception', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }
}

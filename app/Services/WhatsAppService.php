<?php

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
        $this->url = config('fonnte.url', 'https://api.fonnte.com/send');
    }

    public function sendMessage(string $to, string $message): bool
    {
        try {
            // Validate token exists
            if (empty($this->token)) {
                Log::error('Fonnte token not configured');
                return false;
            }

            // Format phone number
            $phoneNumber = preg_replace('/[^0-9]/', '', $to);
            
            if (substr($phoneNumber, 0, 1) === '0') {
                $phoneNumber = '62' . substr($phoneNumber, 1);
            } elseif (substr($phoneNumber, 0, 2) !== '62') {
                $phoneNumber = '62' . $phoneNumber;
            }

            Log::info('Sending to Fonnte API', [
                'phone' => $phoneNumber,
                'url' => $this->url
            ]);

            $response = Http::timeout(10)->withHeaders([
                'Authorization' => $this->token,
            ])->post($this->url, [
                'target' => $phoneNumber,
                'message' => $message,
                'countryCode' => '62',
            ]);

            Log::info('Fonnte response', [
                'status' => $response->status(),
                'body' => $response->json()
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['status']) && $data['status'] === true) {
                    return true;
                }
                
                Log::error('Fonnte returned false status', [
                    'response' => $data
                ]);
                return false;
            }

            Log::error('Fonnte HTTP error', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            return false;

        } catch (\Exception $e) {
            Log::error('WhatsApp service exception', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }
}

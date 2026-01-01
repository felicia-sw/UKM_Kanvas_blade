<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    /**
     * Send a WhatsApp message via Fonnte.
     *
     * @param string $target  The phone number
     * @param string $message The text message
     * @return mixed Array response from Fonnte OR false on failure
     */
    public static function send($target, $message)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => env('FONNTE_TOKEN'),
            ])->post('https://api.fonnte.com/send', [
                'target' => $target,
                'message' => $message,
                'countryCode' => '62',
            ]);

            // Check if the HTTP request itself failed (e.g., 401, 500)
            if ($response->failed()) {
                Log::error("Fonnte API HTTP Error for {$target}: " . $response->body());
                return false;
            }

            return $response->json();
        } catch (\Exception $e) {
            // Log the specific system error
            Log::error("Fonnte Connection Error for {$target}: " . $e->getMessage());

            return false;
        }
    }

    /**
     * Format phone number for Fonnte API.
     * Removes leading 0 and ensures proper format.
     *
     * @param string $phoneNumber
     * @return string
     */
    public static function formatPhoneNumber($phoneNumber)
    {
        // Remove all non-numeric characters
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        // Remove leading 0 if present
        if (substr($phoneNumber, 0, 1) === '0') {
            $phoneNumber = substr($phoneNumber, 1);
        }

        // Remove country code if already present (62)
        if (substr($phoneNumber, 0, 2) === '62') {
            $phoneNumber = substr($phoneNumber, 2);
        }

        return $phoneNumber;
    }
}

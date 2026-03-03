<?php

require __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

echo "=== Testing Cloudinary Connection ===\n\n";

// Check environment variables
echo "Checking environment variables:\n";
echo "CLOUDINARY_URL: " . (env('CLOUDINARY_URL') ? '✓ Set' : '✗ Not set') . "\n";
echo "CLOUDINARY_CLOUD_NAME: " . (env('CLOUDINARY_CLOUD_NAME') ? env('CLOUDINARY_CLOUD_NAME') : '✗ Not set') . "\n";
echo "CLOUDINARY_API_KEY: " . (env('CLOUDINARY_API_KEY') ? '✓ Set (hidden)' : '✗ Not set') . "\n";
echo "CLOUDINARY_API_SECRET: " . (env('CLOUDINARY_API_SECRET') ? '✓ Set (hidden)' : '✗ Not set') . "\n\n";

// Test SSL certificate
echo "Checking SSL certificate configuration:\n";
$sslInfo = openssl_get_cert_locations();
echo "Default cert file: " . ($sslInfo['default_cert_file'] ?? 'Not set') . "\n";
echo "Default cert dir: " . ($sslInfo['default_cert_dir'] ?? 'Not set') . "\n";
echo "Default CA path from php.ini: " . (ini_get('openssl.cafile') ?: 'Not configured') . "\n\n";

// Try to ping Cloudinary
try {
    echo "Testing Cloudinary API connection...\n";
    $api = Cloudinary::getApi();
    $ping = $api->ping();
    echo "✓ Connection successful!\n";
    echo "Response: " . json_encode($ping) . "\n";
} catch (\Exception $e) {
    echo "✗ Connection failed!\n";
    echo "Error: " . $e->getMessage() . "\n";
    echo "This might be an SSL certificate issue.\n";
}

echo "\n=== Test Complete ===\n";

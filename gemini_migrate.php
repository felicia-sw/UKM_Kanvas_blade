<?php

require __DIR__.'/bootstrap/app.php';

use Illuminate\Support\Facades\Artisan;

Artisan::call('migrate', [
    '--force' => true
]);

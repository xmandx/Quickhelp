<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Contact;
use App\Models\Address;
use App\Models\Message;

// Limpa qualquer dado com payload de script ou tags HTML para evitar problemas visuais
Contact::where('name_contact', 'like', '%<%')
    ->orWhere('phone_contact', 'like', '%<%')
    ->delete();

Address::where('city_address', 'like', '%<%')
    ->orWhere('street_address', 'like', '%<%')
    ->delete();

Message::where('name_message', 'like', '%<%')
    ->orWhere('message_message', 'like', '%<%')
    ->delete();

echo "Database cleaned up from XSS payloads.\n";

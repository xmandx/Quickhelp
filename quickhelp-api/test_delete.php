<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Contact;
use App\Models\Message;

echo "Contacts: \n";
$contacts = Contact::all();
foreach($contacts as $c) {
    echo "ID: " . $c->id_contact . " - " . $c->name_contact . "\n";
}

echo "\nTest Delete Contact 1: \n";
$c = Contact::find(1);
if ($c) {
    echo "Found contact 1. Deleting...\n";
    $c->delete();
    echo "Deleted.\n";
} else {
    echo "Contact 1 not found.\n";
}

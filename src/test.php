<?php

require '/var/www/html/php/TeamThreads/vendor/autoload.php';

use MongoDB\Client;

// Verbindung zur MongoDB herstellen
$mongoClient = new Client("mongodb://localhost:27017");

// Datenbank und Collection auswählen
$database = $mongoClient->selectDatabase('admin');
$collection = $database->selectCollection('user');

// Nutzerdaten
$nutzerDaten = [
    'name' => 'Felix',
    'uuid' => '23489',
    'age' => 23,
];

// Filterkriterium basierend auf der UUID
$filter = ['uuid' => '23489'];

// Aktualisiere den Eintrag in der MongoDB, falls vorhanden, ansonsten füge ihn hinzu
$result = $collection->replaceOne(
    $filter,
    $nutzerDaten,
    ['upsert' => true]
);

echo "Eintrag erfolgreich aktualisiert bzw. erstellt.";


?>^

<?php

require '/var/www/html/php/TeamThreads/vendor/autoload.php';

use MongoDB\Client;

// Verbindung zur MongoDB herstellen
$mongoClient = new Client("mongodb://localhost:27017");

// Datenbank und Collection auswählen
$database = $mongoClient->selectDatabase('admin');
$collection = $database->selectCollection('user');



// Überprüfe, ob GET-Parameter vorhanden sind
if (!empty($_GET)) {
    // Erstelle eine leere Liste
    $parameterListe = array();

    // Iteriere über alle GET-Parameter
    foreach ($_GET as $key => $value) {
        // Füge den Parameterwert zur Liste hinzu
        $parameterListe[$key] = $value;
    }

    // Erstelle das gewünschte Format
    $nutzerDaten = array();

    foreach ($parameterListe as $key => $value) {
        $nutzerDaten[$key] = $value;
    }

    // Gib die Daten im gewünschten Format aus
    print_r($nutzerDaten);
} else {
    echo "Keine GET-Parameter vorhanden.";
}


// Filterkriterium basierend auf der UUID
$filter = ['uuid' => $_GET['uuid']];

// Aktualisiere den Eintrag in der MongoDB, falls vorhanden, ansonsten füge ihn hinzu
$result = $collection->replaceOne(
    $filter,
    $nutzerDaten,
    ['upsert' => true]
);

echo "Eintrag erfolgreich aktualisiert bzw. erstellt.";


?>
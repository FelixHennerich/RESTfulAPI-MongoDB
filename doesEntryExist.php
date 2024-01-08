<?php

require '/var/www/html/php/TeamThreads/vendor/autoload.php';

use MongoDB\Client;

// Verbindung zur MongoDB herstellen
$mongoClient = new Client("mongodb://localhost:27017");

// Datenbank und Collection auswählen
$database = $mongoClient->selectDatabase('admin');
$collection = $database->selectCollection('user');


foreach ($_GET as $parameter => $value) {
    // MongoDB-Abfrage vorbereiten
    $query = [$parameter => $value];
    $result = $collection->findOne($query);

    // Überprüfen, ob ein Dokument gefunden wurde
    if ($result) {
        // Dokument existiert, daher "true" anzeigen
        echo "true";
        // Falls du nur den ersten gefundenen Datensatz verwenden möchtest, kannst du hier break verwenden
        break;
    }
}

// Wenn kein Dokument gefunden wurde, "false" anzeigen
if (!$result) {
    echo "false";
}

?>
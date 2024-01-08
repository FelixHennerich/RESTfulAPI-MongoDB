<?php

require '/var/www/html/php/TeamThreads/vendor/autoload.php';

use MongoDB\Client;

// Verbindung zur MongoDB herstellen
$mongoClient = new Client("mongodb://localhost:27017");

// Datenbank und Collection auswählen
$database = $mongoClient->selectDatabase('admin');
$collection = $database->selectCollection('user');


// Iteriere über alle Parameter in der URL
foreach ($_GET as $parameter => $value) {
    // MongoDB-Abfrage vorbereiten
    $query = [$parameter => $value];
    $result = $collection->findOne($query);

    // Überprüfen, ob ein Dokument gefunden wurde
    if ($result) {
        // Dokument gefunden, Daten ausgeben
        foreach ($result as $key => $val) {
            echo ucfirst($key) . ":" . $val . "#";
        }
        // Füge hier weitere Anpassungen hinzu, je nachdem, was du ausgeben möchtest
        break;
    }
}

// Wenn kein Dokument gefunden wurde, entsprechende Meldung ausgeben
if (!$result) {
    echo "Benutzer nicht gefunden.";
}

?>
<?php

// Suchen nach der Variable X5 als Servervariable, Konstante, oder als Umgebungsvariable
if (isset($_SERVER['X5'])) {
    $x5 = $_SERVER['X5'];
} elseif (defined('X5')) {
    $x5 = X5;
} elseif (getenv('X5') !== false) {
    $x5 = getenv('X5');
} else {
    // Wenn X5 nicht gefunden wird, dann selber setzen und sicherstellen, dass der Pfad korrekt beginnt
    $x5 = '/../x5/';
}

// Korrigiere sofort doppelte Schrägstriche
$x5 = str_replace('//', '/', $x5);
if(substr($x5, -1) != '/') {
    $x5 .= '/';
}

$x5_exists = false;
$iterations = 0;

// Überprüfen, ob der x5 Ordner existiert
while (!$x5_exists && $iterations < 3) {
    if (is_dir($x5)) {
        $x5_exists = true;
    } else {
        $x5 .= '/../'; // Einen Ordner höher gehen
        // Korrigiere eventuell doppelte Schrägstriche bei jedem Schleifendurchlauf
        $x5 = str_replace('//', '/', $x5);
        $iterations++;
    }
}

// $x5_filepath setzen
$x5_filepath = $x5_exists ? $x5 . 'x5_start.php' : null;

// Korrigiere eventuell doppelte Schrägstriche
$x5_filepath = str_replace('//', '/', $x5_filepath);

// Überprüfen, ob $x5_filepath eine Datei ist und inkludieren
if (is_file($x5_filepath)) {
    include $x5_filepath;
} else {
    // Fehlermeldung ausgeben, wenn die Datei nicht existiert
    echo "Fehler: x5_start.php wurde nicht gefunden.";
}

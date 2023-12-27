<?php

$files = array(
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
);
$css = '';

foreach ($files as $file) {
    if(substr($file, 0, 6) == 'https:' || substr($file, 0, 6) == 'https:') {
        $css .= Curl::get_cached($file, DAY);
    } else {
        $File = File::instance($file);
        $css .= $File->get_content();
    }
}

// Setze den MIME-Typ und Kodierung für die Antwort
App::$mime = 'text/css';
App::$encoding = 'UTF-8';

// Sende den zusammengefügten JavaScript-Inhalt
Response::deliver($css);

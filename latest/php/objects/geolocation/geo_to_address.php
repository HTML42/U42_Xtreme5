<?php

$errors = [];
$response = [];

// Längen- und Breitengrad aus den Request-Parametern abrufen
$lat = Request::param('lat');
$lng = Request::param('lng');

// Überprüfen, ob die erforderlichen Parameter vorhanden sind
if (empty($lat) || empty($lng)) {
    $errors[] = _('errors.geo.missing_coordinates');
} else {
    // Verwenden der XGeo-Klasse für Reverse-Geocoding
    $address = XGeo::lnglat_to_address($lng, $lat);
    
    if ($address) {
        $response['address'] = $address;
    } else {
        $errors[] = _('errors.geo.no_results');
    }
}

// Antwort zurücksenden
Response::ajax($response, empty($errors) ? 200 : 400, $errors);

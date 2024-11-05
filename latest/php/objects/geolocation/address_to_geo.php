<?php

$errors = [];
$response = [];

// Abrufen der Adresse aus dem Request-Parameter `address`
$address = Request::param('address');

// Prüfen, ob eine Adresse übergeben wurde
if (empty($address)) {
    $errors[] = _('errors.geo.missing_address');
} else {
    // Verwenden der XGeo-Klasse zur Geokodierung
    $coordinates = XGeo::address_to_lnglat($address);
    
    if ($coordinates) {
        $response['lat'] = $coordinates['lat'];
        $response['lng'] = $coordinates['lng'];
    } else {
        $errors[] = _('errors.geo.no_results');
    }
}

// Antwort zurücksenden
Response::ajax($response, empty($errors) ? 200 : 400, $errors);

<?php

$errors = [];
$response = [];

// Abrufen des Eingabestrings aus den Request-Parametern
$input = Request::param('input');

// Validierung des Eingabestrings
if (empty($input) || !is_string($input)) {
    $errors[] = _('errors.geo.missing_input');
} else {
    // Nutzung der neuen XGeo-Klasse für die Adresssuche
    try {
        $suggestions = XGeo::address_search($input);
        if (!empty($suggestions)) {
            foreach ($suggestions as $location) {
                $response[] = [
                    'display_name' => $location['display_name'],
                    'lat' => $location['lat'] ?? null,
                    'lng' => $location['lng'] ?? null
                ];
            }
        } else {
            $errors[] = _('errors.geo.no_results');
        }
    } catch (Exception $e) {
        $errors[] = _('errors.geo.api_failed');
    }
}

// Antwort zurücksenden
Response::ajax($response, empty($errors) ? 200 : 400, $errors);

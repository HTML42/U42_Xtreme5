<?php

class XGeo {

    // Base URL for the geolocation API (e.g., OpenStreetMap Nominatim)
    private static $baseurl = "https://nominatim.openstreetmap.org/";

    // Convert an address to longitude and latitude coordinates
    public static function address_to_lnglat($address, $ttl = 84000) {
        $params = ['format' => 'json'];
        
        // Check if address is a string or an array with components
        if (is_string($address)) {
            $params['q'] = $address;
        } elseif (is_array($address)) {
            $params = array_merge($params, array_filter([
                'street' => $address['street'] ?? null,
                'housenumber' => $address['housenumber'] ?? null,
                'city' => $address['city'] ?? null,
                'postcode' => $address['postcode'] ?? null,
                'country' => $address['country'] ?? null
            ]));
        } else {
            return null;  // Return null if input format is invalid
        }

        $result = self::_cache_curl('search', $params, $ttl);
        return !empty($result) && isset($result[0]['lat'], $result[0]['lon']) ? [
            'lat' => floatval($result[0]['lat']),
            'lng' => floatval($result[0]['lon'])
        ] : null;
    }

    // Convert longitude and latitude coordinates to an address
    public static function lnglat_to_address($lng, $lat, $ttl = 84000) {
        if (!self::is_valid_coordinate($lng) || !self::is_valid_coordinate($lat)) {
            return null;
        }

        $params = [
            'format' => 'json',
            'lat' => $lat,
            'lng' => $lng
        ];

        $result = self::_cache_curl('reverse', $params, $ttl);
        return $result['display_name'] ?? null;
    }

    // Search for multiple address suggestions based on input
    public static function address_search($input, $ttl = 84000) {
        if (!is_string($input) || empty(trim($input))) {
            return null;
        }

        $params = [
            'format' => 'json',
            'q' => trim($input),
            'addressdetails' => 1,
            'limit' => 5
        ];

        $results = self::_cache_curl('search', $params, $ttl);

        // Map results to ensure latitude and longitude are consistently returned
        return array_map(function($location) {
            return [
                'display_name' => $location['display_name'] ?? '',
                'lat' => $location['lat'] ? floatval($location['lat']) : null,
                'lng' => $location['lon'] ? floatval($location['lon']) : null
            ];
        }, $results ?? []);
    }

    // Helper method: Validate coordinates
    private static function is_valid_coordinate($value) {
        return is_numeric($value) && ($value = floatval($value)) >= -180 && $value <= 180;
    }

    // Helper method: Send cURL request without caching
    private static function _curl($endpoint, $params = []) {
        $url = self::$baseurl . $endpoint . '?' . http_build_query($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, "XGeo/1.0");
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }

    // Helper method: Send cURL request with caching
    private static function _cache_curl($endpoint, $params = [], $ttl = 60) {
        if (!is_numeric($ttl) || $ttl <= 0) {
            return self::_curl($endpoint, $params);
        }

        $cache_key = md5($endpoint . serialize($params));
        $cached_result = Cache::get($cache_key);
        if ($cached_result) {
            return $cached_result;
        }

        $result = self::_curl($endpoint, $params);
        Cache::set($cache_key, $result, intval($ttl));
        return $result;
    }
}

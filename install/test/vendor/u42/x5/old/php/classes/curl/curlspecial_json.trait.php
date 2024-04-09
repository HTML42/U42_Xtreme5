<?php

trait Curl_special_json {
    public static function special_json($url, $options) {
        $response = Curl_special::special($url, $options);
        return @json_decode($response, true);
    }
}

<?php

trait Curl_get_json
{
    public static function get_json($url)
    {
        $response = self::get($url);
        return @json_decode($response, true);
    }
}
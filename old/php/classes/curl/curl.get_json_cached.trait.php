<?php

trait Curl_get_json_cached
{
    public static function get_json_cached($url)
    {
        $response = self::get_cached($url);
        return @json_decode($response, true);
    }
}
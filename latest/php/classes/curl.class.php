<?php

class Curl
{
    public static function get($url)
    {
        if (is_string($url) && strlen($url) > 5) {
            $url = trim($url);
            ob_start();
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, false);
            $ch_exec = curl_exec($ch);
            //
            if (!$ch_exec && !App::config('offline_able'))
                self::error($ch, $url);
            //
            curl_close($ch);
            usleep(1);
            return ob_get_clean();
        }
        return '';
    }

    public static function get_cached($url, $ttl = 3600)
    {
        if (Cache::get($url, $ttl)) {
            return Cache::get($url, $ttl);
        } else {
            return Cache::set($url, self::get($url));
        }
    }

    public static function get_json($url)
    {
        $response = self::get($url);
        return @json_decode($response, true);
    }

    public static function get_json_cached($url)
    {
        $response = self::get_cached($url);
        return @json_decode($response, true);
    }

    public static function special($url, $options)
    {
        if (is_string($url) && strlen($url) > 5) {
            $url = trim($url);
            ob_start();
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt_array($ch, $options);
            $ch_exec = curl_exec($ch);
            //
            if (!$ch_exec && !App::config('offline_able'))
                self::error($ch, $url);
            //
            curl_close($ch);
            return ob_get_clean();
        }
        return '';
    }

    public static function special_json($url, $options)
    {
        $response = self::special($url, $options);
        return @json_decode($response, true);
    }

    public static function error($ch, $url = null)
    {
        $ch_header = curl_getinfo($ch);
        debug('Curl-Error | URL: ' . $url);
        debug($ch_header);
        debug(curl_error($ch));
        die;
    }
}

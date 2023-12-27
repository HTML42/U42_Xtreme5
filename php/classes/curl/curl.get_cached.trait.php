<?php

trait Curl_get_cached {
    public static function get_cached($url, $ttl = 3600) {
        if(Cache::get($url)) {
            return Cache::get($url);
        } else {
            return Cache::set($url, Curl::get($url));
        }
    }
}

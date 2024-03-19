<?php

trait Curl_error {
    public static function error($ch, $url = null) {
        $ch_header = curl_getinfo($ch);
        debug('Curl-Error | URL: ' . $url);
        debug($ch_header);
        debug(curl_error($ch));
        die;
    }
}
